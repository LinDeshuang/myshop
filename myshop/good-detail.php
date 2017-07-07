<?php
 require "check-user.php";
 require "public/db.class.php";
 $merID=isset($_GET['merID'])?$_GET['merID']:'';
 $db=new DB('shop14131');
 $sql="select * from merchandise where merID=$merID";
 $result=$db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>商城主页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/good-detail.css">
</head>
<body>
<?php
 include "public/home/home-header.php";
 include "public/home/home-logo-search.php";
?>
<div class="container">
	<section class="good-detail">
     <?php
      foreach ($result as $value) {
      	extract($value);
      	$realPrice=$price*$discount;
      	echo "<img src='{$cover}' alt='{$name}'/>";
      	echo "<table class='table' id='detail'>";
      	echo "<tr><th colspan='2'>{$name}</th></tr>";
      	echo "<tr><td >价格</td><td>￥{$price}</td></tr>";
      	echo "<tr><td>折扣</td><th class='discount'>{$discount}</th></tr>";
      	echo "<tr><td>折后价</td><th class='price' id='price'>￥{$realPrice}</th></tr>";
      	echo "<tr><td>球队</td><td>{$team}</td></tr>";
      	echo "<tr><td>年份</td><td>{$year}</td></tr>";
      	echo "<tr><td>简介</td><td>{$introduction}</td></tr>";
      	echo "<tr><td>小计</td><th class='price' id='subprice'>￥{$realPrice}</th></tr>";
        echo "<tr><td>数量</td><td><input type='number' id='number' value='1' max='{$inventory}' preNum='1'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>库存：{$inventory}</span></td></tr>";
      	echo "<tr><td colspan='2'><a class='btn btn-danger' id='cart' merID='{$merID}'>加入购物车</a></td></tr>";
      	echo "</table>";
      }
     ?>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/good-detail.js"></script>
</html>