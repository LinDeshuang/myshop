var address=document.getElementById('address');
var newAddress=document.getElementById('newAddress');
var addressText=document.getElementById('addressText');
addressText.disabled=true;
address.addEventListener("click",changeStatue,false);
newAddress.addEventListener("click",changeStatue,false);
addressText.addEventListener("change",changeValue,false);

function changeStatue(){
   var id=this.id;
   if(id=='address')
   {
     addressText.disabled=true;
   }
   else
   	{
      addressText.disabled=false;
   	}
}

function changeValue(){
	var val=this.value;
	newAddress.value=val;
}
