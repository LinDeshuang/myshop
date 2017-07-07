var input=document.getElementsByClassName("number");
var deleteGood=document.getElementsByClassName("deleteGood");
for(var i=0;i<input.length;i++)
{
	input[i].addEventListener("change",update,false);
}
for(var i=0;i<input.length;i++)
{
  deleteGood[i].addEventListener("click",Delete,false);
}
function Delete(){
  var merID=this.getAttribute("merID");
  var subTotal=parseFloat(this.parentNode.previousElementSibling.childNodes[0].nodeValue.substr(1));
  var count=parseInt(this.parentNode.previousElementSibling.previousElementSibling.childNodes[0].value);
  var preTotalCount=parseInt(document.getElementById("totalCount").innerHTML);
  var preTotal=parseFloat(document.getElementById("total").innerHTML.substr(1));
  var newTotalCount=preTotalCount-count;
  var newTotal=(preTotal-subTotal).toFixed(2);
  if(confirm('是否删除该商品？'))
  {
    severUpdate(merID,0);
    this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
    document.getElementById("totalCount").innerHTML=newTotalCount;
    document.getElementById("total").innerHTML='￥'+newTotal;
   }
}

/*检验是否整数*/
function check(num){
  var patt=new RegExp('^\\d+$');
    var result=patt.exec(num);
    return result;
}
//通知服务器端更新购物车信息的函数
function severUpdate(merID,count){
	var url="addToCart.php?merID="+merID+"&count="+count;
  ajaxGet(url,callback);
}
function update(){
    //获取对购物车更新所需的各个参数
	  var count=this.value;
	  var preSubTotal=parseFloat(this.parentNode.nextSibling.childNodes[0].nodeValue.substr(1));
  	var preTotal=parseFloat(document.getElementById("total").innerHTML.substr(1));
  	var price=parseFloat(this.parentNode.previousSibling.childNodes[0].nodeValue.substr(1));
  	var preTotalCount=parseInt(document.getElementById("totalCount").innerHTML);
  	var preCount=parseInt(this.getAttribute("preCount"));
  	var merID=this.getAttribute("merID");
    var max=this.getAttribute('max');
	if(check(count)==null)
	{
      this.value=preCount;
	}
  else if(parseInt(count)>parseInt(max))
  {
    this.value=preCount;
  }
	else if(check(count)=='0')//如果数量为0，则询问是否删除商品
	{
		if(confirm('是否删除该商品？'))
		{
        //在前端删除该条记录，计算新的数量总计和价格总计，并通知服务器删除该记录
        var newCount=0;
		    severUpdate(merID,newCount);
  		  var newTotal=(preTotal-preSubTotal).toFixed(2);
  		  var newTotalCount=preTotalCount-preCount;
  		  document.getElementById("total").innerHTML='￥'+newTotal;
  		  document.getElementById("totalCount").innerHTML=newTotalCount;
          this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
  		 }
  		 else
  		 {
  		 	this.value=preCount;
  		 }

	}

	else
	{
      //以下操作计算新的小计、数量总计和价格总计，并做修改
      var newCount=count-preCount;
	    severUpdate(merID,newCount);
      var newSubTotal=(count*price).toFixed(2);
      var newTotal=(newSubTotal-preSubTotal+preTotal).toFixed(2);
      var newTotalCount=preTotalCount+(count-preCount);
      document.getElementById("totalCount").innerHTML=newTotalCount;
      this.parentNode.nextSibling.childNodes[0].nodeValue='￥'+newSubTotal;
      document.getElementById("total").innerHTML='￥'+newTotal;
      this.setAttribute("preCount",count);
	}
}
function callback(){

}