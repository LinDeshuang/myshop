<?php
setcookie("user",'',time()-1);
header("Content-type:text/html;charset=utf-8");
header("refresh:3;url='index.php'");
echo("<p class='info'>已退出当前登录帐号！3秒后将跳转到商城主页,您也可点<a href='index.php'>这里</a>立即跳转</p>"); 
?>