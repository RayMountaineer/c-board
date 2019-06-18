<?php
	SESSION_START();
 	$usar= ($_SESSION['user']['username']); 
	$qr = trim($_POST["qr"]);
	$qr =strip_tags($qr, '<b><u><i></b></u></i>');
 	require_once("./PDO/PDOcboard.php");
$b=$pdocx->prepare('INSERT into cflags(username,statstat)VALUES(:usar,:statstat)');
$b->bindParam(":usar",$usar);
$b->bindParam(":statstat",$qr);
$b->execute();
?>
