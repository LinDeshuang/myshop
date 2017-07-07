<?php
require "check-admin.php";
require "../public/db.class.php";
require "../public/function.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看所有订单</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
		 <p>当前位置：查看所有订单</p>
		</div>

		<?php
	        $db=new DB('shop14131');
	        $sql="select count(*) from orders";
	        $rows=getRow($sql);
		    $pageSize=4;
			$page=isset($_GET['page'])? $_GET['page']:1;
		    if($rows>0)
		    {
		       $offset=($page-1)*$pageSize; 
		       $pageSql="select orderID,userID,address,total,deliverMode,paymentMode,createTime,orderState from orders order by orderID desc limit $offset,$pageSize";
		       $pageRecords=getPageRecords($pageSql);
		       echo "<h2>所有订单信息如下</h2>";
		       outputInfo($rows,$page,$pageSize);
	           echo "<table class='table table-hover table-bordered order-list'>";
	           echo "<tr><th>订单号</th><th>用户名</th><th>商品</th><th>配送方式</th><th>支付方式</th><th>收货地址</th><th>下单时间</th><th>总价</th><th>订单状态</th></tr>";
	           foreach ($pageRecords as $value) 
	           {
	        	extract($value);
	        	echo "<tr>";
	        	echo "<th>{$orderID}</th>";
	        	$sql="select user from user where userID=$userID";
	        	$result=$db->query($sql);
	        	$user=$result[0]['user'];
	        	echo "<td>{$user}</td>";
	        	$sql="select merchandise.merID,count,cover,name from suborders inner join merchandise on suborders.merID=merchandise.merID  where orderID=$orderID";
	        	$result=$db->query($sql);
	        	echo "<td class='good-imgs'>";
	        	foreach ($result as $value) 
	        	{
	        		extract($value);
	        		echo "<a href='../good-detail.php?merID={$merID}' title='{$name}' target='_blank'><img src='../{$cover}'/><p class='btn btn-default'>{$count}</p></a>";
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
				  $target="allOrders.php";
				  outputNav($pages,$page,$target);
			  }
		    }
	        else
	        {
	        	echo "<p class='info'>目前没有任何订单记录！</p>";
	        }
		?>
	</section>
</div>
</body>
</html>