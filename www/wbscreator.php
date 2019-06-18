<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");
   // At the top of the page we check to see whether the user is logged in or not

    
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: ./login/login.php");
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to ./login/login.php");
    }

   

// die L1 - L6 alle Null setzen:
$nwbs_L1 = 0;
$nwbs_L2 = 0;
$nwbs_L3 = 0;
$nwbs_L4 = 0;
$nwbs_L5 = 0;
$nwbs_L6 = 0;

$wbsnumber = trim($_POST["WBSid"]);  
$wbsnumber = strip_tags($wbsnumber);

// 1st: check, if Pid is sent via post - or not (not = manually entered new wbs-id(=wbsnumber)) 
if(isset($_POST["Pid"])) {
$wbs_Pid = trim($_POST["Pid"]);  
$wbs_Pid = strip_tags($wbs_Pid);

//echo'Pid isset<br>';
}

// if(!($_POST["Pid"])){ 
// start alternative, if no Pid is sent via $_POST (if not via colored bar bit directly as number entered WBS-ID)
if(empty($wbs_Pid)) { 

 
	
		$levPart = explode(".",($wbsnumber)); // Fragmentierung mit . als Seperator

	$Lev1 = $levPart[0];
	$Lev2 = $levPart[0].'.'.$levPart[1];
	$Lev3 = $levPart[0].'.'.$levPart[1].'.'.$levPart[2];
	$Lev4 = $levPart[0].'.'.$levPart[1].'.'.$levPart[2].'.'.$levPart[3];
	$Lev5 = $levPart[0].'.'.$levPart[1].'.'.$levPart[2].'.'.$levPart[3].'.'.$levPart[4];
	$Lev6 = $levPart[0].'.'.$levPart[1].'.'.$levPart[2].'.'.$levPart[3].'.'.$levPart[4].'.'.$levPart[5];
	$Lev7 = $levPart[0].'.'.$levPart[1].'.'.$levPart[2].'.'.$levPart[3].'.'.$levPart[4].'.'.$levPart[5].'.'.$levPart[6];
// zu2) check via case, welches $lev der $_POST[WBSid] entspricht.
switch($wbsnumber) {
	case $Lev1: $PWBSnumb = $Lev1; 
break; 
	case $Lev2: $PWBSnumb = $Lev1;  
break;	
	case $Lev3: $PWBSnumb = $Lev2; 
break;
	case $Lev4: $PWBSnumb = $Lev3; 
break;
	case $Lev5: $PWBSnumb = $Lev4; 
break;
	case $Lev6: $PWBSnumb = $Lev5; 
break;
	case $Lev7: $PWBSnumb = $Lev6; 
	
			}	
			// echo'PWBSnumb = '.$PWBSnumb;
 
$QidParent = $pdo->query("SELECT id FROM wbs WHERE wbsnumber = '$PWBSnumb'");
$PidArray = $QidParent->fetchAll(PDO::FETCH_ASSOC); 
$wbs_Pid = $PidArray[0]['id'];

	 
} // if no pid was posted end	
// $_POST[Pid] alternative end
// **************************************

$namPosted = trim($_POST["topic"]);  
$namPosted = strip_tags($namPosted);
$nam = htmlentities($namPosted, ENT_COMPAT | ENT_HTML401, 'UTF-8');
 
$descPosted = trim($_POST["descr"]);  
$descPosted = strip_tags($descPosted);
$desc = htmlentities($descPosted, ENT_COMPAT | ENT_HTML401, 'UTF-8');

$activ = 1; // set to activated as default

$qParent = $pdo->query("SELECT * FROM wbs WHERE id = '$wbs_Pid'");
$pArray = $qParent->fetchAll(PDO::FETCH_ASSOC); 
 

