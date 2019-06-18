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
$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
 

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=0.8">
	<title>C-BOARD: CFLX enhanced communication -> advanced collaboration</title>

	<!--Media queries css directly in the page: -->
	
	<link type="text/css" rel="stylesheet" media="only screen and (max-device-width: 720px)" href="CSS/middlemobiles.css" /> 
	<link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 100px max-device-width: 719px)" href="CSS/smallmobiles.css" /> 
	
	<!--
	<link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 481px and max-device-width: 720px)" href="CSS/middlemobiles.css" /> 
 -->

	<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/button.css">
	   
 		      	
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
     
      		 		
      <!--	<script type="text/javascript" src="./JScripts/funcCheckAP.js"></script>-->
      	
			<script type="text/javascript" src="./JScripts/funcStartDialogStat.js"></script>
			<script type="text/javascript" src="./JScripts/funcStartDialogAP.js"></script>
			<script type="text/javascript" src="./JScripts/funcStartDialogQR.js"></script>
 			<script type="text/javascript" src="./JScripts/funcStartDialogIM.js"></script>
 		
      
    	<script type="text/javascript" src="./tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
				tinyMCE.init({

        			theme : "modern",
        			mode : "specific_textareas",// => nur für jene textareas, dessen class-name unter editor_selector: "..." aufgeführt sind
        			editor_selector : "mssgtxtarea", // => der classname der nachrichteneingabe-textarea.
        			menubar : false,
        			plugins: [
        						"colorpicker emoticons textcolor image"
        						],
    	 			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor |   emoticons"

					});
		</script>
	<!--tinyMCE ende & CFLX header-part2 start-->
	<!--START php-mySQL-->
<?php
 
	$usrsname= ($_SESSION['user']['username']);
	
	// $usrArray = $_SESSION['user'];
 	
	//	$_SESSION["usr"] = $usrsname;
 
 require_once("./PDO/connex.php");
 require_once('./jsPHP/js_takestat.php');
 require_once('./jsPHP/js_takeqr.php');
 require_once'./jsPHP/js_takeim.php';
 require_once'./jsPHP/js_takeap.php';
// Close the connection

// Query All -> Assoc Array -> $JARRAY variable für den AJAX dialog
// die Selection ist im Folgenden nicht all, sondern gefiltert auf qr,im,ap in Abhängigkeit des username
$selector = ("SELECT qr,im,ap,statstat,username FROM cflags WHERE username = ?"); // '$usrsname'");
$prepArray = $pdo->prepare($selector);
$prepArray->execute(array($usrsname));
$jarray= $prepArray->fetchAll(PDO::FETCH_ASSOC); 


?>
	<script type="text/javascript">
        	function statentry() {
        		var statModvalue = document.getElementById('statTextBox').value;
        		
        		if (statModvalue.length == 0) {
        			alert('Please enter a brief Status Statement for sharing information about your work and for a better understanding!');	return;} 		
				
        		var usrEntrystat = document.getElementById('statCFLGstatement');
        		usrEntrystat.innerHTML = statModvalue;
        	}
       
     </script>
		<script type="text/javascript">
        	function qrentry() {
        		var qrModvalue = document.getElementById('qrTextBox').value;
        		
        		if (qrModvalue.length == 0) {
        			alert('Please enter a brief Repeat of the Question for clarification & verification of understanding!');	return;} 		
				
        		var usrEntry = document.getElementById('qrCFLGstatement');
        		usrEntry.innerHTML = qrModvalue;
        	}
       
     </script>   	
        	<script type="text/javascript">
        	function imentry() {
        		var imModvalue = document.getElementById('imTextBox').value;
        		
        		if (imModvalue.length == 0) {
        			alert('Please, take position, share your committment, give a personal statement!');
			return;        		
        		}
        		var usrEntryim = document.getElementById('imCFLGstatement');
        		usrEntryim.innerHTML = imModvalue;
        	}
        	</script>      	
        		
        	 	<script type="text/javascript">
        	function apentry() {
        		var apModvalue = document.getElementById('apTextBox').value;
        		
        		if (apModvalue.length == 0) {
        			alert('Honestly & Directly: Say, what you need!');
			return;        		
        		}
        		var usrEntryap = document.getElementById('apCFLGstatement');
        		usrEntryap.innerHTML = apModvalue;
        	}
        	</script>    	
        		
           
        	
        <!--	//START included Dialog Script mit integriertem textarea-check und if Anweisungen:      --> 	
        <!--	<script type="text/javascript" src="./jsDialogExt1-3.js">     	
        	</script>-->
 
 
		
</head>
<!--<body bgcolor="grey">-->
<body> 

<div id="IsNewDialogStat" title="This is a new 'Status Statement' Statement!">
	<p>You can store new CFLX on-the-fly,<br>
	add them in your pers. database storage,<br>
	& re-use them in all CFLX-enhanced applications!<br>
		<br><small>
		A <a href="http://www.c-cybernetics.com/pub/c-board-wiki.html#CFLX">CFLX how2 (click!)</a> is available.
		</small>
	</p>
</div>



