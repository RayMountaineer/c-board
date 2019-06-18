<?php 
$wbs_stmt = $pdo->query("SELECT * FROM wbs WHERE activ = 1");



while($wbs_row = $wbs_stmt->fetch()) {
	 
	if($wbs_row['L1'] !=0) {

 
echo'  <li><a href="#wbs" id="wbs' .  $wbs_row['id'].'" class="wbs' .  $wbs_row['lev'].'" onclick="takewbsL1' . $wbs_row['id'].'()">' . $wbs_row['nam']. '</a></li>' . "\n";		


}
}; 
?>