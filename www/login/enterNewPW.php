<head><link rel="stylesheet" href="registerCSS.css" type="text/css" media="screen" /></head>
<?php
  
    require_once("../PDO/connex.php");
     
    if(!empty($_POST))
    { 
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
        
         
        $row = $stmt->fetch();
         
        if($row)
        {
            die("this username is allready in use!");
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
         
        
        $row = $stmt->fetch();
        
        if($row)
        {
            die("This e-mail address is already in use!");
        }
        
       
         
    $qrdef1 = "This is a question!";
    $imdef1 = "I really appreciate your approach!";
    $apdef1 = "I really need an answer - asap, please!";   
    
         
    $qrdef2 = "You were asking,";
    $imdef2 = "I have hardly no time (for that) yet!";
    $apdef2 = "please apologize!";   
    
          
    $qrdef3 = "I did not understand the question";
    $imdef3 = "I am not convinced yet!";
    $apdef3 = "please clarify!";   
    
          
    $qrdef4 = "Information about the status of";
    $imdef4 = "I am happy about this";
    $apdef4 = "please, share us a bit more information!";   
        
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
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_regparams);
        
        }
              
   $cflxiniquery = "
            INSERT INTO cflags (
                username,
                qr,
                im,
                ap 
            ) VALUES (
                :username,
               
                :qr,
                :im,
                :ap 
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
            ':ap' => $apdef1 
        );
			 $query_params2 = array(
            ':username' => $_POST['username'],
          
            ':qr' => $qrdef2,
            ':im' => $imdef2,
            ':ap' => $apdef2 
        );        
        	 $query_params3 = array(
            ':username' => $_POST['username'],
           
            ':qr' => $qrdef3,
            ':im' => $imdef3,
            ':ap' => $apdef3 
        );    
        	 $query_params4 = array(
            ':username' => $_POST['username'],
           
            ':qr' => $qrdef4,
            ':im' => $imdef4,
            ':ap' => $apdef4 
        );     
        try
        {
            // Execute the query to create the user
            $stmt = $pdo->prepare($cflxiniquery);
            $result = $stmt->execute($query_params);
            $result = $stmt->execute($query_params2);
            $result = $stmt->execute($query_params3);
            $result = $stmt->execute($query_params4);
        }
              
        
// Einschub usersprofile stuff (take id -> use id 4 new profile) start     



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
                       
        header("Location: login.php");
         
        die("Redirecting to login.php");
    }
 
    
?>



<form action="register.php" method="post" id="login">
	<fieldset>
		<legend>REGISTER</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right">Username:</td>
      <td><input id="username" name="username" type="text" placeholder="Your username" required autofocus value="" size="30" maxlength="50" /></td>
    </tr>
	 <tr>
      <td align="right">E-Mail:</td>
      <td><input id="email" name="email" type="text" placeholder="Your email address " required value="" size="30" maxlength="50" /></td>
    </tr>   
    <tr>
      <td align="right">Password:</td>
      <td><input id="password" name="password" type="password" placeholder="A password for logging-in" required value="" size="30" maxlength="50" /></td>
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
		<button type="submit" value="Register">REGISTER</button>
		<br>
		
	</fieldset>
</form>


