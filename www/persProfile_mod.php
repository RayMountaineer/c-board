<?php
if( !session_start() )
{
session_start(); 
}


// start user login-status & redirect if user is not set:
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
	<title>C-BOARD: personal profile -> give trust, earn trust</title>


		<link rel="stylesheet" href="CSS/standard.css" type="text/css" />
		<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	   <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/button.css">
           <link rel="stylesheet" href="CSS/inputs.css">
      
		<!--CFLX-part start-->	
		<link rel="stylesheet" href="CSS/html.css"> 	 
      <link rel="stylesheet" href="CSS/cssboardhead.css"> 	
      
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        		<script>window.jQuery || document.write('<script src="JScripts/jquery-1.11.3.min.js"><\/script>')</script>
			
<?php
 
// $usrsname= htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

$usrsname= ($_SESSION['user']['username']);//, ENT_QUOTES, 'UTF-8');  
$usrID= ($_SESSION['user']['id']);//, ENT_QUOTES, 'UTF-8');  


//$usr_query = $pdo->query("SELECT id,username,email,image_type,image_type2,fname,lname,phone,daytime,tzone,position,skills,interestedin,linklist,comment,thorie_nearness,thorie_risk FROM usrsprofiles WHERE username = '$usrsname'");
$usr_query = $pdo->query("SELECT * FROM usrsprofiles WHERE id = '$usrID'");

$pers_row= $usr_query->fetchAll(PDO::FETCH_ASSOC); 

$cflag_query = $pdo->query("SELECT qr,im,ap,statstat FROM cflags WHERE username = '$usrsname'");
$cflx_row= $cflag_query->fetchAll(PDO::FETCH_ASSOC); 

?>
		
     
 	
		
</head>
<body bgcolor="grey">


<?php
	echo '<p style="float: right;"><a href="overview.php" class="myButtonBlu" title="the wbs-structured board-sight">WBS/ overview</a></p>'; // Thema erstellen-Link

	echo '<h2 style="font-size: 1.6em; font-weight: 400; text-align: left; ">C-BOARD :: Y O U R - P E R S O N A L - P R O F I L E</h2><hr />';
	//	echo '<p style="display: inline;"><a href="overview.php" class="myButtonBlu" title="back to the wbs-structured board-sight">WBS/ overview</a> &laquo; </p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 

echo '<table border=2 bordercolor="green" width="100%" class="cssov">'; // start Ansatz div classes in den tablen html-table und unterschiedlichen tablen mit gesetzter td breite classes  
echo'<tr style="line-height: 0.7em;"><td><h3 style="font-size: 1.3em; text-align:center; padding: 0.5em;">a d j u s t  _ A V A T A R  _ &  _  C F L X _  a v a i l a b l e </3></td></tr></table><br>';
// admin-user-header-table end

 //haupttable start
 		// tr 3 start (CFLX-admin-tr)

 //haupttable start
		echo '<table class="profileCSS" width="100%">
		<tr><td>'; 
		
// *** haupttable-DREI start (für misc)
		echo '<table class="profileCat" width="100%">'; 
		//haupt tr 1 start (Avatar, pers. Grunddaten)
			echo '
		<tr>
		<td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">';
			
//
			
//			
													
				if($pers_row[0]['image_type']=="nopic") {
					echo '<div align=center><img name="Photo of ' .$pers_row[0]['fname'].'" src="./images/no-pic130.png" width="300" height="300"></div>';
					echo '<p style="display: inline;"><a href="upload.php" class="myButtonBlu" title="Upload or update a picture of you - will be shown in your postings & your profile-page">Upload new picture</a> &laquo; </p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 
					}
						// insert default pic end
					else {
					// insert usr picture start
					echo '<div align=center><img class="displayed" name="Photo of ' .$pers_row[0]['fname'].'" src="./source.php?id='.$_SESSION['user']['username'].'" width="300" height="300"></div>';
					echo '<p style="display: inline;"><a href="upload.php" class="myButtonBlu" title="Upload or update a picture of you - will be shown in your postings & your profile-page">Upload new picture</a> &laquo; </p>'; // <a class="WBS2link" href="threadview.php?ID='.$strg_id.'">'.$pers_row['topic'].'</a> </p>'; 
 						}
 						// insert pic end
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
			// echo test: ****************************************************************************************************** try outs------------------------
			echo'<h1>session stored data - id: ' .$_SESSION['user']['id'].'</h1>';
			//-------
			foreach($_SESSION as $elements)
{
    foreach($elements as $element) {
        echo $element . '<br />';
    }
}
			//------------
						echo'<h1>some echo' .$pers_row[0]['fname'].'</h1>';
			//$usrsname= ($_SESSION['user']['username']);//, ENT_QUOTES, 'UTF-8');
			$hidid = $_SESSION['user']['id'].md5($_SESSION['user']['id']);
