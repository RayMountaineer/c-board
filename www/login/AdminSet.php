<?php
session_start();

	$TotalURI = $_SERVER['REQUEST_URI']; 
	$domainURI = substr($TotalURI, 0, -13); 
?><!DOCTYPE html>
<head>
	<meta charset="UTF-8" /> 
	
<meta name="viewport" content="width=device-width, initial-scale=0.5"> 
        <link rel="stylesheet" href="https://www.c-board.de/index/CSS/style2.css" type="text/css" media="screen" />

<link rel="shortcut icon" type="image/ico" href="https://c-board.de/start/images/favicon.ico"> 
</head>
<?php

    // First we execute our common code to connection to the database and start the session
    require("../PDO/connex.php");
    
    if(!empty($_POST))
    {
        if(empty($_POST['FormPostVal']))
        {
            die("Please, retry from your C-BOARD slot!");
        }
       
      //  echo 'slot via post sent (test): '.$_POST['FormPostVal'];
     
		      $generaladminid = 1;  // 1 = first user who registers
		      $adminid = 11;
				$insert11 = "UPDATE reg
				SET permission = :permission

				WHERE id = :firstid";
 				$stmt = $pdo->prepare($insert11);
				$stmt->bindParam(':firstid',$generaladminid); 
				$stmt->bindParam(':permission',$adminid);
				$stmt->execute();
				
				header ("Location: ./login.php"); 
        }
   
     
 
    
?>



    <div id="mainform" style="margin-top:9em;">
  <div id="divform">
 
    <form  action="AdminSet.php" class="form" id="form1" name="entryForm" method="post" >
        <legend class="legend">MANUALLY SET ADMIN-PERMISSION</legend>
		 
     
<?php echo'	<input type="hidden" name="FormPostVal" id="FormPostVal" value="'.$domainURI.'" />';?>
      
   <div class="ENTERbtn">
		<button id="btnBlue">Grant Admin Privileges</button> 
        <div class="btnTrans"></div>
      </div>      
   
<p style="color: orangered;">
Please, also check your C-BOARD's email notification settings!<br>
go to:<br>
 <a href="<?php echo $domainURI.'/MailerTest.php'; ?>"><?php echo $domainURI.'/MailerTest.php'; ?></a> 
 <br>
enter your "user-number-one" credentials (usr-name and password) <br>
and check/ modify your email-provider settings!<br>
 (more info at the README.txt in your OpenC-BOARD.zip package)
 

</p>		

     
      
    </form>
  </div>
  </div>




