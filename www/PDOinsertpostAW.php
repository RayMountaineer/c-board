<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
    require_once("./PDO/connex.php");

 $username= ($_SESSION['user']['username']);
     $email= ($_SESSION['user']['email']);     
	
$pstval = $_POST; // all values from html-form are stored in $_POST. Nun werden diese in die $formval variable übergeben

//$topic_orig = $pstval['topic'];
 $topic_orig =  trim($pstval["topic"]);
 $topic_orig =strip_tags($topic_orig, '<b><u><i></b></u></i>');

	$topic= $topic_orig;
  		

$text = $pstval['mssgbox'];


$qr =  $pstval["qrCFLX"];
	// $qr =  trim($pstval["qrCFLX"]);
	// $qr =strip_tags($qr, '<b><u><i></b></u></i>');

$im =  $pstval["imCFLX"];
$ap =  $pstval["apCFLX"];
$reAW =  $pstval["reAW"];
$tid = $pstval["tid"];
$Pid = $pstval["Pid"];

// check if empty fields:
	if($topic == NULL) {
		echo 'No name/caption for the new thread was given. Please, enter a meaningful topic for your thread!';
		exit();}
	elseif($tid == NULL) {
		echo 'No Parent-Thread-ID was selected. You need to select a related thread you want to post a message in. Please, make a selection!';
		exit();}
	else {
$insertdb = "INSERT INTO forum_posts (tid,Pid,reAW,username,email,topic,text,qr,im,ap) VALUES (:tid, :Pid, :reAW, :username, :email, :topic, :text, :qr, :im, :ap)";

$pdoexec = $pdo->prepare($insertdb);
$pdoexec->execute(array(':tid'=>$tid,':Pid'=>$Pid,':reAW'=>$reAW,':username'=>$username,':email'=>$email,':topic'=>$topic, ':text'=>$text, ':qr'=>$qr, ':im'=>$im, ':ap'=>$ap));

// header('location:directAns.php?reID=' . $reAW. '#' . '82'); //ID-Wert / die variable "$strg_id" muss noch mit irgendeiner Methode übergeben werden. evtl. via SESSION?  
 
header('location:directAns.php?reID=' . $reAW . '#box');

 exit();
	}
 ?> 
