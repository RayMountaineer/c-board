function CheckJarrayAP () {
	

	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVar =  document.getElementById('apTextBox').value;
	
	var usrEntryap = document.getElementById('apCFLGstatement');
        		usrEntryap.innerHTML = textAreaVar;
	alert(textAreaVar);
	var posap = jarrays.indexOf(textAreaVar);
	alert(posap);
	//
	switch(posap) {
	case -1:StartDialogAP (textAreaVar);break;
		default: alert("Entry already existst at Pos: "+posap);
	}


	
}
