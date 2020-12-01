
$.ajaxSetup({
	async : false
});


//https://classes.engineering.wustl.edu/cse330/index.php?title=JavaScript_Calendar_Library
//Full Version http://classes.engineering.wustl.edu/cse330/content/calendar.js

var listOfMonths= ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
// For our purposes, we can keep the current month in a variable in the global scope
var currentMonth = new Month(2018, 6); //July 2018

user = "";

//call updateCalendar()
updateCalendar();

document.getElementById("prev_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	// alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);


// Change the month when the "next" button is pressed
document.getElementById("next_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	// alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);


function getMonthlyEvents(){
	personalEventDays = [];
	groupEventDays = [];
	if(user!=""){
		$.post("show_month_event.php",JSON.stringify({
			year:currentMonth.year,
			month:currentMonth.month+1,
			username:user,
			token:token,
		}),function(data,status){
			if(data.success){
				personalEventDays = data.date;
				groupEventDays = data.group;
			}else{
				alert(data.message);
			}
		},"json");
	}
}

// This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
// it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
// https://www.w3schools.com/js/js_date_methods.asp
function updateCalendar(){

	var d = new Date();
	var today = d.getDate();
	thisMonth = d.getMonth();
	var thisYear = d.getFullYear();


	var weeks = currentMonth.getWeeks();
	var month = currentMonth.month;
	var year = currentMonth.year;
	getMonthlyEvents();

	//https://stackoverflow.com/questions/3450593/how-do-i-clear-the-content-of-a-div-using-javascript
	document.getElementById("calendar-days").innerHTML=" ";
	document.getElementById("calender-header").innerHTML = listOfMonths[month] + " " + year;

	var countDays=0;
	var countWeeks=0;
	var display;
	var divName;

   //Display day blocks
   if (countDays >= 0 && countWeeks >= 0) {
   for(var w in weeks){
   		//days contains normal JavaScript Date objects.
	var days = weeks[w].getDates();
     countWeeks++;

     //get the number of week and use css to display the table
     display = '<div class="week"' +countWeeks+ '>';

	for(var d in days){
		 // You can see console.log() output in your JavaScript debugging tool, like Firebug,
		 // WebWit Inspector, or Dragonfly.
		 //console.log(days[d].toISOString());
         if(days[d].getMonth()==month){
         countDays++;
         divName = "day";
         if (today == countDays && thisMonth == month && thisYear == year) {
                divName+=" today";
        }
        if (personalEventDays.indexOf(countDays)!==-1||groupEventDays.indexOf(countDays)!==-1) {
                divName+=" eventDay";
        }

        //get the days
         display += '<div class="'+ divName+'"> <div class="calendar">'+days[d].getDate()+'</div></div>';
         }else{
            //display empty days
        display += '<div class="blank"><div class="calendar"></div></div>';
         }
		}

      display += '</div>';
      document.getElementById("calendar-days").innerHTML += display;
		}
	}

	//print all the events
	if(user!=""){
		showevents();
	}
}
