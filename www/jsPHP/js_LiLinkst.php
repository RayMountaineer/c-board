<?php

$stmt = $pdo->query("SELECT id,statstat FROM cflags WHERE username = '$usrsname'");


while($row = $stmt->fetch()) {
	 
	if($row['statstat'] !='') {


echo'  <li><a href="#stat" id="stat' .  $row['id'].'" onclick="takestat' . $row['id'].'()">' . htmlentities($row['statstat']). '</a></li>' . "\n";		


}
}; 
?>