<?php
 require "public/db.class.php";
 $merID=$_GET['merID'];
 $count=$_GET['count'];
 if (isset($_COOKIE['user'])) 
 {
 	$user=$_COOKIE['user'];
    date_default_timezone_set('Asia/Shanghai');
 	$createTime=date("Y-m-d H:i");
 	$db=new DB('shop14131');
    $sql = "select * from cart where merID='$merID' and user='$user'";
    $row=$db->rowCount($sql);
    if($row)
    {
        if($count==0)
        {
            $sql1="delete from cart where merID='$merID' and user='$user'";
        }
        else
        {
            $sql1="update cart set count=count+$count where  merID='$merID' and user='$user' "; 
        }

    	$return=$db->exec($sql1);
    }
    else
    {
        $sql2="insert into cart values(null,'$merID','$user','$count','$createTime')";
        $return=$db->exec($sql2);
    }

    if ($return) 
    {
    	$response='1';
    }
    else
    {
        $response='0';
    }
    echo $response;
 }
 else
 {
    session_start();
    if(isset($_SESSION['cart']))
    {
        if(isset($_SESSION['cart'][$merID]))
        {
            if($count==0)
            {
              unset($_SESSION['cart'][$merID]);
            }
            else
            {
              $_SESSION['cart'][$merID]=$_SESSION['cart'][$merID]+$count;
            }
        }
        else
        {
            $_SESSION['cart'][$merID]=$_SESSION['cart'][$merID]+$count;
        }
    }
    else
    {
        $_SESSION['cart'][$merID]=$_SESSION['cart'][$merID]+$count;
    }
    $response='1';
    echo $response;
 }
?>