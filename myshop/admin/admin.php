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
</head>
<body>
<?php
 include "../public/admin/admin-header.php"
?>
<div class="container">
	<?php
	include "../public/admin/admin-nav.php"
	?>
	<iframe src="welcome.php" name="iframe-a" seamless="seamless"></iframe>
</div>
<?php
 include "../public/admin/admin-footer.php"
?>
</body>
<script type="text/javascript" src="../js/admin.js"></script>
</html>