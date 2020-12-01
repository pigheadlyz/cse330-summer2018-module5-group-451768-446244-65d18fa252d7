//build ajax funcion to call addevent.php
$("#create").unbind("click").click(function(){
  $("#addTitle").val("");
  $('#tag option:selected').text();
  now = new Date();
  $("#addEventTimeYear").val(now.getFullYear());
  $("#addEventTimeMonth").val(now.getMonth()+1);
  $("#addEventTimeDay").val(now.getDay());
  $("#addEventTimeHour").val(now.getHours());
  $("#addEventTimeMinute").val(now.getMinutes());
  $("#addSubmit").unbind("click").click(function(){
    $.post("addevent.php",JSON.stringify({
      "token":token,
      "title":$("#addTitle").val(),
      "tagID":$('#tag option:selected').val(),
      "date":$("#addEventTimeYear").val()+"-"+$("#addEventTimeMonth").val()+"-"+$("#addEventTimeDay").val()+" "+$("#addEventTimeHour").val()+":"+$("#addEventTimeMinute").val()+":00",
    }),function(data,status){
        alert(data.message);
        if(data.success){
          $("#add_event").dialog("close");
          updateCalendar();
        }
    },"json");
  });
  $("#add_event").dialog({
    maxWidth:300,
    maxHeight:300,
    resizable: false
  });
});
