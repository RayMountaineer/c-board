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
	<title>C-BOARD: CFLX enhanced communication -> advanced collaboration</title>
	<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />

		<link rel="stylesheet" href="CSS/html.css"> 	         
      <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/button.css">
      
      <link rel="stylesheet" href="CSS/cssovtables.css"> 	
      
       <link rel="stylesheet" href="CSS/admintables_admin.css">		<!--<div class="cssadmin">-->
       <link rel="stylesheet" href="CSS/admintables_wbscreator.css">	 <!--<div class="csswbscreator">-->
       <link rel="stylesheet" href="CSS/admintables_activ.css">	 	<!--<div class="cssactivusr">-->
       <link rel="stylesheet" href="CSS/admintables_unactiv.css"> 	<!--<div class="cssunactivusr">-->
       <link rel="stylesheet" href="CSS/admintables_PWreset.css"> 	<!--<div class="cssPWreset">-->
 
<?php
/*include './PDO/connex.php';
	$usrArray = $_SESSION['user'];*/

// start user login-status & redirect if not:
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {

header ("Location: ./login/login.php");

}
// start: permission-check

$usrsPermission = $usrArray['permission'];
if($usrsPermission != 11) // if not admin - no access!
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
 

	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the WBS-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link
	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: U S E R - A D M I N I S T R A T I O N  </h2><hr />';
 		
	
echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr style="line-height: 3.3em;"><td><h3 style="font-size: 1.3em;  padding: 2em;">m a n a g e _  U S E R S -  P E R M I S S I O N S  _ b o a r d w i d e </h3></td></tr></table><br>';
// admin-user-header-table end

// query 4 table1: admin-rights = permission = 11

$PermissIONadmin = 11; // normal 11 - zu testzwecken mal auf 1 (= activ user)
$getAdm = $pdo->prepare('SELECT * FROM reg WHERE permission=? ORDER by username');
$getAdm->bindParam(1, $PermissIONadmin, PDO::PARAM_INT);
$getAdm->execute();
//
 
// query 4 table2: wbs-creator-rights = permission = 7

$PermissIONwbs = 7;
$getwbsCreators = $pdo->prepare('SELECT * FROM reg WHERE permission=? ORDER by username');
$getwbsCreators->bindParam(1, $PermissIONwbs, PDO::PARAM_INT);
$getwbsCreators->execute();
//
 	
	
// query 4 table3: aktivierte Nutzer-rights = permission = 1

$PermissIONactiv = 1;
$getActivated = $pdo->prepare('SELECT * FROM reg WHERE permission=? ORDER by username');
$getActivated->bindParam(1, $PermissIONactiv, PDO::PARAM_INT);
$getActivated->execute();
//
 
// query 4 table4: noch nicht / de- aktivierte Nutzer mit permission = 0

$PermissIONzero = 0;
$getNOTActivated = $pdo->prepare('SELECT * FROM reg WHERE permission=? ORDER by username');
$getNOTActivated->bindParam(1, $PermissIONzero, PDO::PARAM_INT);
$getNOTActivated->execute();
//
// query 4 table5: PW-status auf reset & noch kein neues PW vom usr gesetzt
$PWset = "PWreset00";
$getPWnotSet = $pdo->prepare('SELECT * FROM reg WHERE password=? ORDER by username');
$getPWnotSet->bindParam(1, $PWset, PDO::PARAM_STR);
$getPWnotSet->execute();
//
// admin-user-header-table start
echo '<table border=2 bordercolor="green" width="100%" class="cssadmin">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr><td color="red"><h3>A D M I N - U S E R S  --users with administration-rights [11]--</h3></td></tr></table>';
// admin-user-header-table end
echo '<table border=2 bordercolor="green" width="100%" class="cssadmin">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
 
// start div css class admin mit table1 (=rot)
//echo'<div class="cssadmin" >';

echo'<tr><td width="20%">User Name</td><td width="20%">EMail</td><td width="20%">Permission</td><td width="20%">PWstatus</td>'; 

