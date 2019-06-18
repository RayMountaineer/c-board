<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
$assigntoWBS=$_POST["WBSid"];  
$TasksID=$_POST["strgID"];

	 include_once('./PDO/connex.php');  
		$wbsnumber = $assigntoWBS; // status = 8 means: task is accepted, parent wbs (Pid) is selected and set
		$getWBSid = $pdo->prepare('SELECT id FROM wbs WHERE (wbsnumber=?)');
		$getWBSid->bindParam(1, $wbsnumber, PDO::PARAM_INT);
		$getWBSid->execute();
		$SelwbsID4Pid = $getWBSid->fetch(PDO::FETCH_ASSOC);
			
		$assigntoWBS = $SelwbsID4Pid['id'];
	 
		$closeddefaultZero = 0;
		$sqlUpdateTask = 'UPDATE strg set Pid=:Parent where ID=:id';
		$prepUp = $pdo->prepare($sqlUpdateTask);
		$prepUp->execute(array(':Parent' => $assigntoWBS, ':id' => $TasksID));
	header('location:overview.php');

 	exit();