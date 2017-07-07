
var cart=document.getElementsByClassName('cart');
for(var i=0;i<cart.length;i++)
{
	cart[i].addEventListener("click",Cart,false);
}
function Cart(){
	this.preventDefault;
	var count=this.getAttribute('count');
    var merID=this.getAttribute('merID');
	addToCart(merID,count,callback);
}
function callback(){
	if(xhr.readyState==4)
	{
		if(xhr.status==200)
		{
			var response=xhr.responseText;
         if(response)
         {
               if(confirm("添加成功，是否前往购物车结算？（继续购物点击取消）"))
               {
               	window.location.href="cart.php";
               }
               else
               {
                 retrun;
               }
         }
          else
         {
        	alert('添加失败');
         }
		}
	}
}