while ($AdminList = $getAdm->fetch(PDO::FETCH_ASSOC)) {	
 echo'<tr>';
echo '<td>' . $AdminList['username'] .'</td>';
echo '<td><a href="mailto:' . $AdminList['email'] .'?Subject=cboard-project-discussion(permission-administration)">' . $AdminList['email'] .'</td>'; 
 
 

	echo '<td>User has permission of: ' . $AdminList['permission'];
	// START change permission -innerhalb des td
	echo'
					<form action="InsPermission.php" method="post">
  <select name="PermSelected">
    	<option value="1">select [1]
   	<option value="0">unsign [0]
   	<option value="7">wbs-creation-rights [7]
   	<option value="11">set to admin [11]
  </select>
	<input type="hidden" name="UsrID4set" id="UsUsrID4setrID" value="'.$AdminList['id'].'" />
	<input type=submit value="change permission">
</form>	
	 </td>
			
		
	';

	// end change permission
	 
echo '<td align="center">';
if($AdminList['password'] != "PWreset00") { echo '<font color="green"><b>is_set</b></font>';}
 else { echo '<font color="red"><b>is_not_set</b></font>';}
			//start reset-button-form 		
			echo'
					
	 </td>
	';
	// end reset button  
 			//end reset button form
 echo'</td>'; 

 
echo'</tr>';
}
echo'</table>';
 // end div class admin (=red table end) 



// next div class: wbs-creator-userreights-table start
  

// wbs-user-header-table start
echo '<table border=2 bordercolor="green" width="100%" class="csswbscreator">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr><td color="red"><h3>W B S - U S E R S  --users with wbs-forum-creation-rights [7]--</h3></td></tr></table>';
// wbs-user-header-table end
echo '<table border=2 bordercolor="yellow" width="100%" div class="csswbscreator" >'; 

echo'<tr><td width="20%">User Name</td><td width="20%">EMail</td><td width="20%">Permission</td><td width="20%">PWstatus</td>'; 

while ($wbsCreatorList = $getwbsCreators->fetch(PDO::FETCH_ASSOC)) {	
 echo'<tr>';
echo '<td>' . $wbsCreatorList['username'] .'</td>';
echo '<td><a href="mailto:' . $wbsCreatorList['email'] .'?Subject=cboard-project-discussion(permission-administration)">' . $wbsCreatorList['email'] .'</td>'; 
 echo '<td>User has permission of: ' . $wbsCreatorList['permission'];
	// START chasnge permission -innerhalb des td
	echo'
						<form action="InsPermission.php" method="post">
  <select name="PermSelected">
    	<option value="1">select [1]
   	<option value="0">unsign [0]
   	<option value="7">wbs-creation-rights [7]
   	<option value="11">set to admin [11]
  </select>
	<input type="hidden" name="UsrID4set" id="UsrID4set" value="'.$wbsCreatorList['id'].'" />
	<input type=submit value="change permission">
</form>	
	 </td>
		
	';
	// end change permission
echo '<td align="center">';
if($wbsCreatorList['password'] != "PWreset00") { echo '<font color="green"><b>is_set</b></font>';}
 else { echo '<font color="red"><b>is_not_set</b></font>';}
		
			//start reset-button-form
			echo'
						
	 </td>
	';
	// end reset button  
 			//end reset button form
 echo'</td>'; 

 
echo'</tr>';
}
echo'</table>';  
 // ende div class wbs (=yellow table en) 


// activ-user-header-table start
echo '<table border=2 bordercolor="green" width="100%" class="cssactivusr">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr><td color="red"><h3>A C T I V - U S E R S  --standard-user-rights [1]--</h3></td></tr></table>';
// wbs-user-header-table end
echo '<table border=2 bordercolor="yellow" width="100%" div class="cssactivusr" >'; 

echo'<tr><td width="20%">User Name</td><td width="20%">EMail</td><td width="20%">Permission</td><td width="20%">PWstatus</td>'; 

while ($activUsrList = $getActivated->fetch(PDO::FETCH_ASSOC)) {	
 echo'<tr>';
echo '<td>' . $activUsrList['username'] .'</td>';
echo '<td><a href="mailto:' . $activUsrList['email'] .'?Subject=cboard-project-discussion(permission-administration)">' . $activUsrList['email'] .'</td>'; 
 
echo '<td>User has permission of: ' . $activUsrList['permission'];
	// START chasnge permission -innerhalb des td
	echo'
								<form action="InsPermission.php" method="post">
  <select name="PermSelected">
    	<option value="1">select [1]
   	<option value="0">unsign [0]
   	<option value="7">wbs-creation-rights [7]
   	<option value="11">set to admin [11]
  </select>
	<input type="hidden" name="UsrID4set" id="UsrID4set" value="'.$activUsrList['id'].'" />
	<input type=submit value="change permission">
</form>	
	 </td>
			
		
	';
	// end change permission
echo '<td align="center">';
if($activUsrList['password'] != "PWreset00") { echo '<font color="green"><b>is_set</b></font>';}
 else { echo '<font color="red"><b>is_not_set</b></font>';}
			//start reset-button-form
			echo'
						
	 </td>
	';
	// end reset button  
 			//end reset button form
 echo'</td>'; 

 
echo'</tr>';
}
echo'</table>';  
 // ende div class aktiv (=gruener table ende) 


