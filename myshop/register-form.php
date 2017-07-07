<?php
 require "check-user.php";
  if(isset($_SERVER['HTTP_REFERER']))
   {
	session_start();
	$_SESSION['refer']=$_SERVER['HTTP_REFERER'];
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
	<section class="register">
	<div class="normal-form">
	 <h1>用户注册</h1>
	 <p class="tip"></p>
	 <form id="registerForm" action="register.php" method="post">
	     <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户名：</label>
		 <input type="text" id="user" name="user" size="20" required placeholder="输入用户名" /><br/>
		 <span id="checkUser"> </span><br/>
		 <label>请设置密码：</label>
		 <input type="password" name="pwd" id="pwd" size="20" required placeholder="输入密码，不少于6位" minlength="6" maxlength="20" /><br/>
		 <span id="checkPwd"> </span><br/>
		 <label>请确认密码：</label>
		 <input type="password" name="confirmPwd" id="confirmPwd" size="20" required placeholder="再次输入密码" minlength="6" maxlength="20"/><br/>
		 <span id="checkConfirm"> </span><br/>
         <label>&nbsp;&nbsp;联系手机：</label>
		 <input type="tel" name="phone" size="20" required placeholder="输入联系手机"/><br/>
		 <label>&nbsp;&nbsp;收货地址：</label>
		 <input type="text" name="address" size="40" required placeholder="输入收货地址"/><br/>
		 <input type="submit" id="register" value="立即注册" />
	 </form>
	</div>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
<script type="text/javascript" src='js/ajax.js'></script>
<script type="text/javascript" src='js/validateUser.js'></script>
</html>