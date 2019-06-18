    $('document').ready(function() {
    	$("#datebuttonPrev a").trigger('click'); // When the Page is loaded we trigger a click
    });
     
    $('#datebuttonPrev').on('click', 'a', function(e) { // When click on a 'a' element of the pagination div
    	var weekvariable = this.id; // week-number is the id of the 'a' element
// PROBLEM: die wochen-variable kommt über die id des a-tags. aber wie kommt die jahres-variable?
// momentan semi-hardcoded via php, aber ich benötige eine browser-seitige lsung zur übergabe beim jahreswechsel    	
  
  // zum test das jahr mal hardcoded:
 var currentyearvariable = 2015;
    	var pagination = ''; // Init pagination
    	alert("test the trigger and show the week: "+weekvariable+" as well as the year: "+currentyearvariable)
    	$('#vsfmBoardArea').html('<img src="images/icon_54_trans.png" alt="img could not be shown" />'); // Display a processing icon 2do: change to colored-pdca-circle.gif, animated and on page-center
    	var data = {sel_week: weekvariable, sel_year: currentyearvariable}; //here we  Create JSON which will be sent via Ajax
    	
    	$.ajax({ // jQuery Ajax
    		type: 'POST',
    		url: 'jsPHP/ShopFloorDay.php', // URL to the PHP file which will query based on selected  value in the database
    		data: data, // We send the data string
    		dataType: 'json', // Json format
    		timeout: 3000,
    		success: function(data) {
    			$('#vsfmBoardArea').html(data.ShopFloorDayboard); // We update the vsfmBoardArea DIV with the data received from php/mysql-db-table
    			
    			// Pagination system: baut die seitenzahlen anhand der via ajay vom php geantworteten werte auf. hier: unnötig.  soll einfach woche und jahr wiedergeben.
    			// auch first und last sind unnötig. (anstelle seitenweise rumblättern zum suchen, lieber ein table-view und eine punktlandung zum week-year-vsfm-board via link...)

    			/*

    			if (weekvariable == 1) pagination += '<div class="cell_disabled"><span>Previous</span></div>';
    			else pagination += '<div class="cell"><a href="#" id="' + (weekvariable - 1) + '">Previous</span></a></div>';
     */
    		
    			if (weekvariable == 1) pagination += '<div class="cell_active"><span>Last Week in Previous Year</span></div>';
    			// benötige hier ajax-Anfrage mit letztem monat im vorherigem Jahr! 
    			else pagination += '<div class="cell"><a href="#" id="' + (weekvariable - 1) + '">Previous</span></a></div>';
// mod: if-else für seite 1 fiel erstmal raus. später evtl. fallunterscheidung für Jahreswechsel
				// pagination += '<div class="cell"><a href="#" id="' + (weekvariable - 1) + '">Previous</span></a></div>';
     
		    	
// orig:    			for (var i=parseInt(weekvariable)-3; i<=parseInt(weekvariable)+3; i++) {
    		
    		//mod: benötige keine weiteren zahlen. prev, ist,next, thisweek sind ausreichend:	
    			for (var i=parseInt(weekvariable); i<=parseInt(weekvariable)+3; i++) {	
    				if (i >= 1 && i <= data.weekyear) {
    					pagination += '<div';
    					if (i == weekvariable) pagination += ' class="cell_active"><span>' + i + '</span>';
    					else pagination += ' class="cell"><a href="#" id="' + i + '">' + i + '</a>';
    					pagination += '</div>';
    				}
    			}
     
    			if (weekvariable == data.weekyear) pagination += '<div class="cell_disabled"><span>Next</span></div><div class="cell_disabled"><span>This Week</span></div>';
    			else pagination += '<div class="cell"><a href="#" id="' + (parseInt(weekvariable) + 1) + '">Next</a></div><div class="cell"><a href="#" id="' + data.weekyear + '">This Week</span></a></div>';
    			
    			$('#vsfmBoardArea').html(pagination); // We update the pagination DIV
    			 
    		},
    		error: function() {
    			alert("error in .js - wahrscheinlich im php, js hatte so funktioniert + hardcoded angezeigt... ")
    		}
    	});
    	return false;
    });