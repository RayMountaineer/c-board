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
<title>C-BOARD: personal profile -> give trust, earn trust</title>

		<link rel="stylesheet" href="CSS/standard.css" type="text/css" /> <!--mit userprofileclass-->
		<link rel="stylesheet" href="CSS/wbslayout.css" type="text/css" />
	   <link rel="stylesheet" href="CSS/styles.css">
      <link rel="stylesheet" href="CSS/button.css">
            <link rel="stylesheet" href="CSS/inputs.css">
 	<?php
	 $name4profile = filter_input(INPUT_GET, "nm", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    require_once("./PDO/connex.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: ./login/login.php");
        // Remember that this "die"-statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to ./login/login.php");
    }
    
   
	$usrsname= htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
$query4prof = "select * from usrsprofiles WHERE username = ?";
$q4prof = $pdo->prepare( $query4prof );
$q4prof->bindParam(1, $name4profile); 
$q4prof->execute();
$profileArray = $q4prof->fetch(PDO::FETCH_ASSOC);	
?>
		
</head>
<body bgcolor="grey">
<?php
	
	echo '<h2 align="left">..:: <font color="darkred"> '.$name4profile.'`s </font> Profile ::.. </h2>';
		echo '<div style="text-align:right;"><a href="overview.php" class="myButtonBlu" title="back to the wbs-structured board-sight">WBS/ overview</a> </div>
  		'; 
 //haupttable start
		echo '<table class="profileCSS" width="100%">
<tr>
<td><table class="profileCat" width="100%">

		<tr>
		<td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">';
												if($profileArray['image_type']=="nopic") {
					echo'<img src="./images/no-pic130.png"  width="300" height="300"></img>';
					}
						// insert default pic end
					else {
						echo'<img src="source.php?id='.$profileArray['username'].'" width="300" height="300"></img>';	
							}		
												echo'	
													</td></tr>
													</table>			
										
									</td>		'; 
			
	
				echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">
  				<tr>
					<td>';

// start mit html- Username: Avatar <tr> 
echo'
	
		<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">MAIN DATA of ' .$profileArray['fname'].' ' .$profileArray['lname'].'</span>
		</fieldset>
		
		<table class="contentgrid">	
		
   <tr class="contentgrid">
      <td align="right" style="width:12em;">First name:</td>
      <td class="profileData">'.$profileArray['fname'].'</td>
   </tr>
  	<tr class="contentgrid">
      <td align="right" style="width:12em;">Last name: </td>
      <td class="profileData">'.$profileArray['lname'].'</td>
   </tr>
   <tr class="contentgrid">
      <td align="right" style="width:12em;">Phone No.: </td>
      <td class="profileData">'.$profileArray['phone'].'</td>
   </tr>
   <tr class="contentgrid">
     <td align="right" style="width:12em;">In time zone: </td>
     <td class="profileData">'.$profileArray['tzone'].'</td>
   </tr>
   <tr class="contentgrid">
      <td align="right" style="width:12em;">Email-Address: </td>
      <td class="profileData">'.$profileArray['email'].'</td>
   </tr>	
  
  </table>';

	echo '						
			</td> 
				</tr>
			
	 </table>
 			</td>	
 		<!--	Ende Main Data Cell--> 
 		</tr>';	
 	/*	<!--	Ende MAIN data row-->	
	</table>		 
 	<!--ENDE Cat MAIN table-->				 



</td>
</tr>';*/
		
			//haupt tr2 start (thomann riemann, culture of origin, lang skills)
			echo '<table class="profileCat" width="100%">
			<tr><td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">';			
													
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


var kPosxSuck = <?php echo $profileArray['thorie_risk']; ?>; // waagrecht, konstanz(li bei Minuswerten/ no-risk) wandel(re be pluswerten/ yes-risk)
var kPosySuck = <?php echo $profileArray['thorie_nearness']; ?>; // senkrecht, nähe(obn bei Pluswerten nearness) distanz(untn bei minuswerten nearness)

