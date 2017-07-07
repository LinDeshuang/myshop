<?php
require "check-admin.php";
require "../public/db.class.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>商城后台管理</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/global.css"/>
	<script type="text/javascript">
	var day=new Array();
	day=['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
	function setTime(){
		var t=new Date();
	    var year=t.getFullYear();
	    var month=ten(t.getMonth()+1);
	    var date=ten(t.getDate());
	    var hours=t.getHours();
	    var minutes=ten(t.getMinutes());
	    var seconds=ten(t.getSeconds());
		var Day=t.getDay();
		document.getElementById('time').innerHTML='现在的时间是：'+year+'/'+month+'/'+date+'&nbsp;&nbsp;&nbsp;&nbsp;'+day[Day]+'&nbsp;&nbsp;&nbsp;&nbsp;'+hours+':'+minutes+':'+seconds;
	}
	function ten(n){
	    if(n<10)
	    {
	    	return '0'+n;
	    }
	    else
	    {
	    	return n;
	    }
	}
	setInterval('setTime()',1000);
	</script>
</head>
<body>
<div class="container">
	<div class="admin-tip">
		<h1>
		<?php echo "欢迎回来，管理员{$admin}"; ?>
		</h1>
		<h2 id="time"></h2>
		<h3>
        <?php
        $db=new DB('shop14131');
        $sql="select count(*) from orders where orderState='待审核'";
        $result=$db->getRows($sql);
        if($result!=0)
        {
        	echo "您有{$result}条新订单未审核 <a class='btn btn-success' href='checkOrders.php'>现在就去</a>";
        }
        else
        {
        	echo "";
        }
        ?>
		<h3>
	</div>
</div>
</body>
</html>