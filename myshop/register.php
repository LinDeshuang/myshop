 <?php  
 require "public/db.class.php"; 
  session_start();
  $refer=$_SESSION['refer'];
  header("Content-type:text/html;charset=UTF-8"); 
  $user=isset($_GET['user'])?$_GET['user']:'';
  $db=new DB('shop14131');
  $sql="select count(*) from user where user=?";
  $stmt=$db->prepare($sql,array($user));
  $rows=$stmt->fetch(PDO::FETCH_NUM)[0];
  if($rows==1)
  {
  	$return=0;
  	echo $return;
  }
  else
  {

  	if(isset($_POST['user']) && isset($_POST['pwd']) && isset($_POST['phone']) && isset($_POST['address']))
  	{
  	 $user=$_POST['user'];
     $pwd=$_POST['pwd'];
     $pwd=md5($pwd);	  
     $phone=$_POST['phone'];
     $address=$_POST['address'];
     $sql="insert into user values(null,?,?,?,?)";
     $stmt=$db->prepare($sql,array($user,$pwd,$phone,$address));
     $rows=$stmt->rowCount();
     if($rows==1)
     {
      if(isset($_SESSION['cart']))
      {
        $cart=$_SESSION['cart'];
        foreach ($cart as $key => $value) 
        {
          $merID=$key;
          $count=$value;
          $createTime=date('Y-m-d H:m');
          $sql = "select * from cart where merID='$merID' and user='$user'";
          $row=$db->rowCount($sql);
          if($row)
          {
            $sql1="update cart set count=count+$count where  merID='$merID' and user='$user' ";
            $db->exec($sql1);
          }
          else
          {
            $sql2="insert into cart values(null,'$merID','$user','$count','$createTime')";
            $db->exec($sql2);
          }
        }
       unset($_SESSION['cart']);
      } 
     	unset($_SESSION['refer']);
     	setcookie("user",$user);	
        header("refresh:3;url=$refer");
        echo("注册成功,欢迎{$user}成为本站的会员！,3秒后将返回到您注册前所在的页面,您也可点<a href='$refer'>这里</a>立即返回");
     }
     else
	  {
	    header("refresh:3;url=register-form.php?registerError=1");
	    echo("注册失败!3秒后将重新返回到注册页面,如果您现在不想注册，也可点<a href='$refer'>这里</a>返回到您注册前的页面,稍后再注册"); 
	  }  		
  	}
  	else
  	{
  		$return=1;
  		echo $return;
  	}
  }  
 ?> 