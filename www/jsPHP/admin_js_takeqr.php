<?php 
$stmt = $pdo->query('SELECT * FROM cflags');


while($row = $stmt->fetch()) {
	  
	if($row['qr'] !='') {
 
echo'	<script type="text/javascript">
	function takeqr'.  $row['id']. '() {
	var qrCflagSelected = document.getElementById(\'qr'. $row['id'] . '\').text;
	document.getElementById("qrCFLGstatement").innerHTML = qrCflagSelected;
	}
	</script>' ; 

}
}; 
?>