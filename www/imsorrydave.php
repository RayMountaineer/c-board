<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 
       
	<title>I am sorry, Dave</title>
<style type="text/css">
.mycss
{
text-shadow:1px 3px 4px rgba(240,149,96,1);font-weight:normal;font-style:italic;color:#00FF00;letter-spacing:1pt;word-spacing:2pt;font-size:37px;text-align:center;font-family:arial black, sans-serif;line-height:2;
}
body {
    background-image: url("./images/space_bigsize.png");
    background-repeat: repeat
;
}
</style>
</head>


</p>





      <link rel="stylesheet" href="CSS/button.css">
 
 <?php     		
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {

header ("Location: ./login/login.php");

}
else {
echo' <body><div align=center name="you cannot kick yourself out of responsibility!">
<p class="mycss">
 I am sorry, Dave. I am afraid I cant do that!<br><br></p>

<img src= "./images/hal_400.png" alt="you cannot kick yourself out of responsibility! "></img><br><br>
<a href="usrAdminPanel.php" class="myButtonRed" name="you cannot kick yourself out of responsibility!"align="right">back to user-administration</a>
</div>

</body>';
	}