<?php 
$stmt = $pdo->query("SELECT id,im FROM cflags WHERE username = '$usrsname'");

while($row = $stmt->fetch()) {
	
 
	if($row['im'] !='') {
 
echo'	<script type="text/javascript">
	function takeim'.  $row['id']. '() {
	var imCflagSelected = document.getElementById(\'im'. $row['id'] . '\').text;
	document.getElementById("imTextBox").value = imCflagSelected;
	document.getElementById("imCFLGstatement").innerHTML = imCflagSelected;
	}
	</script>' ; 

}
}; 
?>