<div id="IsNewDialogQR" title="This is a new 'Question Repeat' Statement!">
	<p>You can store new CFLX on-the-fly,<br>
	add them in your pers. database storage,<br>
	& re-use them in all CFLX-enhanced applications!<br>
		<br><small>
		A <a href="http://www.c-cybernetics.com/pub/c-board-wiki.html#CFLX">CFLX how2 (click!)</a> is available.
		</small>
	</p>
</div>


<div id="IsNewDialogIM" title="This is a new 'I-Message' Statement!">
	<p>You can store new CFLX on-the-fly,<br>
	add them in your pers. database storage,<br>
	& re-use them in all CFLX-enhanced applications!<br>
		<br><small>
		A <a href="http://www.c-cybernetics.com/pub/c-board-wiki.html#CFLX">CFLX how2 (click!)</a> is available.
		</small>
	</p>
</div>


<div id="IsNewDialogAP" title="This is a new 'Appeal' Statement!">
	<p>You can store new CFLX on-the-fly,<br>
	add them in your pers. database storage,<br>
	& re-use them in all CFLX-enhanced applications!<br>
		<br><small>
		A <a href="http://www.c-cybernetics.com/pub/c-board-wiki.html#CFLX">CFLX how2 (click!)</a> is available.
		</small>
	</p>
</div>



<?php

		
		echo '<h2>C-BOARD :: W O R K  - P A C K A G E - T H R E A D S </h2><hr />';
  $strg_id = filter_input(INPUT_GET, "ID", FILTER_SANITIZE_NUMBER_INT);
 	$closedStatusOpen = 0;	
	

$getstrg = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE ID=? ');
$getstrg->bindParam(1, $strg_id, PDO::PARAM_INT);
//$getstrg->bindParam(2, $closedStatusOpen, PDO::PARAM_INT);
$getstrg->execute();
//
$th_strang = $getstrg->fetch(PDO::FETCH_ASSOC);	
//
$th_strangPid = $th_strang['Pid'];
$getPid = $pdo->prepare('SELECT * FROM wbs WHERE id=?');
$getPid->bindParam(1, $th_strangPid, PDO::PARAM_INT);
$getPid->execute();
//
$wbs_strang = $getPid->fetch(PDO::FETCH_ASSOC);		
//--------------------------------------------------------------------------------------------------------------
	// start button table	
	echo '<table class="headbuttontable" border=0 width = "100%" align="right">';
// if admin rights, the admin-panel-link-button
	$usrsPermission = $usrArray['permission'];
if($usrsPermission == 11) 
		{
		echo '
	<tr>	
		<td class="headbuttontd"><a href="insertstrg.php?ID='.$wbs_strang['id'].'" class="myButton" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="open a menu to insert a new wbs-related thread">create NEW thread</a></td>
		<td class="headbuttontd"><a href="zerothread.php?ID='.$strg_id.'" class="myButtonRed" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="set thread-status to invisible">delete THIS thread</a></td>
		<td class="headbuttontd"><a href="ovViewDeleted.php" class="myButtonOrange" style="position: relative; left: 0em;"title="view and re-activate deleted threads">view deleted threads</a></td>
		<td class="headbuttontd"><a href="threadRassign.php?thrd='.$strg_id.'" class="myButtonYelow" title="change assignment of the thread / set to another WBS-element" align="right">re-assign</a></td>	
		<td class="headbuttontd"><a href="overview.php" class="myButtonBlu" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="the WBS-structured board-sight">WBS/ overview</a></td>
	 
		</tr>';
		}
		
// if wbs create-rechte with newwbs button (minus admin button)
elseif($usrsPermission == 7) //|| $usrsPermission == 11) 
		{
		echo '
	<tr>	
			
		<td class="headbuttontd"><a href="insertstrg.php?ID='.$wbs_strang['id'].'" class="myButton" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="open a menu to insert a new wbs-related thread">create NEW thread</a></td>
		<td class="headbuttontd"><a href="zerothread.php?ID='.$strg_id.'" class="myButtonRed" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="set thread-status to invisible">delete THIS thread</a></td>
		<td class="headbuttontd"><a href="ovViewDeleted.php" class="myButtonOrange" style="position: relative; left: 0em; width:9.5em; text-align: center;"title="view and re-activate deleted threads">view deleted threads</a></td>
		<td class="headbuttontd"><a href="threadRassign.php?thrd='.$strg_id.'" class="myButtonYelow" title="change assignment of the thread / set to another WBS-element" align="right">re-assign</a></td>			
		<td class="headbuttontd"><a href="overview.php" class="myButtonBlu" style="position: relative; left: 0em; width:9.5em; text-align: center;" title=" the WBS-structured board-sight">WBS/ overview</a></td>
		 
		</tr>';
		}
	
// normal users, no wbs-create-button (no permission to create new forums)
	else {		
	
		echo '
	<tr>	
		<td class="headbuttontd"><a href="insertstrg.php?ID='.$wbs_strang['id'].'" class="myButton" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="open a menu to insert a new wbs-related thread">create NEW thread</a></td>
		<td class="headbuttontd"><a href="overview.php" class="myButtonBlu" style="position: relative; left: 0em; width:9.5em; text-align: center;" title="the WBS-structured board-sight">WBS/ overview</a></td>
		 
		</tr>';
		}
