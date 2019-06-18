<?php

$stmt = $pdo->query("SELECT id,qr FROM cflags WHERE username = '$usrsname'");


while($row = $stmt->fetch()) {
	 
	if($row['qr'] !='') {


echo'  <li><a href="#questrep" id="qr' .  $row['id'].'" onclick="takeqr' . $row['id'].'()">' . htmlentities($row['qr']). '</a></li>' . "\n";		


}
};
//}

?>