//build sign up box
function show(){
    document.getElementById('signupbox').style.display="block";

}

function hide(){
	document.getElementById('signupbox').style.display="none"; 
}


document.getElementById("signupform").addEventListener("click", show, false); 
document.getElementById("closeForm").addEventListener("click", hide, false); 




