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
        <title>..::CFLX -> advanced communication ::.. </title>

			        
        	<link rel="stylesheet" href="CSS/styles.css"> <!--4 CFLX-dropdowns & dialog-boxes-->
        	<link rel="stylesheet" href="CSS/cflxmailCSS.css">
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
         
			    	
           
<script type="text/javascript" src="./JScripts/funcStartDialogAP.js"></script>
<script type="text/javascript" src="./JScripts/funcStartDialogQR.js"></script>
<script type="text/javascript" src="./JScripts/funcStartDialogIM.js"></script>
  
<?php
 // First we execute our common code to connection to the database and start the session
 //   require("./login/common.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: ./login/login.php");
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to ./login/login.php");
    }
    
    // Everything below this point in the file is secured by the login system
    
    // We can display the user's username to them by reading it from the session array.  Remember that because
    // a username is user submitted content we must use htmlentities on it before displaying it to the user.

	//$usrsname= htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
  	$usrsname= ($_SESSION['user']['username']); //, ENT_QUOTES, 'UTF-8');	
  		//	echo Angemeldet als User: $usrsname;
 		//SESSION_START(); is schon via common.php
		$_SESSION["usr"] = $usrsname;
    
    


   require_once('./PDO/connex.php');

$Email4ReDo = (int)$_GET['id'];    
// query wheree username and emailid:
		$getmailData = $pdo->prepare('SELECT * FROM cflxmails WHERE emailID=? AND username=?');
		$getmailData->bindParam(1, $Email4ReDo);
		$getmailData->bindParam(2, $usrsname);
		$getmailData->execute();
		$mailDataRow = $getmailData->fetch(PDO::FETCH_ASSOC);
// print_r($mailDataRow);
 //  echo $mailDataRow['fact'];

 
   require_once('./jsPHP/js_takeqr.php');



require_once'./jsPHP/js_takeim.php';

require_once'./jsPHP/js_takeap.php'; 
$query = $pdo->query("SELECT qr,im,ap FROM cflags WHERE username = '$usrsname'");
$jarray= $query->fetchAll(PDO::FETCH_ASSOC); 

?>
        	
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





  <div id="outer">
	<div id="cflx">
 
   <nav>
     <ul>
<!-- cat 1 raus               
                <li class = "cat1">
                    <a href="#">C-FLAGS</a>
                </li>
 -->
     <li class = "flagQR">
       <a href="#">Question Repeat</a>
         <ul>
                    
                    
<?php
require_once'./PDO/connex.php';


//START: echo-Schleife für den QuestionRepeat <li> Link
require_once'./jsPHP/js_LiLinkqr.php';


// Close the connection for question repeat

?>                    

 <!--  <li><a href="#"><text id="qrNewEntry">--New Entry -- </text></a></li> -->
       	     <textarea id="qrTextBox" name="qrTextBox" rows="8" cols="70" placeholder="Repeat Question. briefly, own words."/><?php echo $mailDataRow['qr']?></textarea> </li>
              <li><input type="submit" value="use & add (click!)" onclick="CheckJarrayQR()" ></li>
          </ul>
      </li>
               
               
               
      <li class = "flagIM">
      <a href="#">I-Message</a>
         <ul>                    
                    
                    
                    
 <!--START php-mySQL connection Und schleife  for i-message-->
<?php
require_once'./PDO/connex.php';


//START: echo-Schleife für den QuestionRepeat <li> Link
require_once'./jsPHP/js_LiLinkim.php';


// Close the connection for question repeat

?>
 								  <textarea id="imTextBox" name="imTextBox" rows="8" cols="70" placeholder="Give an insight of YOUR thoughts, YOUR situation via making an 'I... Message' !"/><?php echo $mailDataRow['im']?></textarea> </li>
                       
                        <li><input type="submit" value="use & add (click!)" onclick="CheckJarrayIM()" ></li>
                     </ul>
                </li>
                <li class = "flagAP">
                    <a href="#">Appeal</a>
                    <ul>
                    
                   
                    
 <!--START php-mySQL connection Und schleife  for Appeal-->
<?php
require_once'./PDO/connex.php';


//START: echo-Schleife für den QuestionRepeat <li> Link
require_once'./jsPHP/js_LiLinkap.php';


