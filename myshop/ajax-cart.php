<?php
 require "public/db.class.php";
 require "public/function.php";
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
        $merID=array_keys($cart);
        $merIDString=implode($merID, ',');
        $sql="select merID,name,price,discount,cover,inventory from merchandise where merID in ({$merIDString})";
        $allRows=$db->query($sql);
        echo "<table class='table table-hover'>";
        echo "<tr><th>商品</th><th>商品名</th><th>数量</th></tr>";
        foreach($allRows as $record)
        {
          extract($record);
          $count=$cart[$merID];
          echo "<tr>";
          echo "<td><a href='good-detail.php?merID={$merID}'><img src='{$cover}'/></a></td>";
          echo "<td>{$name}</td>";
          echo "<td>{$count}</td>";
          echo "</tr>";
        }
        echo "</table>";
     }
     else
     {
     	echo "<p>您的购物车空空如也!</p>";
     }
	}
	else
	{
	 session_start();
	 if(isset($_SESSION['cart']) and (!empty($_SESSION['cart'])))
	 {
	 	$db=new DB('shop14131');
	    $cart=$_SESSION['cart'];
	    $merID=array_keys($cart);
        $merIDString=implode($merID, ',');
        $sql="select merID,name,price,discount,cover,inventory from merchandise where merID in ({$merIDString})";
        $allRows=$db->query($sql);
        echo "<table class='table table-hover'>";
        echo "<tr><th>商品</th><th>商品名</th><th>数量</th></tr>";
        foreach($allRows as $record)
        {
          extract($record);
          $count=$cart[$merID];
          echo "<tr>";
          echo "<td><a href='good-detail.php?merID={$merID}'><img src='{$cover}'/></a></td>";
          echo "<td>{$name}</td>";
          echo "<td>{$count}</td>";
          echo "</tr>";
        }
        echo "</table>";
	 }
	 else
	 {
	 	echo "<p>您的购物车空空如也</p>";
	 }
}
?>