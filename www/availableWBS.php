<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
 include_once('./PDO/connex.php');
 $usrArray = $_SESSION['user'];
		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 
<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
    if (typeof jQuery == 'undefined') {
        	document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery.dataTables.css" /%3E'));
 			document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.css" /%3E'));
         document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.structure.css" /%3E'));
         document.write(unescape('%3Clink rel="stylesheet" type="text/css" href="CSS/jquery-ui.theme.css" /%3E'));
             
        document.write(unescape('%3Cscript type="text/javascript" src="JScripts/jquery-1.11.3.min.js" %3E%3C/script%3E'));
        document.write(unescape('%3Cscript type="text/javascript" src="JScripts/jquery-ui.min.js" %3E%3C/script%3E'));
        document.write(unescape('%3Cscript type="text/javascript" src="JScripts/jquery.dataTables.min.js" %3E%3C/script%3E'));
    }
</script>	
	<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
			    <script>window.jQuery.ui || document.write('<script src="JScripts/jquery-ui.min.js"><\/script>')</script>
         
<!-- DataTables js-->
			<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
				 <script>jQuery.fn.dataTables || document.write('<script src="JScripts/jquery.dataTables.min.js"><\/script>')</script>
         

		<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
		<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
		<link rel="stylesheet" href="CSS/button.css" type="text/css" />
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/cssovtables.css"> 	<!--<div class="cssov">-->

	<title>C-BOARD: manage access of forums (boardwide AND/OR user-specific)</title>

</head>

<?php

	echo '<p style="float: right;">	
	<a href="newWBSelement.php" class="myButton" title="create a new forum by adding a new wbs-element!">wbs admin.</a>	
	<a href="overview.php" class="myButtonBlu" title="the WBS-structured board-sight">WBS/ overview</a>
	</p>'; // Thema erstellen-Link
	
	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: M A N A G E - W B S - P E R M I S S I O N S </h2><hr />';
 	echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
	echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;">s e t  _ A V A I L A B I L I T Y _  b o a r d w i d e - o r -  u s e r s p e c i f i c </h3></td></tr></table><br>';

	$arrayUsrsNames = array(); // array für alle möglichen user-bezeichner nach welchen via autocomplete gesucht werden kann / wird
			$getusrsnomen = $pdo->prepare('SELECT id,username FROM usrsprofiles');
			$getusrsnomen->execute();
				while ($nomenrow = $getusrsnomen->fetch(PDO::FETCH_ASSOC)) 
				{
			 	$arrayUsrsNames[] = $nomenrow['username'];
 	 			} 
  			json_encode($arrayUsrsNames);
 ?>

 <form  action="availableWBS.php"  id="usrsname" name="usrsname" method="post" >
   
	<table>
      <tr><!-- align="left">-->
       <td align="left">Set WBS-access of user:</td>
       <td align="left"><input id="usrIDsetAccessOf" name="usrIDsetAccessOf" placeholder="Select with Mouse & press Return"  size="44" maxlength="80" /></td>
      	
  		</tr>
  	</table>		
</form>

<?php
 // get user variable from $_GET start:
 if ( isset( $_POST['usrIDsetAccessOf'] ) && !empty( $_POST['usrIDsetAccessOf'] ) )
 {
 	$selectedUsername = $_POST['usrIDsetAccessOf'];
 	echo '&gt; ready to set permissions for user <b>'. $selectedUsername .'</b>';
 	
 	
	$getID = $pdo->prepare('SELECT id,username FROM usrsprofiles WHERE username=?');
	$getID->bindParam(1, $selectedUsername);
	$getID->execute();
	$UsarsID = $getID->fetch(PDO::FETCH_ASSOC);	
 	//
 
 }
 
 
// fixed html part of the table:
echo'<table id="example" class="display" width="100%" cellspacing="0" style="font-size:0.9em;
	font-family:Arial,Helvetica,Verdana,sans-serif; color:#666">
         <thead align="left">
            <tr>
                <th>WBS-ID</th>
                <th>WBS-Name</th>
                <th>WBS-Description</th>
                <th>Level</th>
                <th>board-wide-access</th>
                <th>board-status</th>
                <th>'.$selectedUsername.'<b>s</b> access is:</th>
                <th>set permission</th>
                
                ';
             	
           echo' </tr>
        </thead>
 
         <tbody>';
// 
// php-driven html part of the table:
				

	
						$getallwbs = $pdo->prepare('SELECT * FROM wbs');
						$getallwbs->execute();
						 while ($trow = $getallwbs->fetch(PDO::FETCH_ASSOC)) {
						 	echo '<tr>
	 									<td>'.$trow['wbsnumber'].'</td>
	 									<td>'.$trow['nam'].'</td>
	 									<td>'.$trow['des'].'</td>	
	 									<td>'.$trow['lev'].'</td>';	 			
	 								echo'<td>
											<form action="UpdateWBSaccess.php" method="post">
  												 <select name="SetAccess2" class="myButtonC" >
    												<option value="1">activate
   												<option value="0">grey out
   											 </select>
												<input type="hidden" name="wbsID2update" id="wbsID2update" value="'.$trow['id'].'" />
												<input type=submit value="set" class="myButtonAzureS" >
											</form>	
	 									</td>';if($trow['activ'] == 1)
	 				 
					{echo'<td><font color=green><b>activ</b></font></td>';}
	 				
	 				elseif($trow['activ'] == 0)
	 				 
	 				 {echo'<td><font color=grey><i>idle</i></font></td>';}
	 		$USRid2SETaccess4 =$UsarsID['id']; 	
							
								 
	 				if($trow["$USRid2SETaccess4"] == 1 OR $trow["$USRid2SETaccess4"] == 3)
	 					{echo'<td><font color=green><b>granted</b></font></td>';}
	 				
	 				elseif($trow["$USRid2SETaccess4"] == 0)
	 					 {echo'<td><font color=red><b>denied</b></font></td>';}			 	
 				 					
								echo'<td>
											<form action="UpdateWBSUsraccess.php" method="post">
  												 <select name="SetwbsAccess" class="myButtonC" >
    												<option value="1">granted
   												<option value="0">denied
   											 </select>
												<input type="hidden" name="wbsID4accss" id="wbsID4accss" value="'.$trow['id'].'" />
												<input type="hidden" name="usersheaderid" id="usersheaderid" value="'.$USRid2SETaccess4.'" />
												<input type=submit value="set" class="myButtonAzureS" >
											</form>	
	 									</td>';
	 			echo'</tr>'; 
  			 } 
         
		 
		echo'
			</tbody>
		</table>			
		';  // echo html-table ende    
?>	  

<script>		
		$(document).ready(function() {
  			 $('#example').dataTable( {
      	  "scrollY":        444,
     		   "scrollCollapse": true,
      		"jQueryUI":       true,
      		  "paging": false
      		//"iDisplayLength": 50
  			  } );
		} );  
</script>
		


<script>
	$(document).ready(function () {
			var usrnamesportfolio = <?php echo json_encode($arrayUsrsNames);?>;	
		$( "#usrIDsetAccessOf" ).autocomplete({
			source: usrnamesportfolio,
			 minLength: 0
    }).mouseover(function() {
        $(this).autocomplete("search");
    });
});
</script>

           