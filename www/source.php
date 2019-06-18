<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");
$query = "select image,image_type from usrsprofiles WHERE username = ?";
$stmt = $pdo->prepare( $query );
$stmt->bindParam(1, $_GET['id']); 
$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	header("Content-type: ".$row['image_type']);
	print $row['image'];
	exit;
?>
