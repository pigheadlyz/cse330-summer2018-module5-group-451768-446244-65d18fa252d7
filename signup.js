//build ajax funcion and then call after get click informaion
function createuser(event){

	var username = document.getElementById("newusername").value;
	var password = document.getElementById("newpassword").value; 

	$.post("signup.php",JSON.stringify({
		"username":encodeURIComponent(username),
		"password":encodeURIComponent(password),
	}),function(data,status){
		if(data.success){
			alert("Successfully Create the user!");
		}else{
			alert(data.message);
		}
	},"json");

	document.getElementById('signupbox').style.display="none";
}

document.getElementById("signup").addEventListener("click", createuser, false);
