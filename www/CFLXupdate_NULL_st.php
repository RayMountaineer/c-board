<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

	$ForUsr= ($_SESSION['user']['username']); 
	 require_once("./PDO/connex.php");
	$apPosted4del1= ($_POST['delst']); 
	// is html encoded via ajax key:value pairs sent via data: keyvaluepairs,
	// 2do:  html_entity_decode($apPosted4del1);
	$apPosted4del = html_entity_decode($apPosted4del1);
	$apNULL = NULL;
	
		$sqlUpdateAP = 'UPDATE cflags SET statstat=NULL WHERE (statstat = :ap AND username = :username)';
		$prepAP = $pdo->prepare($sqlUpdateAP);
		$prepAP->execute(array(':ap' => $apPosted4del, ':username' => $ForUsr));

    header("Location: persProfile.php#cflxreturn");
    die("Redirecting to persProfile.php");
  