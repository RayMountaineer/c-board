
// hier die function StartDialog	
function StartDialogIM (textAreaVar) {
			
$(document).ready(function() {
	$("#IsNewDialogIM").dialog({
	//	title: "This is a new or modified Entry!",
		width: 400,
		modal: true,
		show: "fade",
		hide: "explode",
	//	position: [230, 230],
		buttons: [{
			text: "Use Once and Discard",
			click: function() {
				$(this).dialog("close");
			}
		}, {
			text: "Add & Save the Entry",
			click: function() {
				$(this).dialog("close");
				                var im=textAreaVar;          
				                var imKeyVal={im:im}    
                           $.ajax({
                              type:"post",
                              url:"./bPDOprepinsertIM.php",
                               data: imKeyVal,
                           //   data:"im="+im,
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
				