// Close the connection for question repeat

?>
                    
                    
                    
                    
                      <textarea id="apTextBox" name="apTextBox" rows="8" cols="70" placeholder="Frankly & Direktly: tell, what YOU want!"/><?php echo $mailDataRow['ap']?></textarea> </li>
                        <li><input type="submit" value="use & add (click!)" onclick="CheckJarrayAP()" ></li>
                    </ul>
                </li>
                
                <!--EINSCHUB: Buttons logout, DE, EN-->
                <p align="right">
                 <a href="myCFLXmails.php" class="myButtonAzure" title="All sent CFLX-emails in one table">email management</a>
                <a href="overview.php" class="myButtonBlu" title="the WBS-structured board-sight">WBS/ overview</a>
               <!-- <a href="./de/CFLX_de.php">|DE|</a> -->
               <a href="./login/logout.php" class="outButton" >Logout</a>
               </p>
            </ul>
        </nav>

<!--START CheckJarray scrpts-->
<!--QR start-->
<script type="text/javascript">

var qrEntryString = textAreaVarQR;
var qri = jarray.length;

//function CheckJarrayAP: 
// JSON erzeugen via php; als stringify in jarrays speichern, 
// via indexOf die Position des textarea-Eintrags rausziehen,
// mittels switch - case: Falluntescheidung und spezifische Ausführungen.

//
//
function CheckJarrayQR () {
//	neu seit 22.mai 2015:
// der if empty-check wird für die qr's weggelassen. 
// 2do: 1.) beim fragesteller die option "mark as question" bzw. 
// ein check nach dem string "this is a question" durchführen, 
 // 	und 2.) darauf basierend die fallunterscheidung, ob auf  ===0 gecheckt wird - oder eben nicht.
        		var qrModvalue = document.getElementById('qrTextBox').value;
				        		
        		// also mal (vorläufig) raus damit <<hier in den cflx-mails kanns auch ganz endgültig raus.>
        	//	if (qrModvalue.length === 0) { 
//					IsMissingDialogQR(); return;}		
//				else {
        	
						var jarray = <?php echo json_encode($jarray); ?> 
						var jarrays = JSON.stringify(jarray);
						var textAreaVarQR =  document.getElementById('qrTextBox').value;

						var usrEntryqr = document.getElementById('qrCFLGstatement');
       						usrEntryqr.innerHTML = textAreaVarQR;

	// neu 2 22.05.2015 :
	//den switch und test ob Eintrag schon vorhanden, hier auch raus. Fragewiederholungen sind per se 1-malig
	// und die standard-statements können via user-profil geändert werden.
					//	var posqr = jarrays.indexOf(textAreaVarQR);
//
//
//						switch(posqr) {
//												case -1:StartDialogQR (textAreaVarQR);break;
//		
//											}
						}
		//	} flog raus - mit der if-else schleife beim qr.
//
//
function CheckJarrayIM () {
//	// new at no.17,2: mit if-else Fallunterscheidung für fehlenden Eintrag; function start bei onclick der use&send buttons
	
        		var imModvalue = document.getElementById('imTextBox').value;
				        		
        		//
        		if (imModvalue.length === 0) {
// NEU: anstelle des Alerts wird hier der "IsMissingDialogQR/IM/AP();" aufgerufen 
					IsMissingDialogIM(); return;}
        //			alert('Ihre Situation, Ihre Sichtweise: Teilen Sie ihren Standpunkt durch eine "Ich-Botschaft" mit!');	return;} 		
				else {
        	
						var jarray = <?php echo json_encode($jarray); ?> 
						var jarrays = JSON.stringify(jarray);
						var textAreaVarIM =  document.getElementById('imTextBox').value;

						var usrEntryim = document.getElementById('imCFLGstatement');
       						usrEntryim.innerHTML = textAreaVarIM;

						var posim = jarrays.indexOf(textAreaVarIM);


						switch(posim) {
												case -1:StartDialogIM (textAreaVarIM);break;
		
											}
						}
			}
