<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
}
 include_once('./PDO/connex.php');
		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" />  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        		<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
		
	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/newWBSform.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
			<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	 
      <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
	<title>CREATE NEW THREAD :: WBS RELATED DISCUSSION</title>

</head>
     
<body>
<?php

	 include './PDO/connex.php';
	$usrArray = $_SESSION['user'];
/*
		echo 'You are logged in as User: "<font color="red"><b>'.$usrArray['username'].'</b></font>"<br>
		With the email-address: "<font color="red"><b>'.$usrArray['email'].'</b></font>"<br>';
*/
// start user login-status & redirect if not:
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {

header ("Location: ./login/login.php"); 
 die("Redirecting to ./login/login.php");


}
$actualWBSid = $_GET["ID"];
	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link
	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: C R E A T E - N E W - T H R E A D</h2><hr />';
	echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
	echo'<tr style="line-height: 0.7em;"><td><h3 style="font-size: 1.3em; text-align:center; padding: 0.5em;">a c t u a l  _ W B S - E L E M E N T _  r e l a t e d</3></td></tr></table><br>';

?>

		
<form action="PDOinsertThread.php" method="POST" id="nwbs">
	<fieldset>
		<legend>CREATE NEW WBS-ELEMENT-RELATED THREAD</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right">Title:</td>
      <td><input id="topic" name="topic" type="text" placeholder="Caption of your new deliverable/ WBS-Element"  size="40" maxlength="80"/></td>
    </tr>
     <tr>
      <td align="right">Content:</td>
      <td><input id="descr" name="descr" type="text" placeholder="Description of deliverable"  size="40" maxlength="80"/></td>
    </tr>
    <tr>
     <!-- <td align="right">Related to WBS-Element:</td>-->
     <td></td>
      <td><input id="Pid" name="Pid" type="hidden"  value="<?php echo $actualWBSid; ?>" size="40" maxlength="80" /></td>
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
	
	<button type="submit" name="wbs_btn" id="wbs_btn" value="create" >CREATE NEW THREAD</button>
		
	<br>
		
	</fieldset>
</form>

