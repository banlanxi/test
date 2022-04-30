<?php
session_start();


//session值的读取:
$username = $_SESSION['username'];
$nickname = $_SESSION['name'];
$time=time();
//预处理传过来的票据

//获得传过来多少票据,并把票据插入到$passkey数组中，并预处理$passkey数组
$times=0;
//记录此次执行多少成功上传
$realtimess=0;
$passkey=array();
function lastkey(){
    //传过来的数量
    global $times;
    //暂存key
    global $passkey;
    //有效地key
    global $realpasskeynull;
    //有效地key数量
    global $realtimes;
    $frequency=1;
    for($frequency=1;$frequency<33;$frequency++){
        array_push($passkey,$_POST[$frequency]);
        //判断不为空
        if(!empty($_POST[$frequency])){
            $times++;
        }   
     //去除重复的key并获得处理后的
    $realpasskey=array_unique($passkey);
    
    //去除为空的key
    $realpasskeynull=array_filter($realpasskey);
    //重新排序
    $realpasskeynull=array_merge($realpasskeynull);
    //获得不重复且不为空的数量
    $realtimes=count($realpasskeynull);
}

}
echo $now;
lastkey();
// echo $realtimes;
// var_dump($realpasskeynull);
checkenterkey($realtimes,$realpasskeynull,$time,$username);

 function checkenterkey($times,$realpasskey,$nowtime,$username){
    include 'connect.php';
    mysqli_select_db ($db,"www.jinhong.com");
    mysqli_query($db,"set names utf8");
    include 'redis.php';
    for($time=0;$time<$times;$time++){
    //获得当前redis中所有的set名词
    $redisname = $redis->keys('*');
    //查询value在哪个set中
    $redis_value = $redis->SISMEMBER($redisname[$time],$realpasskey[$time]);
    //如果在redis中，则查询是否是当前车主
    if($redis_value){
            echo "<script> alert('请检查此编号$realpasskey[$time]已使用,车牌是$redisname[$time]'); </script>";
    }
    //如果没有继续完成查询
    else{
    $sql = "select valid from `www.jinhong.com`.`fa_car_key` where keyword ='$realpasskey[$time]';";
    $rst=mysqli_query($db,$sql);
    while($arr=mysqli_fetch_assoc($rst))
	{   
		$valid[]=$arr['valid'];
		}
    //如果有效就继续操作 更改数据库 并存入redis
    if($valid[0]=='1'){
        //echo $time;
        $sql = "UPDATE `www.jinhong.com`.`fa_car_key` SET `jointime`=$nowtime ,`carnumber`='$username',`valid`='2' WHERE `valid`='1' AND `keyword`='$realpasskey[$time]';";
        $rst=mysqli_query($db,$sql);
        global $realtimess;
        $realtimess=$realtimess+1;
        $redis->SADD("$username", "$realpasskey[$time]");
        //设计过期时间
        $overtime=86400-date('H', $nowtime)*3600- date('i', $nowtime)*60-date('s')+$nowtime;
        $redis->expireAt("$username", $overtime);
        //添加到redis中
        $sql1 = "select `Id`,`key`,`km` from `www.jinhong.com`.`fa_car_key` where keyword ='$realpasskey[$time]';";
        $rst1=mysqli_query($db,$sql1);
        while($arr=mysqli_fetch_assoc($rst1))
        {
            $zId[]=$arr['Id'];
            $kmz[]=$arr['km'];
            $keyz[]=$arr['key'];       
        }   
        //更新redis
        $redis->SADD($username,$kmz[$time].$keyz[$time]);
        //设计过期时间
        $overtime=86400-date('H', $nowtime)*3600- date('i', $nowtime)*60-date('s')+$nowtime;
        $redis->expireAt("$username", $overtime);
    }
    //已经被兑现,写出兑换的车友是谁
    if($valid[0]=='2'){
        //echo $time;
        $sql = "select `carnumber`,`key`,`km` from `www.jinhong.com`.`fa_car_key` where keyword ='$realpasskey[$time]' and valid = '$valid[0]';";
        $rst=mysqli_query($db,$sql);
        while($arr=mysqli_fetch_assoc($rst))
	    {   
        $km[0]=$arr['km'];
        $key[0]=$arr['key'];
		$carnumber[0]=$arr['carnumber'];
        if($username==$carnumber[0]){
            global $realyou;
            $realyou=$realyou+1;
            echo null;
        }
        if($username!=$carnumber[0]){
            //将查询到的车主还有序号上传到redis中
            $redis->SADD("$carnumber[0]", "$km[0].$key[0]");  
            //设计过期时间
            $overtime=86400-date('H', $nowtime)*3600- date('i', $nowtime)*60-date('s')+$nowtime;
            $redis->expireAt("$carnumber[0]", $overtime);
            echo "<script> alert('请检查此编号$km[0].$key[0]已使用,车牌是$carnumber[0]'); </script>";
        }
		}
    }
    //无效的票 已经被删除了
    if($valid[0]=='0'){
        $sql = "select carnumber from `www.jinhong.com`.`fa_car_key` where keyword ='$realpasskey[$time]' and valid = '0';";
        $rst=mysqli_query($db,$sql);
        echo '此票无效';
    }
    }
  }
 }
echo "<script> alert('输入的票据有$times 个，其中不重复有 $realtimes,成功登记的有$realtimess ');history.go(-1); </script>";
?>