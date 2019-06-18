<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
$UsrID4send=$_POST["UsrID4PWlink"];

$UsrToken4send=$_POST["PWtoken4link"];

$UsrsEmail=$_POST["usrsemail"];

$path=$_SERVER['SERVER_NAME'];  
echo '<br><br>';
echo'user s id = '.$UsrID4send;
echo'<br><br>';
echo'ResetToken = '.$UsrToken4send;
echo'<br><br>';
echo'users email where to send via sendgrid the reset-pw-link: '.$UsrsEmail;
echo'
following url was created for reset the password:<br>
<a href="http://'.$path.'/login/newPW.php?USrid='.$UsrID4send.'&&SI='.$UsrToken4send.'">http://'.$path.'/login/newPW.php?USrid='.$UsrID4send.'&&SI='.$UsrToken4send.'</a><br>
click or copy the link into the address-bar of your browser for resetting your password.<br> ';
 

 exit();
?>