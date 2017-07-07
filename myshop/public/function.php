<?php
/*与分类有关的方法*/

/*查询分类结果集*/
function category(){
    $db=new DB('shop14131');
    $sql="select * from category";
    $result=$db->query($sql);
    $return=categoryArray($result); 
    return $return;
}

/*获取分类信息，并给各分类分等级，输出为一维数组*/
function categoryArray($array,$pid=0,$level=0,&$result=array()){
	$level++;
	foreach ($array as $key => $value) 
	{
		if($value['parentID']==$pid)
		{
			$category=$value['category'];
			$result[]=array('level'=>$level,'category'=>$category);
			categoryArray($array,$value['cateID'],$level,$result);
		}
	}
	return $result;
}

/*输出主分类信息单选框*/
function outputMainCate($array=array()){
	$output="<select name='parent'><option  value='0' selected='selected'>0</option>";
	foreach ($array as $key => $value) 
	{
      if($value['level']==1)
      {
      	$output.="<option name='parent' value='{$value['category']}'>".$value['category']."</option>";
      }
	}
	return $output.'</select>';
}

/*输出分类信息单选框*/
function outputCateSelect($array=array()){
	        $parentCate="<select id='parentCate' name='parentCate'  required><option selected='selected'  level='0' value=''>请选择主分类</option>";
	        $childCate="<select id='childCate' name='childCate'><option selected='selected'  level='0' value=''>请选择子分类</option>";
	        $level=0;
         foreach ($array as $key => $value) 
         {
         	if($value['level']==1)
         	{
         		$level++;
         		$parentCate.="<option level='{$level}' value='{$value['category']}'>".$value['category']."</option>";
         		 
         	}
         	else
         	{
         		$childCate.="<option  level='{$level}' value='{$value['category']}'>".$value['category']."</option>";
         	}
         	
         }
         $output=$parentCate.'</select><br/>'.$childCate.'</select><br/>';
        return $output;
}

/*输出分类信息表格*/
function outputCateTable($array=array()){
	$output="<table class='table table-hover table-bordered'><tr><th>主分类</th><th colspan='8'>子分类</th></tr>";
	$tr='';
	$times=0;
	foreach ($array as $key => $value) 
	{
		if($value['level']==1)
		{
			$tr.="</tr><tr><th>".$value['category']."</th>";
			$times=0;
		}
		else
		{
			$times++;
			if(($times%9)==0)
			{
				$tr.="</tr><tr><th style='border-top:solid 4px #fff;'></th><td>".$value['category']."</td>";			
			}
			else
			{
				$tr.="<td>".$value['category']."</td>";
			}

		}
	}
		$tr=substr($tr, 5);
		$output.=$tr."</tr></table>";
		return $output;
}
function outputCateNav($array=array()){
	$output="<nav><ul><li>";
	$li='';
		foreach ($array as $key => $value) 
	{
		if($value['level']==1)
		{
			$li.="</ul><li><a>".$value['category']."</a><ul>";
		}
		else
		{
			$li.="<li><a href='query.php?data={$value['category']}'>".$value['category']."</a></li>";			
		}
	}
	$li=substr($li, 9);
	$output.=$li."</ul></li></ul></nav>";
	return $output;
}
/*与分类有关的方法*/

/*与商品和商品分页有关的方法*/
/*获取分页所需的记录条数*/
function  getRow($sql)
{  
 $db=new DB("shop14131"); 
 $rows=$db->getRows($sql);
 return $rows;
}

/*分页头部信息*/
function outputInfo($rows,$page,$pageSize)
{
  if($rows==0)
  {
   echo "<p class='info'>对不起,本站暂时还没有你要检索的商品</p>";		
  }
  else
  {
   $pages=ceil($rows/$pageSize);	
   echo "<p class='info'>共有{$rows}条记录,每页显示{$pageSize}条,共{$pages}页,当前为第{$page}页</p>";
  }
}
/*获取当前页的记录*/
function  getPageRecords($pageSql){ 
  $db=new DB("shop14131");
  $pageRecords=$db->query($pageSql); 
  return $pageRecords;
}

/*分页导航条*/
function outputNav($pages,$page,$target) { 
   $currentPage=$page; 
   $previousPage=$page-1; 
   $nextPage=$page+1;
   $frontO=($currentPage-2>1?'<span>...</span>':'');
   $lastO=($currentPage+2<$pages?'<span>...</span>':'');
   $previousPageNav=($previousPage<=0)?"<span class='btn btn-default'><<</span>":"<a href='$target?&page=$previousPage' class='btn btn-default'><<</a>";
   $nextPageNav=($nextPage>$pages)?"<span class='btn btn-default'>>></span>":"<a href='$target?&page=$nextPage' class='btn btn-default'>>></a>";  
   $pageList='';
   for($i=($currentPage-2>1?$currentPage-2:1);$i<=($currentPage+2<$pages?$currentPage+2:$pages);$i++)
    {
		 if($i==$currentPage)
		 {
			 $pageList.="<span class='page-list current-page'>{$i}</span>";
		 }
		 else
		 {
			 $pageList.="<a href='$target?&page=$i' class='page-list'>{$i}</a>";
		 }
    }
   echo "<p class='page-nav'>$previousPageNav$frontO$pageList$lastO$nextPageNav</p>";  
  }

