<?php 
 require "public/db.class.php";
 session_start();
 $refer=$_SESSION['refer'];
 $user=$_POST['user'];
 $pwd=$_POST['pwd'];
 $pwd=md5($pwd);
 $code=$_POST['code'];
 $verify=$_SESSION['code'];
if($verify!=$code)
{
   $loginError=2;
   header("refresh:3;url=login-form.php?loginError=$loginError");
   echo("登录失败!3秒后将重新返回到登录页面,如果您现在不想登录，也可点<a href='$refer'>这里</a>返回到您登录前的页面,稍后再登录"); 
}
else
{
 $db=new DB('shop14131');
 $sql="select count(*) from user where user=? and pwd=?";
 $stmt=$db->prepare($sql,array($user,$pwd));
 $rows=$stmt->fetch(PDO::FETCH_NUM)[0];
 header("Content-type:text/html;charset=utf-8");
 if($rows==1)
 {
  if(isset($_POST['autoLogin']))
  {
   setcookie("user",$user,time()+60*60*24*7);
  }     
  else
  {
   setcookie("user",$user);
  } 
  if(isset($_SESSION['cart']))
  {
    $cart=$_SESSION['cart'];
    foreach ($cart as $key => $value) 
    {
      $merID=$key;
      $count=$value;
      $createTime=date('Y-m-d H:m');
      $sql = "select * from cart where merID='$merID' and user='$user'";
      $row=$db->rowCount($sql);
      if($row)
      {
        $sql1="update cart set count=count+$count where  merID='$merID' and user='$user' ";
        $db->exec($sql1);
      }
      else
      {
        $sql2="insert into cart values(null,'$merID','$user','$count','$createTime')";
        $db->exec($sql2);
      }
    }
    unset($_SESSION['cart']);
  } 
  unset($_SESSION['refer']);
  header("refresh:3;url=$refer");
  echo("{$user}登录成功！3秒后将返回到您登录前所在的页面,您也可点<a href='$refer'>这里</a>立即跳转");  
 }
 else
 {   
   $sql="select count(*) from user where user=?";
   $stmt=$db->prepare($sql,array($user));
   $stmt->execute(array($user));
   $rows=$stmt->fetch(PDO::FETCH_NUM)[0]; 
   $loginError=$rows==0?0:1;  
   header("refresh:3;url=login-form.php?loginError=$loginError");
   echo("登录失败!3秒后将重新返回到登录页面,如果您现在不想登录，也可点<a href='$refer'>这里</a>返回到您登录前的页面,稍后再登录");  
 }  
}
	
?>