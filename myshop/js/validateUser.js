var user=document.getElementById("user");
var registerForm=document.getElementById("registerForm");
var pwd=document.getElementById("pwd");
var confirmPwd=document.getElementById("confirmPwd");
var checkPwd=document.getElementById("checkPwd");
var checkConfirm=document.getElementById("checkConfirm");
var register=document.getElementById("register");
var checkUser=document.getElementById("checkUser");
var input=document.getElementsByTagName("input");
for(i=3;i<=6;i++)
{
	if(i==3)
	{
        input[i].addEventListener("focus",checkU,false);
        input[i].addEventListener("input",check,false);
	}
	else
	{
		input[i].addEventListener("focus",checkU,false);
		input[i].addEventListener("focus",check,false);
	}

}
confirmPwd.addEventListener("input",confirm,false);
user.addEventListener("input",validateUser,false);
function validateUser()
{  
  var userText=user.value;
  var url="register.php?user=" + userText; 
  ajaxGet(url,callback);
}
function callback(){
	if(xhr.readyState==4)
	{
		if(xhr.status==200)
		{
			var response=xhr.responseText;					
			checkUser.style.marginLeft="2em";					
			if(response==1)
			{
				user.style.border="1px solid green";
				checkUser.style.color="green";
				checkUser.firstChild.nodeValue="√ ,此用户名可以使用!";
				register.style.background="#6699CC";
			    register.disabled = false;
			}
			else
			{
				user.style.border="1px solid red";
				checkUser.style.color="red";
				checkUser.firstChild.nodeValue="× ,此用户名已经被占用!";
			    register.style.background="#aaa";
				register.disabled = true;
			}
		}
	}
}

function checkU(){
	if(user.value=='')
	{
		user.style.border="1px solid red";
		checkUser.style.color="red";
		checkUser.innerHTML="请先输入用户名";
	    register.style.background="#aaa";
		register.disabled = true;
		user.focus();
	}
	else
	{
		user.style.border="1px solid #ddd";
		checkUser.innerHTML="";
		register.style.background="#6699CC";
	    register.disabled = false;		
	}
}
function check(){
  	if(pwd.value=='')
	{
	    pwd.style.border="1px solid red";
	    checkPwd.style.color="red";
	    checkPwd.innerHTML="请先输入密码";
	    register.style.background="#aaa";
	    register.disabled = true;
	    pwd.focus();   
	}
	else if((pwd.value.length<6) || (pwd.value.length>20) )
	{
        pwd.style.border="1px solid red";
        checkPwd.style.color="red";
        checkPwd.innerHTML="密码长度错误，长度在6~20位之间";
        register.disabled = true;
        register.style.background="#aaa";
        pwd.focus();
	}
	else
	{
	  	pwd.style.border="1px solid #ddd";
	    checkPwd.innerHTML="";
	    register.style.background="#6699CC";
	    register.disabled = false;
	}
}
function confirm(){  

    if( pwd.value!=confirmPwd.value)
	{
		pwd.style.border="1px solid red";
		confirmPwd.style.border="1px solid red";
		checkConfirm.style.color="red";
		checkConfirm.innerHTML="密码验证失败，两次输入密码不一样";
		register.style.background="#aaa";
	    register.disabled = true;
		confirmPwd.focus();  
    }
    else
    {
         pwd.style.border="1px solid green";
	     confirmPwd.style.border="1px solid green";
	     checkConfirm.style.color="green";
	     checkConfirm.innerHTML="密码验证成功";
	     register.style.background="#6699CC";
         register.disabled = false;
    } 
}