//
//
function CheckJarrayAP () {
//	// new at no.17,2: mit if-else Fallunterscheidung für fehlenden Eintrag; function start bei onclick der use&send buttons
	
        		var apModvalue = document.getElementById('apTextBox').value;
				        		
        		//
        		if (apModvalue.length === 0) {
        			IsMissingDialogAP(); return;}
        			//alert('Ehrlich, offen  & direkt: Was möchten Sie? Was brauchen Sie? Was hätten Sie gerne?');	return;} 		
				else {
        	
						var jarray = <?php echo json_encode($jarray); ?> 
						var jarrays = JSON.stringify(jarray);
						var textAreaVarAP =  document.getElementById('apTextBox').value;

						var usrEntryap = document.getElementById('apCFLGstatement');
       						usrEntryap.innerHTML = textAreaVarAP;

						var posap = jarrays.indexOf(textAreaVarAP);


						switch(posap) {
												case -1:StartDialogAP (textAreaVarAP);break;
		
											}
						}
			}
//
<!--end checkjarrays-->
</script>

        
  <nav>


  <span>Subject was related to wbs-number: <?php echo $mailDataRow['wbsnr']?>;</span> at the moment set to: <span id="showwbs"><?php echo $mailDataRow['wbsnr'];?>;</span> 
        			 	<table id="cflxtable">
								<hr width=85% align="left">
								<tr><td  id="qrCFLGstatement" class="forumflagQR"><?php echo $mailDataRow['qr']?></td></tr>
								<tr><td  id="imCFLGstatement" class="forumflagIM"><?php echo $mailDataRow['im']?></td></tr>								
								<tr><td  id="apCFLGstatement" class="forumflagAP"><?php echo $mailDataRow['ap']?></td></tr>								
								</table>    
        		  
        <!--factual message START-->

     <ul>
			<form action="./exec.php" method="post" accept-charset="UTF-8">
       	     <textarea id="factMess" name="factMess"/><?php echo $mailDataRow['fact']?></textarea> </li>

             
         </form>
      </ul>
 		<ul>
			
			<!--login - form start-->
<?php
		// start wbs-auto-search-selector (user-specific wbs-portfolio)	
			$arrayUsrWBS = array();
			
			$IDofUsrViewing = $_SESSION['user']['id'];
			$usrsDefaultView = 1;
			$activL1 = 1;	$getwbs = $pdo->prepare('SELECT * FROM wbs WHERE activ=? && `'.$IDofUsrViewing.'`=?');
			$getwbs->bindParam(1, $activL1, PDO::PARAM_INT); // activ auf 1
			$getwbs->bindParam(2, $usrsDefaultView, PDO::PARAM_INT); // usrID-Spalte auf 1 (default)
			$getwbs->execute();
				while ($row = $getwbs->fetch(PDO::FETCH_ASSOC)) 
				{
				$arrayUsrWBS[] = $row['wbsnumber'];
			 //	$arrayUsrWBS[$row['wbsnumber']] = $row['nam'];
 	 			/*$arrayUsrWBS[] = $row['wbsnumber'];
 	 			$arrayUsrWBS[] = $row['nam'];
 	 				$KeyValarray[$row['wbsnumber']] = $row['nam'];
 	 				$ValKeyarray[$row['nam']] = $row['wbsnumber']; */ 
  			 } 
  json_encode($arrayUsrWBS);
 // print_r($arrayUsrWBS, $return = null);
   
?>  
<form action="./exec.php" method="post" id="senden"accept-charset="UTF-8">
	<fieldset>
		<legend>RECEIVER & SUBJECT</legend>
	
		 <table class="sendtable" border="0" cellpadding="0" cellspacing="4">
   
     <tr align="left">
      <td align="right">Receiver:</td>
       <td align="left"><input id="sendto" name="sendto" type="email" value="<?php echo $mailDataRow['receiver']?>"  size="23" maxlength="80" /></td>
    </tr>
    <tr align="left">
      <td align="right">Subject:</td>
      <td align="left"><input id="subject" name="subject" type="text" value="<?php echo $mailDataRow['subject']?>"  size="23" maxlength="80" /></td>
    </tr>
     <tr align="left">
      <td align="right">WBS:</td>
      <td align="left"><input id="wbsSelect" name="wbsSelect" value="<?php echo $mailDataRow['wbsnr']?>"  size="23" maxlength="80" /></td>
    </tr>
    </table>
  
		 <table class="sendtable" border="0" cellpadding="0" cellspacing="2">
    <tr><td>
		    
      For deployment on your company's environment: do not hesitate & get in touch with us at <a href="http://www.c-cybernetics.com/">C-Cybernetics.com :: advanced communication</a>
		<td></td>	
	</td></tr>
	
  </table>
	
		

	</fieldset>
	
	</fieldset>
