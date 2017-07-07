
/*删除商品记录*/
function deleteGood(merID){
	confirm("是否删除？")
	{
		var page=document.getElementsByClassName('current-page')[0].innerHTML;
		window.location.href='goods.php?merID='+merID+'&page='+page;
	}
}

/*修改订单状态选择框的可用性*/
var radio=document.getElementsByClassName('radio');
for (var i = 0; i < radio.length; i++) 
{
   radio[i].addEventListener("click",changeDisabled,false);
}

function changeDisabled(){
	var val=this.value;
	if(val=='取消修改')
	{
      this.parentNode.lastChild.previousSibling.disabled=true;
	}
	else
	{
      this.parentNode.lastChild.previousSibling.disabled=false;
	}
}