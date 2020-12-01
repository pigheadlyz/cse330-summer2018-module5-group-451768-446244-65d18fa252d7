//build box for change and then call ajax function 
$("#tagChange").unbind("click").click(function(){
  $("#tag_dialog").dialog();
});

for(var i = 0;i<4;i++){
  $("#checkbox"+i).unbind("click").click((function(i){
    return function(){
      if($("#checkbox"+i).prop("checked")){
        $(".tagClass"+i).removeClass("hidden");
      }else{
        $(".tagClass"+i).addClass("hidden");
      }
    }
  })(i));
}
