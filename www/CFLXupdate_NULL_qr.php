<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

	$ForUsr= ($_SESSION['user']['username']); 
	 require_once("./PDO/connex.php");
	$qrPosted4del1= ($_POST['delqr']); 
	// is html encoded via ajax key:value pairs sent via data: keyvaluepairs,
	// 2do:  html_entity_decode($apPosted4del1);
	$qrPosted4del = html_entity_decode($qrPosted4del1);
		$qrNULL = NULL;
	
		$sqlUpdateQR = 'UPDATE cflags set qr=:qrNULL where (qr = :qr AND username = :username)';
		$prepQR = $pdo->prepare($sqlUpdateQR);
		$prepQR->execute(array(':qrNULL' => $qrNULL, ':qr' => $qrPosted4del, ':username' => $ForUsr));

    header("Location: persProfile.php#cflxreturn");
    die("Redirecting to persProfile.php");
  