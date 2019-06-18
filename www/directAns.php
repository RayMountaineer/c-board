<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrArray = $_SESSION['user'];

	if ($usrArray == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
	
}
 include_once('./PDO/connex.php');
		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 

?><!DOCTYPE html>
<head>
<meta charset="UTF-8" /> 

	<title>C-BOARD: CFLX enhanced communication -> advanced collaboration</title>



	<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/button.css">
	     <link rel="stylesheet" href="CSS/style3.css">
              	
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
<?php

    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: ./login/login.php");
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to ./login/login.php");
    }
    
    // Everything below this point in the file is secured by the login system
     
  $usrsname= ($_SESSION['user']['username']);
  		 
		$_SESSION["usr"] = $usrsname;

require_once("./PDO/connex.php"); 
require_once('./jsPHP/js_takeqr.php');
require_once'./jsPHP/js_takeim.php';
require_once'./jsPHP/js_takeap.php';


// Query All -> Assoc Array -> $JARRAY variable für den AJAX dialog
// die Selection ist im Folgenden nicht all, sondern gefiltert auf qr,im,ap in Abhängigkeit des username
$query = $pdo->query("SELECT qr,im,ap FROM cflags WHERE username = '$usrsname'");
$jarray= $query->fetchAll(PDO::FETCH_ASSOC); 

?>
		
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
        		
           
        	 
 	
		
</head>
<body> 

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

		echo '<h2>C-BOARD :: D I R E C T - A N S W E R S </h2><hr />';
	 $reAW_id = filter_input(INPUT_GET, "reID", FILTER_SANITIZE_NUMBER_INT);


$getiniAns = $pdo->prepare('SELECT * FROM forum_posts WHERE ID=?');
$getiniAns->bindParam(1, $reAW_id, PDO::PARAM_INT);
$getiniAns->execute();

$iniAnsP = $getiniAns->fetch(PDO::FETCH_ASSOC);	
 //
 //
$iniAnsPtid = $iniAnsP['tid'];
$qthwbs = $pdo->prepare('SELECT * FROM strg WHERE ID=?');
$qthwbs->bindParam(1, $iniAnsPtid, PDO::PARAM_INT);
$qthwbs->execute();

$strangData = $qthwbs->fetch(PDO::FETCH_ASSOC);			
//
//
//
$inistrDtaPid = $strangData['Pid'];
$get_wbslev = $pdo->prepare('SELECT * FROM wbs WHERE id=?');
$get_wbslev->bindParam(1, $inistrDtaPid, PDO::PARAM_INT);
$get_wbslev->execute();
//
$reAWwbslev = $get_wbslev->fetch(PDO::FETCH_ASSOC);		
$reAW_wbslev = $reAWwbslev['lev'];
	 											
		echo '<p style="display: inline;"><a href="overview.php" class="myButtonBlu" name="brings you back to the wbs-overview">C-BOARD :: overview</a> :: <a class="myButton" name="leave the direct answers - go back to the whole thread" href="threadview.php?ID='.$iniAnsP['tid'].'&amp;#'.$iniAnsP['ID'].'">back to: '.htmlspecialchars($iniAnsP['topic']).'</a>  </p><hr>'; // Breadcrumb

// start table header

//2do: wbs-level (in <td class=wbs >)variabel anpassen
echo '<table border=1 bordercolor=red width="100%"><tr><td class = wbs'.$reAW_wbslev.'>';  
// einschub: table innerhalb der <td>  
	$MakesecTopic = $iniAnsP['topic'];
echo '<table border=1 bordercolor=green width="100%" style="background-color: rgba(0, 0, 0, 0.2); border-radius: 7px;"><tr><td class = wbsreAW'.$reAW_wbslev.'>'; 
echo '<h3>Direct answer related to: '.htmlspecialchars($MakesecTopic). '</h3><hr />';	
 
echo '<div class="postingtxtRE" >'.$iniAnsP['text'].'</div>';
// CFLX ini post start:
echo '<table width=100%>';
echo '<hr width=100%>';


echo '<tr>'; 
 // check, if there is a status statement statstat from the CYBER-SCRUM. use for view, if there is an entry. else: qr
								if(!empty($iniAnsP['statstat'])) {
									echo '<td class="BflagStat2">Status Statement:'.htmlspecialchars($iniAnsP['statstat']);
									}
								else {
									echo '<td class="BflagQR'. $reAWwbslev['lev'].'">Question Repeat:'.htmlspecialchars($iniAnsP['qr']);
									}
						
