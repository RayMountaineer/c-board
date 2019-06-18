
// hier die function StartDialog	
function StartDialogAP (textAreaVar) {
	 		
$(document).ready(function() {
	$("#IsNewDialogAP").dialog({	
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
				                var ap=textAreaVar;          
				                        
 								var KeyValAp= {ap:ap}
                          $.ajax({
                              type:"post",
                              url:"./bPDOprepinsertAP.php",
										 data:KeyValAp,                             
                            //  data:"ap="+ap,
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
				