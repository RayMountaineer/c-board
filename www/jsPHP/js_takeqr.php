<?php 
$stmt = $pdo->query("SELECT id,qr FROM cflags WHERE username = '$usrsname'"); 


while($row = $stmt->fetch()) {
	 
	if($row['qr'] !='') {
 
echo'	<script type="text/javascript">
	function takeqr'.  $row['id']. '() {
	var qrCflagSelected = document.getElementById(\'qr'. $row['id'] . '\').text;
	document.getElementById("qrTextBox").value = qrCflagSelected;
	document.getElementById("qrCFLGstatement").innerHTML = qrCflagSelected;
	}
	</script>' ; 

}
}; 
?>