$n_lev = $pArray[0]["lev"] + 1; //L1
if($pArray[0]["L1"] !=0) { // if Lev1 vom parent wbs ungleich Null, dann:
									// 1.) übernehme den Wert
									//2.) nxt if to check next Level id
									// else (die elses kommen dann alle weiter unten): "anstelle der ersten Null nehme die Parent id": new_LnID =  $pArray[0]["id"] ;
									 
		$nwbs_L1 = 	$pArray[0]["L1"];					
	 
 							
	//L2
	if($pArray[0]["L2"] !=0) {
		$nwbs_L2 = $pArray[0]["L2"];
	 
		//L3
		if($pArray[0]["L3"] !=0) {
			$nwbs_L3 = $pArray[0]["L3"];
		 
			
			//L4
			if($pArray[0]["L4"] !=0) {
				$nwbs_L4 = $pArray[0]["L4"];
		 				
				//L5
				if($pArray[0]["L5"] !=0) 
					{$nwbs_L5 = $pArray[0]["L5"];
			 
					//L6
					if($pArray[0]["L6"] !=0) 
						{$nwbs_L6 = $pArray[0]["L6"];
					 
					
					
				 		}
				 		else {  	$nwbs_L6 = $pArray[0]["id"];
	 				 
	 					}
					
				 	}
				 	else {  	$nwbs_L5 = $pArray[0]["id"];
	 		 
	 				}
								
				} // L4 ungleich null ende
				else {  	$nwbs_L4 = $pArray[0]["id"];
			 
	 			}
			
			} // L3 ungleich null ende
			else {  $nwbs_L3 = $pArray[0]["id"];
	 	 
	 		}	
		
	}// L2 ungleich null ende
			 
	 else {  $nwbs_L2 = $pArray[0]["id"];
	 
	 	}	
} 
else {	
	$nwbs_L1 = $pArray[0]["id"];
 
	 	}	
 	
$ini_topic = $nam . '-related discussion';
$ini_descr = $desc . ' (initial thread)';
/*		
$ini_topic = htmlentities($nam, ENT_COMPAT | ENT_HTML401, 'ISO-8859-1')  . '-related discussion';
$ini_descr = htmlentities($desc, ENT_COMPAT | ENT_HTML401, 'ISO-8859-1',true) . ' (initial thread)';*/
$ini_closed = 0;
				$insertElement = "INSERT INTO wbs (lev,L1,L2,L3,L4,L5,L6,nam,des,wbsnumber,activ) VALUES (:lev, :L1, :L2, :L3, :L4, :L5, :L6, :nam, :des, :wbsnumber, :activ)";

					$pdoexecE = $pdo->prepare($insertElement);
					$pdoexecE->execute(array(':lev'=>$n_lev,':L1'=>$nwbs_L1,':L2'=>$nwbs_L2,':L3'=>$nwbs_L3, ':L4'=>$nwbs_L4, ':L5'=>$nwbs_L5, ':L6'=>$nwbs_L6, ':nam'=>$nam, ':des'=>$desc, ':wbsnumber'=>$wbsnumber,':activ'=>$activ));

$idsuck = $pdo->query("SELECT id FROM wbs WHERE lev = '$n_lev' AND L1 = '$nwbs_L1' AND L2 = '$nwbs_L2' AND L3 = '$nwbs_L3' AND L4 = '$nwbs_L4' AND L5 = '$nwbs_L5' AND L6 = '$nwbs_L6' AND nam = '$nam' AND des = '$desc'");
$n_idArray = $idsuck->fetchAll(PDO::FETCH_ASSOC); 
$n_id = $n_idArray[0]['id'];

					$insertinitial = "INSERT INTO strg (Pid,topic,dscrption,closed) VALUES (:n_id, :topic, :dscrption, :closed)";

					$pdoexecIni = $pdo->prepare($insertinitial);
					$pdoexecIni->execute(array(':n_id'=>$n_id,':topic'=>$ini_topic,':dscrption'=>$ini_descr,':closed'=>$ini_closed));


// den redirect mal raus - dafür mal den session printen:

//$sessarray = $_SESSION['user'];
//foreach($sessarray as $key => $value){
//    echo $value . "<br />";
//}
 
 header('location:newWBSelement.php');
 exit;
			