echo'</table>';	// button-table END		
//	------------------------------------------------------------------------
		

$getres = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE ID=? ');
$getres->bindParam(1, $strg_id, PDO::PARAM_INT);
 
$getres->execute();

echo '<table border=2 bordercolor="red" width="100%">'; // start start-html-table   
while ($row = $getres->fetch(PDO::FETCH_ASSOC)) {	

  $rowID = $row['ID'];
$lastpost = $pdo->prepare('SELECT * FROM forum_posts WHERE tid=? ORDER BY ID DESC');
$lastpost->bindParam(1, $rowID, PDO::PARAM_INT);
$lastpost->execute();  
$last_post = $lastpost->fetch(PDO::FETCH_ASSOC); 

 
$echoTopic = htmlspecialchars($row['topic'], ENT_QUOTES, 'UTF-8');
$echoDescription = htmlspecialchars($row['dscrption'], ENT_QUOTES, 'UTF-8');																			
	echo '<tr><td  width="85%" class="wbs'.$wbs_strang['lev'].'"><p class="wbs'.$wbs_strang['lev'].'txt" >'.$echoTopic.'&nbsp; ::&nbsp;'.  $echoDescription.' &nbsp; </p></td>'; //.  $row['created']. wbs lev-Variable aus wbs spalte lev grün m. HAP-qstrg als Überschrift
	
			echo'	<td class="wbs'.$wbs_strang['lev'].'" align="right"><div class="lastposttime">latest post from <br>'.($last_post['created']).' </div> 	</td> 
				</tr>';
   }
// Liste für wbs-spezifische Beitrags-Hintergründe:
$levnum = $wbs_strang['lev'];

$levarray = array("wbs0","wbs1","wbs2","wbs3","wbs4","wbs5","wbs6","wbs7"); // array beginnt mit 0 -> wbs0 als vorlauf
$levcolarray1 = array("#DEEAFA","#DEEAFA", "#C9F5B8","#FAF8A2","#ffcad1","#BBFAF4","#C5DE8E","#FAEC9D"); // array beginnt mit 0 -> 1.farbnummer doppelt als vorlauf
$levcolarray2 = array("#C3DBFA","#C3DBFA","#B6E6A3","#F2F18A","#FABBC6","#ACE6E0","#B1C97D","#FAE570"); // array beginnt mit 0 -> 1.farbnummer doppelt als vorlauf

// start new pdo suckpost

$suckpost = $pdo->prepare('SELECT * FROM forum_posts WHERE tid=? ORDER BY created');
$suckpost->bindParam(1, $strg_id, PDO::PARAM_INT);
$suckpost->execute();  
// check sum of postings in thread - if none: this will be the first posting, and it will have a status statement instead a question repeat.:

