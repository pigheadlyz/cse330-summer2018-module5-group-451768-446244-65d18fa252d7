////build ajax funcion and then call after get click informaion
$("#share").unbind("click").click(function(){
  $("#share_user").dialog({
    buttons: [
      {
        text: "share",
        click: function() {
          var otherUser = $("#share_user_input").val();
          $.post("share_calendar.php",JSON.stringify({
            "token":token,
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
