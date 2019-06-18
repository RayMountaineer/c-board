<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
	$usrsname= ($_SESSION['user']['username']); 
	$usrEmail = $_SESSION["email"];
  
 //     qr textarea:    
      if ($_GET['qrCFLX']):
        $qrCFX = htmlentities($_GET['qrCFLX'],ENT_QUOTES);
       // echo "textarea qrCFLX von CFLX_en via AJAX, in. der Variablen qrCFX: $qrCFX<br />\n <br />\n";
    endif;           
 // im textarea:         
      if ($_GET['imCFLX']):
        $imCFX = htmlentities($_GET['imCFLX'],ENT_QUOTES);
       // echo "textarea imCFLX von CFLX_en via AJAX, in. der Variablen imCFX: $imCFX<br />\n <br />\n";
    endif;  
    // ap textarea:         
      if ($_GET['apCFLX']):
        $apCFX = htmlentities($_GET['apCFLX'],ENT_QUOTES);
      //  echo "textarea apCFLX von CFLX_en via AJAX, in. der Variablen apCFX: $apCFX<br />\n <br />\n";
    endif;  
         
      if ($_GET['sendto']):
        $sendto = filter_var($_GET['sendto'], FILTER_SANITIZE_EMAIL);
       // echo "entered reciever: $sendto<br />\n <br />\n";
    endif;  
   //subject:          
      if ($_GET['subject']):
          $subject = trim($_GET['subject']); 
//$subject = htmlentities($_GET['subject'],ENT_QUOTES);
        // subject steht im header deer mail - und wird nicht html-coded/ decoded by client, sondern bleibt plain:
        
    
      //  echo "entered subject: $subject<br />\n <br />\n";
    endif;  

  		if ($_GET['wbsSelect']):
			$wbsSelect = ($_GET['wbsSelect']);
			$wbsSelect4mail = htmlentities($wbsSelect,ENT_QUOTES);
		endif;

		if (!strlen(trim($_GET['wbsSelect'])))
			{
			$wbsSelect ="none wbs-assigned / unspecific";			
			}

if (!strlen(trim($_GET['factMess'])))
{echo "there was no factual message.<br />\n However, the Statements made via the selected CFLX were sent<br />\n<br />\n";
$fact = "this Message's Content is made by CFLX-Statements only. ";}
else
{
       $fact =(htmlentities($_GET['factMess'],ENT_QUOTES));

}

 require_once("./PDO/connex.php");
// start: query in wbs where wbsnumber = ? =  $wbsSelect 
 
 	// 	$wbsSelect = ($_GET['wbsSelect']); s.o.	
		$getwbsdata = $pdo->prepare('SELECT id,lev,nam,activ FROM wbs WHERE wbsnumber=?');
		$getwbsdata->bindParam(1, $wbsSelect);
		$getwbsdata->execute();
		$wbsdatarow = $getwbsdata->fetch(PDO::FETCH_ASSOC);
		
		$wbs=$wbsdatarow['nam'];
		$wbsName4mail = htmlentities($wbs,ENT_QUOTES);
		$level = $wbsdatarow['lev'];
		
		$projectLevel = 1; // es gibt nur ein level1 element pro projekt: das Projekt selbst (100% regel)
		$getproject =  $pdo->prepare('SELECT id,lev,nam,activ FROM wbs WHERE lev=?');
		$getproject->bindParam(1, $projectLevel);
		$getproject->execute();
		$projectRow = $getproject->fetch(PDO::FETCH_ASSOC);
		 $project=$projectRow['nam']; 
 		 $projectName4mail = htmlentities($project,ENT_QUOTES);
 		 
 require './gmail_V7.php';		 
    // zudem fehlt noch: der Reciever. des weiteren: nicht in cflxmails, sondern in forum_posts ablegen. dann geht das expose OData Producer wohl einfacher. schaun mer mal...  
$xit=$pdo->prepare('INSERT into cflxmails(project,wbsnom,wbsnr,lev,receiver,username,email,subject,qr,im,ap,fact)VALUES(:project,:wbsnom,:wbsnr,:lev,:receiver,:username,:email,:subject,:qr,:im,:ap,:fact)');

$xit->bindParam(":project",$project);
$xit->bindParam(":wbsnom",$wbs);
$xit->bindParam(":wbsnr",$wbsSelect);

$xit->bindParam(":lev",$level);
//$xit->bindParam(":postid",$postid);

$xit->bindParam(":receiver",$sendto);
$xit->bindParam(":username",$usrsname);
$xit->bindParam(":email",$usrsemail);
$xit->bindParam(":subject",$subject);
$xit->bindParam(":qr",$qrCFX);
$xit->bindParam(":im",$imCFX);
$xit->bindParam(":ap",$apCFX);

$xit->bindParam(":fact",$fact);

$xit->execute();