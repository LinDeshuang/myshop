<?php
 require "public/db.class.php";
 if(!empty($_POST))
     {
        $user=$_COOKIE['user'];
     	extract($_POST);
     	$db=new DB('shop14131');
     	$sql="select userID from user where user='$user'";
     	$result=$db->query($sql);
     	$userID=$result[0]['userID'];
      date_default_timezone_set('Asia/Shanghai');
     	$date=date("Y-m-d H:i",time());
        $sql="insert into orders values(null,?,?,?,?,?,?,?)";
        $result=$db->prepare($sql,array($userID,$address,$total,$deliverMode,$paymentMode,$date,'待审核'));
        if($result)
        {
          $orderID=$db->lastInsertId("orderID");
          $sql="select cart.merID,inventory,count from merchandise JOIN cart on merchandise.merID=cart.merID where cart.merID in (select merID from cart where user='$user')";
          $result=$db->query($sql);
          foreach ($result as $value) 
          {
          	extract($value);
          	$sql="insert into suborders values(null,?,?,?)";
          	$result=$db->prepare($sql,array($merID,$count,$orderID));
          	if($result)
          	{
          	  $sql="update merchandise set inventory=inventory-{$count} where merID=$merID";
          	  $result=$db->exec($sql);
          	  if($result)
          	  {
          	  	$sql="delete from cart where user='$user' and merID=$merID";
          	  	$result=$db->exec($sql);
          	  	if($result)
          	  	{
          	  		$sql="select * from orders where orderID=$orderID";
          	  		$result=$db->query($sql);
          	  	}
          	  	else
          	  	{
          	  		$erro="删除购物车记录出错";
          	    }
          	  }	
          	  else
          	  {
          	  	$erro='更新库存发生错误';
          	  }
          	}
          	else
          	{
          		$erro='生成子订单发生错误';
          	}
          }
        }
        else
        {
        	    $erro='生成发生订单错误';
        }
      }
      if($result)
      {
         header("Content-type:text/html;charset=utf-8");
         header("refresh:2;url='order-detail.php?orderID={$orderID}'");
         echo("<p class='info'>订单提交成功！2秒后将跳转到订单详情页面,您也可点<a href='order-detail.php?orderID={$orderID}'>这里</a>立即跳转</p>");
      }
      else
      {
         header("Content-type:text/html;charset=utf-8");
         header("refresh:3;url='input-order.php'");
         echo("<p class='info'>订单提交失败！{$erro}，2秒后将跳转到订单信息输入页面,您也可点<a href='input-order.php'>这里</a>立即跳转</p>");
      }

?>