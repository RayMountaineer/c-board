<?php 
$stmt = $pdo->query("SELECT id,ap FROM cflags WHERE username = '$usrsname'");

while($row = $stmt->fetch()) {
	
 
	if($row['ap'] !='') {
 
echo'	<script type="text/javascript">
	function takeap'.  $row['id']. '() {
	var apCflagSelected = document.getElementById(\'ap'. $row['id'] . '\').text;
	document.getElementById("apTextBox").value = apCflagSelected;
	document.getElementById("apCFLGstatement").innerHTML = apCflagSelected;
	}
	</script>' ; 

}
};
//}
?>