<?php
require "../public/db.class.php";
session_start();
$admin=$_POST['admin'];
$pwd=$_POST['pwd'];
$pwd=md5($pwd); 
$code=$_POST['code'];
$verify=$_SESSION['code'];
if($verify!=$code)
{
   $loginError=2;
   header("refresh:3;url=loginAdmin-form.php?loginError=$loginError");
   echo("登录失败!3秒后将重新返回到登录页面，您也可点<a href='loginAdmin-form.php?loginError=$loginError'>这里</a>立即跳转");  
}
else
{
 $con=new DB('shop14131');
 $sql="select count(*) from admin where admin=? and pwd=?";
 $stmt=$con->prepare($sql,array($admin,$pwd));
 $rows=$stmt->fetch(PDO::FETCH_NUM)[0];
 header("Content-type:text/html;charset=utf-8");
 if($rows==1)
 {
  setcookie("admin",$admin,time()+60*60*2);
  header("refresh:3;url=admin.php");
  echo("登录成功！欢迎{$admin}回来，3秒后将进入后台管理页面,您也可点<a href='admin.php'>这里</a>立即跳转");   
 }
 else
 {   
   $sql="select count(*) from admin where admin=?";
   $stmt=$con->prepare($sql,array($admin));
   $rows=$stmt->fetch(PDO::FETCH_NUM);
   $rows=$rows[0]; 
   $loginError=$rows==0?0:1;  
   header("refresh:3;url=loginAdmin-form.php?loginError=$loginError");
   echo("登录失败!3秒后将重新返回到登录页面，您也可点<a href='loginAdmin-form.php?loginError=$loginError'>这里</a>立即跳转");  
 } 
}
	
?>