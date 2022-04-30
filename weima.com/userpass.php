<?php
session_start();
$username = $_POST['username'];



//连接数据库用来验证是否有相对应的车主
include 'connect.php';
//防止sq注入
check_param($username);


mysqli_select_db ($db,"www.jinhong.com");
mysqli_query($db,"set names utf8");
if(!$db){
	die('数据库连接失败');
}
$sql="select * from `www.jinhong.com`.`fa_user` where username = '$username' ";
$rst=mysqli_query($db,$sql);
//var_dump($rst);
//print_r($rst);
//转换接收到的信息代入相对应的数据名称
while($rs=mysqli_fetch_assoc($rst))
{
//var_dump($rs);
$rows=$rs['username'];
$nickname=$rs['nickname'];
}
//var_dump($rows);

//登陆信息的确定
if($rows!== null){
    echo "<script> alert('验证正确 ， 请再次确定当前登录的账号是：$rows  车主姓名是：$nickname ');</script>"; 
    $_SESSION['name']=$nickname;
    $_SESSION['username']=$rows;
    header("refresh:1;url=./index.php");
}else if($rows== null){
    echo "请再次确定，当前车辆信息车牌不存在!";
    header("refresh:5;url=./user.php");//输入错误跳转登录页面
    die;
    
}


