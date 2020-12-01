//build login box
function show(){
    document.getElementById('loginbox').style.display="block";

}

function hide(){
	document.getElementById('loginbox').style.display="none";
}


document.getElementById("loginButton").addEventListener("click", show, false); 
document.getElementById("closeForm2").addEventListener("click", hide, false); 



