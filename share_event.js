//build ajax funcion and then call after get click informaion
   function share_event(event){

	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var othername = document.getElementById("othername").value;

	$.post("share_calendar.php",JSON.stringify({
    "token":token,
    "id":id,
		"username":encodeURIComponent(username),
		"password":encodeURIComponent(password),
		"othername":encodeURIComponent(othername),
	}),function(data,status){
		if(data.success){
			alert("Successfully Share EVENT!");
		}else{
			alert(data.message);
		}
	},"json");
}

document.getElementById("share_event").addEventListener("click", share_event, false);
