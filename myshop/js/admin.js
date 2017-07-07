var li=document.getElementsByTagName("nav")[0].firstElementChild.childNodes;
for(var i=0;i<li.length;i++)
{
	if(li[i].nodeType==1)
	{
		li[i].firstElementChild.onclick=function changeDisplay(){
																	var ul=this.nextElementSibling;
																	var disp=getStyle(ul,'display');
																	if(disp=="none")
																	{
																		show(ul);
																	}
																	else
																	{
																		hide(ul);
																	}
																}
	}	
}
function getStyle(dom, attr) {
    if (dom.currentStyle) 
    {
        return dom.currentStyle[attr];
    } 
    else 
    {
        return getComputedStyle(dom)[attr];
    }
}

function show(ele){
	ele.style.display="block";
}
function hide(ele){
	ele.style.display="none";
}



