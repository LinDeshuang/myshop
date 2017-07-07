<?php
require "check-admin.php";
require "../public/db.class.php";
require "../public/function.php";
$category=category();
if(!empty($_POST))
{
	 header("Content-type:text/html;charset=utf-8");
	$db=new DB('shop14131');
	if($_POST['childCate']!=null)
	{
		$childCate=$_POST['childCate'];
		$sql="delete from category where category='$childCate'";
		$result=$db->exec($sql);
		if($result)
		{
			echo "<script>alert('删除成功');window.location.href='category.php'</script>";
		}
		else
		{
			echo "<script>alert('删除失败');window.location.href='category.php'</script>";
		}
	}
	else
	{
	    $parentCate=$_POST['parentCate'];
	    $sql="select cateID from category where category='$parentCate'";
	    $result=$db->query($sql);
	    $pID=$result[0]['cateID'];
	    $sql="delete from category where cateID=$pID or parentID=$pID";
	    $result=$db->exec($sql);
	    if($result)
		{
			echo "<script>alert('删除成功');window.location.href='category.php'</script>";
		}
		else
		{
			echo "<script>alert('删除失败');window.location.href='category.php'</script>";
		}
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看分类</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：查看分类</p>
		</div>
		<div class="content">
		<h4>所有分类</h4>
		<?php
           $table=outputCateTable($category);
           echo $table;
        ?>	
		</div>
		<div class='normal-form'>
		    <h3>删除分类（子分类未选择，则删除所选主分类及其子分类）</h3>
			<form method="post" action="category.php"  onsubmit="return deleteCate();">
				<?php
     			 $select=outputCateSelect($category);
                  echo $select;
				?>
				<input type="submit" value="删除" />
			</form>
		</div>
	</section>
</div>
</body>
<script type="text/javascript" src="../js/category.js"></script>
</html>