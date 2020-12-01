//I really really appreciate the help from Jinhao Cui who teach me to write jquery step by step. It cost him lots of time to teach me a new language and debug for me! 
function showevents(){
	$.post("print_event.php",JSON.stringify({
		"token":token,
	}),function(data,status){
		if(data.success){
			$("#event_details").empty();
			if(data.time.length>0){
				for(i in data.time){
					var t = data.time[i].split(/(-| |:)/);
					if(t[2]==currentMonth.month+1){
						$("#event_details").append($("<div>").append($("<a>").text(data.time[i]+" : "+data.title[i]).addClass("tagClass"+data.tag[i]).addClass("events").attr("id","event"+data.id[i])));
						$("#event"+data.id[i]).unbind("click").click((function(i){
							return function(){
								$("#editTitle").val(data.title[i]);
								var t = data.time[i].split(/(-| |:)/);
								$("#eventTimeYear").val(t[0]);
								$("#eventTimeMonth").val(t[2]);
								$("#eventTimeDay").val(t[4]);
								$("#eventTimeHour").val(t[6]);
								$("#eventTimeMinute").val(t[8]);
								$("#editTag").val(data.tag[i]);
								$("#editSubmit").unbind("click").click(function(){
									if($("#editTitle").val()!==""){
										$.post("editevent.php",JSON.stringify({
											"token":token,
											"id":data.id[i],
											"title":$("#editTitle").val(),
								      "tagID":$('#editTag').val(),
											"date":$("#eventTimeYear").val()+"-"+$("#eventTimeMonth").val()+"-"+$("#eventTimeDay").val()+" "+$("#eventTimeHour").val()+":"+$("#eventTimeMinute").val()+":00 UTC"
										}),function(data,status){
											if(status==="success"){
												if(data.success){
													alert("modify successfully");
													$("#event_edit").dialog("close");
													updateCalendar();
												}else{
													alert(data.message);
												}
											}else{
												alert("server error");
											}
										},"json");
									}else{
										alert("title should not be empty");
									}
								});
								$("#editDelete").unbind("click").click(function(){
									$.post("deleteevent.php",JSON.stringify({
										token:token,
										id:data.id[i]
									}),function(data,status){
										if(status==="success"){
											if(data.success){
												alert("delete successfully");
												$("#event_edit").dialog("close");
												updateCalendar();
											}else{
												alert(data.message);
											}
										}else{
											alert("server error");
										}
									});
								});
								$("#editShare").unbind("click").click(function(){
									$("#share_user").dialog({
										buttons: [
							        {
							          text: "share",
							          click: function() {
							            var otherUser = $("#share_user_input").val();
							            $.post("share_event.php",JSON.stringify({
												    "token":token,
												    "id":data.id[i],
														"time":data.time[i],
														"title":data.title[i],
														"username":user,
														"othername":otherUser,
							            }),function(data,status){
						                if(data.success){
															alert("share success");
															$("#share_user").dialog("close");
						                }else{
															alert(data.message);
						                }
							            },"json");
							          }
							        }
							      ]
									});
								});
								$("#event_edit").dialog({
									 maxWidth:300,
    								 maxHeight:300,
    								 resizable: false
								});
							}
						})(i));
					}
				}
			}else{
				$("#event_details").text("no events now");
			}
		}else{
			alert(data.message);
		}
	},"json");
}
