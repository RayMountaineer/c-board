<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");
	
$formval = $_POST; // all values from html-form are stored in $_POST. Nun werden diese in die $formval variable übergeben
$topic = $formval['topic'];
$Pid = $formval['Pid'];
$dscrption = $formval['descr'];

// check if empty fields:
	if($topic == NULL) {
		echo 'No name/caption for the new thread was given. Please, enter a meaningful topic for your thread!';
		exit();}
	elseif($Pid == NULL) {
		echo 'No Parent-WBS-Element was selected. You need to select a WBS-Element related to the new thread. Please, make a selection!';
		exit();}
	else {
$insertdb = "INSERT INTO strg (topic,Pid,dscrption) VALUES (:topic, :Pid, :dscrption)";

$pdoexec = $pdo->prepare($insertdb);
$pdoexec->execute(array(':topic'=>$topic, ':Pid'=>$Pid, ':dscrption'=>$dscrption));

$nsPid = $pdo->query("SELECT ID FROM strg WHERE Pid = '$Pid' AND topic ='$topic' AND dscrption ='$dscrption'");
$nsPidArray = $nsPid->fetchAll(PDO::FETCH_ASSOC); 
$nsPidy = $nsPidArray[0]["ID"]; 

header('location:threadview.php?ID=' . $nsPidy);   
 


  exit();
	}
 ?> 