echo '<br><div><font color="red">'.$hidid.'<br>nur die id: '.substr($hidid,0,-32).'

 </font></div>br>';
			//-------------------------------- ********************************************************____________________________________________
			
				echo'</div></td></tr></table>			
					</td>';
	
				echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">';

// start mit html- Username: Avatar <tr> 
echo'

<form action="InsProfileMainData.php" method="post" id="insert">
		<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">YOUR MAIN DATA</span>
		</fieldset>
		
		<table class="contentgrid">	
		
   <tr class="contentgrid">
      <td align="right" style="width:12em;">My first name:</td>
      																																					
      <td><input class="fixed-input" id="fname" name="firstname" type="text" placeholder="Your first name / Surname" value="'.htmlspecialchars($pers_row[0]['fname'], ENT_QUOTES, 'UTF-8').'" size="27" maxlength="60" /></td>
    </tr>
  	<tr class="contentgrid">
      <td align="right" style="width:12em;">My last name: </td>
      <td><input class="fixed-input" id="lname" name="lastname" type="text" placeholder="Your last name / Family Name" value="'.htmlspecialchars($pers_row[0]['lname'], ENT_QUOTES, 'UTF-8').'" size="27" maxlength="60" /></td>
    </tr>
    <tr class="contentgrid">
      <td align="right" style="width:12em;">My phone No.: </td>
      <td><input class="fixed-input" id="phone" name="phone" type="text" placeholder="Your telephone number" value="'.htmlspecialchars($pers_row[0]['phone'], ENT_QUOTES, 'UTF-8').'" size="27" maxlength="60" /></td>
    </tr>
    <tr class="contentgrid">
      <td align="right" style="width:12em;">My time zone: </td>
      <td><input class="fixed-input" id="tzone" name="tzone" type="text" placeholder="Your time zone" value="'.htmlspecialchars($pers_row[0]['tzone'], ENT_QUOTES, 'UTF-8').'" size="27" maxlength="60" /></td>
    </tr>
    <tr class="contentgrid">
      <td align="right" style="width:12em;">My email-address: </td>
      <td><input class="fixed-input" id="email" name="email" type="email" placeholder="'.$pers_row[0]['email'].'"  value="'.$pers_row[0]['email'].'" size="27" maxlength="60" /></td>
    </tr>
  </table>
		
	</fieldset>
		<br>
		<button type="submit" value="change main data">submit changes</button>

</form>';

	echo '						
				
				</td> 
				</tr>';
			//haupt tr1 ende
			
			//haupt tr2 start (thomann riemann, culture of origin, lang skills)
		/*	echo '<tr><td  width="20%" class="wbs2">
			<p class="wbs2txt" >My Preferences &nbsp; </p>
			
				<table border=1 bgcolor="black"><tr><td>';*/
				
//haupt tr2 start (thomann riemann, culture of origin, lang skills)
			echo '<table class="profileCat" width="100%">
			<tr><td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">
													
				<span class="persPicture" width="250" height="250">									
													';					
?>
<!--// insert Thomann-Riemann-JScript-diagramm start-->
<canvas id="ThoRieCanvas" >
    </canvas>
    <script>
        var canvas=document.getElementById("ThoRieCanvas");
