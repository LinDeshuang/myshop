<?php
 require "check-user.php";
 require "public/db.class.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>商城主页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<style type="text/css">
	.container	.main .user-info{
		width: 60%;
	}
	 .container	.main .user-info p{
        padding-left: 20px;
	 }
	 .container	.main .user-info h3{
	 	padding-left: 20px;
	 }
	 .container	.main .user-info p span{
        color: red;
        font-size: 20px;
	 }
	</style>
</head>
<body>
<?php
 include "public/home/home-header.php";
 include "public/home/home-logo-search.php";
?>
<div class="container">
	<section class="main">
	<?php
	    $db=new DB('shop14131');
	    $orderID=isset($_GET['orderID'])?$_GET['orderID']:'';
	    $user=$_COOKIE['user'];
        echo "<h2>订单提交成功，订单信息如下</h2>";
        $sql="select * from orders where orderID=$orderID";
        $result=$db->query($sql);
        extract($result[0]);
        echo "<div class='user-info'>";
        echo "<h3>订单号：{$orderID}</h3>";
        echo "<p>收货人：{$user}</p>";
        echo "<p>收货地址：{$address}</p>";
        echo "<p>付款方式：{$paymentMode}</p>";
        echo "<p>快递方式：{$deliverMode}</p>";
        echo "<p>总计：<span>￥{$total}<span></p>";
        echo "</div>";
	?>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
</html>