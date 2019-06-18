<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

	$ForUsr= ($_SESSION['user']['username']); 
	 require_once("./PDO/connex.php");
	$imPosted4del1= ($_POST['delim']); 
	// is html encoded via ajax key:value pairs sent via data: keyvaluepairs,
	// 2do:  html_entity_decode($apPosted4del1);
	$imPosted4del = html_entity_decode($imPosted4del1);
	$imNULL = NULL;
	
		$sqlUpdateIM = 'UPDATE cflags set im=:imNULL where (im = :im AND username = :username)';
		$prepIM = $pdo->prepare($sqlUpdateIM);
		$prepIM->execute(array(':imNULL' => $imNULL, ':im' => $imPosted4del, ':username' => $ForUsr));

    header("Location: persProfile.php#cflxreturn");
    die("Redirecting to persProfile.php");
 
  