<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
}
 include_once('./PDO/connex.php');
 
$_SESSION['url'] = $_SERVER['REQUEST_URI']; // set into cookie 4 last-position-reminder
$position=$_POST["position"];
$skills=$_POST["skills"];
$nearness=$_POST["nearness"];
$risk=$_POST["risk"];
$usrsnme = $_SESSION["usr"];

$insertdbp = "UPDATE usrsprofiles
SET position = :position,
skills = :skills,
thorie_nearness = :nearness,
thorie_risk = :risk
WHERE username = :username";
 

$stmt = $pdo->prepare($insertdbp);


$stmt->bindParam(':position',$position); 
$stmt->bindParam(':skills',$skills);
$stmt->bindParam(':nearness',$nearness);
$stmt->bindParam(':risk',$risk);


$stmt->bindParam(':username',$usrsnme);

$stmt->execute();
header('location:persProfile.php');

 exit();
?>