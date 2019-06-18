<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	

$usrArray = $_SESSION['user'];
 include_once('./PDO/connex.php');
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
       

	<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/cssovtables.css"> 
     <!-- <link rel="stylesheet" href="CSS/jquery.dataTables.css">-->
         <link rel="stylesheet" href="CSS/ovtablestyle2.css">	 	<!--<div class="cssactivusr">-->
     
    <!--  <link rel="stylesheet" href="CSS/cssovtables.css"> -->	<!--<div class="cssov">-->

	<title>..::myCFLX -> ALL MAILS - ONE-TABLE</title>

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
 
//echo' <div title="change overview to the work-breakdown-structured board sight" align="right"><a href="overview.php" class="myButton" name="change overview to the work-breakdown-structured board sight" align="right">wbs-structured view</a></div>';	
echo '<p style="float: right;">
	<a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!" align="right">CFLX email</a>
	
<a href="overview.php" class="myButtonBlu" title="the WBS-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link
	
	
		echo '<h2 style="font-size: 1.6em; font-weight: 400; ">C-BOARD :: P E R S O N A L - C F L X - E M A I L S </h2><hr />';
 		
	
echo '<table border=2 bordercolor="orange" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;">r e v i e w  _  A L L  -  P R O J E C T  -  E M A I L S  _ t r a n s a c t e d </h3></td></tr></table>';


$angemeldeterUsr = $usrArray['username'];
$getmails = $pdo->prepare('SELECT * FROM cflxmails WHERE username=?');
$getmails->bindParam(1, $angemeldeterUsr, PDO::PARAM_STR); 
$getmails->execute();


echo'<table id="example" class="cssactivusr" cellspacing="0" style="width:100% !important; font-size:0.9em;
	font-family:Arial,Helvetica,Verdana,sans-serif; color:#666; ">
<colgroup> 
	<col width="7%" />
	<col width="4%" />
	<col width="10%" />
	<col width="2%" />
	<col width="13%" /> 
	<col width="13%" /> 
	<col width="30%" />
	<col width="14%" />
	<col width="6%" />    
</colgroup>
      <thead align="left">
            <tr>
            	 <th>Project</th>
                <th>WBS-ID</th>
                <th>WBS-Name</th>
                <th>Level</th>
                <th>Subject</th>
                <th>Receiver</th>
                <th>Email (click!)</th>
                <th>Appeal</th>
                <th>Date</th>
               
                
            </tr>
     </thead>
 
     <tfoot align="left">
            <tr>
                 <th>Project</th>
                <th>WBS-ID</th>
                <th>WBS-Name</th>
                <th>Level</th>
                <th>Subject</th>
                <th>Receiver</th>
                <th>Email (click!)</th>
                <th>Appeal</th>
                <th>Date</th>
              
            </tr>
     </tfoot>
 
     <tbody>';

		
		while ($mailrow = $getmails->fetch(PDO::FETCH_ASSOC)) 
		{        
      echo '<tr>
        		<td>' . htmlspecialchars($mailrow['project'], ENT_QUOTES, 'UTF-8'). '</td>'; //1
		echo '<td>' . htmlspecialchars($mailrow['wbsnr'], ENT_QUOTES, 'UTF-8') .    '</td>'; //2
 		echo '<td>' . htmlspecialchars($mailrow['wbsnom'], ENT_QUOTES, 'UTF-8') .   '</td>'; //3
		echo '<td>' . htmlspecialchars($mailrow['lev'], ENT_QUOTES, 'UTF-8').      '</td>'; //4
		echo '<td>' . htmlspecialchars($mailrow['subject'], ENT_QUOTES, 'UTF-8').  '</td>'; //5
		echo '<td>' . htmlspecialchars($mailrow['receiver'], ENT_QUOTES, 'UTF-8'). '</td>'; //6	
// start a-href-text in form of factual mssg:
$usernamestring=urlencode($mailrow['username']);

		echo '<td> <span id="spandtable" style="font-size: 1 em;
font-style: normal;
font-weight: normal;
text-align: left;
text-decoration: none;
text-indent: 0;
text-transform: none;
display: inline; " >
				<a href=CFLXmailReDo.php?id=' . $mailrow['emailID'] .' title="click to show in forum-thread">';
			 	
			 	if(strlen($mailrow['fact']) >= 66) { // shorten, if longer than 66 signs
			 		echo substr($mailrow['fact'], 0, 66);
			 		echo'...'; 
							  } else {
			  		echo htmlspecialchars($mailrow['fact'], ENT_QUOTES, 'UTF-8'); // $mailrow['fact'];  
							  }
	echo'	</span></a></td>';	
	//	echo '<td>' . $mailrow['fact'] .     '</td>'; //7		

		echo '<td>' . htmlspecialchars($mailrow['ap'], ENT_QUOTES, 'UTF-8').       '</td>'; //8
		echo '<td>' . htmlspecialchars($mailrow['created'], ENT_QUOTES, 'UTF-8').  '</td>'; //9			
	
	echo' </tr>';
		} 	

echo' 	</tbody>
 </table>';
		  		 
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