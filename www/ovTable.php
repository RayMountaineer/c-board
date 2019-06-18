<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
		header ("Location: ./login/login.php"); 
 		die("Redirecting to ./login/login.php");
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
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/cssovtables.css"> 
      <link rel="stylesheet" href="CSS/ovtablestyle2.css">	 
	<title>C-BOARD: ONE-TABLE-OVERVIEW</title>
</head>
 
 <?php
	
// start: permission-check
	$usrsPermission = $usrArray['permission'];
	if($usrsPermission == 0) // if not activated - no access!
	{echo '
		<form action="./login/logout.php" method="post" id="login">
		<fieldset>
		<legend>A C C E S S   D E N I E D</legend>
			 <table border="0" cellpadding="0" cellspacing="4">
       	<tr>
      		<td align="left"> You do not have the permission to access the user administration of the cboard (yet).<br><br>
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
	echo '<h2 style="font-size: 1.6em; font-weight: 400; ">C-BOARD :: O N E -  T A B L E  - O V E R V I E W  </h2><hr />';
 	echo '<table border=2 bordercolor="orange" width="100%" class="cssov">'; 
	echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;">o v e r l o o k _  A L L  -  P O S T I N G S  _ a c c e s s i b l e</h3></td></tr></table>';
// admin-user-header-table end

// table start - beginn with fixed html part of the table (table header, table footer, table "framework/design"):
echo'<table id="example" class="cssactivusr" cellspacing="0" style="width:100% !important; font-size:0.9em;
	font-family:Arial,Helvetica,Verdana,sans-serif; color:#666; ">
<colgroup> 
	<col width="7%" />
	<col width="1%" />
	<col width="4%" />
	<col width="17%" />
	<col width="20%" /> 
	<col width="10%" /> 
	<col width="30%" />
	<col width="6%" />    
</colgroup>
         <thead align="left">
            <tr>
               <th>WBS-ID</th>
                <th>Level</th>
                <th>WBS-Name</th>
                <th>WBS-Description</th>
                <th>Subject</th>
                <th>Author</th>
                <th>Postings (click!)</th>
                <th>Date</th>
               
                
            </tr>
        </thead>
 
        <tfoot align="left">
            <tr>
                <th>WBS-ID</th>
                <th>Level</th>
                <th>WBS-Name</th>
                <th>WBS-Description</th>
                <th>Subject</th>
                <th>Author</th>
                <th>Factual mssg (shortened, click to view)</th>
                <th>Date</th>
              
            </tr>
        </tfoot>
 
        <tbody>';
     
	// for the user-specific sights: user-ID & default view settings-dependant	
$IDofUsrViewing = $usrArray['id'];
$usrsDefaultView = 1;
$usrsInvisibleView = 4;
$activL1 = 1; 
$getwbs = $pdo->prepare('SELECT * FROM wbs WHERE activ=? && `'.$IDofUsrViewing.'`=? or `'.$IDofUsrViewing.'`=?');
$getwbs->bindParam(1, $activL1, PDO::PARAM_INT); // activ auf 1
$getwbs->bindParam(2, $usrsDefaultView, PDO::PARAM_INT); // usrID-Spalte auf 1 (default)
$getwbs->bindParam(3, $usrsInvisibleView, PDO::PARAM_INT); // usrID-Spalte auf 3 (invisible)
$getwbs->execute();        
 
 
 
while ($rowwbs = $getwbs->fetch(PDO::FETCH_ASSOC)) {	// as long as there are wbs-elements with the actual user has access to, lookup for related forum_posts:
// need dynamic, row-dependend change of var $actualWBSid -> do the query in here (besser wäre wohl ein einmaliges query der db, fetch ins array, und select from the array - dependant on the wbs-id...)
	
    // select all forum-posts related to the selected wbs-item / wbs-query-row     
$actualWBSid = $rowwbs['id'];
$getposts = $pdo->prepare('SELECT * FROM forum_posts WHERE Pid = ? ORDER by created DESC ');
$getposts->bindParam(1, $actualWBSid, PDO::PARAM_INT); // activ auf 1
$getposts->execute();

	while ($rowposts = $getposts->fetch(PDO::FETCH_ASSOC)) {	// as long as there are forum_posts with wbs-id, fill up new <table-rows> with <table-data>:

	 echo'<tr>';
	// echo '<td>testdata</td>'; //1
	 	echo '<td>' . $rowwbs['wbsnumber'] .'</td>'; //1
 		echo '<td>' . $rowwbs['lev'] .'</td>'; //2
 		echo '<td>' . $rowwbs['nam'] .'</td>'; //3
		echo '<td>' . $rowwbs['des'] .'</td>'; //4
		echo '<td>' . $rowposts['topic'] .'</td>'; //5
		echo '<td>' . $rowposts['username'] .'</td>'; //6	
																	//7		
		// start a-href-text in form of factual mssg:
		echo '<td> <span id="spandtable" style="font-size: 1 em;
font-style: normal;
font-weight: normal;
text-align: left;
text-decoration: none;
text-indent: 0;
text-transform: none;
display: inline; " >
				<a href=threadview.php?ID=' . $rowposts['tid'] .'#'.$rowposts['ID'].' title="click to show in forum-thread">';
			 	
			 	if(strlen($rowposts['text']) >= 66) { // shorten, if longer than 66 signs
			 		echo substr($rowposts['text'], 0, 66);
			 		echo'...'; 
							  } else {
			  		echo $rowposts['text'];  
							  }
	echo'	</span></a></td>';
// end a href text-factual-mssg			
	
//		echo '<td>' . $rowposts['text'] .'</td>'; //7
		echo '<td>' . $rowposts['created'] .'</td>'; //8
		
																	//9
	
echo'</tr>';
	
	} // while wbs available
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
 
// einschub btn view deleted threads
	if(($usrsPermission == 11) or ($usrsPermission == 7))
		{
		echo '<span style="margin-right:1em; display:table;">
		<a href="ovViewDeleted.php" class="myButtonOrange" title="view and re-activate deleted threads">view deleted threads</a>
			</span>'; 
		}
// view deleted btn end
} // ende der else-klammer für activated users (--> none-zero-users = permission to view the list)


