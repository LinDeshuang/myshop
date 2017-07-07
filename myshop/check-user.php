<?php
$userLoginOrNotInfo="<span>您好，欢迎来到本店!</span><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><a href='login-form.php'>登录</a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><a href='register-form.php'>注册</a>";
if(isset($_COOKIE['user']))
{
	$user=$_COOKIE['user'];
	$userLoginOrNotInfo="<span>{$user}</span>您好,欢迎来到本店!<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><a href='register-form.php'>注册</a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><a href='logout.php'>退出</a>";
}
?>