$sumOfTidPostings = $suckpost->rowCount();


	$cnter = 0; // Zähler-Variable auf null setzen
	while ($suckP = $suckpost->fetch(PDO::FETCH_ASSOC)) {	

									switch($cnter) { // Sorgt für "Zebra-Effekt"
										case 0: $bgp1 = $levcolarray1[$levnum]; // '#98fc85'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
											$cnter++; // Zähler-Variable + 1
											break;
										case 1: $bgp1 = $levcolarray2[$levnum];// '#8bea72'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
											$cnter--; // Zähler-Variable - 1
											break;
									}
		 ?>
		  <tr>
			  <!-- td -->
				<td style="background-color:<?php echo $bgp1; ?>;">
					<div class="sub_post_a" width=100%> <!--style="background-color: <?php echo $bgp2; ?>;>-->
					<!--im a href wird der Ziel-link über die ID festgelegt-->
					
							<?php echo '<div id="' . $suckP['ID'] . '">' .'</div>' 
							// prevent xss-attacks via cflx by using htmlspecialchars for the db-data:
				/*	$secQR=htmlspecialchars($suckP['qr']);
					$secIM=htmlspecialchars($suckP['im']);
					$secAP=htmlspecialchars($suckP['ap']);*/
							?>																																											 
							<a href="directAns.php?reID=<?php echo $suckP['ID']; ?>" class="directAns" title="click for making a direct answer/ response to this posting"><?php $suckPecho = htmlspecialchars($suckP['topic'], ENT_QUOTES, 'UTF-8'); echo $suckPecho;  ?>&raquo;</a> 
							<!--// optional: PDOinsertpostanswer.php zur direkten Bezugnahme als Antwort auf Posting. evtl. auch grafisch anzeigen/ dropdown im source-posting mit den verfügbaren antworten
							<a href="showposts.php?tid='.$suckP['tid'].'&amp;ID='.$suckP['ID'].'">';						
										// hier kommen die getätigten CFLX aus der "posts Tabelle" rein-->	<br>						
								<table width=99%>
								<hr width=97%>
								<tr>
							<?php // check, if there is a status statement statstat from the CYBER-SCRUM. use for view, if there is an entry. else: qr
								if(!empty($suckP['statstat'])) {
									echo '<td class="BflagStat2">Status Statement:'.htmlspecialchars($suckP['statstat']);
									}
								else {
									echo '<td class="BflagQR'. $wbs_strang['lev'].'">Question Repeat:'.htmlspecialchars($suckP['qr']);
									}
								 ?>								
								
								
								</td></tr>
								
								
								
								<tr> 
								<?php echo '<td class="BflagIM'. $wbs_strang['lev'].'">I-Message:'.htmlspecialchars($suckP['im']) ?></td></tr>								
								<tr> 
								<?php echo '<td class="BflagAP'. $wbs_strang['lev'].'">Appeal:'.htmlspecialchars($suckP['ap']) ?></td></tr>								
								</table>
								
								<br />
						<div class="postingtxt" > <!--die css-class für die eigentliche Textdarstellung (factual part of message)-->
<!--factual message - main-text-part-->
							<?php echo $suckP['text']; // posting txt ?> 
<!--Einschub: check if there are reAW's for posting	-->														
<?php


// $urlencodedName = urlencode($suckP['username']);
$urlencodedName = ($suckP['username']);

$suckP_ID = $suckP['ID'];
$sqlreAW = $pdo->prepare('SELECT  count(*) FROM forum_posts WHERE reAW=? ORDER BY created DESC');
$sqlreAW->bindParam(1, $suckP_ID, PDO::PARAM_INT);
$sqlreAW->execute();  
//

if($sqlreAW->fetchColumn() > 0) { // Falls reAWs vorhanden sind
 
			echo '<div align="right" style="padding-right:6px;">';
			echo '<a title="click for viewing a summary of all direct answers/ responses to this posting (or add an additional one!)" class="myButtonOrange" href="directAns.php?reID=' . $suckP['ID'] .'" >direct answers/ responses available!</a></div>'; // ja, vorhanden (button auf grün)   
				}
		else {
			echo '<div align="right" style="padding-right:6px;">';
			echo '<a title="click for making a direct answer/ response to this posting" class="myButton" href="directAns.php?reID=' . $suckP['ID'] .'" >give a direct answer/ response to this posting!</a></div>'; // ja, vorhanden (button auf grün)   
					}
	
?>
<!--reAW-ende-->
							</div>
						</div>
					</div>
				</td>
	<td valign="top" style="background-color:<?php echo $bgp1; ?>;">
				
					<div class="avatarfield">						
							<br>								
						<!--	<?php echo '<a class="avatarlink" href="UsersProfile.php?nm='.$suckP['username'].'" >'.$suckP['username'].'</a>'; ?><br>-->
								<div class="avatartime">								
								<?php echo $suckP['created']; ?>
								</div>
					<!--	</div>-->	
					
							<div>
								<?php 
							// check if still default-pic is in use <via query of usersprofiles image_type>	
							 
									$query4nopic = "select image_type from usrsprofiles WHERE username = ?";
									$checkpic = $pdo->prepare( $query4nopic );
									$checkpic->bindParam(1, $suckP['username']); 
									$checkpic->execute();
									$picYesNo = $checkpic->fetch(PDO::FETCH_ASSOC);
// a href with integrated Useravatar <title="click picture to view the profile of your team-mate!">
											
// neo try for frenchman mit vor und nachnamen - specialchars & two seperated words (not just a username - but a real name...)							
							 echo '<a title="click picture to view the profile of your team-mate!" href="UsersProfile.php?nm='.$suckP['username'].'">'; 
									if($picYesNo['image_type'] == "nopic") {
										echo '<img width="133" src="./images/no-pic130.png"></img>';
										}
								// if not nopic, select the users uploaded avatar-picture								
										else {
										echo'<img src="source.php?id='.$suckP['username'].'" width="133" />';
										}							 
							 echo'</a>';
// ende a href user Avatar -> UsersProfile.php							
					 	?>					
					 	</div> <!--Pic div end-->
					 		<?php echo '<a class="avatarlink" href="UsersProfile.php?nm='.$suckP['username'].'" >'.$suckP['username'].'</a>'; ?>
					</div>	<!--Avatarfield-div end	-->
				
			</td>	
		
		</tr>	
	<?php

		} // while-schleife für die Auflistung der postings ende
// im original mysqli ist dies eine if num->row ... else. hier kam daher noch die else- anweisung für "echo keine Eintrgäge vorhanden" 
?>
<!-- start showposts.php - bereich -->

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
						<td width="100%" valign="top">
						<a id="go"></a>
						</td>
					</tr>
				</table>		

<?php

// start neo-status-check (if closed in strg is zero)