echo'</td></tr>';

echo '<tr> <td class="BflagIM'. $reAWwbslev['lev'].'">I-Message: ' . htmlspecialchars($iniAnsP['im']) .'</td></tr>';
echo '<tr> <td class="BflagAP'. $reAWwbslev['lev'].'">Appeal: ' .htmlspecialchars($iniAnsP['ap']) .'</td></tr>';

echo '</table>';
// CFLX-table des ini post ende


echo '</td></tr></table>'; // end inner-table des headers
echo '</td></tr></table>'; // end-header-html-MAIN-table   	
 
 
echo '<table border=1 width="100%">'; // start reAW-postings-html-table   

$levnum = $reAW_wbslev; // die wbs-level-nummer, s.o.<ok!>

$levarray = array("wbs0","wbs1","wbs2","wbs3","wbs4","wbs5","wbs6","wbs7"); // array begint mit 0 -> wbs0 als vorlauf
$levcolarray1 = array("#DEEAFA","#DEEAFA", "#C9F5B8","#FAF8A2","#ffcad1","#BBFAF4","#C5DE8E","#FAEC9D"); // array beginnt mit 0 -> 1.farbnummer doppelt als vorlauf
$levcolarray2 = array("#C3DBFA","#C3DBFA","#B6E6A3","#F2F18A","#FABBC6","#ACE6E0","#B1C97D","#FAE570"); // array beginnt mit 0 -> 1.farbnummer doppelt als vorlauf

// Einschub des obigen ?Leerlauf? query-stuffs start
// pdo-ersatz für num_rows zum checken if available:
$checkAnsP = $pdo->prepare('SELECT count(*) from forum_posts WHERE reAW=?');
$checkAnsP->bindParam(1, $reAW_id, PDO::PARAM_INT);
$checkAnsP->execute();
if ($checkAnsP->fetchColumn() > 0){   						// { if- Klammer Fall_1: ja, re-AWs vorhanden!
		// nach checkAns nun queryAns via pdo-> um daraus das suckPost-assoc zu generieren:
		$qAnsP = $pdo->prepare('SELECT * FROM forum_posts WHERE reAW=? ORDER BY created');
		$qAnsP->bindParam(1, $reAW_id, PDO::PARAM_INT);
		$qAnsP->execute();  
	//	$rowqAnsP = $qAnsP->fetch(PDO::FETCH_ASSOC);   
		$cnter = 0; // Zähler-Variable auf null setzen
		while($suckP = $qAnsP->fetch(PDO::FETCH_ASSOC)) {		// start while-Klammer
  //
					
				
							//	while($suckP = $suckPosts->fetch_assoc()) { // die SELECTion $gPosts ist nun im assoc_Array $suckP :: suckP-Schleife beginnt
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
				<td width=85% style="background-color:<?php echo $bgp1; ?>;">
					<div class="sub_post_a" width=100%> <!--style="background-color: <?php echo $bgp2; ?>;>-->
					<!--im a href wird der Ziel-link über die ID festgelegt-->
					
							<?php echo '<div id="' . $suckP['ID'] . '">' .'</div>' ?>
								<a href="directAns.php?reID=<?php echo $suckP['ID']; ?>" class="directAns" title="click for making a direct answer/ response to this posting"><?php $suckPecho = ($suckP['topic']); echo htmlspecialchars($suckPecho);  ?>&raquo;</a> 
							 	<br>						
								<table width=99%>
								<hr width=97%>
								<tr>
										<?php 
										// check, if there is a status statement statstat from the CYBER-SCRUM. use for view, if there is an entry. else: qr
								if(!empty($suckP['statstat'])) {
									echo '<td class="BflagStat2">Status Statement:'.htmlspecialchars($suckP['statstat']);
									}
								else {
									echo '<td class="BflagQR'. $reAWwbslev['lev'].'">Question Repeat:'.htmlspecialchars($suckP['qr']);
									} ?>
									
									</td></tr>
								<tr>
								 
								<?php echo '<td class="BflagIM'. $reAWwbslev['lev'].'">I-Message:'.htmlspecialchars($suckP['im']) ?></td></tr>								
								<tr> 
								<?php echo '<td class="BflagAP'. $reAWwbslev['lev'].'">Appeal:'.htmlspecialchars($suckP['ap']) ?></td></tr>								
								</table>
								<br />

																
								
					<div class="postingtxt" > <!--die css-class für die eigentliche Textdarstellung (factual part of message)-->
						
						<!--<hr width=100%>-->
							<?php echo $suckP['text']; // posting txt ?> 
															
							</div>
						</div>
					</div>
				</td>
			<td valign="top" style="background-color:<?php echo $bgp1; ?>;">
<?php 
 
$urlencodedName = ($suckP['username']);
?>
					<div class="avatarfield">						
						 
										<div class="avatartime">
												<?php echo $suckP['created']; ?>
										</div>		
					
					<div>	
						<div style="vertical-align:top;">	
						<?php 
							// check if still default-pic is in use <via query of usersprofiles image_type>	
							 
									$query4nopic = "select image_type from usrsprofiles WHERE username = ?";
									$checkpic = $pdo->prepare( $query4nopic );
									$checkpic->bindParam(1, $suckP['username']); 
									$checkpic->execute();
									$picYesNo = $checkpic->fetch(PDO::FETCH_ASSOC);
				// a href with integrated Useravatar <title="click picture to view the profile of your team-mate!">
			
							
 							
							 echo '<a title="click picture to view the profile of your team-mate!" href="UsersProfile.php?nm='.$suckP['username'].'">'; 
									if($picYesNo['image_type'] == "nopic") {
										echo '<img width="133" src="./images/no-pic130.png"></img>';
										}
								// if not nopic, select the users uploaded avatar-picture								
										else {
										echo'<img src="source.php?id='.$urlencodedName.'" width="133"  />';
										}							 
							 echo'</a>';
// ende a href user Avatar -> UsersProfile.php				
					 	?>					
			
			
					</div>							
			<?php echo '<a class="avatarlink" href="UsersProfile.php?nm='.$suckP['username'].'" >'.$suckP['username'].'</a>'; ?>
			
					</div>					
				
			</td>			
		
		</tr>	
	<?php

				} 					// ende while-Klammer für die(Ense der Auflistung der postings)

	}						 // ende if-Klammer (Ende Fall_1, "if themen sind vorhanden...")

