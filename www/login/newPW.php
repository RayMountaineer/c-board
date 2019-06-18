<?php
session_start(); 
?>
<head><link rel="stylesheet" href="registerCSS.css" type="text/css" media="screen" /></head>
<?php 
$theUsrID = filter_input(INPUT_GET, "USrid", FILTER_SANITIZE_NUMBER_INT);
$SIVar = filter_input(INPUT_GET, "SI", FILTER_SANITIZE_NUMBER_INT);

$defToken = 0;

 include_once('../PDO/connex.php');
//
	
        $query4name = "
            SELECT
                *
            FROM reg
            WHERE
                (id = :userID AND SecToken=:tok)
        ";
       
        $query_params = array(
            ':userID' => $theUsrID,
             ':tok' => $SIVar
        );
        
        try
        { 
            $stmt = $pdo->prepare($query4name);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {  
            die("Failed to run query - manipulated values, old Token, or database-malfunct");
        }
      
        $row = $stmt->fetch();
    

       if(!empty($_POST))  
    {   
			 
        if(empty($_POST['password']))
        {
            die("Your entry for a new password is needed for setting a new password ;-) ");
        }       
     
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        
        
        $PWersatz = hash('sha256', $_POST['password'] . $salt);
        
        
        for($round = 0; $round < 65536; $round++)
        {
            $PWersatz = hash('sha256', $PWersatz . $salt);
        }
        

	$sqlupdate = 'UPDATE reg set password=:pw where (id=:id AND SecToken=:tok)'; 
		$pStatement = $pdo->prepare($sqlupdate);
		$pStatement->execute(array(':pw' => $PWersatz , ':id' => $theUsrID, ':tok' => $SIVar));
 
        header("Location: login.php");
         
        die("Redirecting to login.php");
    }
 
    
?>



<form action="InsNewPW.php" method="post" id="login">
	<fieldset>
		<legend>SET A NEW PASSWORD</legend>
		
		
		 <table border="0" cellpadding="0" cellspacing="4">
    <tr>
      <td align="right">Enter a new password for:</td>
      <td><?php echo $row['username']; ?></td>
    </tr>
	
    <tr>
      <td align="right">New Password:</td>
      <td><input id="password" name="password" type="password" placeholder="A password for logging-in" required value="" size="30" maxlength="50" /></td>
     		<input type="hidden" name="token" id="token" value="<?php echo $SIVar; ?>" />
      	<input type="hidden" name="postID" id="postID" value="<?php echo $theUsrID; ?>" />
    </tr>
  </table>
		
	</fieldset>
	
	<fieldset>
		<button type="submit" value="Register">Set new password</button>
		<br>
		
	</fieldset>
</form>


