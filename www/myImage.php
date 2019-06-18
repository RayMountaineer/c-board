<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");

     
	//$usrsname= htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
	
	$usrsname= ($_SESSION['user']['username']);
	
//select the image
$query = "select image_type from usrsprofiles WHERE username = ?";
$stmt = $pdo->prepare( $query );

$stmt->bindParam(1, $usrsname); 
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	if(! $row['image_type']) {
		
 //if no image_type found with the given id,
	//load/query your default image here
	
//select the image
$queryim2 = "select image, image_type from usrsprofiles WHERE username = ?";
$stmt2 = $pdo->prepare( $queryim2 );
$iniusrname = "iniusr";
$stmt2->bindParam(1, $iniusrname); 
$stmt2->execute();
 
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	
	 header("Content-type: ".$row2['image_type']);

	//display the image data
	print $row2['image'];
	exit;
	}
	

else {
// if image_type found,

//select the image
$query = "select image,image_type from usrsprofiles WHERE username = ?";
$stmt = $pdo->prepare( $query );

$stmt->bindParam(1, $usrsname); 
$stmt->execute();

	//if found
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//specify header with content type, 
	//you can do header("Content-type: image/jpg"); for jpg, 
	//header("Content-type: image/gif"); for gif, etc.
	
	 header("Content-type: ".$row['image_type']);

	//display the image data
	print $row['image'];
	exit;

}
?>
