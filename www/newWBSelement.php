<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
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

// include PDO-database-connection:
 include_once './PDO/connex.php';

	

// start user login-status & redirect if user is not set:
	if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
		header ("Location: ./login/login.php"); 
 		die("Redirecting to ./login/login.php");
		}		
	
	$usrArray = $_SESSION['user'];
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];  

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
<?php

// start: permission-check

$usrsPermission = $usrArray['permission'];
if($usrsPermission == 1) //|| ($usrsPermission == 0)
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
elseif(($usrsPermission == 11) or ($usrsPermission == 7)) { 

?>



<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>
	
	
<h2 style="font-size: 1.6em; font-weight: 400; ">C-BOARD :: W O R K - B R E A K D O W N - S T R U C T U R E</h2><hr />
 		

<table border=2 bordercolor="orange" width="100%" class="cssov">
<tr style="line-height: 1.3em;"><td><h3 style="font-size: 1.3em;  padding: 0.9em; text-align:center;"> c r e a t e _  W B S - B O A R D - E L E M E N T S _ h i e r a r c h i c a l </h3>
</td></tr></table>

 <div id="wrapper" style="z-index:15; display:block;">


<p style="float: right;"><a href="availableWBS.php" class="myButton" title="activate & deactivate / grant & deny access / boardwide & userspecific">WBS/ set availability</a></p>
	
<!--EINSCHUB: autosearch Pid-->
<?php
	$arrayAllwbs = array();
			
			$activated = 1;
			$getElements = $pdo->prepare('SELECT nam,des,wbsnumber FROM wbs WHERE activ=? ');
			$getElements->bindParam(1, $activated, PDO::PARAM_INT); // activ auf 1
			$getElements->execute();
				while ($WBSrow = $getElements->fetch(PDO::FETCH_ASSOC)) 
				{
				$arrayAllwbs[] = $WBSrow['wbsnumber']; 
  			 } 
  json_encode($arrayAllwbs); 
?>	
<span class="drag-hint">
    <span>Start with the WBS-ID, follow the coding scheme.<br> 
Move mouse to appropriate level of existing Parent-Element (colored bar below) <br>
<i>or</i> start typing the new WBS-ID in the text field below</span>
info!</span> 
	
<script>
function takewbsNuevo(wbs_row_id, wbs_row_wbsnumber, wbs_row_level) {
   
   IDofElement = (wbs_row_level + "_id" + wbs_row_id);
   	return document.getElementById("WBSid").value = wbs_row_wbsnumber +'.'; 
	
}
</script>


<script>
function takewbsNuevoTest1(wbs_row_id, wbs_row_wbsnumber, wbs_row_level) {
   
   IDofElement = (wbs_row_level + "_id" + wbs_row_id);
   	 document.write (wbs_row_id); 
   			 document.write ( document.getElementById(IDofElement).text);
	
}
</script>
<?php

include_once './PDO/connex.php';   
	
 ?> 
   <nav>
     <ul>

     <li class = "wbsL1">
       <a href="#">WBS-Level1</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 1 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L1'] == 0) {
					echo'  <li><a href="#go4it" id="L1_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL1">' . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};
		
					$checklev1 = "1";	 		
				$stmt = $pdo->prepare('SELECT * FROM wbs WHERE lev = ?');
				$stmt->bindParam(1, $checklev1, PDO::PARAM_INT);
				 
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
				if( ! $row)
				{
					echo '';
					echo '<br><a href= ./newProject.php class="myButton">no project elements <br /> & no project<br /> created yet!<br />click here for setting up a new project!</a>';   				
    				//die('nothing found');
				}

?>
			</ul>
		</li>
		<!--</ul>
	</nav>-->
	
	

<!--Level2 Start-->
<?php

include_once './PDO/connex.php';  
 
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL2">
       <a href="#">WBS-Level2</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 2 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L2'] == 0) {
					// hier fehlt die Vererbungs-Überprüfung,d.h. ob WBS-element mit id= Wert gleich dem in dieser selrow['L1'] überhaupt activ ist. 	
					echo'  <li><a href="#go4it" id="L2_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL2">' . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->
	


<!--Level3 Start-->
<?php

include_once './PDO/connex.php'; 
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL3">
       <a href="#">WBS-Level3</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 3 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L3'] == 0) {
					echo'  <li><a href="#go4it" id="L3_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL3">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->


<!--Level4 Start-->
<?php

include_once './PDO/connex.php';  
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL4">
       <a href="#">WBS-Level4</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 4 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L4'] == 0) {
					echo'  <li><a href="#go4it" id="L4_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL4">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->


<!--Level5 Start-->
<?php

include_once './PDO/connex.php';  
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL5">
       <a href="#">WBS-Level5</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 5 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L5'] == 0) {
					echo'  <li><a href="#go4it" id="L5_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL5">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
		<!--</ul>
	</nav>
	-->


<!--Level6 Start-->
<?php

include_once './PDO/connex.php';  
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL6">
       <a href="#">WBS-Level6</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 6 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L6'] == 0) {
					echo'  <li><a href="#go4it" id="L6_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL6">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
		<!--</ul>
	</nav>
	-->


<!--Level7 Start-->
<?php

include_once './PDO/connex.php';  
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL7">
       <a href="#">WBS-Level7</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 7 && activ = 1");  
				while($selrow = $select->fetch()) {
					 
					if($selrow['L7'] == 0) {
					echo'  <li><a href="#go4it" id="L7_id' .  $selrow['id'].'" onclick="takewbsNuevo(\'' . $selrow['id'] .'\',\'' . $selrow['wbsnumber'] .'\',\'' . $selrow['lev'] .'\')" class = "wbsL7">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

// if permission 7 or 11 ende
//}
?>
			</ul>
		</li>
		


</ul>
</nav>
	
	</div>

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
<?php
} // else if permission = 11
?>