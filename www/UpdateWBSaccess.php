<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	 include_once './PDO/connex.php';
	$wbsID2update=$_POST["wbsID2update"];
	$Access2Set=$_POST["SetAccess2"];
	$setAccess = 'UPDATE wbs SET activ =:AccessSet WHERE id =:wbsID2update';
	$prepPerm = $pdo->prepare($setAccess);
	$prepPerm->execute(array(':AccessSet' => $Access2Set, ':wbsID2update' => $wbsID2update));
	header('location:availableWBS.php');
 	exit();
 ?>