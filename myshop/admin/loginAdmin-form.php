  <?php
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
   $tip="";   	
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>登录后台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
	html,body{
		width: 100%;
		height: 100%;
	}
	html,body{
		background-color: #3366FF;
	}
	.container{
		margin: 100px auto;
		width: 30%;
		text-align: center;
	}
	.container h1{
		margin: 2px auto;
		color: white;
	}
	.container form{
		margin:10px auto;
		width: 100%;
		height: 450px;
		background-color: #336699;
		color: white;
	}
	.container form p{
		color:yellow;
	}
	.container form a{
		color: white;
		text-decoration:none; 
	}
	.container form input{
		margin: 20px auto;
		width: 60%;
		height: 30px;
		border: solid 1px #ddd; 
	    border-radius: 5px;
	}
	.container form input[type="submit"]{
		width: 100px;
	}
	.container form input[type="submit"]:hover{
		color: white;
        background-color: #3366FF;
        cursor: pointer;
	}
	#code{
		width: 100px;
		cursor: pointer;
		vertical-align:middle;
		z-index: 100;
	}
</style>
<body>
<div class="container">
    <h1>管理员登录</h1>
	<form method="post" action="loginAdmin.php">
	    <p><?php  
           echo $tip;
	     ?></p>
		<label>管理员：</label>
		<input type="text" name="admin" required placeholder="请输入登录名"/><br/>
		<label>密码&nbsp;&nbsp;&nbsp;：</label>
		<input type="password" name="pwd"  required placeholder="请输入密码" /><br/>
		<label>验证码：</label>
		<input type="text" name="code" placeholder="请输入验证码" required /><br/>
        <img id="code" src="../public/create_code.php" alt="看不清楚，换一张" onClick="create_code()"/>&nbsp;&nbsp;&nbsp;
        <a href="javascript:create_code();">看不清楚，换一张</a><br/>
		<input type="submit" value="登录" /><br/>
		<a href="../index.php">返回商城</a>
	</form>
<script>
function create_code(){
    document.getElementById('code').src = '../public/create_code.php?'+Math.random()*10000;
}
</script>
</div>
</body>
</html>