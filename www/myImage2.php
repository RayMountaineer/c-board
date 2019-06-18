<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");

$usrsname= ($_SESSION['user']['username']);
$query = "select image2,image_type2 from usrsprofiles WHERE username = ?";
$stmt = $pdo->prepare( $query );
$stmt->bindParam(1, $usrsname); 
$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	 header("Content-type: ".$row['image_type2']);

	print $row['image2'];
	exit;
?>
