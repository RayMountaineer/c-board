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
		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
 
$linklist=trim($_POST["linklist"]);
$linklist =strip_tags($linklist, '<li></li><b><u><i><a></a><A></A></b></u></i>');
$interestedin=trim($_POST["interestedin"]);
$interestedin =strip_tags($interestedin, '<li></li><b><u><i><a></a><A></A></b></u></i>');
	
  require_once("./PDO/connex.php");


$usrsnme = $_SESSION['user']['username'];

$insertdbp = "UPDATE usrsprofiles
SET linklist = :linklist,

interestedin = :interestedin
WHERE username = :username";
 

$stmt = $pdo->prepare($insertdbp);


$stmt->bindParam(':linklist',$linklist); 
$stmt->bindParam(':interestedin',$interestedin);


$stmt->bindParam(':username',$usrsnme);

$stmt->execute();

header('location:persProfile.php');

 exit();
?>