/*输出当前页商品信息表格*/
 function outputPageTable($pageRecords){
 	echo "<table class='table table-hover table-bordered table-striped'><tr><th>商品ID</th><th>商品名称</th><th>所属球队</th><th>价格</th><th>折扣</th><th>年份</th><th>类型</th><th>库存</th><th>简介</th><th>图片</th><th>操作</th></tr>";
 	
 	foreach($pageRecords as $value) {
 		echo "<tr>";
 		extract($value);
 		echo "<td width='50px'>{$merID}</td>";
 		echo "<td width='70px'>{$name}</td>";
 		echo "<td width='70px'>{$team}</td>";
 		echo "<td width='40px'>{$price}</td>";
 		echo "<td width='40px'>{$discount}</td>";
 		echo "<td width='40px'>{$year}</td>";
 		echo "<td width='60px'>{$type}</td>";
 		echo "<td width='40px'>{$inventory}</td>";
 		echo "<td width='200px'>{$introduction}</td>";
 		echo "<td><img src='../{$cover}' /></td>";
 		echo "<td width='50px'><a href='javascript:deleteGood({$merID})' class='btn btn-danger'>删除</a></td>";
 		echo "<tr>";
 	}
 	echo "</table>";
 }
 /*输出用户信息表格*/
 function outputUserTable($pageRecords){
 	echo "<table class='table table-hover table-bordered table-striped'><tr><th>用户ID</th><th>用户名</th><th>手机号</th><th>地址</th></tr>";
 	foreach($pageRecords as $value) {
 		echo "<tr>";
 		extract($value);
 		echo "<td width='50px'>{$userID}</td>";
 		echo "<td width='60px'>{$user}</td>";
 		echo "<td width='60px'>{$phone}</td>";
 		echo "<td width='40px'>{$address}</td>";
 		echo "<tr>";
 	}
 	echo "</table>";
 }
/*与商品和商品分页有关的方法*/


/*输出最新商品*/
function newGoods($count){
	$db=new DB('shop14131');
	$sql="select * from merchandise where merID order by merID desc limit $count";
	$result=$db->query($sql);
	foreach ($result as $value) 
	{
		extract($value);
		echo "<div class='goods'>";
		echo "<a href='good-detail.php?merID={$merID}' target='_blank' title='{$name}' ><img src='{$cover}' /></a>";
		echo "<a href='good-detail.php?merID={$merID}' target='_blank' title='{$name}'>{$name}</a>";
		echo "<p>￥{$price}<span>({$discount}折)</span></p>";
		echo "<a class='btn btn-danger cart' merID='{$merID}' count='1'>加入购物车</a>";
		echo "</div>";
	}
}
/*输出分页商品*/
function outputGoods($pageRecords){
		foreach ($pageRecords as $value) 
	{
		extract($value);
		echo "<div class='goods'>";
		echo "<a href='good-detail.php?merID={$merID}' target='_blank' title='{$name}' ><img src='{$cover}' /></a>";
		echo "<a href='good-detail.php?merID={$merID}' target='_blank' title='{$name}' >{$name}</a>";
		echo "<p>￥{$price}<span>({$discount}折)</span></p>";
		echo "<a class='btn btn-danger cart'  merID='{$merID}' count='1'>加入购物车</a>";
		echo "</div>";
	}
}

/*输出购物车*/
function outputCart($cart){
	    $db=new DB('shop14131');
        $merID=array_keys($cart);
        $merIDString=implode($merID, ',');
        $sql="select merID,name,price,discount,cover,inventory from merchandise where merID in ({$merIDString})";
        $allRows=$db->query($sql);
        $total=0;
        $totalCount=0;
        echo "<h2>您的购物车记录如下</h2>";
        echo "<table class='table table-striped table-hover cart-list'>";
        echo "<tr><th>商品</th><th>商品名</th><th>价格</th><th>数量</th><th>小计</th><th>操作</th></tr>";
        foreach($allRows as $record)
        {
          extract($record);
          $count=$cart[$merID];
          $price=round($price*$discount,2);
          $subTotal=$price*$count;
          echo "<tr>";
          echo "<td><a href='good-detail.php?merID={$merID}'><img src='{$cover}'/></a></td>";
          echo "<td>{$name}</td>";
          echo "<td>￥{$price}<span>({$discount}折)</span></td>";
          if($count>$inventory)
          {
           echo "<td style='color:red'>商品库存不足，请重新选购该商品</td>";
          }
          else
          {
           echo "<td><input type='number' class='number' value='{$count}' max='{$inventory}' preCount='{$count}' merID='{$merID}'/></td>";
          }
          echo "<td>￥{$subTotal}</td>";
          echo "<td><a class='btn btn-danger deleteGood' merID='{$merID}' >删除</a></td>";
          echo "</tr>";
          $total+=$subTotal;
          $totalCount+=$count;
        }
        echo "</table>";
         echo "<div class='total'><p>共<span id='totalCount'>{$totalCount}</span>件球衣，总计：<span id='total'>￥{$total}</span></p>&nbsp<a href='input-order.php' class='btn btn-warning'>结算</a></div>";
}

/*库存减少*/
function inventoryReduce($merID,$count){
     $db=new DB('shop14131');

}
?>