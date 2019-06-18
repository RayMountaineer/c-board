<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) C-CYBERNETICS 2015,2016,2017,2018,2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

	/*
	newWBSelemt.php WBS-ID-selection via dropdpwn or autocomplete in form to be made as the basis for the concatenated new WBS-ID.
	User Adds meaniingful name and description of deliverable in form -> PDO INSERT into ProjectDatabase processings in wbscreator.php
	|---> projectfolder/overview.php
	|-> case: new-project-form 	-> InsNewProject.php
	|-> case: wbs-form 			-> wbscreator.php
	Requires:
	+ ./PDO/connex.php (connexion strings)
	Directly accessible for users with admin-or-wbs-creator status (11 or 7) from overview.php [wbs admin.] (green button)
	*/

 
// start user login-status & redirect if user is not set:
	if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
		header ("Location: ./login/login.php"); 
 		die("Redirecting to ./login/login.php");
		}		
	
// include PDO-database-connection:
 include_once './PDO/connex.php';
	$usrArray = $_SESSION['user'];
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];  


// start: permission-check

$usrsPermission = $usrArray['permission'];
if($usrsPermission == 1) //|| ($usrsPermission == 0)
{echo '

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" />  
	
<link rel="shortcut icon" type="image/ico" href="https://c-board.de/start/images/favicon.ico"> 

	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" /> 
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" /> 
 <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
	<title>TREE STRUCTURE GENERATOR :: WBS STRUCTURED DISCUSSION BOARD</title>

</head>
     
<body>
<!-- header 4 non-wbs/ admin user end-->
		
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
elseif(($usrsPermission == 11) or ($usrsPermission == 7)) {
 ?><!DOCTYPE html>
 	<!--
		This is C-CYBERNETICS!
		Our business is to help - with deployment, customizing, courses about doing SCRUM in a virtual team, change management to project-organized virtual enterprises...
		If you need some support: jobs@c-cybernetics.com
	-->
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
        <script>window.jQuery.ui || document.write('<script src="JScripts/jquery-ui.min.js"><\/script>')</script>
        <link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
        <link rel="stylesheet" href="./CSS/dropdownstylesWBSlevels.css" type="text/css" /> 
        <link rel="stylesheet" href="./CSS/button.css" type="text/css" /> 
     <!--CFLX-part start-->	
        <link rel="stylesheet" href="CSS/html.css"> 	 
        <link rel="stylesheet" href="CSS/cssboardhead-Neo.css"> 	
    
    <title>TREE STRUCTURE GENERATOR :: WBS STRUCTURED DISCUSSION BOARD</title>
   
   </head>    
   <body>
   
    <div style="z-index:100; display:block;">
     <br> 
     <form action="wbscreator.php" method="POST" id="nwbs">
     <fieldset>
      <legend>CREATE NEW WBS-ELEMENT</legend>
    
      <table border="0" cellpadding="0" cellspacing="4">    
       <tr>
         <td align="right">Add new WBS-ID:</td>
         <td><input id="WBSid" name="WBSid" type="text" placeholder="Follow the methodology/ use the same as in ERP/PS" value="" size="45" maxlength="80" /></td>
       </tr>   
       <tr>
         <td align="right">Element-Name:</td>
         <td><input id="topic" name="topic" type="text" placeholder="Caption of your new deliverable/ WBS-Element"  size="45" maxlength="80"/></td>
       </tr>
        <tr>
         <td align="right">Element-Description:</td>
         <td><input id="descr" name="descr" type="text" placeholder="Description of deliverable"  size="45" maxlength="80"/></td>
       </tr>
   
     <!--  
       <tr>
        
         <td><input id="Pid" name="Pid" type="hidden" placeholder="The related/ higher leveled WBS-Element"  value="" size="40" maxlength="80" /></td>
       </tr>
       -->
     </table>
     
    </fieldset>
    
    <fieldset>
      
    <button type="submit" name="wbs_btn" id="wbs_btn" value="create" >CREATE ELEMENT</button>    
    <br>  
    </fieldset>
   </form>
   <div id="go4it"></div> 
   <script>
    $(document).ready(function () {
    
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
          
       }).change();
   });
   </script> 
    
   </div>
 </body>
 <?php
 } // else if permission = 11
?>