<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$firstname=trim($_POST["firstname"]);
	$firstname =strip_tags($firstname, '<b><u><i></b></u></i>');
	
	$lastname=trim($_POST["lastname"]);
	$lastname =strip_tags($lastname, '<b><u><i></b></u></i>');
	
	$phone=trim($_POST["phone"]);
	$phone =strip_tags($phone, '<b><u><i></b></u></i>');

	$timezone=trim($_POST["tzone"]);
	$timezone =strip_tags($timezone, '<b><u><i></b></u></i>');

	$email=trim($_POST["email"]);
	$email =strip_tags($email, '<b><u><i></b></u></i>');

 include('./PDO/connex.php');

$usrsnme = $_SESSION['user']['username'];

$insertdbp = "UPDATE usrsprofiles
SET fname = :fname,
lname = :lname,
phone = :phone,
tzone = :tzone,

email = :email

WHERE username = :username";
 

$stmt = $pdo->prepare($insertdbp);


$stmt->bindParam(':fname',$firstname); 
$stmt->bindParam(':lname',$lastname);
$stmt->bindParam(':phone',$phone);
$stmt->bindParam(':tzone',$timezone);

$stmt->bindParam(':email',$email);


$stmt->bindParam(':username',$usrsnme);

$stmt->execute();

header('location:persProfile.php');

 exit();
?>