$stat = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE ID=? ');
//$stat = $pdo->prepare('SELECT * FROM strg WHERE ID=?');
$stat->bindParam(1, $strg_id, PDO::PARAM_INT);
$stat->execute();  
$stats = $stat->fetch(PDO::FETCH_ASSOC); 
 
				 $strangID = $stats['ID'];	
			 
				if($stats['closed'] == 0) { // Falls Thema nicht geschlossen

?>
<!--START BIG einschub CFLX-->				  


 <div id="wrapper">
   <nav>
     <ul>

 <!-- Benötige hier Falluntescheidung für stat oder qr.
  if ($sumOfTidPostings > 0) { qr...} else { stat...}
  der gesamte Abschnitt somit via echo '...';-->
  
<?php  
		 if ($sumOfTidPostings == 0)
		  { ?>
     
    	<li class = "flagStat">
      <a href="#stat">Status Statement</a>
        <span style="font-size:1%"> &nbsp;</span>
         <ul>                   
	<?php	
 		require_once("./PDO/connex.php");
	 	require_once("./jsPHP/js_LiLinkst.php"); 
		?>                    
   	     <textarea id="statTextBox" name="statTextBox" rows="8" cols="70" placeholder="Give a short status report"/></textarea> </li>
              <li><input type="submit" value="use & send" onclick="CheckJarrayStat()" ></li>
         <?php  } 
           else {
           	 ?> 
    	<li class = "flagQR">
      <a href="#qr">Question Repeat</a>
        <span style="font-size:1%"> &nbsp;</span>
         <ul>                   
		<?php
 		require_once("./PDO/connex.php");
	 	require_once("./jsPHP/js_LiLinkqr.php"); 
		   ?>                 
   	     <textarea id="qrTextBox" name="qrTextBox" rows="8" cols="70" placeholder="brief repetition of the question your are answering. own words."/></textarea> </li>
              <li><input type="submit" value="use & send" onclick="CheckJarrayQR()" ></li>
        <?php   }  
              
  ?>            
          </ul>
      </li>
               
               
               
      <li class = "flagIM">
      <a href="#imssg">I-Message</a>  <span style="font-size:1%"> &nbsp;</span>
         <ul>                    
                    
                    
                    
 <!--START php-mySQL connection Und schleife  for i-message-->
<?php
 require_once("./PDO/connex.php");

//START: echo-Schleife für die i-mssg <li> Link
 
 require_once("./jsPHP/js_LiLinkim.php");
 


// Close the connection for question repeat

?>
 								  <textarea id="imTextBox" name="imTextBox" rows="8" cols="70" placeholder="Give an Insight of YOUR Thoughts, YOUR Situation via making an 'I... Message' !"/></textarea> </li>
                       
                        <li><input type="submit" value="use & send" onclick="CheckJarrayIM()" ></li>
                     </ul>
                </li>
                <li class = "flagAP">
                    <a href="#appell">Appeal</a>  <span style="font-size:1%"> &nbsp;</span>
                    <ul>
                    
                   
                    
 <!--START php-mySQL connection Und schleife  for Appeal-->
<?php
 require_once("./PDO/connex.php");

//START: echo-Schleife für den Appell <li> Link
 
 require_once("./jsPHP/js_LiLinkap.php");
 

// Close the connection for question repeat

?>
                    
                    
                    
                    
                      <textarea id="apTextBox" name="apTextBox" rows="8" cols="70" placeholder="Frankly & Direktly: tell, what YOU want!"/></textarea> </li>
                        <li><input type="submit" value="use & send" onclick="CheckJarrayAP()" ></li>
                    </ul>
                </li>
               
            </ul>
        </nav>

<!--START CheckJarray scrpts-->
<!--QR start-->
<script type="text/javascript">
//
//var qrEntryString = textAreaVarQR;
//var qri = jarray.length;

//function CheckJarrayAP: 
// JSON erzeugen via php; als stringify in jarrays speichern, 
// via indexOf die Position des textarea-Eintrags rausziehen,
// mittels switch - case: Falluntescheidung und spezifische Ausführungen.
function CheckJarrayQR () {
	//alert("CheckJarrayQR function Zeile 586 was triggered ");
//	// new at no.3: 
//
	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVarQR =  document.getElementById('qrTextBox').value;
//	
	var usrEntryqr = document.getElementById('qrCFLGstatement');
       		usrEntryqr.innerHTML = textAreaVarQR;
// alert(textAreaVarStat); // ok, did trigger and show the text areas value! (13.12.2015))
	var posqr = jarrays.indexOf(textAreaVarQR);
// alert(posstat); ok, did trigger and show -1 for not in the array (-1) (13.12.2015)
//	//
	switch(posqr) {
		case -1:StartDialogQR (textAreaVarQR);break;
		//default: alert("Entry already existst at Pos: "+posstat);
	}
}
</script>

<script type="text/javascript">
//
//var statEntryString = textAreaVarStat;
//var stati = jarray.length;

//function CheckJarrayAP: 
// JSON erzeugen via php; als stringify in jarrays speichern, 
// via indexOf die Position des textarea-Eintrags rausziehen,
// mittels switch - case: Falluntescheidung und spezifische Ausführungen.
function CheckJarrayStat () {
//	alert("CheckJarrayStat function Zeile 614 was triggered ");
//	// new at no.3: 
//
	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVarStat =  document.getElementById('statTextBox').value;
//	
	var usrEntrystat = document.getElementById('statCFLGstatement');
       		usrEntrystat.innerHTML = textAreaVarStat;
// alert(textAreaVarStat); // ok, did trigger and show the text areas value! (13.12.2015))
	var posstat = jarrays.indexOf(textAreaVarStat);
// alert(posstat); //ok, did trigger and show -1 for not in the array (-1) (13.12.2015)
//	//
	switch(posstat) {
		case -1: StartDialogStat (textAreaVarStat);break;
	// for testing: 	case -1: alert(textAreaVarStat);break;
		//default: 	alert("Entry already existst at Pos: "+posstat);
	}
}
</script>
<!--StatStat end-->


<!--IM start-->
<script type="text/javascript">
//
//var imEntryString = textAreaVarIM;
//var imi = jarray.length;

//function CheckJarrayAP: 
// JSON erzeugen via php; als stringify in jarrays speichern, 
// via indexOf die Position des textarea-Eintrags rausziehen,
// mittels switch - case: Falluntescheidung und spezifische Ausführungen.

//
//
function CheckJarrayIM () {
//	alert("CheckJarrayIM func");
//	// new at no.3: 
//
	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVarIM =  document.getElementById('imTextBox').value;
//	
	var usrEntryim = document.getElementById('imCFLGstatement');
       		usrEntryim.innerHTML = textAreaVarIM;
//alert(textAreaVarIM);
	var posim = jarrays.indexOf(textAreaVarIM);
//alert(posim);
//	//
	switch(posim) {
		case -1:StartDialogIM (textAreaVarIM);break;
		//default: alert("Entry already existst at Pos: "+posim);
	}
}
</script>
<!--IM end-->




<!--AP start-->
<script type="text/javascript">
//
//var apEntryString = textAreaVarAP;
//var api = jarray.length;

//function CheckJarrayAP: 
// JSON erzeugen via php; als stringify in jarrays speichern, 
// via indexOf die Position des textarea-Eintrags rausziehen,
// mittels switch - case: Falluntescheidung und spezifische Ausführungen.

//
//
function CheckJarrayAP () {
//	// new at no.3: 
//
	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVarAP =  document.getElementById('apTextBox').value;
//	
	var usrEntryap = document.getElementById('apCFLGstatement');
       		usrEntryap.innerHTML = textAreaVarAP;
//alert(textAreaVarAP);
	var posap = jarrays.indexOf(textAreaVarAP);
//alert(posap);
//	//
	switch(posap) {
		case -1:StartDialogAP (textAreaVarAP);break;
		//default: alert("Entry already existst at Pos: "+posap);
	}
}
</script>
<!--AP end-->


<!--end checkjarrays-->


						
								<table width=85%>
								<hr width=85% align="left">
			<?php  
		 	if ($sumOfTidPostings == 0) { ?>				
								<tr><td  id="statCFLGstatement" class="forumflagStat">Status Statement:</td></tr>
			<?php } 
			else {?>					
								<tr><td  id="qrCFLGstatement" class="forumflagQR">Question Repeat:</td></tr>
			<?php } ?>					
								<tr><td  id="imCFLGstatement" class="forumflagIM">I-Message:</td></tr>								
								<tr><td  id="apCFLGstatement" class="forumflagAP">Appeal:</td></tr>								
								</table>      
        		  
        <!--factual message START-->				  
				  
				  
				  
				  
				  
				  
<!--Ende BIG Einschub CFLX-->				  
						<hr width=85% align="left">
<!-- <?php echo $strg_id; ?>-->

<table width=85%><tr><td>
 	<!--der ganze td mal als div mit id=box - dann bei success function auf .hide gesetzt...hatte funktioniert, brachte jedoch den ui-dialog und die tiny mce durcheinander....-->
<!--
anchors for jumping when cflx-dropdown-item is clicked now removed (commented-out):  
<a id="stat"></a><a id="questrep"></a><a id="imssg"></a><a id="appell"></a>-->	 
							<div class="wbs2txt" style="float:left; padding-right:6em; margin-top: 0.66em;">Subject:</div> <input type="text" name="topic" id="topic" value="Re: <?php echo htmlspecialchars($stats['topic'], ENT_QUOTES, 'UTF-8');	 ?>" class="usrtxt-input"  size="30"/> <br />
							<div class="wbs2txt">Factual Message:</div><br />
							<textarea id='mssgbox' name="mssgbox" class="mssgtxtarea" rows="10" cols="133" ></textarea>
								<br />
			
							
						<!--	<input type="hidden" name="tid" id="tid" value="<?php echo $strg_id; ?>" />-->
<!--<input type="hidden" name="tid" id="tid" <?php echo 'value="' . $strg_id . '">'  ?>				-->			
							<input type="hidden" name="ID" id="ID" <?php echo 'value="' . $suckP_ID . '">'  ?>
						<!--	<input type="hidden" name="reAW" id="reAW" value="<?php echo $postID; ?>" />-->
							<input type="submit" class="myButton" name="absenden" id="absenden" value="Insert Posting" />
							

</td>
<td></td><!--evtl usr-avatar & pers. preferences, pers-site-link etc.-->
</tr></table>
			<script>mssgbxtxt = $('#mssgbox').val();</script>
			 <?php
					} 
		
				else { // Falls Thema nicht existiert
  		    	echo '<strong>Status of this thread is closed. </strong>';
  
  					}
  					echo '</table>'; // ende </table> <!--ende des php tables-->		
			?> 

