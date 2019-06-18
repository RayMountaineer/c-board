
// hier die function StartDialog	
function StartDialogStat (textAreaVar) {
	 		
$(document).ready(function() {
	$("#IsNewDialogStatStat").dialog({	
	//	title: "This is a new or modified Entry!",
		width: 400,
		modal: true,
		show: "fade",
		hide: "explode",
		//position: [230, 230],
		buttons: [{
			text: "Use Once and Discard",
			click: function() {
				$(this).dialog("close");
				  return false;
			}
		}, {
			text: "Add & Save the Entry",
			click: function() {
				$(this).dialog("close");
				                var qr=textAreaVar;          
				                        
 								var KeyValQr= {qr:qr}
                          $.ajax({
                              type:"post",
                              url:"./bPDOprepinsertStatStat.php",
										 data:KeyValQr,                             
                            //  data:"qr="+qr,
                              success:function(data){
                                 $("#box").html(data);
                              }
 
                          });
                            return false;
			}
		}]
	});
});
}
// function StartDialog ENDE
				