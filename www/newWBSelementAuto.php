<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
 include_once('./PDO/connex.php');
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
/*
else { // bis ganz runter zum seitenende, dort die geschweifte klammer zumachen.
// if admin rights, the admin-panel-link-button
if($usrsPermission == 11) //|| ($usrsPermission == 7) 
{ echo'permission  11 is triggered';}*/

?>

<script>

	var wbsPidfield =  document.getElementById('Pid').value;
	alert(wbsPidfield);
$(document).ready(function () {
	$("#wbs_btn").click(function () {
		var msg = $('#topic')
		alert(msg)
	})
});
</script>


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
			 //	$arrayAllwbs[$row['wbsnumber']] = $row['nam'];
 	 			/*$arrayAllwbs[] = $row['nam'];
 	 			$arrayAllwbs[] = $row['wbsnumber'];
 	 				$arrayAllwbs[$row['des']] = $row['wbsnumber'];
 	 				$arrayAllwbs[$row['wbsnumber']] = $row['nam']; */ 
  			 } 
  json_encode($arrayAllwbs);
 // print_r($arrayAllwbs, $return = null);   
?>	

<h3 id="Pidh3">Start with the WBS-ID, follow the coding scheme. Start typing or move mouse to appropriate level of existing Parent-Element (colored bar below) <br></h3>

  <span>Subject related to wbs-number: </span>    <span id="showwbs">--none selected / unspecific-- </span> 
 
<!--Level1 Start-->
<?php

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL1.php');
	
 ?> 
   <nav>
     <ul>

     <li class = "wbsL1">
       <a href="#">WBS-Level1</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 1 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L1'] == 0) {
					echo'  <li><a href="#" id="L1_id' .  $selrow['id'].'" onclick="takewbsL1' . $selrow['id'].'()" class = "wbsL1">' . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};
		// if no wbs level1 found, pop-up dialog with editfields for entering a new project (wbs1 = toplevel = projectname)
					$checklev1 = "1";	
					//$setactiv = "1";				
				$stmt = $pdo->prepare('SELECT * FROM wbs WHERE lev = ?');
				$stmt->bindParam(1, $checklev1, PDO::PARAM_INT);
				//$stmt->bindParam(2, $setactiv, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
				if( ! $row)
				{
					echo '';
					echo '<br><a href= ./newProject.php class="myButton">no project elements <br /> & no project<br /> created yet!<br />klick here for set up new project!</a>';   				
    				//die('nothing found');
				}

?>
			</ul>
		</li>
		<!--</ul>
	</nav>-->
	
	

<!--Level2 Start-->
<?php

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL2.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL2">
       <a href="#">WBS-Level2</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 2 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L2'] == 0) {
					// hier fehlt die Vererbungs-Überprüfung,d.h. ob WBS-element mit id= Wert gleich dem in dieser selrow['L1'] überhaupt activ ist. 	
					echo'  <li><a href="#" id="L2_id' .  $selrow['id'].'" onclick="takewbsL2' . $selrow['id'].'()" class = "wbsL2">' . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->
	


<!--Level3 Start-->
<?php

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL3.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL3">
       <a href="#">WBS-Level3</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 3 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L3'] == 0) {
					echo'  <li><a href="#" id="L3_id' .  $selrow['id'].'" onclick="takewbsL3' . $selrow['id'].'()" class = "wbsL3">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->


<!--Level4 Start-->
<?php

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL4.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL4">
       <a href="#">WBS-Level4</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 4 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L4'] == 0) {
					echo'  <li><a href="#" id="L4_id' .  $selrow['id'].'" onclick="takewbsL4' . $selrow['id'].'()" class = "wbsL4">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
					}
				};

?>
			</ul>
		</li>
	<!--	</ul>
	</nav>-->


<!--Level5 Start-->
<?php

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL5.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL5">
       <a href="#">WBS-Level5</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 5 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L5'] == 0) {
					echo'  <li><a href="#" id="L5_id' .  $selrow['id'].'" onclick="takewbsL5' . $selrow['id'].'()" class = "wbsL5">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
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

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL6.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL6">
       <a href="#">WBS-Level6</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 6 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L6'] == 0) {
					echo'  <li><a href="#" id="L6_id' .  $selrow['id'].'" onclick="takewbsL6' . $selrow['id'].'()" class = "wbsL6">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
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

include './PDO/connex.php'; // Datei für DB-Verbindung laden $pdo= ...
// include 'pdoconnex.php'; // Datei für DB-Verbindung laden $pdo= ...
 include('./jsPHP/js_takewbsL7.php');
	
 ?> 
  <!-- <nav>
     <ul>-->

     <li class = "wbsL7">
       <a href="#">WBS-Level7</a>
         <ul>



          
<?php
	

	
	$select = $pdo->query("SELECT * FROM wbs WHERE lev = 7 && activ = 1"); //2do: eine global verfügbare variable fürs Project - dann können alle projekte auf einem table laufen:  WHERE projectname = '$projectname'");
				while($selrow = $select->fetch()) {
					// nur wenn der Inhalt der Zelle row/qr nicht leer ist, wird "ge-echo't":
					if($selrow['L7'] == 0) {
					echo'  <li><a href="#" id="L7_id' .  $selrow['id'].'" onclick="takewbsL7' . $selrow['id'].'()" class = "wbsL7">'  . $selrow['wbsnumber'] .'&nbsp;'.$selrow['nam'].  '</a></li>' . "\n";		
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
      <td align="right">WBS-ID:</td>
      <td><input id="WBSid" name="WBSid" type="text" placeholder="Follow the methodology/ use the same as in ERP/PS" value="" size="40" maxlength="80" /></td>
    </tr>   
    <tr>
      <td align="right">Element-Name:</td>
      <td><input id="topic" name="topic" type="text" placeholder="Caption of your new deliverable/ WBS-Element"  size="40" maxlength="80"/></td>
    </tr>
     <tr>
      <td align="right">Element-Description:</td>
      <td><input id="descr" name="descr" type="text" placeholder="Description of deliverable"  size="40" maxlength="80"/></td>
    </tr>

    
    <tr>
     
      <td><input id="Pid" name="Pid" type="hidden" placeholder="The related/ higher leveled WBS-Element"  value="" size="40" maxlength="80" /></td>
    </tr>
     <tr>
      <td align="right">ParentWBS:</td>
      <td><input id="ParentWBS" name="ParentWBS" type="text" placeholder="The related/ higher leveled WBS-Element" required autofocus value="<?php echo $submitted_projectname; ?>" size="32" maxlength="128" /></td>
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
		<!--<button type="button" name="wbs_btn" id="wbs_btn" value="create" onclick="insElement();" >CREATE ELEMENT</button>
	-->	
	<button type="submit" name="wbs_btn" id="wbs_btn" value="create" >CREATE ELEMENT</button>
		
	<br>
		
	</fieldset>
</form>

<!--jscript des autosearch nun nach dem html form input:-->
<script>
	$(document).ready(function () {

	//	$(function() {
			var WBSPortfolio = <?php echo json_encode($arrayAllwbs);?>;	
		$( "#ParentWBS" ).autocomplete({
			source: WBSPortfolio,
			 minLength: 1
    }).mouseover(function() {
        $(this).autocomplete("search");
			});
		});
</script>
	
	
<script>
$(document).ready(function () {
    $('#wbsSelect').on('autocompletechange change', function () {
      //  $('#showwbs').html('Subject related to wbs-number: ' + this.value);
        $('#showwbs').html(this.value);
    }).change();
});
</script> 
	

</div>
<?php
} // else if permission = 11
?>