<?php
 require "check-admin.php";
 require "../public/db.class.php";
 require "../public/function.php";
 if(isset($_GET['merID']))
 {
 	$merID=$_GET['merID'];
 	$db=new DB('shop14131');
 	$sql="delete from merchandise where merID=$merID";
 	$result=$db->exec($sql);
 	if($result)
 	{
		echo "<script>alert('删除成功');window.location.href='goods.php'</script>";
 	}
 	else
 	{
		echo "<script>alert('删除失败');window.location.href='goods.php'</script>";
 	}
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看商品</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：查看商品</p>
		</div>
		 <?php  
	      $sql="select count(*) from merchandise";
		  $rows=getRow($sql);
		  $pageSize=3;
		  $page=isset($_GET['page'])? $_GET['page']:1;
	      outputInfo($rows,$page,$pageSize);
		  if($rows>0)
		  {
			 $offset=($page-1)*$pageSize; 
	         $pageSql="select * from merchandise limit $offset,$pageSize";           
			 $pageRecords=getPageRecords($pageSql);
			 outputPageTable($pageRecords);
		  }
		  if($rows>$pageSize)
		  {
			  $pages=ceil($rows/$pageSize);
			  $target="goods.php";
			  outputNav($pages,$page,$target);
		  }
		 ?>

	</section>
</div>
</body>
<script type="text/javascript" src="../js/admin-other.js"></script>
</html>