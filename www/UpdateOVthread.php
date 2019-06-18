<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	 include_once './PDO/connex.php';
	$ID2update=$_POST["strgID2update"];
	//$Access2Set=$_POST["SetAccess2"];
	// now hardcoded. reset to 0 only. no other update-operation will be made
	$Access2Set= 0;
	$setAccess = 'UPDATE strg SET closed =:AccessSet WHERE ID =:strgID2update';
	$prepPerm = $pdo->prepare($setAccess);
	$prepPerm->execute(array(':AccessSet' => $Access2Set, ':strgID2update' => $ID2update));
	header('location:ovThread.php');
 	exit();
 ?>