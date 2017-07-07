var parentCate = document.getElementById('parentCate');
var childCate = document.getElementById('childCate');
var child=childCate.childNodes;
for(var i=0;i<child.length;i++)
{
	child[i].style.display="none";
}
parentCate.addEventListener("change",selectChildren,false);
function selectChildren(){
	var selected=this.options;
	for(var i=0;i<selected.length;i++)
	{
		if(selected[i].selected)
		{
			var level=selected[i].getAttribute("level");
		}
	}
	var children=childCate.options;
	for(var i=0;i<children.length;i++)
	{
		cLevel=children[i].getAttribute("level");
		if(cLevel==level)
		{		
			children[i].style.display="block";
		}
		else
		{
			children[i].style.display="none";
		}
	}
}
function deleteCate(){
	if(confirm("确认删除？"))
	{
		return true;
	}
	else
	{
		return false;
	}
}