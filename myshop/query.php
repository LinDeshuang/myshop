<?php
 require "check-user.php";
 require "public/db.class.php";
 require "public/function.php";
 if(!empty($_POST))
 {
 	extract($_POST);         
    $condition="where $type like '%{$value}%'";
 }
 else
 {
 	$data=isset($_GET['data'])?$_GET['data']:'*';
 	if($data!='*')
 	{
 	  $condition="where name like '%{$data}%' or year like '%{$data}%' or  team like '%{$data}%'  or type like '%{$data}%' or introduction like '%{$data}%'";
 	}
 	else
 	{
 		$condition='';
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
	<aside>
     <?php
      $category=category();
      $nav=outputCateNav($category);
      echo $nav;
     ?>
	</aside>
	<section>
		<?php
          $sql="select count(*) from merchandise ".$condition;
		  $rows=getRow($sql);
		  $pageSize=8;
		  $page=isset($_GET['page'])? $_GET['page']:1;
	      outputInfo($rows,$page,$pageSize);
	      ?>
	  <div class="content">
	  	  <?php
		  if($rows>0)
		  {
			 $offset=($page-1)*$pageSize; 
	         $pageSql="select * from merchandise ".$condition."order by merID desc limit $offset,$pageSize";           
			 $pageRecords=getPageRecords($pageSql);
			 outputGoods($pageRecords);
		  }
		  ?>
	  </div>
	  <?php
		  if($rows>$pageSize)
		  {
			  $pages=ceil($rows/$pageSize);
			  $target="query.php";
			  outputNav($pages,$page,$target);
		  }
		?>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?> 
<?php
 $sql="select * from merchandise";
 $db=new DB('shop14131');
 $result=$db->query($sql);
 var_dump($result);
?> 
</body>
<script src="js/ajax.js"></script>
<script src="js/index.js"></script>
</html>