/*function showtag(){

		var tag = document.getElementById("showtag.php").value;
		var dataString = "tag=" + encodeURIComponent(tag);
		var xmlHttp1 = new XMLHttpRequest();
		xmlHttp1.open("POST", "showtag.php", true);
		xmlHttp1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp1.addEventListener("load", function(event){
			var data = JSON.parse(event.target.responseText);
			if (data.title.length>0){
				for(var i=0;i<data.title.length;i++){
					output = output + "id: " + data.id[i] + "<br>"  + "Date:  "+datenow + "<br>" + "Event Title:  "+data.title[i] + "<br>"+"Description:  "+data.body[i] + "<br>"+"Time:  "+ data.tme[i] + "<br><br>" ;
				}
			}
			else{
				output = output + "No Event!";
			}
			document.getElementById("myDialog").innerHTML = output;

		}, false);
		xmlHttp1.send(dataString);
		var x = document.getElementById("myDialog");
		x.open = true;
	}
document.getElementById("showtag").addEventListener("click", showtag, false); */