<!--ui-dialoge bei fehlenden CFLX-Angaben START-->

<div id="reshowQR"></div> 

<!--
<div gelbe Dialog Ich-Botschaft>-->
<div id="IsMissingDialogQR" title="'Question Repeat' Statement is missing!">
	<p>
	The 'CFLX' are a basic concept of this application. If your message aims to answer a question, please repeat the related question you want to answer to! 

	For more background-information and a deeper understanding, the <a href="http://www.c-cybernetics.com/pub/ICT-Filters-and-Solution.pdf">ICT-induced communication-filters.pdf</a> is available for download.
	<br><br>
	<small>
	ps: Via the 'use & add' buttons (in the CFLX Drop-Down-Menu) You can add new statements to Your personal database and re-use them in future messages. <br>
	The so confirmed statement is shown instead of 'Question Repeat:' in the purple-colored bar as well</small>
		
		</p>
</div>

<div id="IsMissingDialogStat" title="'Status Statement' is missing!">
	<p>
	The 'CFLX' are a basic concept of this application. Giving a status statement is mandatory, so that the team is informed and we can coordinate the required steps if necessary.

	For more background-information and a deeper understanding, the <a href="http://www.c-cybernetics.com/pub/ICT-Filters-and-Solution.pdf">ICT-induced communication-filters.pdf</a> is available for download.
	<br><br>
	<small>
	ps: Via the 'use & add' buttons (in the CFLX Drop-Down-Menu) You can add new statements to Your personal database and re-use them in future messages. <br>
	The so confirmed statement is shown instead of 'Question Repeat:' in the purple-colored bar as well</small>
		
		</p>
