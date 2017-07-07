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
	<script type="text/javascript" src='js/animation.js'></script>
</head>
<body>
<?php
 include "public/home/home-header.php";
 include "public/home/home-logo-search.php";
?>
<div class="container">
	<aside>
     <?php
      $category=category();
      $nav=outputCateNav($category);
      echo $nav;
     ?>
	</aside>
	<section id='container'>
	 <div id="wrapper"> 
	  <div id="box"> 
	  <img src="images/banner1.jpg"/> 
	  <img src="images/banner2.jpg"/> 
	  <img src="images/banner3.jpg"/>
	  <img src="images/banner4.jpeg"/> 
	  </div> 
	  <div id="pointer"> 
	  <span class="active"></span> 
	  <span></span> 
	  <span></span> 
	  <span></span> 
	  </div> 
     </div> 
	</section>
	<section class="main">
		<h2>新品推荐<a href="query.php">更多>></a></h2>
		<section>
		<?php			
		 newGoods(10);
		?>
		</section>
	</section>
</div>
<?php
 include "public/home/home-footer.php";
?>  
</body>
<script src="js/ajax.js"></script>
<script src="js/index.js"></script>
</html>