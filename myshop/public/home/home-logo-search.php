<div class="search">
	<a href="index.php" class="logo" title="主页">
		<img src="images/logo.jpg" />
		<h1>球衣专卖店</h1>
	</a>
	<form name="search" method="post" action="query.php"> 
		<input type="text" name="value" required placeholder="请先选择搜索类型" />
		<select name="type">
			<option value="name">球衣名</option>
			<option value="team">球队</option>
			<option value="year">球衣年份</option>
			<option value="type">球衣类型</option>
			<option value="name">球星</option>
		</select>
		<input type="submit" value="搜索" />
	</form>
</div>