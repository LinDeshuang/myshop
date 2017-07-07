<?php
require "check-admin.php";
require "../public/db.class.php";
require "../public/function.php";
if(!empty($_POST))
{
  $parent=$_POST['parent'];
  $category=$_POST['category'];
  $db=new DB('shop14131');
  $sql="select * from category where category='$category'";
  $result=$db->getRows($sql);
  if($result==false)
  {
	  if($parent=='0')
	  {
	  	$sql="insert into category values(null,?,?)";
	  	$result=$db->prepare($sql,array($category,0));
	  	if($result)
	  	{
	  		$tipInfo="添加成功";
	  	}
	  	else
	  	{
	  		$tipInfo="添加失败";
	  	}
	  }
	  else
	  {
	  	$sql="select cateID from category where category='$parent'";
	  	$row=$db->getRows($sql);
	  	$parentID=$row;
	  	$sql="insert into category values(null,?,?)";
	  	$result=$db->prepare($sql,array($category,$parentID));
	  	if($result)
	  	{
	  		$tipInfo='添加成功';
	  	}
	  	else
	  	{
	  	    $tipInfo='添加失败';

	  	}
	  	
	  }
  }
  else
  {
  	$tipInfo="该分类已存在，请重新输入";
  }
}
else
{
  $tipInfo='0代表顶级分类，即主分类';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加分类</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：添加分类</p>
		</div>
		<div class="normal-form" >
		 <p class="tip">
			    	<?php
                     echo $tipInfo;
			    	?>
	     </p> 
		 <form method="post" action="addCate.php" >
			<label>父级分类：</label>
			<?php
			 $cate=category();
			 $output=outputMainCate($cate);
             echo $output;
			?><br/>
			<label>分类名：</label>
			<input type="text" name="category" placeholder="输入分类名" required /><br/>
			<input type="submit" value="添加" />
		 </form>
		</div>
	</section>
</div>
</body>
</html>