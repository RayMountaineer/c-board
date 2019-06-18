<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
// if user is 1st user (id=1), "I'm sorry Dave, I can not do this."
  if($_POST["UsrID4set"]==1) {
 	
header('location:imsorrydave.php');

 exit(); 
 	}
 
 else {
 //
	$UsrID4set=$_POST["UsrID4set"];

	$Perm2Set=$_POST["PermSelected"];

	 include_once('./PDO/connex.php');
//
		//updating some some data
		//$sqlInsert = 'UPDATE reg set password=:pw , SecToken=:PrimDings where (id=:id AND permission=:perm)'; versuch mit AND. OK, geht so.
		$sqlUpdatePerm = 'UPDATE reg set permission=:perm where id=:id';
		$prepPerm = $pdo->prepare($sqlUpdatePerm);
		$prepPerm->execute(array(':perm' => $Perm2Set, ':id' => $UsrID4set));
	header('location:usrAdminPanel.php');

 	exit();
 }
?>