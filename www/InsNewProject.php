<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
$pname=trim($_POST["pname"]);
$pname=strip_tags($pname);
$pnumber=trim($_POST["pnumber"]);
$pnumber=strip_tags($pnumber);
$pdecrption=trim($_POST["pdescr"]);
$pdecrption=strip_tags($pdecrption);

 require_once("./PDO/connex.php");


$usrsnme = $_SESSION['user']['username'];
$usrsID = $_SESSION['user']['id'];
//
//$insertproj = "INSERT INTO wbs (lev,L1,L2,L3,L4,L5,L6,nam,des,wbsnumber,activ) VALUES (:lev, :L1, :L2, :L3, :L4, :L5, :L6, :nam, :des, :num, :activ)";
// v2: mit usrsID = 
$insertproj = "INSERT INTO wbs (lev,L1,L2,L3,L4,L5,L6,nam,des,wbsnumber,activ,usrsID) VALUES (:lev, :L1, :L2, :L3, :L4, :L5, :L6, :nam, :des, :num, :activ, :usrsID)";
$init0 = "0";
$init1 = "1";
					$pdoexecNP = $pdo->prepare($insertproj);
					$pdoexecNP->execute(array(':lev'=>$init1,':L1'=>$init0,':L2'=>$init0,':L3'=>$init0, ':L4'=>$init0, ':L5'=>$init0, ':L6'=>$init0, ':nam'=>$pname, ':des'=>$pdecrption, ':num'=>$pnumber, 'activ'=>$init1, 'usrsID'=>$usrsID));

// INSERT initial Thread for the new project:
		$n_id = 1; // belongs to 1st wbs-element. mandatory.
 		$ini_topic = $pname . '-related discussion';
		$ini_descr = $pdecrption . ' (initial thread)';
/*		
$ini_topic = htmlentities($nam, ENT_COMPAT | ENT_HTML401, 'ISO-8859-1')  . '-related discussion';
$ini_descr = htmlentities($desc, ENT_COMPAT | ENT_HTML401, 'ISO-8859-1',true) . ' (initial thread)';*/
		$ini_closed = 0;
			

					$insertinitial = "INSERT INTO strg (Pid,topic,dscrption,closed) VALUES (:n_id, :topic, :dscrption, :closed)";

					$pdoexecIni = $pdo->prepare($insertinitial);
					$pdoexecIni->execute(array(':n_id'=>$n_id,':topic'=>$ini_topic,':dscrption'=>$ini_descr,':closed'=>$ini_closed));


//echo '<hr>pname= '.$pname.'  Eintrag von: '.$usrsnme;

$URL = "newWBSelement.php";
if( headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
else { header("Location: $URL"); }
exit;

?>
