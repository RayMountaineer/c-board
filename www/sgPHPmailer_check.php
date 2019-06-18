<?php
header('Content-type: text/html; charset=utf-8');  
require_once 'PHPMailerAutoload.php';
// include connexion strings
include_once 'PDO/email-provider.php';

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

$mail->From = $UsersEmail; 
//$mail->From = " hardcoded@hard.com"; //$usrEmail; 
// $mail->AddReplyTo = $usrEmail;
$mail->FromName =$UsersName; 
//$mail->AddAddress
// Add a recipient (wurde unten mittels variablen gelöst))
$mail->addAddress($UsersEmail); //



$mail->Subject    = $subject;// 'PHPMailer Test gmail_V7.php im exec.php dynamisch, html';
//$mail->Body    = 'this is the Boda txt - html part zu testzwecken auskommentiert'; 
$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; // optional, comment out and test


			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";   
			$path = substr($actual_link, 0, -22); 
$fact = 'Hello dear cboard-user "'.$UsersName.'"!<br><br>You are receiving this message because you requested an email-notification-test. <bR><br> 
<br><br>This is an automatically created message.<br><br> Love,<br>Your cboard-bot';
$factbreak = nl2br($fact);
$body = '<html>
<head>
    <title>' . $subject . '</title>
</head>
 
<body> 
 
<table border="1">
  <tr>
    <td bgcolor="#BCA9F5"><b>Question Repeat: You were asking for a email functionality check</b></td>
  </tr>
  <tr><td bgcolor="#F5DA81"><b> I-Message: I am the cboard-bot. I am always happy if I can help my users</b></td>
  </tr>
  <tr><td bgcolor="#F78181"><b> Appeal: Please, contact us if you have any problems via: info@c-cybernetics.com </b></td>
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
  echo 'Notification Email for checking email-functionality was sent successfully !
<br>
Return to the <a href='.$path.'>LOGIN FORM</a>  
  ';
}