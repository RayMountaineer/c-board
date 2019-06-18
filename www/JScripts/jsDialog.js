function CheckJarray () {
	while( api-- ) {
    if(jarray[api].ap === apEntryString ) break;
		}


	if (api == '-1')
	
		 { StartDialog(apEntryString);}
}

CheckJarray();


function StartDialog (apEntryString) {
	 		
$(document).ready(function() {
	$("#box").dialog({
		title: "This is a new Entry!",
		width: 400,
		modal: true,
		show: "fade",
		hide: "explode",
		position: [230, 230],
		buttons: [{
			text: "Use Once and Discard",
			click: function() {
				$(this).dialog("close");
			}
		}, {
			text: "Add & Save the Entry",
			click: function() {
				$(this).dialog("close");
				                var ap=apEntryString;          
				                        
 
                          $.ajax({
                              type:"post",
                              url:"PDO4ap.php",
                              data:"ap="+ap,
                              success:function(data){
                                 $("#info").html(data);
                              }
 
                          });
			}
		}]
	});
});
}
	