canvas.width  = 300;
canvas.height = 300; 
//canvas.style.width  = '300px';
//canvas.style.height = '300px';        
        var context=canvas.getContext("2d");

        function Line(x1,y1,x2,y2){
            this.x1=x1;
            this.y1=y1;
            this.x2=x2;
            this.y2=y2;
        }
        Line.prototype.drawWithArrowheads=function(ctx){

            // arbitrary styling
            ctx.strokeStyle="blue";
            ctx.fillStyle="blue";
            ctx.lineWidth=1;
            
            // draw the line
            ctx.beginPath();
            ctx.moveTo(this.x1,this.y1);
            ctx.lineTo(this.x2,this.y2);
            ctx.stroke();

            // draw the starting arrowhead
            var startRadians=Math.atan((this.y2-this.y1)/(this.x2-this.x1));
            startRadians+=((this.x2>this.x1)?90:-90)*Math.PI/180;
            this.drawArrowhead(ctx,this.x1,this.y1,startRadians);
            // draw the ending arrowhead
            var endRadians=Math.atan((this.y2-this.y1)/(this.x2-this.x1));
            endRadians+=((this.x2>this.x1)?-90:90)*Math.PI/180;
            this.drawArrowhead(ctx,this.x2,this.y2,endRadians);

        }
        Line.prototype.drawArrowhead=function(ctx,x,y,radians){
            ctx.save();
            ctx.beginPath();
            ctx.translate(x,y);
            ctx.rotate(radians);
            ctx.moveTo(0,0);
            ctx.lineTo(5,20);
            ctx.lineTo(-5,20);
            ctx.closePath();
            ctx.restore();
            ctx.fill();
        }

        // create a new line object
        var line=new Line(150,275,150,25);
        // draw the line
        line.drawWithArrowheads(context);
         // create a complete new line object
         Line.prototype.drawWithArrowheads=function(ctxwaag){

            // arbitrary styling
            ctxwaag.strokeStyle="red";
            ctxwaag.fillStyle="red";
            ctxwaag.lineWidth=1;
            
            // draw the line
            ctxwaag.beginPath();
            ctxwaag.moveTo(this.x1,this.y1);
            ctxwaag.lineTo(this.x2,this.y2);
            ctxwaag.stroke();

            // draw the starting arrowhead
            var startRadians=Math.atan((this.y2-this.y1)/(this.x2-this.x1));
            startRadians+=((this.x2>this.x1)?90:90)*Math.PI/180;
            this.drawArrowhead(ctxwaag,this.x1,this.y1,startRadians);
            // draw the ending arrowhead
            var endRadians=Math.atan((this.y2-this.y1)/(this.x2-this.x1));
            endRadians+=((this.x2>this.x1)?90:-90)*Math.PI/180;
            this.drawArrowhead(ctxwaag,this.x2,this.y2,endRadians);

        }
        Line.prototype.drawArrowhead=function(ctxwaag,x,y,radians){
            ctxwaag.save();
            ctxwaag.beginPath();
            ctxwaag.translate(x,y);
            ctxwaag.rotate(radians);
            ctxwaag.moveTo(0,0);
            ctxwaag.lineTo(5,20);
            ctxwaag.lineTo(-5,20);
            ctxwaag.closePath();
            ctxwaag.restore();
            ctxwaag.fill();
        }
          // create a complete new line object
        var waagline=new Line(275,150,25,150);
// draw the waagrechteline
        waagline.drawWithArrowheads(context);
      
// start achsenbeschriftung middle waagrecht        
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(255,91,127,0.3)';
			context.fillText('t     i     m     e', 99, 149);
			
      
// start achsenbeschriftung middle senkrecht  - s p a c e (5x ein buchstabe)      
	// s  
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(74, 109, 234, 0.3)';
			context.fillText('s', 152, 102);	
	// p			
			   context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(74, 109, 234, 0.3)';
			context.fillText('p', 152, 132);		
	// a			  
			   context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(74, 109, 234, 0.3)';
			context.fillText('a', 152, 162);	
	// c			
			   context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(74, 109, 234, 0.3)';
			context.fillText('c', 152, 192);	
	// e			
			   context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(74, 109, 234, 0.3)';
			context.fillText('e', 152, 222);			
		       
        
// start achsenbeschriftung TOP        
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(35, 116, 255, 0.8)';
			context.fillText('CLOSENESS', 100, 15);
// start achsenbeschriftung DOWN        
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'rgba(255, 167, 46, 1)';
			context.fillText('ALOOF', 116, 299);
// start achsenbeschriftung LEFT        
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'green';
			context.fillText('CONSTANCY', 1, 170);		
