
// hier die function StartDialog	
function StartDialogQR (textAreaVar) {
	
$(document).ready(function() {
	$("#IsNewDialogQR").dialog({	
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
                              url:"./bPDOprepinsertQR.php",
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
				