// in-activ-user-header-table start
echo '<table border=2 bordercolor="green" width="100%" class="cssunactivusr">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr><td color="red"><h3>N O T  - A C T I V A T E D - U S E R S  --access denied [0]--</h3></td></tr></table>';
// wbs-user-header-table end
echo '<table border=2 bordercolor="yellow" width="100%" div class="cssunactivusr" >'; 

echo'<tr><td width="20%">User Name</td><td width="20%">EMail</td><td width="20%">Permission</td><td width="20%">PWstatus</td>'; 

while ($disabledUsrList = $getNOTActivated->fetch(PDO::FETCH_ASSOC)) {	
 echo'<tr>';
echo '<td>' . $disabledUsrList['username'] .'</td>';
echo '<td><a href="mailto:' . $disabledUsrList['email'] .'?Subject=cboard-project-discussion(permission-administration)">' . $disabledUsrList['email'] .'</td>'; 
  
echo '<td>User has permission of: ' . $disabledUsrList['permission'];
	// START chasnge permission -innerhalb des td
	echo'
												<form action="InsPermission.php" method="post">
  <select name="PermSelected">
    	<option value="1">select [1]
   	<option value="0">unsign [0]
   	<option value="7">wbs-creation-rights [7]
   	<option value="11">set to admin [11]
  </select>
	<input type="hidden" name="UsrID4set" id="UsrID4set" value="'.$disabledUsrList['id'].'" />
	<input type=submit value="change permission">
</form>	
	 </td>
			
		
	';
	// end change permission
echo '<td align="center">';
if($disabledUsrList['password'] != "PWreset00") { echo '<font color="green"><b>is_set</b></font>';}
 else { echo '<font color="red"><b>is_not_set</b></font>';}
			//start reset-button-form
			echo'
					
	 </td>
	';
	// end reset button  
 			//end reset button form
 echo'</td>'; 

 
echo'</tr>';
}
echo'</table>';  
 // ende div class in-aktiv (=roter table ende)   

// PW reset-user-header-table start
echo '<table border=2 bordercolor="green" width="100%" class="cssPWreset">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr><td color="red"><h3>P A S S W O R D  - R E S E T T E D - U S E R S  --send token-link via email--</h3></td></tr></table>';
// wbs-user-header-table end
echo '<table border=2 bordercolor="yellow" width="100%" div class="cssPWreset" >'; 

echo'<tr><td width="20%">User Name</td><td width="20%">EMail</td><td width="20%">TokenLink</td><td width="20%">EMailResend</td>'; 

while ($PWnotSetUsrList = $getPWnotSet->fetch(PDO::FETCH_ASSOC)) {	
$UsrsID =  $PWnotSetUsrList['id'];
 echo'<tr>';
echo '<td>' . $PWnotSetUsrList['username'] .'</td>';
 
echo '<td><a href="mailto:' . $PWnotSetUsrList['email'] .'?Subject=cboard-project-discussion(permission-administration)">' . $PWnotSetUsrList['email'] .'</td>';
 
echo '<td>Token was: ' . $PWnotSetUsrList['SecToken'];
	// START chasnge permission -innerhalb des td
	echo'
					<form action="SendResetPWLink.php" method="post">
					 	<input type="hidden" name="PWtoken4link" id="PWtoken4link" value="'.$PWnotSetUsrList['SecToken'].'" />
					 	<input type="hidden" name="UsrID4PWlink" id="UsrID4PWlink" value="'.$PWnotSetUsrList['id'].'" />
					 	<input type="hidden" name="usrsemail" id="usrsemail" value="'.$PWnotSetUsrList['email'].'" />
   				<input type=submit value="create & send tokenlink">
</form>	
	 </td>
			
		
	';
	// end change permission
echo '<td align="center">'; 
			//start reset-button-form
			echo'
					<form action="reSendResetPwLink.php" method="post">
					 
  					<input type=submit value="re-send tokenlink">
					</form>	
	 </td>
	';
	// end reset button  
 			//end reset button form
 echo'</td>'; 

 
echo'</tr>';
}
echo'</table>';  
 // ende div class in-aktiv (=grauer table ende)   
 } // ende if admin permission is set
// admin panel table ENDE