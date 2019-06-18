<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
 	$usar= ($_SESSION['user']['username']); 
	$im = trim($_POST["im"]);
	$im =strip_tags($im, '<b><u><i></b></u></i>');
 	require_once("./PDO/connex.php");
$b=$pdo->prepare('INSERT into cflags(username,im)VALUES(:usar,:im)');
$b->bindParam(":usar",$usar);
$b->bindParam(":im",$im);
$b->execute();
?>
