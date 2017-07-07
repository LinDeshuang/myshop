var xhr;
if (window.XMLHttpRequest)
{
    //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    xhr=new XMLHttpRequest();
}
else
{
    // IE6, IE5 浏览器执行代码
    xhr=new ActiveXObject("Microsoft.XMLHTTP");
}
function ajaxGet(url,callback){
	xhr.open("get",url,true);
    xhr.onreadystatechange=callback;
    xhr.send(null);
}
function ajaxPost(url,callback,param){
	xhr.open("post",url,true);
    xhr.onreadystatechange=callback;
    xhr.send(param);
}

/*加入购物车的方法*/
function addToCart(merID,count,callback){
	var url="addToCart.php?merID="+merID+"&count="+count;
    ajaxGet(url,callback);

}


var myCart=document.getElementById("myCart");
var a=myCart.childNodes[0];
var span=myCart.childNodes[1];
a.addEventListener("mouseover",test,false);
span.addEventListener("mouseover",showCart,false);
myCart.addEventListener("mouseout",hideCart,false);
function test(){
    url="ajax-cart.php";
    ajaxGet(url,function(){
        if(xhr.readyState==4)
    {
        if(xhr.status==200)
        {
            var response=xhr.responseText;
            span.style.display="block";
            span.innerHTML=response;
        }
    }
    });
}
function showCart(){
    span.style.display="block";
}
function hideCart(){
    span.style.display="none";
}