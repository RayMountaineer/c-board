<?php 
$stmt = $pdo->query('SELECT * FROM cflags');


while($row = $stmt->fetch()) {
	
	if($row['im'] !='') {
 
echo'	<script type="text/javascript">
	function takeim'.  $row['id']. '() {
	var imCflagSelected = document.getElementById(\'im'. $row['id'] . '\').text;
	document.getElementById("imCFLGstatement").innerHTML = imCflagSelected;
	}
	</script>' ; 

}
}; 
?>