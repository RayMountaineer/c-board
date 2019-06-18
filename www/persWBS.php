<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	

 include_once('./PDO/connex.php');
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
<!-- jQuery with google cdn and local fallback:-->
   	<!-- das jquery "original-cdn" mal hoch, um ggfls. den typeof zu triggern
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        		<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
			    <script>window.jQuery.ui || document.write('<script src="JScripts/jquery-ui.min.js"><\/script>')</script>
         
<!-- DataTables js-->
			<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
				 <script>jQuery.fn.dataTables || document.write('<script src="JScripts/jquery.dataTables.min.js"><\/script>')</script>
     

	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/wbslayout.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/cssovtables.css"> 	<!--<div class="cssov">-->

	<title>C-BOARD: manage mySight</title>

</head>

<?php
 	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>'; 
	echo '<h2 style="font-size: 1.6em; font-weight: 400; ">C-BOARD :: M A N A G E - Y O U R - B O A R D  - S I G H T</h2><hr />';
 	echo '<table border=2 bordercolor="orange" width="100%" class="cssov">';  
	echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;"> m a k e _  W B S - F O R U M S  _ v i s i b l e    /    i n v i s i b l e</h3></td></tr></table>';
// for the user-specific sights: user-ID & default view setting (overview.php - wide):	

$usrArray = $_SESSION['user'];
$IDofUsrViewing = $usrArray['id'];														
$usrsDefaultView = 1;
$usrsInvisibleView = 3;

$activL1 = 1;
//$getwbs = $pdo->prepare('SELECT id,lev,L1,nam,des,activ,'.$IDofUsrViewing.' FROM wbs WHERE lev=? && activ=? && '.$IDofUsrViewing.'=?');
$getwbs = $pdo->prepare('SELECT * FROM wbs WHERE activ=? && `'.$IDofUsrViewing.'`=? or `'.$IDofUsrViewing.'`=?');

$getwbs->bindParam(1, $activL1, PDO::PARAM_INT); // activ auf 1
$getwbs->bindParam(2, $usrsDefaultView, PDO::PARAM_INT); // usrID-Spalte auf 1 (default)
$getwbs->bindParam(3, $usrsInvisibleView, PDO::PARAM_INT); // usrID-Spalte auf 3 (invisible)
$getwbs->execute();
//

 
// fixed html part of the table:
echo'<table id="example" class="display" width="100%" cellspacing="0" style="font-size:0.9em;
	font-family:Arial,Helvetica,Verdana,sans-serif; color:#666">
         <thead align="left">
            <tr>
                <th style="width:12%;">WBS-ID</th>
                 <th style="width:20%;">WBS-Name</th>
                 <th style="width:33%;">WBS-Description</th>
                  <th style="width:14%;">Set Show/ Hide</th>
                  <th style="width:7%;">Is Set To</th>
                  <th style="width:14%;">Resulting View Status</th>
            </tr>
        </thead>
 
        <tfoot align="left">
            <tr>
                <th>WBS-ID</th>
                <th>WBS-Name</th>
                <th>WBS-Description</th>
                 <th>Set Show/ Hide</th>
                 <th>Is Set To</th>
                <th>Resulting View Status</th>
                 
            </tr>
        </tfoot>
 
        <tbody>';
  
			while ($row = $getwbs->fetch(PDO::FETCH_ASSOC)) 
			{
 	 			echo '<tr>
	 			<td>'.$row['wbsnumber'].'</td>
	 			<td>'.$row['nam'].'</td>
	 			<td>'.$row['des'].'</td>';
	// start: <td> mit-selector-und-button </td> 		 			
	 			echo'<td>
					<form action="UpdateWBS.php" method="post">
  						<select name="PermSelected2" class="myButtonC" >
    						<option value="1">show
   						<option value="3">hide
   					 </select>
						<input type="hidden" name="wbsID4update" id="wbsID4update" value="'.$row['id'].'" />
						<input type=submit value="change sight" class="myButtonAzureS" >
					</form>	
	 				</td>';
	
	 				if($row["$IDofUsrViewing"] == 1)
	 				//{$status = "visible";}
					{echo'<td><b>visible</b></td>';}
	 				
	 				elseif($row["$IDofUsrViewing"] == 3)
	 				 //{$status = "hidden";} 
	 				 {echo'<td><font color=grey><i>hidden</i></font></td>';}
	 			 
// Ansatz Array V1
// steps:
// 1) create array with all status-3-elements
// 2) use active row['wbsnumber'] element
// 2.1) create while-loop to take one array-element after the other
// 2.2) shorten row['wbsnumber']element to the len of first element in array
// 2.3) compare it with element, if == --> <td>invisible</td>
// 2.4) nxt array element if !=

 //  clear static cache:
 clearstatcache();

	$activated = 1;
	$search4three =3;
		$getPwbs = $pdo->prepare('SELECT wbsnumber FROM wbs WHERE (activ=? && `'.$IDofUsrViewing.'`=? )'); 
		$getPwbs->bindParam(1, $activated, PDO::PARAM_INT); // activ on 1
		$getPwbs->bindParam(2, $search4three, PDO::PARAM_INT); // usrID-Col on 1 (default)
		$getPwbs->execute();

// first: check if there are any results (or: if not one is set to 3)
		if ($getPwbs->rowCount() > 0) {
  //... got results ...
// zu 1)						
			while ($InactivParent = $getPwbs->fetch(PDO::FETCH_ASSOC)) {	 
	// zu 2.2) a) check length of array in while-loop; b) shorten $row['wbsnumber'] to same length; c) compare if ==
			$InactPLen = strlen($InactivParent['wbsnumber']);
			//echo 'InactPLen= '.$InactPLen;
			$relWBSpart = substr($row['wbsnumber'],0,$InactPLen);			 						
						
			if($relWBSpart == $InactivParent['wbsnumber']) { 
				echo '<td><font color="red"><i>hidden</i></font> from WBS-ID '.$InactivParent['wbsnumber'].'</td>';
				break;
				}
				else {echo'<td><font color=green><b>visible</b></font></td>';}	break;
					}
			
			} else // not one is set to 3, so all are visible: 	
				{echo'<td><font color=green><b>visible</b></font></td>';
				}
	
	// StatusVererbung ENDE 	
  			 } 
         
		// fixed closing part of the table:
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
		
		
		
            