<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	 include_once './PDO/connex.php';

	$wbsID2update=$_POST["wbsID4accss"];
	$Access2Set=$_POST["SetwbsAccess"];
	$usersheaderid= $_POST["usersheaderid"];	$setusrwbsAccess = 'UPDATE wbs SET  `'.$usersheaderid.'`=:SetAccess WHERE id =:wbsID2update';
		$prepusrPerm = $pdo->prepare($setusrwbsAccess);
		$prepusrPerm->execute(array(':SetAccess' => $Access2Set, ':wbsID2update' => $wbsID2update));

header('location:availableWBS.php');

 	exit();
 
?>