</form>
  <!--send cflx-mail-form end-->   	
 		</ul>		     
  </nav>    
  
  
 
 <!--email-test all includive strat-->    


 <!--email all incl. end-->                  
     
<a href="#" class="myButton" id="absenden">POST IT!</a>   

 <div id="box"> </div>
  
 <form accept-charset="UTF-8">
              
                
               <div id="info" />
  </form>

<div id="reshowQR"></div> 
<!--<div magenta Dialog QR>-->
<div id="wasSentsuccessfullyDialog" title="Your message was sent successfully!">
	<p>
	Now, you can modify & re-send the message <br>
	or you can refresh and clear all entries. <br>
	<small>
	ps: all CFLX-enhanced E-Mails you are sending via this application are stored within your personal database</small>
		
		</p>
</div>
<!--
<div magenta Dialog QR>-->
<div id="IsMissingDialogQR" title="'Question Repeat' Statement is missing!">
	<p>
	The 'CFLX' are a basic concept of this application. If your message aims to answer a question, please repeat the related question you want to answer to! 

	For more background-information and a deeper understanding, the <a href="http://www.c-cybernetics.com/pub/ICT-Filters-and-Solution.pdf">ICT-induced communication-filters.pdf</a> is available for download.
	<br><br>
	<small>
	ps: If you need to change the predefined statements of the Question Repeat flag, <br>
	you can do this within the "C-BOARD/ wbs overview" -> via "my Profile" (administration of your CFLX statements) <br>
	There you can add & delete the CFLX of the I-Messages and the Appeals as well</small>
		
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
	The so confirmed statement is shown instead of 'I-Message:' in the yellow-coloured bar as well</small>
	
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
	The so confirmed statement is shown instead of 'Appeal:' in the red-coloured bar as well</small>
	
	</p>
</div>

<div id="SendSubDialog" title="The receiver of your message is missing!">
	<p>

	You did not enter an Email address of the receiver .<br>
	

	<br><br>
	<small>If You wish to use this application on Your own/ Your company's infrastructure,<br>
	  please, get in touch with us at: <a href="http://www.c-cybernetics.com/">C-Cybernetics.com :: advanced communication</a>
	
	</small>
	</p>
</div>

<div id="SendSubDialogRec" title="Receiver is missing!">
	<p>

	To which e-mail-address you want to send the message to?<br>
	Please, enter a receiving address !

	
	</p>
</div>


