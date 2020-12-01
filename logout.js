//build ajax funcion and then call after get click informaion
function logoutAjax(event){

	$.post("logout.php",JSON.stringify({
		"token":token,
	}),function(data,status){
		if(data.success){
			alert("Successfully logout!");
			user = "";
			token = "";
			updateCalendar();

			$("#logout").addClass("hidden");
			$("#create").addClass("hidden");
			$("#loginButton").removeClass();
			$("#signupform").removeClass();
			$("#username").removeClass();
			$("#password").removeClass();
			$("#share").addClass("hidden");
			$("#tagChange").addClass("hidden");
			$("#event_details").text("");
			document.getElementById('userid').innerHTML ="";
		}else{
			alert(data.message);
		}
	},"json");
}

document.getElementById("logout").addEventListener("click", logoutAjax, false);
