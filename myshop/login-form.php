<?php
 require "check-user.php";
  if(isset($_GET['loginError'])) 
  {    
    $loginError=$_GET['loginError'];   
  	if($loginError==0)
  	{
  		$tip='用户名不存在,请输入正确的用户名重新登录!';
  	}
  	else if($loginError==1)
  	{
  		$tip='密码错误,请输入正确的密码重新登录！';	 
  	}
  	else
  	{
  		$tip='验证码错误，请重新输入！';
  	} 
  }
  else
  {
   $tip=''; 	
   if(isset($_SERVER['HTTP_REFERER']))
   {
	session_start();
	$_SESSION['refer']=$_SERVER['HTTP_REFERER'];
   }
  } 
?>
<!DOCTYPE html>
<html>
<head>
	<title>商城主页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<?php
 include "public/home/home-header.php";
 include "public/home/home-logo-search.php";
?>

<div class="container">

	<section class="login">
		<div class="normal-form">
		   <h1>用户登录</h1>
		   <p class="tip">
		   	<?php
		   	 if(isset($_COOKIE['user']))
		   	 {
               header("Content-type:text/html;charset=utf-8");
               header("refresh:3;url='index.php'");
               echo("<p class='info'>已经登录！3秒后将跳转到商城主页,您也可点<a href='index.php'>这里</a>立即跳转</p>");
		   	 }
		   	 else
		   	 {
               echo $tip;
		   	 }
		   	?>
		   </p>
		   <form action="login.php" method="post" class="loginForm">	    
		     <label>用户名：</label>
			 <input type="text" name="user"  size="20" required placeholder="输入用户名"><br>
			 <label>&nbsp;&nbsp;密码：</label>
			 <input type="password" name="pwd" size="20" required placeholder="输入密码"><br>
			 <label>验证码：</label>
			 <input type="text" name="code" placeholder="请输入验证码" required /><br/>
        	 <img id="code" src="public/create_code.php" alt="看不清楚，换一张" onClick="create_code()"/>&nbsp;&nbsp;&nbsp;
       		 <a href="javascript:create_code();">看不清楚，换一张</a><br/>
			 <input type='checkbox' name='autoLogin'> <label>七天之内自动登录</label><br> 
			 <input type="submit" name='login' value="登录">	
			 <p>尚未注册？<a href="register-form.php">点击这里，前往注册</a></p>	
		  </form>
		</div>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
<script>
function create_code(){
    document.getElementById('code').src = 'public/create_code.php?'+Math.random()*10000;
}
</script>
</body>
<script src="js/ajax.js"></script>
</html>