<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$position=trim($_POST["position"]);
	$position =strip_tags($position, '<b><u><i></b></u></i>');
	
	$skills=trim($_POST["skills"]);
	$skills =strip_tags($skills, '<b><u><i></b></u></i>');
//$skills=$_POST["skills"];
	$nearness=trim($_POST["nearness"]);
	$nearness =strip_tags($nearness, '<b><u><i></b></u></i>');
//$nearness=$_POST["nearness"];
//$daytime=$_POST["daytime"];
	$risk=trim($_POST["risk"]);
	$risk =strip_tags($risk, '<b><u><i></b></u></i>');
//$risk=$_POST["risk"];
	$comment=trim($_POST["comment"]);
	$comment =strip_tags($comment, '<b><u><i></b></u></i>');
//$comment=$_POST["comment"];
 include('./PDO/connex.php');


$usrsnme = $_SESSION['user']['username'];

$insertdbp = "UPDATE usrsprofiles
SET position = :position,
skills = :skills,
thorie_nearness = :nearness,
thorie_risk = :risk,
comment = :comment
WHERE username = :username";
 

$stmt = $pdo->prepare($insertdbp);


$stmt->bindParam(':position',$position); 
$stmt->bindParam(':skills',$skills);
$stmt->bindParam(':nearness',$nearness);
$stmt->bindParam(':risk',$risk);
$stmt->bindParam(':comment',$comment);


$stmt->bindParam(':username',$usrsnme);

$stmt->execute();
//
header('location:persProfile.php');

 exit();
?>