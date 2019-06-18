<?php
session_start();
  

    require_once("../PDO/connex.php");
    
    $submitted_username = '';
    
    if(!empty($_POST))
    {
        $query = "
            SELECT
              *
            FROM reg
            WHERE
                username = :username
        ";
        
        // The parameter values
        $query_params = array(
            ':username' => $_POST['username']
        );
     
        try
        {
            // Execute the query against the database
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            
            die("Failed to establish connection");
        }
        $login_ok = false;
        $row = $stmt->fetch();
      
        if($row)
        {
            $check_password = hash('sha256', $_POST['password'] . $row['salt']);
            for($round = 0; $round < 65536; $round++)
            {
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            
            if($check_password === $row['password'])
            {
                // If they do, then we flip this to true
                $login_ok = true;
            }
        }
        
        if($login_ok)
        {       
         unset($row['salt']);
         unset($row['password']);
      	$_SESSION['user'] = $row;
    
   		
			$SomeObscurity4Security = "be-creative-with-some-individual-stuff";// session-cookie-extension-of-some-sort 
			
			$_SESSION['user']['loginSecurity']= $SomeObscurity4Security; // make a check if session-cookie stuff is equal with the ... whatever your idea was. ADD the equality-check on every page! (redirect to login/login.php if != and die ...)
			$usrArray = $_SESSION['user'];
// redirect to:
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";   
			$targetfolder = substr($actual_link, 0, -15); // login-login.php = 15
			$overview = "overview.php"; // go to the c-board's overview.php page
			$locationlink = $targetfolder.$overview ;
 
    
      	 	header("Location: $locationlink"); // perform correct redirect.
      		die("Redirecting to: $locationlink");
        }
        else
        {
            // Tell the user they failed
            print("Login Failed.");
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
    }
 
  

?><!DOCTYPE html>
<head>
	<meta charset="UTF-8" /> 
	
<meta name="viewport" content="width=device-width, initial-scale=0.7"> 
        <link rel="stylesheet" href="https://www.c-board.de/index/CSS/style2.css" type="text/css" media="screen" />
	<!-- <link rel="stylesheet" href="loginCSS.css" type="text/css" media="screen" /> -->
</head>


    <div id="mainform">
  <div id="divform">
 
    <form  action="login.php" class="form" id="form1" name="entryForm" method="post" style="margin-top:9em;" >
         
     
      
      <p>
        <input name="username" type="text" required maxlength="66" class="usrtxt-input" placeholder="Name" id="name" />
      </p>
   
      <p>
        <input name="password" type="password" required maxlength="24" class="usrtxt-input" placeholder="Password" id="pass" />
      </p>
      
   <div class="ENTERbtn">
		<button id="btnBlue">LOGIN</button> 
        <div class="btnTrans"></div>
      </div>      
		

      <p style="margin:1em; padding:1em; text-allign:right;" >
      <span>
	  
	  
		<a class="penciltext" href ="register.php"><span>For using this application you need to Register (click!)</span></a>      
		</span>
		 <span>
		<a class="infotext" href ="Apply4newPW.php"><span>Click me, if You forgot username or password for this slot!</span></a>      
		</span>	      
      </p>
    </form>
  </div>
  </div>





