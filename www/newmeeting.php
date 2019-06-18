<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
?><!DOCTYPE html>
<head>
<meta charset="UTF-8" />  
	
<link rel="shortcut icon" type="image/ico" href="https://c-board.de/start/images/favicon.ico"> 

<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    if (typeof jQuery == 'undefined') {
        
 			document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.css" /%3E'));
         document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.structure.css" /%3E'));
         document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.theme.css" /%3E'));
             
        document.write(unescape('%3Cscript type="text/javascript" src="JScripts/jquery-1.11.3.min.js" %3E%3C/script%3E'));
        document.write(unescape('%3Cscript type="text/javascript" src="JScripts/jquery-ui.min.js" %3E%3C/script%3E'));
         }
</script>	
<!-- jQuery with google cdn and local fallback:-->
   	<!-- das jquery "original-cdn" mal hoch, um ggfls. den typeof zu triggern
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        		<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
			    <script>window.jQuery.ui || document.write('<script src="JScripts/jquery-ui.min.js"><\/script>')</script>
     			
	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/newWBSform.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
	<!--  <link rel="stylesheet" href="CSS/styles.css">-->
   
      

		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	 
      <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
	<title>CyberScrum :: add new meeting of the week</title>

</head>
     
<body>
<?php

// start: permission-check

$usrsPermission = $usrArray['permission'];
if($usrsPermission == 0) //|| ($usrsPermission == 0)
{echo '
		
		<form action="./login/logout.php" method="post" id="login">
		<fieldset>
		<legend>A C C E S S   D E N I E D</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    	  
    	<tr>
      <td align="left"> You do not have the permission to create new wbs-elements and thus new forums (yet).<br><br>
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
elseif(($usrsPermission == 11) or ($usrsPermission == 7) or ($usrsPermission == 1)) {
/*
else { // bis ganz runter zum seitenende, dort die geschweifte klammer zumachen.
// if admin rights, the admin-panel-link-button
if($usrsPermission == 11) //|| ($usrsPermission == 7) 
{ echo'permission  11 is triggered';}*/

?>



<p style="display: inline; float: right;"><a class="myButtonPink" title="return to the CYBER-SCRUM overview-board" href="vsfm.php">CYBER-SCRUM</a> </p>

<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="WBS dicussion-board-sight">C-BOARD</a></p>

<p style="float: right;"><a href="ovViewDelMeet.php" class="myButtonOrange" title="overlook table of all meetings. active & past">MEETINGS-TABLE</a></p>	
	
<h2 style="font-size: 1.6em; font-weight: 400; ">C Y B E R - S C R U M  ::  A D D - N E W - M E E T I N G </h2><hr />
 		

<table border=2 bordercolor="orange" width="100%" class="cssov">
<tr style="line-height: 1.3em;"><td><h3 style="font-size: 1.3em;  padding: 0.9em; text-align:center;"> c r e a t e _  N E W  - D I S C U S S I O N  _ r e l a t e d </h3>
</td></tr>


</table>

 <div id="wrapper" style="z-index:15; display:block;">

<div style="z-index:100; display:block;">
		<br>	
		
<form action="meetcreator.php" method="POST" id="newActivity">
	<fieldset>
		<legend>CREATE NEW THREAD FOR MEETING-DISCUSSION</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
		   
 
      <td align="right">Subject:</td>
      <td><input id="actname" name="actname" type="text" placeholder="Title / credo / motto of the meeting"  size="45" maxlength="80"/></td>
    </tr>
     <tr>
      <td align="right">Description:</td>
      <td><input id="descr" name="descr" type="text" placeholder="Description of content"  size="45" maxlength="144"/></td>
    </tr>
	 <tr>
      <td><input id="year" name="year" type="hidden" value="<?php echo $year_get ?>"/></td>
       <td><input id="week" name="week" type="hidden" value="<?php echo $week_get ?>"/></td>
    </tr>
   
  </table>
		
	</fieldset>
	
	<fieldset>
		<!--<button type="button" name="wbs_btn" id="wbs_btn" value="create" onclick="insElement();" >CREATE ELEMENT</button>
	-->	
	<button type="submit" name="wbs_btn" id="wbs_btn" value="create" >CREATE MEEETING</button>
		
	<br>
		
	</fieldset>
</form>

<!--jscript des autosearch nun nach dem html form input:-->
<script>
	$(document).ready(function () {

	//	$(function() {
			var WBSPortfolio = <?php echo json_encode($arrayAllwbs);?>;	
		$( "#WBSid" ).autocomplete({
			source: WBSPortfolio,
			 minLength: 1
    }).mouseover(function() {
        $(this).autocomplete("search");
			});
		});
</script>
	
	
<script>
$(document).ready(function () {
    $('#WBSid').on('autocompletechange change', function () {
    	$('#WBSid').value(this.value + '.');
      //  $('#showwbs').html('Subject related to wbs-number: ' + this.value);
       // $('#showwbs').html(this.value);
       //  $('#Pid').value(this.value);
    }).change();
});
</script> 
	
</div>
<?php
} // else if permission = 11
?>