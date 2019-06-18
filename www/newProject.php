<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 
	<title>C-BOARD: Setting up a new project</title>
   


		<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
		<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	   <link rel="stylesheet" href="CSS/styles.css">
		<link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" />
	<!--<link rel="stylesheet" href="./CSS/newWBSform.css" type="text/css" />-->
		<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
	<!--  <link rel="stylesheet" href="CSS/styles.css">-->
      

		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	 
      <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
	
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        		<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
				
</head>
<body bgcolor="grey">


<?php
	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link

	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: S E T U P - A - N E W - P R O J E C T</h2><hr />';
	//	echo '<p style="display: inline;"><a href="overview.php" class="myButtonBlu" title="back to the wbs-structured board-sight">WBS/ overview</a> &laquo; </p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 

echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr style="line-height: 0.7em;"><td><h3 style="font-size: 1.3em; text-align:center; padding: 0.5em;">e n t e r    _  P R O J E C T - M A I N - D A T A  _   p r o g r a m m a t i c a l l y </3></td></tr></table><br>';
// admin-user-header-table end



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
// start: permission-check

$usrsPermission = $usrArray['permission'];

if(($usrsPermission == 0) or ($usrsPermission == 1) or ($usrsPermission == 7)) {
echo '
		
		<form action="./login/logout.php" method="post" id="login">
		<fieldset>
		<legend>A C C E S S   D E N I E D</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    	  
    	<tr>
      <td align="left"> You do not have the permission to set up new projects (yet).<br><br>
				If you are a newly registered user,<br>
 				your permissions need to be set by the cboard-admin before you get access to this function.<br>
					<br>
				
					<br>
				The cboard-admin might be your Project Manager (PM),<bR>
 				your Project Management Officer (PMO),<br>
  				a person in your IT-Department <br>
  				or an other person who purchased and/or set up this application.<br>
				<br></td>
    	</tr>
  		 </table>
		
	</fieldset>
	
	<fieldset>
		<button type="submit" value="logout">logout</button>
		<br>
		
	</fieldset>
</form>
';

}
elseif($usrsPermission == 11)  {
 
?>

<div style="z-index:100; display:block;">
		<br>	
		
<form action="InsNewProject.php" method="POST" id="nwbs">
	<fieldset>
		<legend>ENTER THE MAIN-DATA OF THE NEW PROJECT</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right">Project-Name:</td>
      <td><input id="pname" name="pname" type="text" placeholder="Name of your project" required size="50" maxlength="80"/></td>
    </tr>
     <tr>
      <td align="right">Project-Number/ID:</td>
      <td><input id="pnumber" name="pnumber" type="text" placeholder="Use the same identifier as in your ERP/ project-system" required size="50" maxlength="80"/></td>
    </tr>
    <tr>
      <td align="right">Project-Description:</td>
      <td><input id="pdescr" name="pdescr" type="text" placeholder="Enter the description/ sub-title of your project" required value="" size="50" maxlength="80" /></td>
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
		<!--<button type="button" name="wbs_btn" id="wbs_btn" value="create" onclick="insElement();" >CREATE ELEMENT</button>
	-->	
	<button type="submit" name="wbs_btn" id="wbs_btn" value="create" >CREATE NEW PROJECT</button>
		
	<br>
		
	</fieldset>
</form>

</div>
<?php
}
