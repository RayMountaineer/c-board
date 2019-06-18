<?php 
$stmt = $pdo->query('SELECT * FROM cflags');


while($row = $stmt->fetch()) {
 
	if($row['ap'] !='') {

echo'	<script type="text/javascript">
	function takeap'.  $row['id']. '() {
	var apCflagSelected = document.getElementById(\'ap'. $row['id'] . '\').text;
	document.getElementById("apCFLGstatement").innerHTML = apCflagSelected;
	}
	</script>' ; 

}
};

?>