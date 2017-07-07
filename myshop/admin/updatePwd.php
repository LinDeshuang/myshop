<?php
require "check-admin.php";
require "../public/db.class.php";
if(!empty($_POST))
{
    extract($_POST);
	$admin=$_COOKIE['admin'];
	$prePwd=md5($prePwd);
	$newPwd=md5($newPwd);
    $con=new DB('shop14131');
    $sql="select count(*) from admin where admin=$admin and pwd=?";
    $stmt=$con->prepare($sql,array($prePwd));
    $rows=$stmt->fetch(PDO::FETCH_NUM)[0];
    if($rows == 1)
    {
        $sql="update admin set pwd=? where admin=$admin";
        $stmt=$con->prepare($sql,array($newPwd));
        if($stmt)
        {
        	$tipInfo="修改成功";
        }
        else
        {
        	$tipInfo="修改失败";
        }
    }
    else
    {
    	$tipInfo="原密码错误，请重新输入！";
    }

}
else
{
	$tipInfo="";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>密码修改</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：管理员密码修改</p>
		</div>
		<div class="normal-form">
			    <p class="tip">
			    	<?php
                     echo $tipInfo;
			    	?>
			    </p>		
			<form method="post" action="updatePwd.php">
			    <label>原密码:</label>
				<input type="password" name="prePwd" required placeholder="请输入原密码" /><br/>
				<label>新密码:</label>
				<input type="password" name="newPwd" required placeholder="请输入新密码" /><br/>
				<input type="submit" class="btn btn-default" value="提交"/>
			</form>
		</div>
	</section>
</div>
</body>
</html>