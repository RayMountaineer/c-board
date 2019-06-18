<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
 	$usar= ($_SESSION['user']['username']); 
	$ap = trim($_POST["ap"]);
	$ap =strip_tags($ap, '<b><u><i></b></u></i>');
 	require_once("./PDO/connex.php");
$b=$pdo->prepare('INSERT into cflags(username,ap)VALUES(:usar,:ap)');
$b->bindParam(":usar",$usar);
$b->bindParam(":ap",$ap);
$b->execute();
?>
