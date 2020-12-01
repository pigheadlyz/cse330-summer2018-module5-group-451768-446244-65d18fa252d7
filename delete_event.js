function deleteevent(event){

	var id = document.getElementById("deleteEventid").value;

	var dataString = "id=" + encodeURIComponent(id);

	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "deleteevent.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.addEventListener("load", function(event){
		var Data = JSON.parse(event.target.responseText);
		if(Data.success){
			alert("You've Successfully delete the event");
		}else{
			alert("Failed "+Data.message);
		}

	}, false);
	xmlHttp.send(dataString);

}

document.getElementById("Delete_event").addEventListener("click", deleteevent, false);
