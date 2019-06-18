<?php
session_start(); 

// if method POST was executed, start data inserts and sending case-dependend email (normal user mail or admin mail)
    if(!empty($_POST))
    {
		require_once "../PDO/connex.php";
		// all in one flush:
		ob_start();
        if(empty($_POST['username']))
        {
            die("Please, insert your user-name");
        }
        
        if(empty($_POST['password']))
        {
            die("Your password for login is needed");
        }
        
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("e-mail address not valid");
        }
        
        $query = "
            SELECT
                1
            FROM reg
            WHERE
                username = :username
        ";
        
        $query_params = array(
            ':username' => $_POST['username']
        );
        
        try
        {
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed: could not connect" );
        }
        
        $row = $stmt->fetch();
        
                
        $UserNameExists ="<h2>THIS USER NAME ALREADY EXISTS</h2>
        <div id=\"mainform\">
  			<div id=\"divform\">
 
			    <form  action=\"./register.php\" class=\"form\" id=\"form1\" name=\"entryForm\" method=\"post\" style=\"margin-top:9em;\" >
			           
			        
					<fieldset>
					<legend style=\"color: rgb(240, 126, 126);\">THIS USER NAME ALREADY EXISTS</legend>
					
					
					 <table border=\"0\" cellpadding=\"0\" cellspacing=\"4\">
			    	  
			    	<tr>
			    	<td style=\"color: rgb(255, 231, 128);\" align=\"left\">
			    	Please, try again and use a different username (click REGISTER).<br><br>
							If you are already registered to this project,<br>
							please navigate to the login-terminal via clicking LOGIN.<br><br>
							At the login-terminal you can apply for a NEW PASSWORD, if needed.<br>
							<br></td>
			    	</tr>
			    	<tr>
			    		<td>
								    
			   			<div class=\"btnGreen\">
								<button id=\"btnGreen\">REGISTER</button> 
			        			<div class=\"btnTrans\"></div>
			      		</div>   					    
						
				 		</td>
			    	</tr>	
			  		
				
			
			</form>		
				
				    <form  action=\"./login.php\" class=\"form\" id=\"form1\" name=\"entryForm\" method=\"post\" style=\"margin-top:9em;\" >
				           
				        
					
						<tr>
						<td>				    
				   			<div class=\"ENTERbtn\">
									<button id=\"btnBlue\">LOGIN</button> 
				        			<div class=\"btnTrans\"></div>
				      		</div>      
						
				      
				      
				    		</td>
				    	</tr>	
				  	 </table>
						
					</fieldset>
					
				
				</form>
			</div>
			</div>
			";
        if($row)
        {
            die($UserNameExists);
        }
        
        $query = "
            SELECT
                1
            FROM reg
            WHERE
                email = :email
        ";
        
        $query_params = array(
            ':email' => $_POST['email']
        );
        
        try
        {
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed: could not connect");
        }
        
        $row = $stmt->fetch();
        
        if($row)
			{
			 	$emailExistsalready = '<div style="color: aliceblue; font-size: 1.5em;">This email already exists. Login with this email: <a href="./login.php"> click!</a></div>';
          	$emailRetry = '<br><br><div style="font-size: 1.5em; color: aquamarine; background-color: black;">Or retry with another email: <a href="./register.php"> re-try</a></div>';
           
            die("Nope!". $emailExistsalready . $emailRetry);
           
        }
        
       
    $qrdef1 = "This is a question!";
    $imdef1 = "I really appreciate your approach!";
    $apdef1 = "I really need an answer - asap, please!";  
    $statstatdef1 = "Status is all fine. Scope of work will be delivered on time"; 
    
         
    $qrdef2 = "You were asking,";
    $imdef2 = "I have hardly no time (for that) yet!";
    $apdef2 = "please apologize!";  
    $statstatdef2 = "unforeseeable challenges might occur ";  
    
          
    $qrdef3 = "I did not understand the question";
    $imdef3 = "I am not convinced yet!";
    $apdef3 = "please clarify!"; 
    $statstatdef3 = "the actual approach is likely to fail";   
    
          
    $qrdef4 = "Information about the status of";
    $imdef4 = "I am happy about this";
    $apdef4 = "please, share us a bit more information!";  
    $statstatdef4 = "some work is idle due to the fact of undelivered dependencies	";  
     
   $query = "
            INSERT INTO reg (
                username,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";      
        
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        
        $password = hash('sha256', $_POST['password'] . $salt);
        
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
        
        $query_regparams = array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
			
        try
        {
            // Execute the query to create the user
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_regparams);
        
        }
        catch(PDOException $ex)
        {
            die("Failed: could not connect ");
        }    
