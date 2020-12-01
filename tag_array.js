/*function tag(event){
	var tag = document.getElementById("hidetag").value;
	var dataString = "tag=" + encodeURIComponent(tag);

	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", "tag_array.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //
	xmlHttp.addEventListener("load", function(event){
		var Data = JSON.parse(event.target.responseText);
		if(Data.success){
			alert("You've Successfully share the Calendar "+ "Tag name : "+ jsonData.tag);
		}else{
			alert("Failed "+jsonData.message);
		}

	}, false);
	xmlHttp.send(dataString);

}

document.getElementById("hide").addEventListener("click", tag, false); */
