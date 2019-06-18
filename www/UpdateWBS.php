<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	 include_once './PDO/connex.php';
	$usrArray = $_SESSION['user']; 
	$IDofUsrViewing2 = $usrArray['id'];
	$wbsID4update=$_POST["wbsID4update"];
	$PermNr2Set=$_POST["PermSelected2"];
		$sqlUpdatePerm = 'UPDATE wbs SET `'.$IDofUsrViewing2.'`=:PermNr2Set WHERE id =:wbsID4update';
		$prepPerm = $pdo->prepare($sqlUpdatePerm);
		$prepPerm->execute(array(':PermNr2Set' => $PermNr2Set, ':wbsID4update' => $wbsID4update));

	header('location:persWBS.php');
 
 
?>