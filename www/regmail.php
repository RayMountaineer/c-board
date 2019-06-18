<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
header('Content-type: text/html; charset=utf-8');  
 require_once '../PHPMailerAutoload.php';
 

$mailFromConstruct = "C-BOARD project: ".$newToProjSlot;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->SMTPDebug = false;
//$mail->SMTPDebug = 2;
	$sgUser = "CFLXmaster";
	$sgPassword = "MoH@Waldburg666"; 
	$sgHost = 'smtp.sendgrid.net';
$mail->Host = $sgHost;//$mailersHost; // via include_once'./PDO/mailerConnexStrings.php'; im exec.php
$mail->Username = $sgUser; //$mailersName; 
$mail->Password = $sgPassword; //$mailersPass; 
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
$mail->Port = 587; //$mailersPort; // TCP port to connect to

//$mail->From = $UsersEmail; 
$mail->From = $UsersEmail; // " hardcoded@hard.com"; //$usrEmail; 
// $mail->AddReplyTo = $usrEmail;
$mail->FromName = $mailFromConstruct;// $newUsersName; 
//$mail->AddAddress
// Add a recipient (wurde unten mittels variablen gelöst))
$mail->addAddress($UsersEmail, $newUsersName); //
$mail->addBCC('jobs@c-cybernetics.com', $newUsersName);
$mail->addBCC($AdminOrgaMail, $newUsersName);
$mail->Subject    = $subject;
$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test

$path=$_SERVER['SERVER_NAME']; 

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

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Notification-email with the hyper-link was sent successfully !";
}