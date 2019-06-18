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
	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/wbslayout.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
	
	<link rel="stylesheet" href="./CSS/accessdeniedCSS.css" type="text/css" />

	<title>C-BOARD: enhanced communication -> advanced collaboration</title>

</head>

<?php
if( !session_start() )
{
session_start();
}
	
// start: permission-check

$usrsPermission = $usrArray['permission'];
if($usrsPermission == 0) 
{echo '
		
		<form action="./login/logout.php" method="post" id="logindenied">
		<fieldset>
		<legend>A - C - C - E - S - S --  D - E - N - I - E - D</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    	  
    	<tr>
      <td align="left"> You do not have the permission to access the C-BOARD (yet).<br><br>
				If you are a newly registered user,<br>
 				your permissions need to be set by the C-BOARD-admin before you get access to this system.<br>
					<br>
				<font color="red">The C-BOARD-admin is being automatically informed about your registration by the system</font>.<br>

					<br>
				The C-BOARD-admin might be your Project Manager (PM),<bR>
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
// if admin rights, the admin-panel-link-button
if($usrsPermission == 11) 
		{
		echo '<table border=0 width = "100%" align="right"><tr align="left"><td><h2 align="left">C-BOARD: Discussion Board in WBS design</h2></td>
		
		<td align="center"><a href="usrAdminPanel.php" class="myButtonRed" title="new users/team-mates need to be activated here; assign & take permissions " align="right">user admin.</a></td>		
		<td align="center"><a href="newWBSelement.php" class="myButton" title="create a new forum by adding a new wbs-element!"align="right">wbs admin.</a></td>
		
	<td align="center"><a href="vsfm.php" class="myButtonPink" title="discussion sequences for collaborative decision-making & project-management">CYBER-SCRUM</a></td>
		
		<td align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
		
	<td align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my sight</a></td>
		<td align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my profile</a></td>
		<td align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!" align="right">CFLX email</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
// if wbs create-rechte with newwbs button (minus admin button)
elseif($usrsPermission == 7) //|| $usrsPermission == 11) 
		{
		echo '<table border=0 width = "100%" align="right"><tr align="left"><td><h2 align="left">C-BOARD: WBS-structured Discussion Board</h2></td>
		<td align="center"><a href="newWBSelement.php" class="myButton" title="create a new forum by adding a new wbs-element!" align="right">wbs admin.</a></td>
		
	<td align="center"><a href="vsfm.php" class="myButtonPink" title="discussion sequences for collaborative decision-making & project-management">CYBER-SCRUM</a></td>
		<td align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
		
	<td align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my sight</a></td>
		<td align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my profile</a></td>
		<td align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!"  align="right">CFLX email</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
	
// normal users, no wbs-create-button (no permission to create new forums)
	else {		
		echo '<table border=0 width = "100%" align="right"><tr align="left"><td><h2 align="left">C-BOARD: WBS-structured Discussion Board</h2></td>
		
	<td align="center"><a href="vsfm.php" class="myButtonPink" title="discussion sequences for collaborative decision-making & project-management">CYBER-SCRUM</a></td>
			<td align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
	<td align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my Sight</a></td>
			
		<td align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my Profile</a></td>
		<td align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!"  align="right">CFLX E-Mail</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
		
	// for the user-specific sights: user-ID & default view setting (overview.php - wide):	
	
$IDofUsrViewing = $usrArray['id'];
$usrsDefaultView = 1;

$activL1 = 1; 
$getwbs = $pdo->prepare('SELECT id,nam,des,lev,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE activ=? && `'.$IDofUsrViewing.'`=?');

$getwbs->bindParam(1, $activL1, PDO::PARAM_INT); // activ auf 1
$getwbs->bindParam(2, $usrsDefaultView, PDO::PARAM_INT); // usrID-Spalte auf 1 (default)
$getwbs->execute();
//

// *******************test new form advanced query 
		
$amountOfrows = 11;
		
						$latest_n_distinct_posts = $pdo->prepare('SELECT  MAX(created) AS max_date, ID, created, tid, Pid, topic FROM forum_posts WHERE Pid < 9000
						GROUP BY
						        tid  
						ORDER BY
						        max_date DESC
						LIMIT 15');		
//$latest_n_distinct_posts->bindParam(1, $amountOfrows, PDO::PARAM_INT); // set amount of rows
//$latest_n_distinct_posts->bindParam(1, $tid, PDO::PARAM_INT);
$latest_n_distinct_posts->execute();
$counter_n = 0;
while ($post5latest = $latest_n_distinct_posts->fetch(PDO::FETCH_ASSOC)) {
$counter_n = ($counter_n + 1);
echo'<li> <i>show 1 of '.$counter_n.', last ID:</i> ' .$post5latest['ID'].'with tid: '.  $post5latest['tid']   .' at: '.$post5latest['created'] .' Pid: '.$post5latest['Pid'] .'</li> <br>';

}


// ++++++++++++++++++++++++ advanced query test end
while ($row = $getwbs->fetch(PDO::FETCH_ASSOC)) {
 
	
		echo '<table border=1 width="100%">'; // start main html-table (Rahmen aussen) 
	 		echo '<tr><td class="wbs1"><p class="wbs1txt" >' . $row['wbsnumber'] .'&nbsp;'.$row['nam'].'&nbsp; :: &nbsp;'.  $row['des'].'<i> &nbsp; :: &nbsp;lev: '.  $row['lev'].'</i></p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL1 = 0;
								$created = "created";
								$Pidstrg = $row['id'];
							//	$Pidstrg = 2;
$gets = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');// -> suck2 mit  ID,Pid,topic,dscrption,closed,created
$gets->bindParam(1, $Pidstrg, PDO::PARAM_INT);
$gets->bindParam(2, $closedstrgL1, PDO::PARAM_INT);
$gets->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck2 = $gets->fetch(PDO::FETCH_ASSOC)) {
		switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#DEEAFA'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#C3DBFA'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div style="background-color: <?php echo $bg; ?>; margin-right:1px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck2['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck2['topic']; ?>&raquo;</a>
								<br />
						<div class="description">
							<?php echo $suck2['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<div class="sub_cat_b">
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid = $suck2['ID'];
//$latest_post2 = $pdo->prepare('SELECT * FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');

$latest_post2 = $pdo->prepare('SELECT ID,tid,topic,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post2->bindParam(1, $tid, PDO::PARAM_INT);
$latest_post2->execute();
$post2 = $latest_post2->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post2)
{
   echo 'There are no posts in this thread yet';
						
}

// if  available, start
else {

// get topic, based on thread id start	
	$thrid = $post2['tid'];
// $latest_post2 = $pdo->prepare('SELECT topic, Pid, ID FROM strg WHERE ID=?');
	$gettopic2 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
	$gettopic2->bindParam(1, $thrid, PDO::PARAM_INT);
	$gettopic2->execute();
	$topic2 = $gettopic2->fetch(PDO::FETCH_ASSOC);
//					
					
//								
							  echo '<a href="threadview.php?ID='.$post2['tid'].'&amp;#'.$post2['ID'].'">';
							  if(strlen($post2['topic']) >= 15) { // Kürzen, falls Titel länger als 14 Zeichen
								echo substr($post2['topic'], 0, 15).'...</a>';
							  } else {
							  		echo $post2['topic']. 'Latest post' . '</a>';
								 
							  }
							  
							  echo ' by <a href="UsersProfile.php?nm='.$post2['username'].'">'.$post2['username'].'</a> from '.($post2['created']); // Hier wandelt convertdate() unseren timestamp in eine "normale" Angabe um
						  
						  }
						?>
					</div>
					<div style="clear: left;"></div>
				</div>
				  
				  <?php
				  	} // ende der while-Schleife um assoc $suck2}	 
		
		
				
			//	} // ende der kl. 1er while-Schleife 
						echo '</td></tr></table>	';			
				} // ende der gr. 1er while-Schleife 

} // ende der permission if not 0
?>
								
							