// start achsenbeschriftung RIGHT        
         context.beginPath();
         context.font = 'italic 14pt Calibri, sans-serif';
         context.fillStyle = 'red';
			context.fillText('CHANGE', 216, 170);									
 
 // start kreuz-insert at position       
 var imageObj = new Image();


var kPosxSuck = <?php echo $pers_row[0]['thorie_risk']; ?>; // waagrecht, konstanz(li bei Minuswerten/ no-risk) wandel(re be pluswerten/ yes-risk)
var kPosySuck = <?php echo $pers_row[0]['thorie_nearness']; ?>; // senkrecht, nähe(obn bei Pluswerten nearness) distanz(untn bei minuswerten nearness)

var kPosx = 150 + (kPosxSuck * 20) - 33; // Korrektur obere linke ecke in den ursprung, 33 pix weiter links
var kPosy = 150 - (kPosySuck * 20) - 30; // Korrektur obere linke ecke in den ursprung, 30px höher  
//
//var kPosxSuck = <?php echo $pers_row[0]['thorie_risk']; ?>;
//var kPosySuck = <?php echo $pers_row[0]['thorie_nearness']; ?>;
//
//var kPosx = (kPosxSuck*120/7 + 120);
//var kPosy = (-kPosySuck*120/7 + 120);

      imageObj.onload = function() {
        context.drawImage(imageObj, kPosx, kPosy);
      };
   	imageObj.src = "./images/kreuz_rot.png";

    </script>
<!--// ThoRie end-->
<?php		
echo'</span>';
 					// insert Thomann-Riemann-JScript-diagramm end

				echo'</td></tr></table>			
					</td>';
	
				echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">

							
<form action="InsProfilePreferences.php" method="post" id="insert">
					
	<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">YOUR PREFERENCES</span>
		</fieldset>
 	
	<table class="contentgrid">
		<tr class="contentgrid">
      <td align="right" style="width:12em;">MyRole:</td>
		<td><textarea class="fixed-input" rows="5" cols="40" id="position" name="position" placeholder="Your position, Your role, Your work-area in this project."  value="'.htmlspecialchars($pers_row[0]['position'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pers_row[0]['position'], ENT_QUOTES, 'UTF-8').'</textarea></td>
    </tr>
  	<tr class="contentgrid">
       <td align="right" style="width:12em;">MySkills: </td>
      <td><textarea class="fixed-input" rows="5" cols="40" id="skills" name="skills" placeholder="Your profession, Your knowledge-base, Your experiences ..."  value="'.htmlspecialchars($pers_row[0]['skills'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pers_row[0]['skills'], ENT_QUOTES, 'UTF-8').'</textarea></td>
    </tr>
     <tr class="contentgrid">
       <td align="right" style="width:12em;">MyNearness: </td>
      	<td><span style="color:blue"> 
     <input class="fixed-inputGREEN" id="nearness" name="nearness" type="text" placeholder="Your nearness preference"  value="'.htmlspecialchars($pers_row[0]['thorie_nearness'], ENT_QUOTES, 'UTF-8').'" size="3" maxlength="3" />
      	</span></td>
    </tr>
    <tr class="contentgrid">
     	
       <td align="right" style="width:12em;">MyRisk: </td> 
       	<td><span style="color:red"> 
    <input class="fixed-inputRED" id="risk" name="risk" type="text" placeholder="Your risk aversion"  value="'.htmlspecialchars($pers_row[0]['thorie_risk'], ENT_QUOTES, 'UTF-8').'" size="3" maxlength="3" />
      	 </span></td>
    </tr>
	<tr class="contentgrid">
      <td align="right" style="width:12em;">MyComment: </td>
      <td><textarea class="fixed-input" rows="3" cols="40" id="comment" name="comment" placeholder="No Stereotypes, but myCulture, myPassion, myPreferences"  value="'.htmlspecialchars($pers_row[0]['comment'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pers_row[0]['comment'], ENT_QUOTES, 'UTF-8').'</textarea></td>
    </tr>
  
  </table>
		
		<br>
		<button type="submit" value="change main data">submit changes</button>

</form>


							
				
				</td> 
				</tr>';
			//haupt tr2 ende


