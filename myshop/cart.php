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
	if(isset($_COOKIE['user']))
	{
		 $user=$_COOKIE['user'];
	     $db=new DB('shop14131');
	     $sql="select * from cart where user='$user'";
	     $result=$db->query($sql);
	     if($result)
	     {
           foreach ($result as $value) 
	      {
	       $cart[$value['merID']]=$value['count'];
	      }
	      outputCart($cart);
	     }
	     else
	     {
	     	echo "<p class='info'>您的购物车空空如也！&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-danger' href='query.php?data=*'>现在就去购物</a></p>";
	     }
	}
	else
	{
	 session_start();
     if(isset($_SESSION['cart']) and (!empty($_SESSION['cart'])))
     {
       $cart=$_SESSION['cart'];
       outputCart($cart);	
     }
     else
     {
     	echo "<p class='info'>您的购物车空空如也</p>";
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
<script src="js/cart.js"></script>
</html>