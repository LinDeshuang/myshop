<?php
 require "check-user.php";
 require "public/db.class.php";
 require "public/function.php";
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
	 if(!isset($_COOKIE['user']))
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
	 else
	 {
	   $user=$_COOKIE['user'];
	   $db=new DB('shop14131');
	   $sql="select phone,address from user where user='$user'";
	   $result=$db->query($sql);
	 ?>
	   <form method='post' action='create-order.php'>
	   <h2>收货相关信息</h2>
	   <div class='user-info'>
	   <p>用户：<span><?php echo $user; ?></span></p>
	   <p>联系电话：<span><?php echo $result[0]['phone']; ?></span></p>
	   <p>地址：
	         <input type='radio' name='address' id='address'  checked value='<?php echo $result[0]['address'];?>'/>
	         <label for='address' class='btn btn-primary'>使用默认收货地址</label>
	         <span>&nbsp;&nbsp;<?php echo $result[0]['address']?></span>
	         <input type='radio' name='address' id='newAddress' value='新收货地址'/>
	         <label for='newAddress' class='btn btn-primary'>使用新收货地址</label>
	         <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='addressText' required/></span>
	         </p>
	   <p>支付方式：
             <input type='radio' name='paymentMode' id='payment1' value='货到付款' checked/>
             <label for='payment1' class='btn btn-primary'>货到付款</label>
             <input type='radio' name='paymentMode' id='payment2' value='微信支付'/>
             <label for='payment2' class='btn btn-primary'>微信支付</label>
             <input type='radio' name='paymentMode' id='payment3' value='支付宝支付'/>
             <label for='payment3' class='btn btn-primary'>支付宝支付</label>
	         </p>
	   <p>快递方式：
             <input type='radio' name='deliverMode' id='deliverMode1' value='顺丰快递' checked/>
             <label for='deliverMode1' class='btn btn-primary'>顺丰快递</label>
             <input type='radio' name='deliverMode' id='deliverMode2' value='韵达快递'/>
             <label for='deliverMode2' class='btn btn-primary'>韵达快递</label>
             <input type='radio' name='deliverMode' id='deliverMode3' value='EMS快递'/>
             <label for='deliverMode3' class='btn btn-primary'>EMS快递</label>
	         </p>
	   </div>
	   <h2>商品信息</h2>
	   <?php
	   $sql="select ID,cart.merID,name,price,discount,inventory,cover,count from merchandise JOIN cart on merchandise.merID=cart.merID where cart.merID in (select merID from cart where user='$user') order by cart.ID DESC";
	   $result=$db->query($sql);
	   if($result)
	   {
		   echo "<table class='table table-hover table-striped table-hover cart-list'>";
		   echo "<tr><th>商品</th><th>商品名</th><th>价格</th><th>数量</th><th>小计</th></tr>";
	       $total=0;
	       $totalCount=0;
	       $disabled=0;
		   foreach($result as $record)
	        {
	          extract($record);
	          if($count>$inventory)
	          {
	          	 $disabled=1; 
	          	 header("refresh:5;url='cart.php'");
	             echo("<p class='info'>{$name}库存不足,请重新选购该商品，正在返回购物车，您也可点<a href='cart.php'>这里</a>立即跳转</p>");  	 
	          }
	          $price=round($price*$discount,2);
	          $subTotal=$price*$count;
	          echo "<tr>";
	          echo "<td><a href='good-detail.php?merID={$merID}'><img src='{$cover}'/></a></td>";
	          echo "<td>{$name}</td>";
	          echo "<td>￥{$price}<span>({$discount}折)</span></td>";
	          echo "<td>{$count}</td>";
	          echo "<td>￥{$subTotal}</td>";
	          echo "</tr>";
	          $total+=$subTotal;
	          $totalCount+=$count;
	        }
	        echo "</table>";
	        echo "<div class='total'>
	              <p>共<span id='totalCount'>{$totalCount}</span>件球衣，总计：<span id='total'>￥{$total}</span></p>&nbsp";
	        echo "<input type='hidden' name='total' value='{$total}'/>";
	         if($disabled==1)
	         {
	           echo "<input type='submit' value='提交订单' class='btn btn-warning' disabled/>";
	         }
	         else
	         {
	           echo "<input type='submit' value='提交订单' class='btn btn-warning'/>";
	         }
	        echo "</div>";
	        echo "</form>";	   	
	   }
	   else
	   	{
	   	    header("Content-type:text/html;charset=utf-8");
	        header("refresh:3;url='cart.php'");
	        echo("<p class='info'>购物车是空的！3秒后将跳转到购物车,您也可点<a href='cart.php'>这里</a>立即跳转</p>");
	   	}

	 }
	?>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
<script src="js/order.js"></script>
</html>