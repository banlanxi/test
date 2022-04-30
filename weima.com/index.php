<!DOCTYPE html>
<?php
session_start();
//session值的读取:
$username = $_SESSION['username'];
$nickname = $_SESSION['name'];
$key=array();
// 判断是否登录
if(!isset($_SESSION['username'])){
    $error = "请先登录";
    header("Location: user.php");
}
echo"当前识别车牌号为$username 车主姓名是：$nickname";
?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no"/>
    <title>扫描二维码</title>
    <style>
        video {
            display: block;
            margin: 0 auto;
            width: 240px;
            height: 240px;
            background: #000;
            border-radius: 5px;
        }
        div{ margin-top:10px}/* css注释说明：对div都设置上间距10px */ 
        .divcss5-1{font-size:16px}/* 设置css字体大小16px */ 
        .divcss5-2{color:#F00}/* 设置css字体颜色为红色 */ 
        .divcss5-3{ background:#000; color:#FFF}/* 设置CSS背景颜色为黑色和字体颜色为白色 */ 
        .divcss5-4{ border:1px solid #F00; height:60px}/* 设置css边框和CSS高度60px */ 
    </style>
</head>


<body>



<div id="video"></div>
<div>
    <button id="open">打开二维码扫描</button>
</div>
<div>
    <button id="close">关闭二维码扫描</button>
</div>
<div>
<div class=".bootstrap-frm " id="result">
    

<form id="form" name="form" method="POST" action="indexchuli1.php">
<a>秘钥01输入:<input type="text" id="count1" name="1" value=""/></a>
<a>秘钥02输入:<input type="text" id="count2" name="2" value=""/></a>
<a>秘钥03输入:<input type="text" id="count3" name="3" value=""/></a>
<a>秘钥04输入:<input type="text" id="count4" name="4" value=""/></a>
<p>秘钥05输入:<input type="text" id="count5" name="5" value=""/></a>
<a>秘钥06输入:<input type="text" id="count6" name="6" value=""/></a>
<a>秘钥07输入:<input type="text" id="count7" name="7" value=""/></a>
<a>秘钥08输入:<input type="text" id="count8" name="8" value=""/></p>
<p>秘钥09输入:<input type="text" id="count9" name="9" value=""/></a>
<a>秘钥10输入:<input type="text" id="count10" name="10" value=""/></a>
<a>秘钥11输入:<input type="text" id="count11" name="11" value=""/></a>
<a>秘钥12输入:<input type="text" id="count12" name="12" value=""/></p>
<p>秘钥13输入:<input type="text" id="count13" name="13" value=""/></a>
<a>秘钥14输入:<input type="text" id="count14" name="14" value=""/></a>
<a>秘钥15输入:<input type="text" id="count15" name="15" value=""/></a>
<a>秘钥16输入:<input type="text" id="count16" name="16" value=""/></p>
<p>秘钥17输入:<input type="text" id="count17" name="17" value=""/></a>
<a>秘钥18输入:<input type="text" id="count18" name="18" value=""/></a>
<a>秘钥19输入:<input type="text" id="count19" name="19" value=""/></a>
<a>秘钥20输入:<input type="text" id="count20" name="20" value=""/></p>
<p>秘钥21输入:<input type="text" id="count21" name="21" value=""/></a>
<a>秘钥22输入:<input type="text" id="count22" name="22" value=""/></a>
<a>秘钥23输入:<input type="text" id="count23" name="23" value=""/></a>
<a>秘钥24输入:<input type="text" id="count24" name="24" value=""/></p>
<p>秘钥25输入:<input type="text" id="count25" name="25" value=""/></a>
<a>秘钥26输入:<input type="text" id="count26" name="26" value=""/></a>
<a>秘钥27输入:<input type="text" id="count27" name="27" value=""/></a>
<a>秘钥28输入:<input type="text" id="count28" name="28" value=""/></p>
<p>秘钥29输入:<input type="text" id="count29" name="29" value=""/></a>
<a>秘钥30输入:<input type="text" id="count30" name="30" value=""/></a>
<a>秘钥31输入:<input type="text" id="count31" name="31" value=""/></a>
<a>秘钥32输入:<input type="text" id="count32" name="32" value=""/></p>
<input type="submit" name="Submit" value="提交"/>
</form>
</div>


<div class="divcss5-1" id="result">
<!-- 设计一个好看的界面 -->
<div class="divcss5-2" id="result">
<div class="divcss5-3" id="result">
<div class="divcss5-4" id="result">
<div class="divcss5-5" id="result">

    <?
    //连接数据库
$db=mysqli_connect("localhost","www.jinhong.com","2827792","www.jinhong.com","3306");
mysqli_select_db ($db,"www.jinhong.com");
mysqli_query($db,"set names utf8");
//统计今日当前用户上传的票据数量
$sql="select * from `www.jinhong.com`.`fa_car_key` where `carnumber`='$username' and `jointime`>'$nowtime'";
$result=mysqli_query($db,$sql);
//输出总的票据数量
echo "今日当前用户上传的票据数量为：".mysqli_num_rows($result);
echo "<br>其中";
//接收到的票据根据不同种类的km分类
while($row=mysqli_fetch_assoc($result)){
    $key[$row['km']][]=$row;
}
//输出不同种类票据数量
foreach($key as $k=>$v){
    if($k==a){
        echo "1里票据数量为：".count($v)."<br>";
    }elseif($k==b){
        echo "1.5公里票据数量为：".count($v)."<br>";
    }elseif($k==c){
        echo "2公里票据数量为：".count($v)."<br>";
    }elseif($k==d){
        echo "2.5公里票据数量为：".count($v)."<br>";
    }elseif($k==e){
        echo "3公里票据数量为：".count($v)."<br>";
    }elseif($k==f){
        echo "3.5公里票据数量为：".count($v)."<br>";
    }elseif($k==g){
        echo "4公里票据数量为：".count($v)."<br>";
    }elseif($k==h){
        echo "4.5公里票据数量为：".count($v)."<br>";
    }elseif($k==i){
        echo "5公里票据数量为：".count($v)."<br>";
    }elseif($k==j){
        echo "5.5公里票据数量为：".count($v)."<br>";
    }elseif($k==k){
        echo "6公里票据数量为：".count($v)."<br>";
    }elseif($k==l){
        echo "6.5公里票据数量为：".count($v)."<br>";
    }elseif($k==m){
        echo "7公里票据数量为：".count($v)."<br>";
    }
}?>
</div>
</body>
<script src="qrscan.js"></script>
<script src="jsqr.js"></script>
<script>
    var ds = null;
    var scan = new QRScan('video');

    document.getElementById('open').onclick = function () {
        scan.openScan();
        ds = window.setInterval(function () {
            startScan();
        }, 1500);
    };

    document.getElementById('close').onclick = function () {
        scan.closeScan();
        
    };
    
    var re_div = document.getElementById('result');
    var number =1;
    
    function startScan() {
        scan.getImgDecode(function (res) {
            if (res && res.data) {
                
                
                //使得p是document.createElement('p') 创建一个的按钮p:
                var p = document.createElement('p');
               
                
                //用p.innerHTML存储解密后的数据
                //innerHTML 属性设置或返回表格行的开始和结束标签之间的 HTML。
                //可用于开关下列的
                //p.innerHTML = decodeURIComponent(res.data);

                //c.innerText = decodeURIComponent(res.data);

                //自动输入秘钥
                var te = document.getElementById("count"+number);  
                te.value = decodeURIComponent(res.data); 
                 
                //把获得的数据放到cookes中存好

                
                //在re_div列表中添加p项目：
                re_div.appendChild(p);
                //re_div.appendChild(c);

                //关闭扫描窗口   
                scan.closeScan();
                //使用 clearInterval() 来停止执行:
                window.clearInterval(ds);
                recall();
            }
        });
    };

    function recall(){
        scan.openScan();
        ds = window.setInterval(function () { 
            startScan();
        }, 1500);
        number=number+1;
        alert("成功输入，请输入下一个");
    };

</script>
<?php

?>
</html>
