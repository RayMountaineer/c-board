<?php
ob_start();
header('Content-type: text/html; charset=utf-8');  
require_once '../PHPMailerAutoload.php';
// include connexion strings 
require_once "../PDO/email-provider.php";

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->SMTPDebug = false;
//$mail->SMTPDebug = 2;

$mail->Host = $mailersHost; // via include_once'./PDO/mailerConnexStrings.php'; im exec.php
$mail->Username =$mailersName; 
$mail->Password =$mailersPass; 
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
$mail->Port = $mailersPort; // TCP port to connect to

//$mail->From = $UsersEmail; 
$mail->From = $AdminsMail;
 
// $mail->AddReplyTo = $usrEmail;
$mail->FromName =$AdminsUsername; // Admins user name
//$mail->AddAddress
// Add a recipient (wurde unten mittels variablen gelöst))
$mail->addAddress($newUsersEmail); // send notification to newly registered user

$mail->addAddress($AdminsMail); //	send notification to the C-BOARD superadmin (= "user number 1")


$mail->Subject    = $subject;// 'PHPMailer Test gmail_V7.php im exec.php dynamisch, html';
//$mail->Body    = 'this is the Boda txt - html part zu testzwecken auskommentiert'; 
$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test


$path=$_SERVER['SERVER_NAME']; // z.B.: projectboard.azurewebsites.net



$fact = 'Hello dear cboard-user "'.$newUsersName.'"!<br><br>You are receiving this message because you requested to be signed-up to a new Project. <bR><br> 
Clicking the link below will bring you to the login-page of this project.<br><br>


<a href="http://'.$path.$newToProjSlot.'/login/login.php">http://'.$path.$newToProjSlot.'/login/login.php</a><br>
click or copy the link into the address-bar of your browser for logging into your project.<br> 
<br><br>This is an automatically created message.<br><br> Love,<br>Your cboard-bot';
$factbreak = nl2br($fact);
$body = '<html>
<head>
    <title>' . $subject . '</title>
</head>
 
<body> 
 
<table border="1">
  <tr>
    <td bgcolor="#BCA9F5"><b>Question Repeat: You requested to be signed-up for a new project discussion board</b></td>
  </tr>
  <tr><td bgcolor="#F5DA81"><b> I-Message: I am the C-BOARD-bot. I hope you enjoy the capabilities of this application</b></td>
  </tr>
  <tr><td bgcolor="#F78181"><b> Appeal: Please, bookmark the link to the project & add the project-name</b></td>
  </tr>
</table>
 <br>
<p>' . $factbreak .'</p>
 <br>
 <br>
 <br>
 <br>
  <a href="http://www.c-cybernetics.com"><img src="../images/c-cybernetics_com.png" width="666" height="128" border="0" alt="www.c-cybernetics.com :: advanced collaboration"></a>
</body>
</html>
';

//var_dump($mail->send());
//$body = file_get_contents('contents.html');
$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  ob_start();
// redirect to new user welcome page:
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";   
			$targetfolder = substr($actual_link, 0, -12); //  
			$overview = "welcome.php"; // go to the c-board's welcome new user you need to wait for activation page
			$locationlink = $targetfolder.$overview;
			 	header("Location: $locationlink"); // perform correct redirect.
      		die("Redirecting to: $locationlink");	
	// http://c-board.de/OpenC-welcome.php  __> es fehlen BOARD/login/ = 12 zeichen
  echo "Notification-email with the hyper-link was sent successfully !";
 ob_end_flush();
}
 ob_end_flush();