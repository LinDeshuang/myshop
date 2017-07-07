var numberInput=document.getElementById('number');
var cart=document.getElementById('cart');

cart.addEventListener("click",Cart,false);
numberInput.addEventListener("change",validate,false);
function Cart(){
	this.preventDefault;
	var count=numberInput.value;
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

/*检验是否整数*/
function check(num){
	var patt=new RegExp('^\\d+$');
    var result=patt.exec(num);
    return result;
}
function validate(){
	var num=parseInt(this.value);
	var preNum=this.getAttribute('preNum');
	var price=document.getElementById('price').innerHTML.substring(1);
	var max=parseInt(this.getAttribute('max'));
	if(check(num)&&(num<=max)&&(num!=0))
	{
		this.setAttribute('preNum',num);
		var subprice=(num*price).toFixed(2);
		document.getElementById('subprice').innerHTML='￥'+subprice;
		
	}
	else
	{
		this.value=preNum;
	}
}


