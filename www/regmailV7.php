<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
header('Content-type: text/html; charset=utf-8');  
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');

require_once 'PHPMailerAutoload.php';

require_once'./PDO/mailerConnexStrings.php';
//include_once'./PDO/mailerConnexStrings.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->SMTPDebug = false;
//$mail->SMTPDebug = 2;

$mail->Host = $mailersHost; // via include_once'./PDO/mailerConnexStrings.php'; im exec.php
$mail->Username =$mailersName; 
$mail->Password =$mailersPass; 
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
$mail->Port = $mailersPort;
//$mail->Port = 587; // TCP port to connect to
//
/*
echo $mailersHost; 
echo $mailersName; 
echo $mailersPass; */
//
$mail->From = $UsersEmail; 
//$mail->From = " hardcoded@hard.com"; //$usrEmail; 
 $mail->AddReplyTo = $UsersEmail;
$mail->FromName =$newUsersName; 
//$mail->AddAddress
// Add a recipient (wurde unten mittels variablen gelöst))
$mail->addAddress($UsersEmail); 
$mail->Subject    = $subject;// 'PHPMailer Test gmail_V7.php im exec.php dynamisch, html';
//$mail->Body    = 'this is the Boda txt - html part zu testzwecken auskommentiert'; 
$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test

$factbreak = nl2br($fact);

$body = '<html>
<head>
    <title>' . $subject . '</title>
</head>
 
<body style= "background-color: #d2d2ff"> <br><hr>  	
	<h2>CFLX-Mail from project: '.$projectName4mail.' </h2>
		related to WBS-number: '.$wbsSelect4mail.' &nbsp;&nbsp; WBS-name:  '.$wbsName4mail.' <br>
	<br> 
 	
 	<table style= "background-color: rgb(216, 253, 216) ; margin-left:auto; margin-right:auto; border: 1px solid grey;">
	<tr>
    <td bgcolor="#BCA9F5"><b>' . $qrCFX .'</b></td>
  </tr>
  <tr><td bgcolor="#F5DA81"><b> I-Message: ' .  $imCFX . '</b></td>
  </tr>
  <tr><td bgcolor="#F78181"><b> Appeal: ' . $apCFX . '</b></td>
  </tr>

  <tr>
  	<td><br>
 	
		<p>' . $factbreak .'</p>
 	<br>
 	<br>
 	<br>
 	<br>
  		<a href="http://www.c-cybernetics.com"><img src="./images/c-cybernetics_com.png" width="666" height="128" border="0" alt="www.c-cybernetics.com :: advanced collaboration"></a>
		</td>
	</tr>
</table>		
</body>
</html>
';

//var_dump($mail->send());
//$body = file_get_contents('contents.html');
$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent successfully !"; 
  echo'<script type="text/javascript">	wasSentsuccess();</script>';
}