// **********einschub neo-style start part1 *****		
// *** haupttable-DREI start (für misc)
		echo '<table class="profileCat" width="100%">'; 
		//haupt tr 1 start (Avatar, pers. Grunddaten)
			echo '
		<tr>
		<td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">';
						// insert default- picture if image_type = nopic start
				if($pers_row[0]['image_type2']=="nopic") {
					echo '<div align=center><img name="Photo of ' .htmlspecialchars($pers_row[0]['fname'], ENT_QUOTES, 'UTF-8').'" src="./images/misc_initial2beexchanged2.jpg" width="300" height="300"></div>';
					echo '<p style="display: inline;"><a href="upload2.php" class="myButtonBlu" title="Upload or update a picture shown in your profile (private or project related)">Upload new picture</a> &laquo; </p>';  
					}
						// insert default pic end
					else {
					// insert usr picture start
					echo '<div align=center><img name="Photo of ' .htmlspecialchars($pers_row[0]['fname'], ENT_QUOTES, 'UTF-8').'" src="./myImage2.php?ID='.$pers_row[0]['id'].'" width="300" height="300"></div>';
					echo '<p style="display: inline;"><a href="upload2.php" class="myButtonBlu" title="Everything changes. You can update this picture from time to time...">Upload new picture</a> &laquo; </p>';  
 						}
 						 

				echo'</td></tr></table>			
					</td>';
 

	
				echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">';

// start mit html- Username: Avatar <tr> 
echo'

<form action="InsMiscData.php" method="post" id="insert">
							
	<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">MISCELLANEOUS  about ' .htmlspecialchars($pers_row[0]['fname'], ENT_QUOTES, 'UTF-8').' ' .htmlspecialchars($pers_row[0]['lname'], ENT_QUOTES, 'UTF-8').'</span>
		</fieldset>
		
		<table class="contentgrid">
  	
   <tr class="contentgrid">
      <td align="right" style="width:12em;">MyLinklist:</td>
      <td><textarea class="fixed-input" rows="10" cols="40" id="linklist" name="linklist" placeholder="'.htmlspecialchars($pers_row[0]['linklist'], ENT_QUOTES, 'UTF-8').'"  value="'.htmlspecialchars($pers_row[0]['linklist'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pers_row[0]['linklist'], ENT_QUOTES, 'UTF-8').'</textarea></td>
    </tr>
 	<tr class="contentgrid">
      <td align="right" style="width:12em;">MyInterests:</td>
      <td><textarea class="fixed-input" rows="10" cols="40" id="interestedin" name="interestedin" placeholder="'.htmlspecialchars($pers_row[0]['interestedin'], ENT_QUOTES, 'UTF-8').$pers_row[0]['interestedin'].'"  value="'.htmlspecialchars($pers_row[0]['interestedin'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pers_row[0]['interestedin'], ENT_QUOTES, 'UTF-8').'</textarea></td>
    </tr>
    
	
  
  </table>
		
	</fieldset>
		<br>
		<button type="submit" value="change main data">submit changes</button>

</form>';

	echo '						
				
				</td> 
				</tr>';
	
	// ***
	echo'</table><table>';
	// ***			
		 
// *** haupttable-ZWEI ende (für pers & misc)
		echo '</table>'; 
 
// *** haupttable-ZWEI start (für CFLX)
		echo '<table border=0 width="100%">'; 			
			echo '<tr>';	

	
				echo'	<td class="profilewbs2" align="left" style="padding-left:0px;"><br>
						<table border=0 class="persProfiletxt">';


?>
<tr> 
<div id="adminCFLX"></div>
<div id="cflxreturn"></div>
<div id="del"></div>
<form action="InsPersCFLX.php" method="post" id="adminCFLX">
	<fieldset>
		<b>&nbsp; &nbsp; &nbsp; YOUR CFLX STORAGE  :: administration of your CFLX statements</b>
		
	<table border="0" cellpadding="2" cellspacing="4">
		
		<tr>
		<!--status statement start-->
		
		<td style="border:1px; border-style: solid solid none solid; border-color:#cccccc;"><table cellpadding="4" cellspacing="4">
		
    <tr align="center">Status Statements
   <hr>
  </tr>
  <tr>
      <td align="right">available: </td>
    <td style="width:22em;"> 
  		 <nav>
 	    <ul>
			<li class = "flagStat">
       	<a href="#del">Status Statements</a>
        <ul>  
				<?php
				require_once("./PDO/connex.php");

					//START: echo-Schleife für QR's <li> Link
					require_once'./jsPHP/js_LiLinkst.php';
					require_once'./jsPHP/admin_js_takest.php';
				?>                    
         </ul>
      	</li>
    		</nav>           
		  </td>   </tr>
		   <tr>
      <td align="right">selected: </td>
      <td><h3 id="stCFLGstatement" class = "adminflagSt"></h3></td>
    </tr> 
    <tr><td></td>    	<td><a href="#del" class="myButton" id="del_statstat_btn">DELETE IT!</a>  </td>
  	 </tr>

