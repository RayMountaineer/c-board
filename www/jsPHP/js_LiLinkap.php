<?php 
$stmt = $pdo->query("SELECT id,ap FROM cflags WHERE username = '$usrsname'");



while($row = $stmt->fetch()) {
	
  
	if($row['ap'] !='') {

echo'  <li><a href="#appell" id="ap' .  $row['id'].'" onclick="takeap' . $row['id'].'()">' . htmlentities($row['ap']). '</a></li>' . "\n";		


}
};
//}
?>