var kPosx = 150 + (kPosxSuck * 20) - 33; // Korrektur obere linke ecke in den ursprung, 33 pix weiter links
var kPosy = 150 - (kPosySuck * 20) - 30; // Korrektur obere linke ecke in den ursprung, 30px höher  


      imageObj.onload = function() {
        context.drawImage(imageObj, kPosx, kPosy);
      };
   	imageObj.src = "./images/kreuz_rot.png";

    </script>
<?php

				echo'</td></tr></table>			
					</td>';
	
	echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">
  				<tr>
					<td>
					
	<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">PREFERENCES of ' .$profileArray['fname'].' ' .$profileArray['lname'].'</span>
		</fieldset>
		 	
		<table class="contentgrid">
		 <tr class="contentgrid">
      <td align="right" style="width:12em;">Role:</td>
      <td class="profileData">'.$profileArray['position'].'</td>
   </tr>
  	<tr class="contentgrid">
      <td align="right" style="width:12em;">Skills: </td>
      <td class="profileData">'.$profileArray['skills'].'</td>
   </tr>
   <tr class="contentgrid">
      <td align="right" style="width:12em;">Nearness: </td>
      <td class="profileDataBlue"><span style="color:blue">'.$profileArray['thorie_nearness'].'</span></td>
   </tr>
   <tr class="contentgrid">
     <td align="right" style="width:12em;">Risk: </td>
     <td class="profileDataRed"><span style="color:red">'.$profileArray['thorie_risk'].'</span></td>
   </tr>
   <tr class="contentgrid">
      <td align="right" style="width:12em;">Statement Notes: </td>
      <td class="profileData">'.$profileArray['comment'].'</td>
   </tr>
  </table>		
	</td>  <!--usermaindata datatabe end-->
 				 </tr>
 				 </table>
 			</td>	
 		<!--	Ende Main Data Cell--> 
 		</tr>	
 		<!--	Ende MAIN data row-->	
	</table>		 
 	<!--ENDE Cat MAIN table-->				 



</td>
</tr>';
// CAT 2 preferences ende

echo'<tr>
<td>
<!--  //Category-table start (MAIN, PERS, MISC)-->
<table class="profileCat" width="100%">

		<tr> <!--Cat MAIN ROW-->
			<!--Avatar-Cell: <td>  <tr><td>NAME</td></tr> <tr><td>MISC-PIC</td></tr>   </td> -->	
									<td  width="23%" class="profilewbs2">	
										
													<table class="profilePics">
													<tr><td class="profilePics">';	



			//haupt tr3 start MISC.
		
 
$urlencodedPName = urlencode($profileArray['username']);
				if($profileArray['image_type2']=="nopic") {
					echo'<img src="./images/misc_initial2beshown2.jpg"  width="300" height="300"></img>';
						}
						// insert default pic end						
					else {
						  echo '<img name="Photo of ' .$profileArray['fname'].'" src="./source2.php?id='.$urlencodedPName.'" width="300" height="300"></img>';
						}
//
			 
				echo'</td></tr></table>			
					</td>';
	
				echo'	<td class="profilewbs2" align="left">
						<table border=0 class="persProfiletxt">
  				<tr>
					<td>
							
	<fieldset style="padding:5px;margin:25px;">
			<span style="font-weight: 800; margin:11px; color: #666;font: 116% Arial, Helvetica, sans-serif;">MISCELLANEOUS  about ' .$profileArray['fname'].' ' .$profileArray['lname'].'</span>
		</fieldset>
		
		<table class="contentgrid">
  	
   <tr class="contentgrid">
      <td align="right" style="width:12em;">MyLinks:</td>
      <td class="profileData">'.$profileArray['linklist'].'</td>
   </tr>
     <tr class="contentgrid">
      <td align="right" style="width:12em;">MyPassion:</td>
      <td class="profileData">'.$profileArray['interestedin'].'</td>
   </tr>
   
  
  </table>		

			</td>  <!--usermaindata datatabe end-->
 				 </tr>
 				 </table>
 			</td>	
 		<!--	Ende Main Data Cell--> 
 		</tr>	
 		<!--	Ende MAIN data row-->	
	</table>		 
 	<!--ENDE Cat MAIN table-->				 



</td>
</tr>
		</table>
</body>
</html>		
		';
	//haupttable ende

