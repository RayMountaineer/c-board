
function StartDialogStat (textAreaVar) {
	
			
$(document).ready(function() {
	$("#IsNewDialogStat").dialog({
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
				                var stat=textAreaVar;          
				                var statKeyVal={stat:stat}    
                           $.ajax({
                              type:"post",
                              url:"./bPDOprepinsertStat.php",
                               data: statKeyVal,
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