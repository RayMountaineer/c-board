// onload = 
function functYearchange(e){ // When change of select dropdown value
    	var yearselectvariable = document.getElementById("jahreswechsel");
    	alert("popup-alert functYerachange in js/tuto-yearchange.js was triggered");
  alert(yearselectvariable.options[yearselectvariable.selectedIndex].text);
  
  //ok, alert mit jahreszahl poped-up on change
  var currentyearvariable =(yearselectvariable.options[yearselectvariable.selectedIndex].text);
// }
    	
// den tuto-pagination-teil anpassen und einfügen:
// start einfügen *******************************   

  //  $('#pagination').on('click', 'a', function(e) { // fällt beim jahreswechsel raus. anstelle wird hier ja bereits via onchange aus dem html-tag heraus die function getriggert... 
    // ... via jQuery: select this id within the tag with the id#:
    $('#pagination a').ready(function() {
  //var idofweekatag = this.id;
  // do something with it
  // alert("der idofweekatag sollte der week via dom entsprechen: "+ idofweekatag);
 //  alert($('#pagination a').attr('id'));
 var idofweekatag = parseInt($('#pagination a').attr('id')) +1;
alert("der idofweekatag sollte der week via dom entsprechen: "+ idofweekatag );
//  alert($('#pagination a').attr('id'));
/// });

// ok. next what 2do: 
// send ajax with data = key-value-pairs of week and year -> update div on success

	
    	var pagination = ''; // Init pagination
    	
    	$('#vsfmBoardArea').html('<img src="design/icon_54_trans.png" alt="" />'); // Display a processing icon 2do: change to colored-pdca-circle.gif, animated and on page-center
    	var data = {sel_week: idofweekatag, sel_year: currentyearvariable}; //here we  Create JSON which will be sent via Ajax
    	
    	$.ajax({ // jQuery Ajax
    		type: 'POST',
    		url: 'ajax/tuto-pagination.php', // URL to the PHP file which will query based on selected  value in the database
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
    			
    			$('#pagination').html(pagination); // We update the pagination DIV
    			 
    		},
    		error: function() {
    			alert("error in .js - wahrscheinlich im php, js hatte so funktioniert + hardcoded angezeigt... ")
    		}
    	});
    	return false;
   });

//
}
