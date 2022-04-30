<?php
include 'connect.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $key = $_POST['p'];
    $class = $_POST['class'];
    // if($_POST['log'] == "注册"){
    //     $sql = "INSERT INTO admin (username,password) VALUES ('{$username}','{$password}')";
    //     $data = $db->query($sql);
    //     echo "注册成功，请登录";
	// 	echo "<script> alert('注册成功 注册登录的账号是：$username  密码：$password ');parent.location.href='./user.php'; </script>";
    // }
}

check_param($key);
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $class = $_POST['class'];
    if($_POST['log'] == "注册"){
        $sql = "INSERT INTO admin (username,password) VALUES ('{$username}','{$password}')";
        $data = $db->query($sql);
        echo "注册成功，请登录";
		echo "<script> alert('注册成功 注册登录的账号是：$username  密码：$password ');parent.location.href='./user.php'; </script>";
    }
}





function getclassing($class){
    include 'connect.php';
    $rst=mingdan($class);
	mysqli_select_db ($db,"20210624");
	mysqli_query($db,"set names utf8");
    
    $i=0;

    while($arr=mysqli_fetch_assoc($rst))
	{   
        
        
		$arrTr[]=$arr['name'];
        $uid[]=$arr['uid'];
		$sql="INSERT INTO `20210624`.`ing` SET `name`='$arrTr[$i]',`class`='$class',`ing`='0',`uid`='$uid[$i]'";	
        //INSERT INTO `20210624`.`ing` SET `name`='李画',`class`='math',`ing`='1';
        //$sql="insert into '"".$table.""' set '字段1'='值1'，'字段2'='值2'";
        mysqli_query($db,$sql);
        $i++;
		}
	
}

getclassing($class);
//session赋值

 $_SESSION['one']=$username;
 $_SESSION['class']=$class;
//session值的读取:
///$one = $_SESSION['one'];
//session值的销毁
///unset($_SESSION['one']);

?>

