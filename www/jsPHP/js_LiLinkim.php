<?php
$stmt = $pdo->query("SELECT id,im FROM cflags WHERE username = '$usrsname'");


while($row = $stmt->fetch()) {
	

// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
	if($row['im'] !='') {


echo'  <li><a href="#imssg" id="im' .  $row['id'].'" onclick="takeim' . $row['id'].'()">' . htmlentities($row['im']). '</a></li>' . "\n";		


}
};
//}
?>