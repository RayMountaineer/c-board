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
<!--<link rel="stylesheet" href="DataTables.css" type="text/css" /> -->
<!-- jQuery -->
	<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
 <!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

	<link rel="stylesheet" href="standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/cssovtables.css"> 
 <!-- <link rel="stylesheet" href="CSS/jquery.dataTables.css">-->
      <link rel="stylesheet" href="CSS/ovtablestyle2.css">	 	<!--<div class="cssactivusr">-->
<!--  <link rel="stylesheet" href="CSS/cssovtables.css"> -->	<!--<div class="cssov">-->

	<title>C-BOARD: ONE-TABLE-OVERVIEW</title>
</head>
 
 <?php
	$usrArray = $_SESSION['user'];
	/*	echo 'You are logged in as User: "<font color="red"><b>'.$usrArray['username'].'</b></font>"<br>
		With the email-address: "<font color="red"><b>'.$usrArray['email'].'</b></font>"<br>';*/

// start user login-status & redirect if not:
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
		header ("Location: ./login/login.php");
	}
// start: permission-check
	$usrsPermission = $usrArray['permission'];

//	echo 'Permission Status is set to: '.$usrsPermission;
	if(!(($usrsPermission == "11") xor ($usrsPermission == "7"))) // if not 7 x0r 11 - no access!
	{echo '
		<form action="./login/logout.php" method="post" id="login">
		<fieldset>
		<legend>A C C E S S   D E N I E D</legend>
			 <table border="0" cellpadding="0" cellspacing="4">
       	<tr>
      		<td align="left"> You do not have the permission to access and re-activate the deleted threads of this C-BOARD-instance (yet).<br><br>
				Your permissions need to be set by the cboard-admin before you get access.<br>
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

else { // bis ganz runter zum seitenende, dort die geschweifte klammer zumachen.

 require_once("./PDO/connex.php");
 	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the WBS-structured board-sight">WBS/ overview</a></p>'; 
	echo '<h2 style="font-size: 1.6em; font-weight: 400; ">C-BOARD :: C L O S E D - T H R E A D S - O V E R V I E W  </h2><hr />';
 	echo '<table border=2 bordercolor="orange" width="100%" class="cssov">'; 
	echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;">o v e r l o o k _  A L L  -  T H R E A D S  _ d e - a c t i v a t e d</h3></td></tr></table>';
// admin-user-header-table end

// table start - beginn with fixed html part of the table (table header, table footer, table "framework/design"):
echo'<table id="example" class="cssactivusr" cellspacing="0" style="width:100% !important; font-size:0.9em;
	font-family:Arial,Helvetica,Verdana,sans-serif; color:#666; ">
<colgroup> 
	<col width="7%" />
	<col width="1%" />
	<col width="24%" />
	<col width="4%" />
	<col width="22%" /> 
	<col width="25%" /> 
	<col width="6%" />
	<col width="6%" />    
</colgroup>
         <thead align="left">
            <tr>
               <th>WBS-ID</th>
                <th>Level</th>
                <th>WBS-Name</th>
                <th>WBS-Status</th>
                <th>Thread-Title</th>
                <th>Thread-Description</th>
                <th>Date</th>
                <th>Re-activate</th>
               
                
            </tr>
        </thead>
 
        <tfoot align="left">
            <tr>
                <th>WBS-ID</th>
                <th>Level</th>
                <th>WBS-Name</th>
                <th>WBS-Status</th>
                <th>Thread-Title</th>
                <th>Thread-Description</th>
                <th>Date</th>
                <th>Re-activate</th>
              
            </tr>
        </tfoot>
 
        <tbody>';
// get inactive threads:
	$closedstat = 1;
	$getinActiv = $pdo->prepare('SELECT ID,Pid,topic,dscrption,created FROM strg WHERE closed=? ORDER by created DESC');
	$getinActiv->bindParam(1, $closedstat, PDO::PARAM_INT); // closed auf 1
	$getinActiv->execute();   
	while ($rowThread = $getinActiv->fetch(PDO::FETCH_ASSOC)) {	// as long as there are threads with closed = 1   
  // go, suck the wbs-data fo thread's wbs-element:
  	$wbsIDofThread = $rowThread['Pid'];
 
  	
	// for the user-specific sights: user-ID & default view settings-dependant	
	$IDofUsrViewing = $usrArray['id'];
	$getwbs = $pdo->prepare('SELECT id,lev,nam,des,wbsnumber,activ FROM wbs WHERE id=?');
	$getwbs->bindParam(1, $wbsIDofThread, PDO::PARAM_INT); // select wbs-data where id = Pid
	$getwbs->execute();        
 		while ($rowwbs = $getwbs->fetch(PDO::FETCH_ASSOC)) {	// as long as there are wbs-elements with the actual user has access to, lookup for related forum_posts:
// need dynamic, row-dependend change of var $actualWBSid -> do the query in here (besser wäre wohl ein einmaliges query der db, fetch ins array, und select from the array - dependant on the wbs-id...)

	 echo'<tr>';
	// echo '<td>testdata</td>'; //1
	 	echo '<td>' . $rowwbs['id'] .'</td>'; //1
 		echo '<td>' . $rowwbs['lev'] .'</td>'; //2
 		echo '<td>' . $rowwbs['nam'] .'</td>'; //3
		echo '<td>' . $rowwbs['activ'] .'</td>'; //4
		echo '<td>' . $rowThread['topic'] .'</td>'; //5
		echo '<td>' . $rowThread['dscrption'] .'</td>'; //6	
		echo '<td>' . $rowThread['created'] .'</td>'; //7
		
		echo '<td>
											<form action="UpdateSTRGstatus.php" method="post">
											
												<input type="hidden" name="SetAccess2" id="SetAccess2" value="0" />
  												
												<input type="hidden" name="strgID2update" id="strgID2update" value="'.$rowThread['ID'].'" />
												<input type=submit value="re-activate" class="myButtonAzureS" >
											</form>	
	 									</td>';	
		//'<td>' . $rowThread['created'] .'</td>'; //8
																	
	
echo'</tr>';
	}// while wbs available
}	// while posting available
  echo'	</tbody></table>';  // echo html-table ende    
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
		
		
		
  
 <?php
 
} // ende der else-klammer für activated users (--> none-zero-users = permission to view the list)