// EINSCHUB: insert default values in cflags table        
   $cflxiniquery = "
           INSERT INTO cflags (
                username,
                qr,
                im,
                ap,
                statstat 
            ) VALUES (
                :username,
                :qr,
                :im,
                :ap,
                :statstat 
            )
        ";     
        
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        
        $password = hash('sha256', $_POST['password'] . $salt);
        
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
       $query_params = array(
            ':username' => $_POST['username'],
          
            ':qr' => $qrdef1,
            ':im' => $imdef1,
            ':ap' => $apdef1,
              ':statstat' => $statstatdef1 
        );
			 $query_params2 = array(
            ':username' => $_POST['username'],
          
            ':qr' => $qrdef2,
            ':im' => $imdef2,
            ':ap' => $apdef2,
             ':statstat' => $statstatdef2 
        );        
        	 $query_params3 = array(
            ':username' => $_POST['username'],
           
            ':qr' => $qrdef3,
            ':im' => $imdef3,
            ':ap' => $apdef3,
             ':statstat' => $statstatdef3 
        );    
        	 $query_params4 = array(
            ':username' => $_POST['username'],
           
            ':qr' => $qrdef4,
            ':im' => $imdef4,
            ':ap' => $apdef4,
             ':statstat' => $statstatdef4 
        );     
        try
        {
            $stmt = $pdo->prepare($cflxiniquery);
            $result = $stmt->execute($query_params);
            $result = $stmt->execute($query_params2);
            $result = $stmt->execute($query_params3);
            $result = $stmt->execute($query_params4);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query");
        }        
        

$usernamej = $_POST['username'];
$profil=$pdo->prepare('SELECT * FROM reg WHERE username = :username');
$profil->bindParam(":username",$usernamej);

$profil->execute();


$userid = $profil->fetch();
             
   $insquery = "
            INSERT INTO usrsprofiles (
                
                id,
                username,
                email
                
               
            ) VALUES (
            	:id,
               :username,
               :email
                
            )
        ";  
  $insquery_params = array(
            ':id' =>  $userid['id'],
            ':username' => $_POST['username'],
             ':email' => $_POST['email']
           
        );
 try
        {
            // Execute the query to create the user
            $insstmt = $pdo->prepare($insquery);
            $result = $insstmt->execute($insquery_params);
         }
        catch(PDOException $ex)
        {
            die("Failed to run query");
        }                
        if ($userid['id'] == 1) // 1 = first user who registers
        {
		      $generaladminid = 1;  // 1 = first user who registers
		      $adminid = 11;
				$insert11 = "UPDATE reg
				SET permission = :permission

				WHERE id = :firstid";
 				$stmt = $pdo->prepare($insert11);
				$stmt->bindParam(':firstid',$generaladminid); 
				$stmt->bindParam(':permission',$adminid);
				$stmt->execute();
        }
        
 // start: ALTER table wbs - um neuen user in die spalte zu ergänzen (neue spaltenkopf = $userid['id'])
 		$newUsrID = $userid['id'];
 	//	$newUsr4wbs = ("ALTER TABLE wbs ADD $newUsrID INT(5) after usrsID");
 		$pdoInsNewUsr = $pdo->prepare("ALTER TABLE wbs ADD `$newUsrID` INT(5) NOT NULL DEFAULT 1 after usrsID");
 		$pdoInsNewUsr->execute();
 	
		$newUsersName =	$_POST['username'];
      //    usrs email-address: 		
      $newUsersEmail = $_POST['email'];
   
	$TotalProjSlot = $_SERVER['REQUEST_URI']; // = kompletter URL. nxt: substrahiere /login/login.php
	$newToProjSlot = substr($TotalProjSlot, 1, -19);  // gibt: /slotVerzeichnis/ zurück;(/login/register.php = 19 Zeichen)

		
		$subject = "C-BOARD SIGN-UP-INFO for a new project";
		$IDofnewSlot = substr($newToProjSlot, 1, -6);
		
// 2) query for email-address of user number 1 - for sending notification of newly registered user:
   	 
		$adminsid = 1;
		$q_mail=$pdo->prepare('SELECT id,username,email FROM reg WHERE id = :adminsid');
		$q_mail->bindParam(":adminsid",$adminsid);
		$q_mail->execute();
		$adminsEmail = $q_mail->fetch();
		// echo '$adminsEmail: '. $adminsEmail['email'];
		$AdminsMail = $adminsEmail['email'];
  		$AdminsUsername = $adminsEmail['username'];
		
 require_once('./PHPmailer_USRregNotify.php');// kompletter buffer, schickt headers -> weiterleitung  
    
	 ob_end_flush(); // exec buffered here all in once 
	 }     
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8" /> 
	
<meta name="viewport" content="width=device-width, initial-scale=0.5"> 
        <link rel="stylesheet" href="https://www.c-board.de/index/CSS/style2.css" type="text/css" media="screen" />

<link rel="shortcut icon" type="image/ico" href="https://c-board.de/start/images/favicon.ico"> 
</head> 


    <div id="mainform" style="margin-top:9em;">
  <div id="divform">
 
    <form  action="register.php" class="form" id="form1" name="entryForm" method="post" >
        <legend class="legend">SIGN me UP for THIS project!</legend>
		 
     
      
      <p>
        <input name="username" type="text" required maxlength="66" class="usrtxt-input" placeholder="Your name" id="name" />
      </p>
		
      <p>					
        <input name="email" type="text" required maxlength="66" class="usrtxt-input" placeholder="Your email" id="email" />
      </p>
   
      <p>
        <input name="password" type="password" required maxlength="24" class="usrtxt-input" placeholder="Password" id="pass" />
      </p>
      
   <div class="ENTERbtn">
		<button id="btnBlue">REGISTER</button> 
        <div class="btnTrans"></div>
      </div>      
		
   
      
    </form>
  </div>
  </div>