</div>
<!--
<div gelbe Dialog Ich-Botschaft>-->
<div id="IsMissingDialogIM" title="Your 'I-Message' is missing!">
	<p>
	
	The 'CFLX' are a basic concept of this application. Giving an 'I-Message' as well as making an 'Appeal' is mandatory. You cannot send messages without them. 

	For more background-information and a deeper understanding, the <a href="http://www.c-cybernetics.com/pub/ICT-Filters-and-Solution.pdf">ICT-induced communication-filters.pdf</a> is available for download.
<br><br>
	<small>
	ps: Via the 'use & add' buttons (in the CFLX Drop-Down-Menu) You can add new statements to Your personal database and re-use them in future messages. <br>
	The so confirmed statement is shown instead of 'I-Message:' in the yellow-colored bar as well</small>
	
	</p>
</div>
<!--
<div rote Dialog Appell>-->

<div id="IsMissingDialogAP" title="Your 'Appeal' Statement is missing!">
	<p>

	The 'CFLX' are a basic concept of this application. Giving an 'I-Message' as well as making an 'Appeal' is mandatory. You cannot send messages without them.

	For more background-information and a deeper understanding, the <a href="http://www.c-cybernetics.com/pub/ICT-Filters-and-Solution.pdf">ICT-induced communication-filters.pdf</a> is available for download.
	<br><br>
	<small>
	ps: Via the 'use & add' buttons (in the CFLX Drop-Down-Menu) You can add new statements to Your personal database and re-use them in future messages. <br>
	The so confirmed statement is shown instead of 'Appeal:' in the red-colored bar as well</small>
	
	</p>
</div>