<script>
// neo2 ajax start / by threadview :: qr

 $(document).ready(function() {
			 $('#del_statstat_btn').click(function(){   
					
  var cflxselectvarst = document.getElementById("stCFLGstatement").innerHTML;	// was  ausgewählt wurde & im h3 tag steht
    $.ajax({

                type: "POST",
      
                url: "./CFLXupdate_NULL_st.php",																																					 
                data: {delst:cflxselectvarst},																																								   	 
                
                 success:function(data){
                             
      										window.location.reload(true);
      								
                                 }

            }); // Ajax Call
				           
           
        }); //event handler .click function ({
        	
    }); //document.ready
 
 

</script>   

   
	
   <tr>
      <td align="right">add new: </td><!--required autofocus value="Expand YOUR portfolio here."-->
      <td><input class="fixed-input" id="newstat" name="newstat" type="text" placeholder="Expand YOUR Status Statements"  size="28" maxlength="166" /></td>
   </tr>
  	
  	<tr>
  		<td></td>
  		<td><button type="submit" value="addcflx">add to database</button>
   	</td>
   </tr>


    </table></td>
   
		
	<!--	// question repeat start-->
	<td style="border:1px; border-style: solid solid none none; border-color:#cccccc;"><table cellpadding="4" cellspacing="4">
		
    <tr align="center">Question Repeats
   <hr>
  </tr>
  <tr>
      <td align="right">available: </td>
    <td style="width:22em;"> 
  		 <nav>
 	    <ul>
			<li class = "flagQR">
       	<a href="#del">Question Repeats</a>
        <ul>  
				<?php
				require_once("./PDO/connex.php");

					//START: echo-Schleife für QR's <li> Link
					require_once'./jsPHP/js_LiLinkqr.php';
					require_once'./jsPHP/admin_js_takeqr.php';
				?>                    
         </ul>
      	</li>
    		</nav>           
		  </td>   </tr>
		   <tr>
      <td align="right">selected: </td>
      <td><h3 id="qrCFLGstatement" class = "adminflagQR"></h3></td>
    </tr> 
    <tr><td></td>    	<td><a href="#del" class="myButton" id="del_qr_btn">DELETE IT!</a>  </td>
  	 </tr>

<script>
// neo2 ajax start / by threadview :: qr

 $(document).ready(function() {
			 $('#del_qr_btn').click(function(){   
					
  var cflxselectvarqr = document.getElementById("qrCFLGstatement").innerHTML;	 
    $.ajax({

                type: "POST",
      
                url: "./CFLXupdate_NULL_qr.php",																																							 
                data: {delqr:cflxselectvarqr},																																								   	 
                
                 success:function(data){
                             
      										window.location.reload(true);
      								
                                 }

            }); // Ajax Call
				           
           
        }); //event handler .click function ({
        	
    }); //document.ready
  

