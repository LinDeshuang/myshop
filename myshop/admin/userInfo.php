<?php
 require "check-admin.php";
 require "../public/db.class.php";
 require "../public/function.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看用户所有信息</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：查看用户所有信息</p>
		</div>
		<h2>所有用户信息如下</h2>
		 <?php  
	      $sql="select count(*) from user";
		  $rows=getRow($sql);
		  $pageSize=8;
		  $page=isset($_GET['page'])? $_GET['page']:1;
	      outputInfo($rows,$page,$pageSize);
		  if($rows>0)
		  {
			 $offset=($page-1)*$pageSize; 
	         $pageSql="select * from user limit $offset,$pageSize";           
			 $pageRecords=getPageRecords($pageSql);
			 outputUserTable($pageRecords);
		  }
		  if($rows>$pageSize)
		  {
			  $pages=ceil($rows/$pageSize);
			  $target="userInfo.php";
			  outputNav($pages,$page,$target);
		  }
		 ?>

	</section>
</div>
</body>
</html>