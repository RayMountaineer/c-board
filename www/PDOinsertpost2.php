<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
    require_once("./PDO/connex.php");

 		$username= ($_SESSION['user']['username']); 
   $email= ($_SESSION['user']['email']);           
		 $pstval = $_POST; // all values from html-form are stored in $_POST. Nun werden diese in die $formval variable übergeben

 $topic_orig =  trim($pstval["topic"]);
 $topic_orig =strip_tags($topic_orig, '<b><u><i></b></u></i>');
// die Umlaute der Überschrift (Titel / topic) müssen noch html-codiert werden:
	$topic= $topic_orig;
	//	$topic= htmlentities($topic_orig, ENT_QUOTES, 'UTF-8');
 

$text = $pstval['mssg'];


$qr =  $pstval["qr"];
$im =  $pstval["im"];
$ap =  $pstval["ap"];
//$reAW =  $pstval["reAW"];
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
$insertdb = "INSERT INTO forum_posts (tid,Pid,username,email,topic,text,qr,im,ap) VALUES (:tid,:Pid, :username, :email, :topic, :text, :qr, :im, :ap)";

$pdoexec = $pdo->prepare($insertdb);
$pdoexec->execute(array(':tid'=>$tid,':Pid'=>$Pid,':username'=>$username,':email'=>$email,':topic'=>$topic, ':text'=>$text, ':qr'=>$qr, ':im'=>$im, ':ap'=>$ap));
 
header('location:threadview.php?ID=' . $_SESSION["strg_id"] . '#box'); 
 exit();
	}
 ?> 