</script>   

   
	
   <tr>
      <td align="right">add new: </td><!--required autofocus value="Expand YOUR portfolio here."-->
      <td><input class="fixed-input" id="newqr" name="newqr" type="text" placeholder="Expand YOUR Question Repeats"  size="28" maxlength="166" /></td>
   </tr>
  	
  	<tr>
  		<td></td>
  		<td><button type="submit" value="addcflx">add to database</button>
   	</td>
   </tr>


    </table></td>
    
    
   	<td style="border:1px; border-style: solid solid none none; border-color:#cccccc;"><table cellpadding="4" cellspacing="4">
	 <tr align="center">I-Messages
   <hr>
  </tr>
  <tr>
      <td align="right">available: </td>
     <td style="width:22em;"> 
  		 <nav>
 	    <ul>
			<li class = "flagIM">
       	<a href="#del">I-Messages</a>
        <ul>  
				<?php 
				require_once("./PDO/connex.php");

					//START: echo-Schleife für den Appell <li> Link
					require_once'./jsPHP/js_LiLinkim.php';
					require_once'./jsPHP/admin_js_takeim.php';
				?>                    
         </ul>
      	</li>
    		</nav>           
		  </td>   </tr>
 	  
		   <tr>
      <td align="right">selected: </td>
      <td><h3 id="imCFLGstatement" class = "adminflagIM"></h3></td>
    </tr>
    <tr><td></td>    	<td><a href="#del" class="myButton" id="del_im_btn">DELETE IT!</a>  </td>
  	 </tr>

<script>
// neo2 ajax start / by threadview :: qr

 $(document).ready(function() {
			 $('#del_im_btn').click(function(){   
					
  var cflxselectvarim = document.getElementById("imCFLGstatement").innerHTML;	 
 

            $.ajax({

                type: "POST",
      
               url: "./CFLXupdate_NULL_im.php",		
                data: {delim:cflxselectvarim},																																											   
              
                 success:function(data){
                              
      										window.location.reload(true);
      									 
                                 }

            }); // Ajax Call
				// trigger reload via click-function:             
           // window.location.reload();
        }); //event handler .click function ({
        	
    }); //document.ready
  

</script>   

   
   <tr>
      <td align="right">add new: </td><!--required autofocus value="Expand YOUR portfolio here."-->
      <td><input class="fixed-input" id="newim" name="newim" type="text" placeholder="Expand YOUR I-Messages" size="22" maxlength="166" /></td>
   </tr>
  	
  	<tr>
  		<td></td>
  		<td><button type="submit" value="addcflx">add to database</button>
   	</td>
   </tr>

    
    </table></td>
    
    
    	<td style="border:1px; border-style: solid solid none none; border-color:#cccccc;"><table cellpadding="4" cellspacing="4">
		
   <tr align="center">Appeals
   <hr>
  </tr>
  <tr>
      <td align="right">available: </td>
    <td style="width:22em;"> 
  		 <nav>
 	    <ul>
			<li class = "flagAP">
       	<a href="#del">Appeals</a>
        <ul>  
				<?php
					require_once("./PDO/connex.php");

					//START: echo-Schleife für den Appell <li> Link
					require_once'./jsPHP/js_LiLinkap.php';
					require_once'./jsPHP/admin_js_takeap.php';
				?>                    
         </ul>
      	</li>
    		</nav>           
		  </td>   </tr>
		   <tr>
      <td align="right">selected: </td>
      <td><h3 id="apCFLGstatement" class = "adminflagAP"></h3></td>
    </tr>
    <tr><td></td>    	<td><a href="#del" class="myButton" id="del_ap_btn">DELETE IT!</a>  </td>
  	 </tr>

<script> 
 $(document).ready(function() {
			 $('#del_ap_btn').click(function(){   
					
  var cflxselectvarap = document.getElementById("apCFLGstatement").innerHTML;	 
 
            $.ajax({

                type: "POST",
      
               url: "./CFLXupdate_NULL_ap.php",																																						 
                																																					   	 
                	  data: {delap:cflxselectvarap},																																										    								
                
                success:function(data){
                               
      										window.location.reload(true);
										
      									
                                 }

            }); // Ajax Call
				// trigger reload via click-function:             
           // window.location.reload();
        }); //event handler .click function ({
        	
    }); //document.ready
  

</script>   

   
	
   <tr>
      <td align="right">add new: </td> <!--required autofocus value="Expand YOUR portfolio here."-->
      <td><input class="fixed-input" id="newap" name="newap" type="text" placeholder="Expand YOUR Appeals" size="20" maxlength="166" /></td>
   </tr>
  	
  	<tr>
  		<td></td>
  		<td><button type="submit" value="addcflx">add to database</button>
   	</td>
   </tr>

    
    </table></td>
    
    </tr>
  </table>
		
	</fieldset>
	

	
					
				
				</td> 
				</tr>
				</table>

</table>
</td></tr>
</table>
	