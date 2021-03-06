<?php
require "check-admin.php";
require "../public/db.class.php";
require "../public/function.php";
if(!empty($_POST))
{
   $db=new DB('shop14131');
  foreach ($_POST as $key => $value)
  {
  	$state=substr($key,0,5);
  	if($state=='state')
  	{
  		$orderID=substr($key,5);
  		$orderState=$value;
        $sql="update orders set orderState='{$orderState}' where orderID='{$orderID}'";
        $result=$db->exec($sql);
        if(!$result)
        {
    	  break;
        }
  	}
  }
  if($result)
  {
  	 echo "<script>alert('提交成功！')</script>";
  }
  else
  {
  	echo "<script>alert('提交出错！')</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>订单处理</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
</head>
<body>
<div class="container">
	<section>
		<div class="position">
		 <p>当前位置：订单处理</p>
		</div>

		<?php
	        $sql="select count(*) from orders where orderState!='待审核'";
	        $db=new DB('shop14131');
	        $rows=getRow($sql);
		    $pageSize=3;
			$page=isset($_GET['page'])? $_GET['page']:1;
		    if($rows>0)
		    {
		       $offset=($page-1)*$pageSize; 
		       $pageSql="select orderID,userID,address,total,deliverMode,paymentMode,createTime,orderState from orders where orderState!='待审核' order by orderID desc limit $offset,$pageSize";
		       $pageRecords=getPageRecords($pageSql);
		       echo "<h2>待处理订单信息如下</h2>";
		       outputInfo($rows,$page,$pageSize);
   		       echo "<form method='post' action='ordersHandling.php'>";
	           echo "<table class='table table-hover table-bordered order-list'>";
	           echo "<tr><th>订单号</th><th>用户名</th><th>商品</th><th>配送方式</th><th>支付方式</th><th>收货地址</th><th>下单时间</th><th>总价</th><th>订单状态</th><th>订单处理</th></tr>";
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
	    		echo "<td width='150px'>
	    		      <input class='radio' id='radio1{$orderID}' name='radio{$orderID}' type='radio' value='修改状态' required/>
                      <label for='radio1{$orderID}' class='btn btn-primary'>修改状态</label><br/>
	        	      <input class='radio' id='radio2{$orderID}' name='radio{$orderID}' type='radio' value='取消修改' required checked/>
	        	      <label for='radio2{$orderID}' class='btn btn-warning'>取消修改</label>
		              <select id='state{$orderID}' name='state{$orderID}' required disabled/>
		               <option value='商家已接单'>商家已接单</option>
		               <option value='已发货'>已发货</option>
		               <option value='延迟发货'>延迟发货</option>
		               <option value='包裹正在路上'>包裹正在路上</option>
		               <option value='审核未通过'>审核未通过</option>
		              </select>
		    	      </td>";
	        	echo "</tr>";          
	           }
	           echo "</table>";
	           echo "<input class='btn btn-danger' type='submit' value='提交'/>";
	           echo "</form>";
			  if($rows>$pageSize)
			  {
				  $pages=ceil($rows/$pageSize);
				  $target="ordersHandling.php";
				  outputNav($pages,$page,$target);
			  }
		    }
	        else
	        {
	        	echo "<p class='info'>目前没有已审核的订单！</p>";
	        }
		?>
	</section>
</div>
</body>
<script type="text/javascript" src="../js/admin-other.js"></script>
</html>