<!--jscript des autosearch nun nach dem html form input:-->
<script>
	$(document).ready(function () {

	//	$(function() {
			var wbsportfolio = <?php echo json_encode($arrayUsrWBS);?>;	
		$( "#wbsSelect" ).autocomplete({
			source: wbsportfolio,
			 minLength: 0
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

<script type="text/javascript" >
	//Aufruf der "CFLX-Mail was sent successfully" Funktion:		wasSentsuccess();
		function wasSentsuccess() {
		
			$('#wasSentsuccessfullyDialog').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
			//	position: [230, 230],
buttons: [{
			text: "OK & clear from screen",
					click: function() {
					$(this).dialog("close"); 
					location.reload(); 
				  return false;
			}
		}, {
			text: "OK & hold for next message",
			click: function() {
				$(this).dialog("close");
				               
                            return false;
			}
		}]				
				
				
				
			});
				
		}
//
		//Aufruf der "IsMissingDialog" Funktion:		IsMissingDialogQR/IM/AP();
		function IsMissingDialogQR() {
		
			$('#IsMissingDialogQR').dialog({
				width: 400,
				modal: true,
				show: "fade",
				hide: "explode",
				
			//	position: [230, 230],
				
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
				
			//	position: [230, 230],
				
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
				
				//position: [230, 230],
				
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
				
			//	position: [230, 230],
				
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
				
			//	position: [230, 230],
				
				buttons: [{
					text: "OK, wird gemacht!",
					click: function() {
					$(this).dialog("close");
			}}]
			});
			
		}			
		
	</script>
<script>//
//<script type="text/javascript" charset="utf-8">
 
 $(document).ready(function() {
			 $('#absenden').click(function(){   
      			var imCheckVal = document.getElementById('imTextBox').value;
      			var apCheckVal = document.getElementById('apTextBox').value;
      			if (imCheckVal === "" || imCheckVal === undefined)  {IsMissingDialogIM();return;} 
    	 			if (apCheckVal === "" || apCheckVal === undefined) {IsMissingDialogAP();return;} 
					//	var gmlogCheckVal = $('#gmloginname').val(); NOW hardcoded
					//	var gmpwCheckVal = $('#gmloginpw').val(); NOW hardcoded
						var receiverCheckVal = $('#sendto').val();
						//var BetreffCheckVal = $('#subject').val();
    				//	if (gmlogCheckVal === "" || gmlogCheckVal === undefined)  {SendSubDialog();return;} 
    				//	if (gmpwCheckVal === "" || gmpwCheckVal === undefined) {SendSubDialog();return;}
      				if (receiverCheckVal === "" || receiverCheckVal === undefined)  {SendSubDialogRec();return;} 
    	 				//if (BetreffCheckVal === "" || BetreffCheckVal === undefined) {SendSubDialog();return;}   
    	 				
    	 				// line breaks via replace:
    	 				// var factMess = $('#factMess').val().replace(/\r\n|\r|\n/g, '<br />');
    	 				 
    	 				 var factMess = $('#factMess').val(); 
  //   var factMessO = $('#factMess').val();
   // 	var factMess = decodeURIComponent(factMessO);
      //var factMess = factMess.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br />');
      // funkt., aber mit cut des letzten characters:
      //.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br />')
      // .replace(/\r\n|\r|\n/g,"\n")
 var myKeyValPairs = {qrCFLX: $('#qrTextBox').val(), imCFLX: $('#imTextBox').val(), apCFLX: $('#apTextBox').val(), factMess: factMess, sendto: $('#sendto').val(), subject: $('#subject').val(), wbsSelect: $('#showwbs').text()}
     
            $.ajax({

                type: "GET",
                url: "./exec.php",
  					data: myKeyValPairs,
  						              
           //     data: 'qrCFLX=' + $('#qrTextBox').val() + '&imCFLX=' + $('#imTextBox').val() + '&apCFLX=' + $('#apTextBox').val() + '&factMess=' + $('#factMess').val().replace(/\r\n|\r|\n/g, '<br />') +  '&sendto=' + $('#sendto').val() + '&subject=' + $('#subject').val(),
// ohne replace der Zeilenumbruchzeichen zum <br> -> wird nun im exec.pho mittels $fact = nl2br(htmlentities($factorig)); erledigt             	
            // 	 data: 'qrCFLX=' + $('#qrTextBox').val() + '&imCFLX=' + $('#imTextBox').val() + '&apCFLX=' + $('#apTextBox').val() + '&factMess=' + factMess +  '&sendto=' + $('#sendto').val() + '&subject=' + $('#subject').val(),
// mit replace, nur nicht <br> sondern \  backslash            
                //  data: 'qrCFLX=' + $('#qrTextBox').val() + '&imCFLX=' + $('#imTextBox').val() + '&apCFLX=' + $('#apTextBox').val() + '&factMess=' + $('#factMess').val().replace(/\r\n|\r|\n/g, '\n') +  '&sendto=' + $('#sendto').val() + '&subject=' + $('#subject').val(),
     // data: {qrCFLX: $('#qrTextBox').val(), imCFLX: $('#imTextBox').val(), apCFLX: $('#apTextBox').val(), factMess: factMess, sendto: $('#sendto').val(), subject: $('#subject').val()}
//   	   
				//	success: wasSentsuccess();
                success: function(msg){
                    $('#reshowQR').html(msg);
                }

            }); // Ajax Call
        }); //event handler .click function ({
    }); //document.ready
 
</script>   
   
   
        </div>
      </div>  
    </body>
</html>
