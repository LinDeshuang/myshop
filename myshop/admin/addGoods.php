<?php
require "check-admin.php";
require "../public/db.class.php";
if(!empty($_POST))
{
  extract($_FILES['file']); 
  $rand1=rand(0,9);
  $rand2=rand(0,9);
  $rand3=rand(0,9);
  $rand4=rand(0,9);
  $imgName=date("Ymdhm").$rand1.$rand2.$rand3.$rand4;
  $fileType=substr($name, strpos($name, '.'));
  $saveDir='../images/merchandise/'.$imgName.$fileType;
  if($size>1000000)
  {
    $tipInfo="文件太大无法上传";
  }
  else
  {
  	if(move_uploaded_file($tmp_name, $saveDir))
  	{
  		extract($_POST);
  		$db= new DB("shop14131");
  		$sql="insert into merchandise values(null,?,?,?,?,?,?,?,?,?)";
        $cover='images/merchandise/'.$imgName.$fileType;
  		$result=$db->prepare($sql,array($name,$team,$price,$discount,$cover,$year,$type,$introduction,$inventory));
  		if($result)
  		{
  			$tipInfo='上传成功！';
  		}
  		else
  		{
  			$tipInfo='上传失败！';
  		}
  	}
  }
}
else
{
	$tipInfo='';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加商品</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
			<p>当前位置：添加商品</p>
		</div>
		<div class="normal-form">
		 	    <p class="tip">
			    	<?php
                     echo $tipInfo;
			    	?>
			    </p> 		 
		 <form method="post" action="addGoods.php" enctype="multipart/form-data">
			<p class="tip"></p>
			<label>球衣名称：</label>
			<input type="text" name="name" required placeholder="输入球衣名称" /><br/>
			<label>所属球队：</label>
			<input type="text" name="team" required placeholder="输入球衣所属球队" /><br/>
			<label>年份&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：</label>
			<input type="text" name="year" required placeholder="输入球衣年份" /><br/>
			<label>球衣类型：</label>
			<input type="text" name="type" required placeholder="输入球衣类型" /><br/>
			<label>球衣价格：</label>
			<input type="text" name="price" required placeholder="输入球衣价格" /><br/>
			<label>球衣折扣：</label>
			<input type="text" name="discount" required placeholder="输入球衣价格" /><br/>
			<label>球衣简介：</label>
			<textarea name="introduction" maxlength="200" minlength="20" required placeholder="输入球衣简介"  required ></textarea><br/>
			<label>球衣库存：</label>
			<input name="inventory" required placeholder="输入球衣库存"/><br/>
			<label>球衣图片：</label>
			<input type="file" name="file" required /><br/>
			<input type="submit" value="添加">
		 </form>		
		</div>

	</section>
</div>
</body>
</html>