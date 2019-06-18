<?php 
$stmt = $pdo->query('SELECT * FROM cflags');


while($row = $stmt->fetch()) {
	
	if($row['statstat'] !='') {

echo'	<script type="text/javascript">
	function takestat'.  $row['id']. '() {
	var stCflagSelected = document.getElementById(\'stat'. $row['id'] . '\').text;
	document.getElementById("stCFLGstatement").innerHTML = stCflagSelected;
	}
	</script>' ; 

}
}; 
?>