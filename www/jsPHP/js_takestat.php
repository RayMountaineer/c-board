<?php

	$usrsname= ($_SESSION['user']['username']);
 $stmt = $pdo->query('SELECT id,statstat FROM cflags');
 while($row = $stmt->fetch()) {
	 
	if($row['statstat'] !='') { 
echo'	<script type="text/javascript">
	function takestat'.$row['id'].'() {
	var statCflagSelected = document.getElementById(\'stat'. $row['id'] . '\').text;
	document.getElementById("statTextBox").value = statCflagSelected;
	document.getElementById("statCFLGstatement").innerHTML = statCflagSelected;
	}
	</script>' ; 

}
}; 
?>