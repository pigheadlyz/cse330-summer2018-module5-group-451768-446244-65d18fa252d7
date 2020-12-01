//build ajax funcion and then call after get click informaion
   function share_event(event){

	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var tag = document.getElementById("tag").value;

	$.post("share_calendar.php",JSON.stringify({
		"username":encodeURIComponent(username),
		"password":encodeURIComponent(password),
		"tag":encodeURIComponent(tag),
	}),function(data,status){
		if(data.success){
			alert("Successfully Share EVENT!");
		}else{
			alert(data.message);
		}
	},"json");
}

document.getElementById("share_event").addEventListener("click", share_event, false);