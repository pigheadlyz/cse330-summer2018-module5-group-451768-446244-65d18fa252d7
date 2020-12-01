//build ajax funcion and then call after get click informaion
function loginAjax(event){

	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;

	$.post("login.php",JSON.stringify({
		"username":encodeURIComponent(username),
		"password":encodeURIComponent(password),
	}),function(data,status){
		if(data.success){
			alert("Successfully LogIn!");
			user = username;
			token = data.token;
			updateCalendar();

			//cheage botton class
			$("#username").addClass("hidden");
			$("#password").addClass("hidden");
			$("#loginButton").addClass("hidden");
			$("#signupform").addClass("hidden");
			$("#logout").removeClass();
			$("#create").removeClass();
			$("#share").removeClass();
			$("#tagChange").removeClass();

			document.getElementById('loginbox').style.display="none";
			document.getElementById('userid').innerHTML ="Welcome " + username;
		}else{
			alert(data.message);
		}
	},"json");
}

document.getElementById("login").addEventListener("click", loginAjax, false);
