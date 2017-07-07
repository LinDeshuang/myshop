<?php
 require "check-user.php";
 require "public/db.class.php";
 require "public/function.php"
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
	<section class="main">
	<?php
	if(isset($_COOKIE['user']))
	{
		$user=$_COOKIE['user'];
		$db=new DB('shop14131');
		$sql="select userID from user where user='$user'";
		$result=$db->query($sql);
		$userID=$result[0]['userID'];
        $sql="select count(*) from orders where userID='$userID' order by orderID desc";
        $rows=getRow($sql);
	    $pageSize=4;
		$page=isset($_GET['page'])? $_GET['page']:1;
	    if($rows>0)
	    {
	       $offset=($page-1)*$pageSize; 
	       $pageSql="select orderID,address,total,deliverMode,paymentMode,createTime,orderState from orders where userID='$userID' order by orderID desc limit $offset,$pageSize";
	       $pageRecords=getPageRecords($pageSql);
	       echo "<h2>您的所有订单信息如下</h2>";
	       outputInfo($rows,$page,$pageSize);
           echo "<table class='table table-hover order-list'>";
           echo "<tr><th>订单号</th><th>商品</th><th>配送方式</th><th>支付方式</th><th>收货地址</th><th>下单时间</th><th>总价</th><th>订单状态</th></tr>";
           foreach ($pageRecords as $value) 
           {
        	extract($value);
        	echo "<tr>";
        	echo "<th>{$orderID}</th>";
        	$sql="select merchandise.merID,count,cover,name from suborders inner join merchandise on suborders.merID=merchandise.merID  where orderID=$orderID";
        	$result=$db->query($sql);
        	echo "<td class='good-imgs'>";
        	foreach ($result as $value) 
        	{
        		extract($value);
        		echo "<a href='good-detail.php?merID={$merID}' title='{$name}'><img src='{$cover}'/><p class='btn btn-default'>{$count}</p></a>";
        	}
        	echo "</td>";
        	echo "<td>{$deliverMode}</td>";
        	echo "<td>{$paymentMode}</td>";
        	echo "<td>{$address}</td>";
        	echo "<td>{$createTime}</td>";
        	echo "<td><span>￥{$total}</span></td>";
        	echo "<td>{$orderState}</td>";
        	echo "</tr>";          
           }
           echo "</table>";
		  if($rows>$pageSize)
		  {
			  $pages=ceil($rows/$pageSize);
			  $target="user-order.php";
			  outputNav($pages,$page,$target);
		  }
	    }
        else
        {
        	echo "<p class='info'>目前没有任何购物记录！&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' href='query.php?data=*'>现在就去购物</a></p>";
        }
	}
	else
	{
       header("Content-type:text/html;charset=utf-8");
	   header("refresh:3;url='login-form.php'");
	   echo("<p class='info'>尚未登录！3秒后将跳转到登录页面,您也可点<a href='login-form.php'>这里</a>立即跳转</p>");
	   if(isset($_SERVER['HTTP_REFERER']))
	   {
		session_start();
		$_SESSION['refer']=$_SERVER['HTTP_REFERER'];
	   }
	}
	?>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
<script src="js/ajax.js"></script>
</html>