else { // Falls keine Themen vorhanden = else-if = Fall_2

      echo '<div class="postingtxtRE" style="margin: 3em; width: 80%; text-align: center; color: rgba(138, 199, 199, 1); padding-bottom: 3em; padding-left: 2em; font-size: 1.1em;"><br><br>There are no direct answers/ replies to this posting. Be the first one, share your thoughts! </div>';
		}
echo '</table>';

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
						<td width="100%" valign="top">
						<a id="go"></a>
						</td>
					</tr>
				</table>		




<?php

// start neo-status-check (if closed in strg is zero)
$inistatPid = $iniAnsP['tid'];
$stat = $pdo->prepare('SELECT * FROM strg WHERE ID=?');
$stat->bindParam(1, $inistatPid, PDO::PARAM_INT);
$stat->execute();  
$stats = $stat->fetch(PDO::FETCH_ASSOC); 

				 $reAWstrangID_reID = $stats['ID'];	
				if($stats['closed'] == 0) { // Falls Thema im table strg nicht geschlossen

				  ?>
<!--START BIG einschub CFLX-->				  

 <div id="wrapper">
   <nav>
     <ul>

     <li class = "flagQR">
      <a href="#questrep">Question Repeat</a>   
        <span style="font-size:1%"> &nbsp;</span>
         <ul>
                    
                    
<?php 
 require_once("./PDO/connex.php");

//START: echo-Schleife für den QuestionRepeat <li> Link
 
 require_once("./jsPHP/js_LiLinkqr.php");

// Close the connection for question repeat

?>                    

  
       	     <textarea id="qrTextBox" name="qrTextBox" rows="8" cols="70" placeholder="Repeat Question. briefly, own words."/></textarea> </li>
              <li><input type="submit" value="use & send" onclick="CheckJarrayQR()" ></li>
          </ul>
      </li>
               
               
               
      <li class = "flagIM">
      <a href="#imssg">I-Message</a>  <span style="font-size:1%"> &nbsp;</span>
         <ul>                    
                    
                    
                    
 <!--START php-mySQL connection Und schleife  for i-message-->
<?php 
 require_once("./PDO/connex.php");

//START: echo-Schleife für den imssg <li> Link
 
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
 
function CheckJarrayQR () {
//	// new at no.3: 
//
	var jarray = <?php echo json_encode($jarray); ?> 
	var jarrays = JSON.stringify(jarray);
	var textAreaVarQR =  document.getElementById('qrTextBox').value;
//	
	var usrEntryap = document.getElementById('qrCFLGstatement');
       		usrEntryap.innerHTML = textAreaVarQR;
//alert(textAreaVarQR);
	var posqr = jarrays.indexOf(textAreaVarQR);
//alert(posqr);
//	//
	switch(posqr) {
		case -1:StartDialogQR (textAreaVarQR);break;
		//default: alert("Entry already existst at Pos: "+posqr);
	}
}
</script>
<!--QR end-->


<!--IM start-->
<script type="text/javascript">
 
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
								<tr><td  id="qrCFLGstatement" class="forumflagQR">Question Repeat:</td></tr>
								<tr><td  id="imCFLGstatement" class="forumflagIM">I-Message:</td></tr>								
								<tr><td  id="apCFLGstatement" class="forumflagAP">Appeal:</td></tr>								
								</table>        
    
          
				  
				  
				  
				  
				  
<!--Ende BIG Einschub CFLX-->				  
<hr width=85% align="left">
 <table width=85%><tr><td>
 <div id="box"> </div>		 
 	<div class="wbs2txt" style="float:left; padding-right:6em; margin-top: 0.66em;">Subject:</div> <input type="text" name="topic" id="topic" value="Re: <?php echo htmlspecialchars($stats['topic'], ENT_QUOTES, 'UTF-8');	 ?>" class="usrtxt-input"  size="30"/> <br />
							<div class="wbs2txt">Factual Message:</div><br />
							<textarea id='mssgbox' name="mssgbox" class="mssgtxtarea" rows="10" cols="166"></textarea>
								<br />
							<input type="hidden" name="tid" id="tid" value="<?php echo $inistatPid; ?>" />
							<input type="hidden" name="Pid" id="Pid" <?php echo 'value="' . $inistrDtaPid . '">'  ?>	
							 
							<input type="hidden" name="reAW" id="reAW" value="<?php echo $reAW_id; ?>" />
							<input type="submit" class="myButton" name="absenden" id="absenden" value="Send Post" />
				</td>
<td></td><!--evtl usr-avatar & pers. preferences, pers-site-link etc.-->
</tr></table>
			<script>mssgbxtxt = $('#mssgbox').val();</script>
			 <?php
							} // // Ende von "Falls Thema nicht geschlossen" startet in Zeile: 379
		
				else { // Falls Thema nicht existiert
  		    	echo '<strong>Status of this thread is closed. </strong>';
  
  					}
  				 
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
				
				buttons: [{
					text: "OK, I'll go 4 it!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}	
			</script>
<script>
				function SendSubDialog() {
			
		
			$('#SendSubDialog').dialog({
				width: 440,
				modal: true,
				show: "fade",
				hide: "explode",
			
				buttons: [{
					text: "OK, wird gemacht!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}	
	function SendSubDialogRec() {
			
		
			$('#SendSubDialogRec').dialog({
				width: 440,
				modal: true,
				show: "fade",
				hide: "explode",
				
				buttons: [{
					text: "OK, wird gemacht!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}			
		
	</script>
<script>
 
 $(document).ready(function() {
			$('#absenden').click(function(event){
   // prevent the default form submit
   event.preventDefault();	
      					 
			 		var mssgBoxVal = (tinyMCE.activeEditor.getContent());           
      			var imCheckVal = document.getElementById('imTextBox').value;
      			var apCheckVal = document.getElementById('apTextBox').value;
      			if (imCheckVal === "" || imCheckVal === undefined)  {IsMissingDialogIM();return;} 
    	 			if (apCheckVal === "" || apCheckVal === undefined) {IsMissingDialogAP();return;} 
					var AWpostsKeyValPairs = {qrCFLX: $('#qrTextBox').val(), imCFLX: $('#imTextBox').val(), apCFLX: $('#apTextBox').val(), mssgbox: mssgBoxVal,tid: $('#tid').val(),Pid: $('#Pid').val(),reAW: $('#reAW').val(), topic: $('#topic').val()}
            
            $.ajax({

                type: "POST",
                url: "./PDOinsertpostAW.php",																																							 
      																																		   	 
                data: AWpostsKeyValPairs,																																									   	 
           		 success:function(data){
           		 	 window.location.hash = '#go';
                  window.location.reload(true);
                }

            }); // Ajax Call
				
        }); //event handler .click function ({
        	
    }); //document.ready
 
</script>   
   
   

</body>
</html>