<script type="text/javascript" >
		//Aufruf der "IsMissingDialog" Funktion:		IsMissingDialogStat/QR/IM/AP();
		function IsMissingDialogStat() {
		
			$('#IsMissingDialogStat').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
			 
				
				buttons: [{
					text: "OK, I'll go 4 it!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
				
		}
		//Aufruf der "IsMissingDialog" Funktion:		IsMissingDialogQR/IM/AP();
		function IsMissingDialogQR() {
		
			$('#IsMissingDialogQR').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
				 
				
				buttons: [{
					text: "OK, I'll go 4 it!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
				
		}
//Aufruf der "IsMissingDialog" Funktion:		IsMissingDialogQR/IM/AP();
		
		function IsMissingDialogIM() {
			
		
			$('#IsMissingDialogIM').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
			 
				
				buttons: [{
					text: "OK, I'll go 4 it!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}	
//Aufruf der "IsMissingDialog" Funktion:		IsMissingDialogQR/IM/AP();
		function IsMissingDialogAP() {
			
		
			$('#IsMissingDialogAP').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
				position: { my: "center", at: "center", of: window },
				
				buttons: [{
					text: "OK, I'll go 4 it!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}	
			</script>
<script type="text/javascript">
	var threadID = <?php echo $strg_id ?>;		
	var thePidID = <?php echo $th_strangPid ?>;	
	 
</script>	

<!--
// the whole java script for ajax-sending the posts is now case-sensitive: case 1: there are no other entries (its the first entry) -> with Status Statement; case2: else:-->

	<?php  
		 if ($sumOfTidPostings == 0)
		  { ?>
			
			<script>
			 
			 $(document).ready(function() {
					 
								$('#absenden').click(function(event){
			   // prevent the default form submit
			   event.preventDefault();
			      			
						 		var mssgBoxVal = (tinyMCE.activeEditor.getContent());
					         var imCheckVal = document.getElementById('imTextBox').value;
			      			var apCheckVal = document.getElementById('apTextBox').value;
			      		// benötige hier fallunterscheidung, ob statTextBox oder qrTextBox - ansonsten gibt es beim Fehlen hier einen Error!
			      		//	var qrCheckVal = document.getElementById('qrTextBox').value;
			      			var statCheckVal = document.getElementById('statTextBox').value;
			//      			alert(statCheckVal);
			//      			
			//      			alert("qrcheckValue = document.getElementbyID qrtxtbox.value: "+ qrCheckVal);
					if (statCheckVal === "" || statCheckVal === undefined)  {IsMissingDialogStat();return;} 
			//
			      			if (imCheckVal === "" || imCheckVal === undefined)  {IsMissingDialogIM();return;} 
			    	 			if (apCheckVal === "" || apCheckVal === undefined) {IsMissingDialogAP();return;} 
								var postsKeyValPairs = {stat: $('#statTextBox').val(), im: $('#imTextBox').val(), ap: $('#apTextBox').val(), mssg: mssgBoxVal,tid: threadID,Pid: thePidID, topic: $('#topic').val()};
			 
			            $.ajax({
			                	type:"post",
			                	url: "./PDOinsertpost1.php",																																															   										
									data: postsKeyValPairs,              
			              //  data: 'qrCFLX=' + $('#qrTextBox').val() + '&imCFLX=' + $('#imTextBox').val() + '&apCFLX=' + $('#apTextBox').val() + '&mssgbox=' + (encodeURIComponent(mssgBoxVal)) + '&tid=' + $('#tid').val() + '&topic=' + topicVal,
			               success:function(data){
			               									//	 window.location.hash = '#'.lastIDanchor;
			                              		 window.location.hash = '#go';
			      										window.location.reload(true);
			      									 
			                                 }
			
			            }); // Ajax Call
							// trigger reload via click-function: erzeugt probleme, da der ajax call dadurch unterbrochen wird, bei richtiger server-client verbindung             
			           // window.location.reload();
						// daher: abwarten lassen, bis ajax fertig ist - dann reload durch function:
			          
			        }); //event handler .click function ({
			          	
			    }); //document.ready
			 
				</script>   
				<?php 
				}
   			else { ?>
				   				
				<script>
				 
				 $(document).ready(function() {
						 
									$('#absenden').click(function(event){
				   // prevent the default form submit
				   event.preventDefault();
				      			
							 		var mssgBoxVal = (tinyMCE.activeEditor.getContent());
						         var imCheckVal = document.getElementById('imTextBox').value;
				      			var apCheckVal = document.getElementById('apTextBox').value;
				      		// benötige hier fallunterscheidung, ob statTextBox oder qrTextBox - ansonsten gibt es beim Fehlen hier einen Error!
				      			var qrCheckVal = document.getElementById('qrTextBox').value;
				      		//	var statCheckVal = document.getElementById('statTextBox').value;
				//      			alert(statCheckVal);
				//      			
				//      			alert("qrcheckValue = document.getElementbyID qrtxtbox.value: "+ qrCheckVal);
					//	if (statCheckVal === "" || statCheckVal === undefined)  {IsMissingDialogIM();return;} 
				//
				      			if (imCheckVal === "" || imCheckVal === undefined)  {IsMissingDialogIM();return;} 
				    	 			if (apCheckVal === "" || apCheckVal === undefined) {IsMissingDialogAP();return;} 
									var postsKeyValPairs = {qr: $('#qrTextBox').val(), im: $('#imTextBox').val(), ap: $('#apTextBox').val(), mssg: mssgBoxVal,tid: threadID,Pid: thePidID, topic: $('#topic').val()};
				 
				            $.ajax({
				                	type:"post",
				                	url: "./PDOinsertpost2.php",																																															   										
										data: postsKeyValPairs,              
				              //  data: 'qrCFLX=' + $('#qrTextBox').val() + '&imCFLX=' + $('#imTextBox').val() + '&apCFLX=' + $('#apTextBox').val() + '&mssgbox=' + (encodeURIComponent(mssgBoxVal)) + '&tid=' + $('#tid').val() + '&topic=' + topicVal,
				               success:function(data){
																	// window.location.hash = '#'.lastIDanchor;				                              	 
				                              	 	window.location.hash = '#go';
				      										window.location.reload(true);
				      									 
				                                 }
				
				            }); // Ajax Call
								// trigger reload via click-function: erzeugt probleme, da der ajax call dadurch unterbrochen wird, bei richtiger server-client verbindung             
				           // window.location.reload();
							// daher: abwarten lassen, bis ajax fertig ist - dann reload durch function:
				          
				        }); //event handler .click function ({
				          	
				    }); //document.ready
				 
				</script> 
				<?php }
				?>  
<!--
   <script type="text/javascript" src="./tinymce/tinymce.min.js"></script>-->
</body>
</html>

