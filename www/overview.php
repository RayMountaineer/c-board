<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}
require_once("./PDO/connex.php");
   // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
	$URL = "./login/login.php";
	if( headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
	else { header("Location: $URL"); }
	exit;

        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to ./login/login.php");
    }



// hier war der HTML-HEADER -> VII, html nun unten 
// added for umlauts:
// raus, steht schon / 2ter header - already sent error!	header('Content-type: text/html; charset=utf-8'); 
//


// start: permission-check
$usrArray= $_SESSION['user'];
$usrsPermission = $usrArray['permission'];

	if ($usrsPermission == '') // if empty
	{ 
     	header("Location: ./login/login.php");
   	exit;
	}
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
		// echo out username:
		echo '<div style="color:red;font-weight:600;">'.	$_SESSION['user']['username'].'</div>';
	echo '<table class="headbuttontable" style=" border: 0; width: 100%; align:right; padding-left: 0em;">';
	
// if admin rights, the admin-panel-link-button
if($usrsPermission == 11) 
		{
		echo '
	<tr>	
		<td class="headbuttontd" align="center"><a href="usrAdminPanel.php" class="myButtonRed" title="new users/team-mates need to be activated here; assign & take permissions " align="right">user admin.</a></td>		
		<td class="headbuttontd" align="center"><a href="newWBSelement.php" class="myButton" title="create a new forum by adding a new wbs-element!"align="right">wbs admin.</a></td>
		
	 
		
		<td class="headbuttontd"  align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
		
	<td class="headbuttontd"  align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my sight</a></td>
		<td class="headbuttontd"  align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my profile</a></td>
		<td class="headbuttontd"  align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!" align="right">CFLX email</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
// if wbs create-rechte with newwbs button (minus admin button)
elseif($usrsPermission == 7) //|| $usrsPermission == 11) 
		{
		echo '<tr>
		<td class="headbuttontd"  align="center"><a href="newWBSelement.php" class="myButton" title="create a new forum by adding a new wbs-element!" align="right">wbs admin.</a></td>
		
	
		<td class="headbuttontd"  align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
		
	<td class="headbuttontd"  align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my sight</a></td>
		<td class="headbuttontd"  align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my profile</a></td>
		<td class="headbuttontd"  align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!"  align="right">CFLX email</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
	
// normal users, no wbs-create-button (no permission to create new forums)
	else {		
		echo '<tr>
		
	 
			<td class="headbuttontd"  align="center"><a href="ovTable.php" class="myButtonAzure" title="all board-postings in one list" align="right">table view</a></td>
	<td class="headbuttontd"  align="center"><a href="persWBS.php" class="myButtonOrange" title="select your wbs-elements & make the others disappear" align="right">my Sight</a></td>
			
		<td class="headbuttontd"  align="center"><a href="persProfile.php" class="myButtonYelow" title="setup/ adjust your profile!" align="right">my Profile</a></td>
		<td class="headbuttontd"  align="center"><a href="CFLX_en.php" class="myButtonBlu" title="send CFLX-enhanced emails!"  align="right">CFLX E-Mail</a></td>		
		<td align="right"><a href="./login/logout.php" class="outButton" title="have a good time, '.$usrArray['username'].'!" align="right">logout</a></td><hr />
		';
		}
		
	// for the user-specific sights: user-ID & default view setting (overview.php - wide):	
	
$IDofUsrViewing = $usrArray['id'];
$usrsDefaultView = 1;

	// 	now: start level-specifics:
	
	 
$L1 = 1;
$activL1 = 1;
//$getwbs = $pdo->prepare('SELECT id,lev,L1,nam,des,activ,'.$IDofUsrViewing.' FROM wbs WHERE lev=? && activ=? && '.$IDofUsrViewing.'=?');
$getwbs = $pdo->prepare('SELECT id,nam,des,lev,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE lev=? && activ=? && `'.$IDofUsrViewing.'`=?');

//$getwbs = $pdo->prepare("SELECT id,lev,L1,nam,des,activ,".$IDofUsrViewing." FROM wbs WHERE lev=? && activ=? && 2=1");
$getwbs->bindParam(1, $L1, PDO::PARAM_INT); // level auf 1
$getwbs->bindParam(2, $activL1, PDO::PARAM_INT); // activ auf 1
$getwbs->bindParam(3, $usrsDefaultView, PDO::PARAM_INT); // usrID-Spalte auf 1 (default)
$getwbs->execute();
//

while ($row = $getwbs->fetch(PDO::FETCH_ASSOC)) {
 
	
		echo '<table border=1 width="100%">'; // start main html-table (Rahmen aussen) 
	 		echo '<tr><td class="wbs1"><p class="wbs1txt" >' . $row['wbsnumber'] .'&nbsp;'.$row['nam'].'&nbsp; :: &nbsp;'.  $row['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
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
	// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt =	htmlspecialchars($suck2['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt =	htmlspecialchars($suck2['dscrption'], ENT_QUOTES, 'UTF-8');
					 
						
						$ThreadTopiclength = strlen($ThreadTopicTxt);
						$ThreadDesclength = strlen($ThreadDescrTxt);
			//
				
						if($ThreadTopiclength > 133) {$ThreadTopic = (substr($ThreadTopicTxt, 0, 131))."...";	}
							else {$ThreadTopic = $ThreadTopicTxt; }
						if($ThreadDesclength >77) {$ThreadDescription = (substr($ThreadDescrTxt, 0, 131))."...";	}
							else {$ThreadDescription = $ThreadDescrTxt; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti =	wordwrap($ThreadTopic,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti =	wordwrap($ThreadDescription,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end
		switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#DEEAFA'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#C3DBFA'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-right:1px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck2['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck2['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck2['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
				 <!--// 	<div class="sub_cat_b" style="position: absolute;"> <!--// absolute-container for positioning the inner elements relative-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid = $suck2['ID'];
//$latest_post2 = $pdo->prepare('SELECT * FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');

$latest_post2 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post2->bindParam(1, $tid, PDO::PARAM_INT);
$latest_post2->execute();
$post2 = $latest_post2->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post2)
{
		  echo ' <div class="sub_cat_c" style="position: absolute;">
							 	<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
							
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
					
						
							$UsrNameText = $post2['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post2['tid'].'&amp;#'.$post2['ID'].'">';
							 							 if(strlen($post2['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post2['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post2['ap'].'</a>'; 
							  									echo htmlspecialchars($post2['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	 
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post2['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
											$suckAlldate = ($post2['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											
											
									 		echo'</div>								
								</div>
								</div>'; 
						  
						  }
						?>
					<!--</div> -->
					<div style="clear: left;"></div>
				</div>
				  
				  <?php
				  	} // ende der while-Schleife um assoc $suck2}	 
		
			
//level2 start		
$L2 = 2;
$activL2 = 1;

$wbsparent1 = $row['id'];

//$getwbs2 = $pdo->prepare('SELECT id,lev,L1,nam,des,activ,1 FROM wbs WHERE L1=? && lev=? && activ=? && '.$IDofUsrViewing.'=?');
$getwbs2 = $pdo->prepare('SELECT id,lev,L1,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L1=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');

$getwbs2->bindParam(1, $wbsparent1, PDO::PARAM_INT);
$getwbs2->bindParam(2, $L2, PDO::PARAM_INT);
$getwbs2->bindParam(3, $activL2, PDO::PARAM_INT);
$getwbs2->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs2->execute();
//

while ($row2 = $getwbs2->fetch(PDO::FETCH_ASSOC)) {
 
		echo '<table border=1 width="100%">'; // start main html-table (Rahmen aussen) 
 		echo '<tr><td class="wbs2"><p class="wbs2txt" >' . $row2['wbsnumber'] .'&nbsp;'.$row2['nam'].'&nbsp; :: &nbsp;'.  $row2['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL2 = 0;
								$created2 = "created";
//								$getstrg1 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY $created');
								$Pidstrg2 = $row2['id'];
							//	$Pidstrg = 2;
$gets2 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets2->bindParam(1, $Pidstrg2, PDO::PARAM_INT);
$gets2->bindParam(2, $closedstrgL2, PDO::PARAM_INT);
$gets2->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck2b = $gets2->fetch(PDO::FETCH_ASSOC)) {
		// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
			   $ThreadTopicTxtb =	htmlspecialchars($suck2b['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxtb =	htmlspecialchars($suck2b['dscrption'], ENT_QUOTES, 'UTF-8');
				
						
						$ThreadTopiclengthb = strlen($ThreadTopicTxtb);
						$ThreadDesclengthb = strlen($ThreadDescrTxtb);
			//
				
						if($ThreadTopiclengthb > 133) {$ThreadTopicb = (substr($ThreadTopicTxtb, 0, 131))."...";	}
							else {$ThreadTopicb = $ThreadTopicTxtb; }
						if($ThreadDesclengthb > 133) {$ThreadDescriptionb = (substr($ThreadDescrTxtb, 0, 131))."...";	}
							else {$ThreadDescriptionb = $ThreadDescrTxtb; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOptib =	wordwrap($ThreadTopicb,133,"<br>\n",TRUE);	
			
			$ThreadDescOptib =	wordwrap($ThreadDescriptionb,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end
		switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#C9F5B8'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#B6E6A3'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck2b['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck2b['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck2b['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
				<!--	<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid2 = $suck2b['ID']; 

$latest_post2b = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post2b->bindParam(1, $tid2, PDO::PARAM_INT);
$latest_post2b->execute();
$post2b = $latest_post2b->fetch(PDO::FETCH_ASSOC);
// check, if there are any  
if( ! $post2b)
{
    echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
						
}

// if  available, start
else {

// get topic strat	
$thrid2 = $post2b['tid']; 
$gettopic2b = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic2b->bindParam(1, $thrid2, PDO::PARAM_INT);
$gettopic2b->execute();
$topic2 = $gettopic2b->fetch(PDO::FETCH_ASSOC);
						
							$UsrNameText = $post2b['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
								 //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post2b['tid'].'&amp;#'.$post2b['ID'].'">';
							 							 if(strlen($post2b['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post2b['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post2b['ap'].'</a>';
									 						echo htmlspecialchars($post2b['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post2b['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
												$suckAlldate = ($post2b['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											echo'
									 		</div>								
								</div>
								</div>'; 
							  //
							  
							  
							
						  }
						?>
<!--					</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				
				} // ende der while-Schleife um assoc $suck2b
// wbs2 end				
		
		//		} // ende der while-Schleife um assoc $suck2b	 
		
		
// strat wbs level3	
	
// HIER den $sucks3 = SELECT ...   rein =>	
	
//
$L3 = 3;
$activL3 = 1;

$wbsparent2 = $row2['id'];

$getwbs3 = $pdo->prepare('SELECT id,lev,L2,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L2=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');
$getwbs3->bindParam(1, $wbsparent2, PDO::PARAM_INT);
$getwbs3->bindParam(2, $L3, PDO::PARAM_INT);
$getwbs3->bindParam(3, $activL3, PDO::PARAM_INT);
$getwbs3->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs3->execute();

while ($row3 = $getwbs3->fetch(PDO::FETCH_ASSOC)) {

	
		echo '<table border=0 width="100%">'; 
			echo '<tr><td class="wbs3"><p class="wbs3txt" >' . $row3['wbsnumber'] .'&nbsp;'.$row3['nam'].'&nbsp; :: &nbsp;'.  $row3['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL3 = 0;
								$created3 = "created";
								$Pidstrg3 = $row3['id'];
							//	$Pidstrg = 2;
$gets3 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets3->bindParam(1, $Pidstrg3, PDO::PARAM_INT);
$gets3->bindParam(2, $closedstrgL3, PDO::PARAM_INT);
$gets3->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck3 = $gets3->fetch(PDO::FETCH_ASSOC)) {
// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt3 =	htmlspecialchars($suck3['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt3 =	htmlspecialchars($suck3['dscrption'], ENT_QUOTES, 'UTF-8');
				 
						
						$ThreadTopiclength3 = strlen($ThreadTopicTxt3);
						$ThreadDesclength3 = strlen($ThreadDescrTxt3);
			//
				
						if($ThreadTopiclength3 > 133) {$ThreadTopic3 = (substr($ThreadTopicTxt3, 0, 131))."...";	}
							else {$ThreadTopic3 = $ThreadTopicTxt3; }
						if($ThreadDesclength3 > 133) {$ThreadDescription3 = (substr($ThreadDescrTxt3, 0, 131))."...";	}
							else {$ThreadDescription3 = $ThreadDescrTxt3; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti3 =	wordwrap($ThreadTopic3,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti3 =	wordwrap($ThreadDescription3,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end	

	switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#FAF8A2'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#F2F18A'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck3['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck3['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck3['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<!--<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid3 = $suck3['ID']; 

$latest_post3 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post3->bindParam(1, $tid3, PDO::PARAM_INT);
$latest_post3->execute();
$post3 = $latest_post3->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post3)
{
   // die('There are no posts in this thread yet');
   echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
						
}

// if  available, start
else {

// get topic strat	
$thrid3 = $post3['tid']; 
$gettopic3 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic3->bindParam(1, $thrid3, PDO::PARAM_INT);
$gettopic3->execute();
$topic3 = $gettopic3->fetch(PDO::FETCH_ASSOC);
 						   	  // ad user-name shortener  - for our Hadschi's...
							  // add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
							$UsrNameText = $post3['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
							   		 //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post3['tid'].'&amp;#'.$post3['ID'].'">';
							 							 if(strlen($post3['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post3['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post3['ap'].'</a>';
									 						echo htmlspecialchars($post3['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post3['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
												$suckAlldate = ($post3['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											echo'
									 		</div>								
								</div>
								</div>'; 
							  //
						  }
						?>
					<!--</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				
				} // ende der while-Schleife um assoc $suck3
			
// wbs3 end				
// wbs4 start

$L4 = 4;
$activL4 = 1;

$wbsparent3 = $row3['id'];

$getwbs4 = $pdo->prepare('SELECT id,lev,L3,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L3=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');
$getwbs4->bindParam(1, $wbsparent3, PDO::PARAM_INT);
$getwbs4->bindParam(2, $L4, PDO::PARAM_INT);
$getwbs4->bindParam(3, $activL4, PDO::PARAM_INT);

$getwbs4->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs4->execute();

while ($row4 = $getwbs4->fetch(PDO::FETCH_ASSOC)) {
		echo '<table border=0 width="100%">'; // start wbs3 (Table-Rahmen 0) 
			echo '<tr><td class="wbs4"><p class="wbs4txt" >' . $row4['wbsnumber'] .'&nbsp;'.$row4['nam'].'&nbsp; :: &nbsp;'.  $row4['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL4 = 0;
								$created4 = "created";
//								$getstrg1 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY $created');
								$Pidstrg4 = $row4['id'];
							//	$Pidstrg = 2;
$gets4 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets4->bindParam(1, $Pidstrg4, PDO::PARAM_INT);
$gets4->bindParam(2, $closedstrgL4, PDO::PARAM_INT);
$gets4->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck4 = $gets4->fetch(PDO::FETCH_ASSOC)) {

// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt4 =	htmlspecialchars($suck4['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt4 =	htmlspecialchars($suck4['dscrption'], ENT_QUOTES, 'UTF-8');
				
						$ThreadTopiclength4 = strlen($ThreadTopicTxt4);
						$ThreadDesclength4 = strlen($ThreadDescrTxt4);
			//
				
						if($ThreadTopiclength4 > 133) {$ThreadTopic4 = (substr($ThreadTopicTxt4, 0, 131))."...";	}
							else {$ThreadTopic4 = $ThreadTopicTxt4; }
						if($ThreadDesclength4 > 133) {$ThreadDescription4 = (substr($ThreadDescrTxt4, 0, 131))."...";	}
							else {$ThreadDescription4 = $ThreadDescrTxt4; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti4 =	wordwrap($ThreadTopic4,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti4 =	wordwrap($ThreadDescription4,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end	
		switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#ffcad1'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#FABBC6'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck4['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck4['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck4['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<!--<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid4 = $suck4['ID']; 

$latest_post4 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post4->bindParam(1, $tid4, PDO::PARAM_INT);
$latest_post4->execute();
$post4 = $latest_post4->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post4)
{
 //   die('There are no posts in this thread yet');
  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
}

// if  available, start
else {

// get topic strat	
$thrid4 = $post4['tid']; 
$gettopic4 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic4->bindParam(1, $thrid4, PDO::PARAM_INT);
$gettopic4->execute();
$topic4 = $gettopic4->fetch(PDO::FETCH_ASSOC);
 						
							  	  // ad user-name shortener  - for our Hadschi's...
							  // add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
							$UsrNameText = $post4['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
							 		 //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post4['tid'].'&amp;#'.$post4['ID'].'">';
							 							 if(strlen($post4['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post4['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post4['ap'].'</a>';
									 						echo htmlspecialchars($post4['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post4['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
												$suckAlldate = ($post4['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
									echo'
									 		</div>								
								</div>
								</div>'; 
							  //
							 	  }
						?>
				<!--	</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				}
			
// wbs5 start

$L5 = 5;
$activL5 = 1;

$wbsparent4 = $row4['id'];

$getwbs5 = $pdo->prepare('SELECT id,lev,L4,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L4=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');
$getwbs5->bindParam(1, $wbsparent4, PDO::PARAM_INT);
$getwbs5->bindParam(2, $L5, PDO::PARAM_INT);
$getwbs5->bindParam(3, $activL5, PDO::PARAM_INT);

$getwbs5->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs5->execute();

while ($row5 = $getwbs5->fetch(PDO::FETCH_ASSOC)) {
	
		echo '<table border=0 width="100%">'; 
			echo '<tr><td class="wbs5"><p class="wbs4txt" >' . $row5['wbsnumber'] .'&nbsp;'.$row5['nam'].'&nbsp; :: &nbsp;'.  $row5['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL5 = 0;
								$created5 = "created";
//								$getstrg1 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY $created');
								$Pidstrg5 = $row5['id'];
							//	$Pidstrg = 2;
$gets5 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets5->bindParam(1, $Pidstrg5, PDO::PARAM_INT);
$gets5->bindParam(2, $closedstrgL5, PDO::PARAM_INT);
$gets5->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck5 = $gets5->fetch(PDO::FETCH_ASSOC)) {

// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt5 =	htmlspecialchars($suck5['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt5 =	htmlspecialchars($suck5['dscrption'], ENT_QUOTES, 'UTF-8');
				 
						
						$ThreadTopiclength5 = strlen($ThreadTopicTxt5);
						$ThreadDesclength5 = strlen($ThreadDescrTxt5);
			//
				
						if($ThreadTopiclength5 > 133) {$ThreadTopic5 = (substr($ThreadTopicTxt5, 0, 131))."...";	}
							else {$ThreadTopic5 = $ThreadTopicTxt5; }
						if($ThreadDesclength5 > 133) {$ThreadDescription5 = (substr($ThreadDescrTxt5, 0, 131))."...";	}
							else {$ThreadDescription5 = $ThreadDescrTxt5; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti5 =	wordwrap($ThreadTopic5,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti5 =	wordwrap($ThreadDescription5,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end		
	switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#BBFAF4'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#ACE6E0'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck5['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck5['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck5['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<!--<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid5 = $suck5['ID']; 

$latest_post5 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post5->bindParam(1, $tid5, PDO::PARAM_INT);
$latest_post5->execute();
$post5 = $latest_post5->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post5)
{
 //   die('There are no posts in this thread yet');
   echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
}

// if  available, start
else {

// get topic strat	
$thrid5 = $post5['tid']; 
$gettopic5 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic5->bindParam(1, $thrid5, PDO::PARAM_INT);
$gettopic5->execute();
$topic5 = $gettopic5->fetch(PDO::FETCH_ASSOC);
 						
							 
							     // ad user-name shortener  - for our Hadschi's...
							  // add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
							$UsrNameText = $post5['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
							 		 //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post5['tid'].'&amp;#'.$post5['ID'].'">';
							 							 if(strlen($post5['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post5['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post5['ap'].'</a>';
									 							echo htmlspecialchars($post5['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post5['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
												$suckAlldate = ($post5['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											echo'
											
									 		</div>								
								</div>
								</div>'; 
							  //		
							
						  }
						?>
					<!--</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				}
			
// wbs6 start

$L6 = 6;
$activL6 = 1;
//

$wbsparent5 = $row5['id'];

$getwbs6 = $pdo->prepare('SELECT id,lev,L5,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L5=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');
$getwbs6->bindParam(1, $wbsparent5, PDO::PARAM_INT);
//
//$getwbs6 = $pdo->prepare('SELECT * FROM wbs WHERE lev=? && activ=?');
$getwbs6->bindParam(2, $L6, PDO::PARAM_INT);
$getwbs6->bindParam(3, $activL6, PDO::PARAM_INT);

$getwbs6->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs6->execute();

while ($row6 = $getwbs6->fetch(PDO::FETCH_ASSOC)) {
	
		echo '<table border=0 width="100%">'; // start wbs6 (Table-Rahmen 0) 
				echo '<tr><td class="wbs6"><p class="wbs6txt" >' . $row6['wbsnumber'] .'&nbsp;'.$row6['nam'].'&nbsp; :: &nbsp;'.  $row6['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL6 = 0;
								$created6 = "created";
//								$getstrg1 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY $created');
								$Pidstrg6 = $row6['id'];
							//	$Pidstrg = 2;
$gets6 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets6->bindParam(1, $Pidstrg6, PDO::PARAM_INT);
$gets6->bindParam(2, $closedstrgL6, PDO::PARAM_INT);
$gets6->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck6 = $gets6->fetch(PDO::FETCH_ASSOC)) {
// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt6 =	htmlspecialchars($suck6['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt6 =	htmlspecialchars($suck6['dscrption'], ENT_QUOTES, 'UTF-8');
				 
						
						$ThreadTopiclength6 = strlen($ThreadTopicTxt6);
						$ThreadDesclength6 = strlen($ThreadDescrTxt6);
			//
				
						if($ThreadTopiclength6 > 133) {$ThreadTopic6 = (substr($ThreadTopicTxt6, 0, 131))."...";	}
							else {$ThreadTopic6 = $ThreadTopicTxt6; }
						if($ThreadDesclength6 > 133) {$ThreadDescription6 = (substr($ThreadDescrTxt6, 0, 131))."...";	}
							else {$ThreadDescription6 = $ThreadDescrTxt6; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti6 =	wordwrap($ThreadTopic6,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti6 =	wordwrap($ThreadDescription6,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end	
		switch($counter) { // Sorgt für "Zebra-Effekt"
						case 0: $bg = '#C5DE8E'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#B1C97D'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck6['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck6['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck6['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<!--<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid6 = $suck6['ID']; 

$latest_post6 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post6->bindParam(1, $tid6, PDO::PARAM_INT);
$latest_post6->execute();
$post6 = $latest_post6->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post6)
{
 //   die('There are no posts in this thread yet');
   echo ' <div class="sub_cat_c" style="position: absolute;">
							 	<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
}

// if  available, start
else {

// get topic strat	
$thrid6 = $post6['tid']; 
$gettopic6 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic6->bindParam(1, $thrid6, PDO::PARAM_INT);
$gettopic6->execute();
$topic6 = $gettopic6->fetch(PDO::FETCH_ASSOC);
 						
							  // ad user-name shortener  - for our Hadschi's...
							  // add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
							$UsrNameText = $post6['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
							   		 //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post6['tid'].'&amp;#'.$post6['ID'].'">';
							 							 if(strlen($post6['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post6['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post6['ap'].'</a>';
									 							echo htmlspecialchars($post6['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post6['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
											<div class="overviewDate">';
												$suckAlldate = ($post6['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											echo'
									 		</div>								
								</div>
								</div>'; 
							  //
						  }
						?>
					<!--</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				}
// wbs7 start

$L7 = 7;
$wbsparent6 = $row6['id'];
$activL7 = 1;
$getwbs7 = $pdo->prepare('SELECT id,lev,L6,nam,des,wbsnumber,activ,`'.$IDofUsrViewing.'` FROM wbs WHERE L6=? && lev=? && activ=? && `'.$IDofUsrViewing.'`=?');
$getwbs7->bindParam(1, $wbsparent6, PDO::PARAM_INT);
$getwbs7->bindParam(2, $L7, PDO::PARAM_INT);
$getwbs7->bindParam(3, $activL7, PDO::PARAM_INT);

$getwbs7->bindParam(4, $usrsDefaultView, PDO::PARAM_INT);
$getwbs7->execute();

while ($row7 = $getwbs7->fetch(PDO::FETCH_ASSOC)) {
		echo '<table border=0 width="100%">'; // start wbs5 (Table-Rahmen 0) 
				echo '<tr><td class="wbs7"><p class="wbs7txt" >' . $row7['wbsnumber'] .'&nbsp;'.$row7['nam']. '&nbsp; :: &nbsp;'.  $row7['des'].'</p>'; // wbs lev1 grün m. HAP-name als Überschrift
 
								$closedstrgL6 = 0;
								$created6 = "created";
//								$getstrg1 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY $created');
								$Pidstrg6 = $row7['id'];
							//	$Pidstrg = 2;
$gets6 = $pdo->prepare('SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=? ORDER BY created');//SELECT ID,Pid,topic,dscrption,closed,created FROM strg WHERE Pid=? && closed=?
$gets6->bindParam(1, $Pidstrg6, PDO::PARAM_INT);
$gets6->bindParam(2, $closedstrgL6, PDO::PARAM_INT);
$gets6->execute();


//
	 $counter = 0; // Zähler-Variable
//	 
while ($suck6 = $gets6->fetch(PDO::FETCH_ASSOC)) {
	// add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
				$ThreadTopicTxt6 =	htmlspecialchars($suck6['topic'], ENT_QUOTES, 'UTF-8');	
			  	$ThreadDescrTxt6 =	htmlspecialchars($suck6['dscrption'], ENT_QUOTES, 'UTF-8');
						
						$ThreadTopiclength6 = strlen($ThreadTopicTxt6);
						$ThreadDesclength6 = strlen($ThreadDescrTxt6);
			//
				
						if($ThreadTopiclength6 > 133) {$ThreadTopic6 = (substr($ThreadTopicTxt6, 0, 131))."...";	}
							else {$ThreadTopic6 = $ThreadTopicTxt6; }
						if($ThreadDesclength6 > 133) {$ThreadDescription6 = (substr($ThreadDescrTxt6, 0, 131))."...";	}
							else {$ThreadDescription6 = $ThreadDescrTxt6; }
							
				// force linebreak after 35 chars:
			$ThreadTopicOpti6 =	wordwrap($ThreadTopic6,133,"<br>\n",TRUE);	
			
			$ThreadDescOpti6 =	wordwrap($ThreadDescription6,133,"<br>\n",TRUE);	
	// checker, shorte & wrapper end	
		switch($counter) { // Sorgt für "Zebra-Effekt" level7 style
						case 0: $bg = '#FAEC9D'; // Wenn Zähler-Variable auf 0, dann Zeilenhintergrund = #363636
							$counter++; // Zähler-Variable + 1
								break;
						case 1: $bg = '#FAE570'; // Wenn Zähler-Variable auf 1, dann Zeilenhintergrund = #d9d9d9
							$counter--; // Zähler-Variable - 1
								break;
					}	//zeb ra ende
	 
				  ?>
				  
				<div class="ovthreadrow" style="background-color: <?php echo $bg; ?>; margin-left:2px; margin-right:2px;">
					<div class="sub_cat_a">
					<!--im a href wird der Ziel-link der threadview.php über die strg-ID themenstrangspezifisch festgelegt-->
							<a href="threadview.php?ID=<?php echo $suck6['ID']; ?>" style="color: #5959FF; text-decoration: none;"><?php echo $suck6['topic']; ?></a>
								<br />
						<div class="description">
							<?php echo $suck6['dscrption']; // Beschreibung des Themenstranges ?> 
						</div>
					</div>
								<!--wbs-level1: div für 2.teil mit letzen beitrag aus post-table START	-->					
					<!--<div class="sub_cat_b" style="position: absolute;">-->
						<?php   // SELECT FROM forum_posts und FROM forum_threads:
// new pdo forum_posts:

$tid6 = $suck6['ID']; 

$latest_post6 = $pdo->prepare('SELECT ID,tid,topic,ap,username,created FROM forum_posts WHERE tid=? ORDER BY created DESC LIMIT 1');
$latest_post6->bindParam(1, $tid6, PDO::PARAM_INT);
$latest_post6->execute();
$post6 = $latest_post6->fetch(PDO::FETCH_ASSOC);
// check, if there are any wbs-elements with lev=1
if( ! $post6)
{
 //   die('There are no posts in this thread yet');
  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left; position: relative; ">
							 		<i>There are no posts in this thread yet</i>
									</div>								 		
					</div>';
	
}

// if  available, start
else {

// get topic strat	
$thrid6 = $post6['tid']; 
$gettopic6 = $pdo->prepare('SELECT topic FROM strg WHERE ID=?');
$gettopic6->bindParam(1, $thrid6, PDO::PARAM_INT);
$gettopic6->execute();
$topic6 = $gettopic6->fetch(PDO::FETCH_ASSOC);
 						 // ad user-name shortener  - for our Hadschi's...
							  // add strng length checker & shortener & wrapper for thread topics and thread deswcriptions, if needed ...
							$UsrNameText = $post6['username'];
							$UsrNameTextlength = strlen($UsrNameText);
							if($UsrNameTextlength > 23) {$UsrName4show = (substr($UsrNameText, 0, 20))."...";	}
							else {$UsrName4show = $UsrNameText; }
							  //
							    //
						  echo ' <div class="sub_cat_c" style="position: absolute;">
							 		<div style="float:left;">
							  					<div class="overviewSubject">
							  						  <a href="threadview.php?ID='.$post6['tid'].'&amp;#'.$post6['ID'].'">';
							 							 if(strlen($post6['ap']) >=88) { // Kürzen, falls Titel länger als 14 Zeichen
															echo substr($post6['ap'], 0, 85).'...</a>';
														  } else {
							  								//	echo $post6['ap'].'</a>';
									 							echo htmlspecialchars($post6['ap'], ENT_QUOTES, 'UTF-8');
																echo '</a>';	
														  }
							  				 echo '	</div>
									 	
									 		<div class="overviewName" style="padding-left:1em; color: rgb(255, 153, 0); font-weight:600;">by 
									  			<a href="UsersProfile.php?nm='.$post6['username'].'">'.$UsrName4show.'</a>
									  		</div>
									  		
									 		
								</div>
								</div>
								<div class="sub_cat_c" >
							 		<div style="float:right;">			
												<div class="overviewDate">';
												$suckAlldate = ($post6['created']);
											$DateOfDate = substr($suckAlldate, 0, 10);
											$TimeOfDate = substr($suckAlldate, 10, 9);
											echo $DateOfDate.' <b>'.$TimeOfDate.'</b>';
											echo'
									 		</div>								
								</div>
								</div>'; 
							  //
						  }
						?>
				<!--	</div>-->
					<div style="clear: left;"></div>
				</div>
				  
				 
				  <?php
				} // ende der kleinen thread-case-farbwechsel-while suck6 (was suck-wbs7 entspricht)	
				
				
						echo '</td></tr></table>	';		// ende wbs-table level7		
				} // ende der Großen while-Schleife wbs7
			
				
			//	} // ende der kl. 6er while-Schleife 	
						echo '</td></tr></table>	';											
				} // ende der gr. 6er while-Schleife 
				
			//	} // ende der kl. 5er while-Schleife 	
						echo '</td></tr></table>	';											
				} // ende der gr. 5er while-Schleife 
				
			//	} // ende der kl. 4er while-Schleife 
						echo '</td></tr></table>	';			
				} // ende der gr. 4er while-Schleife 
								
			//	} // ende der kl. 3er while-Schleife 
						echo '</td></tr></table>	';			
				} // ende der gr. 3er while-Schleife 
				
			//	} // ende der kl. 2er while-Schleife 
						echo '</td></tr></table>	';			
				} // ende der gr. 2er while-Schleife 
				
			//	} // ende der kl. 1er while-Schleife 
						echo '</td></tr></table>	';			
				} // ende der gr. 1er while-Schleife 

} // ende der permission if not 0
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5"> 

	<!--Media queries css directly in the page: -->
	
	<link type="text/css" rel="stylesheet" media="only screen and (max-device-width: 720px)" href="CSS/middlemobiles.css" /> 
	<link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 100px max-device-width: 719px)" href="CSS/smallmobiles.css" /> 
	
	<link rel="stylesheet" href="./CSS/standard.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/wbslayout.css" type="text/css" />
	<link rel="stylesheet" href="./CSS/button.css" type="text/css" />
	
	<link rel="stylesheet" href="./CSS/accessdeniedCSS.css" type="text/css" />
<!--<link rel="stylesheet" href="./CSS/w3.css" type="text/css" />-->
	<title>C-BOARD: enhanced communication -> advanced collaboration</title>

</head>
								
							
