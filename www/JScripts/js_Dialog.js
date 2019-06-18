<script src="/script/login.js"></script>



<script type="text/javascript">
// einfachste und unsichere! Variante der Einbindung der php Variable (des Arrays):
var jarray = <?php echo json_encode($jarray); ?> 
var textAreaVar = "Appell text to check if in Array13";
// check question repeat(ap) content in array:
var apEntryString = textAreaVar;
var api = jarray.length;


function CheckJarray () {
	while( api-- ) {
    if(jarray[api].ap === apEntryString ) break;
		}


 //document.writeln("The apEntryString: --" + apEntryString + "-- is at Position: ");

 //document.writeln('<FONT COLOR="red">' +api);

	if (api == '-1')
	
// im Falle -1 nun die StartDialog() function aufrufen 
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
// function StartDialog ENDE
				
</script>
