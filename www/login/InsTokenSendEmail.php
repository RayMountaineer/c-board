<?php
 
$usernameemail=$_POST["usernameemail"];
 

 include_once('../PDO/connex.php');

// zu 4.b) check if avaiable START
   $query = "SELECT id,username,email FROM reg WHERE (username = :username || email = :email)";
        
        
        $query_params = array(
            ':username' => $usernameemail,  ':email' => $usernameemail
        );
        
        try
        {
            // These two statements run the query against your database table.
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            die("Failed to run query");
        }
        
        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.
        $namemailArray = $stmt->fetch();
        
        // If a row was returned, then we know a matching username or email was found in
        // the database and we can start creating and sending the email with using the data from the $namemailArray.
        if($namemailArray)
        {
// ****************************************************************************************************************************************************************************
 				
		$UsersID=$namemailArray['id'] ; 
		$UsersName=$namemailArray['username'] ; 
		$UsersEmail=$namemailArray['email'] ; 
 		$Token = mt_rand(); // zum Eintrag in Datenbank reg sowie zum hinzufügen in den new-pw-link der email
 // zu b)
 		$Update4Token = 'UPDATE reg set SecToken=:PrimDings where id=:id';
		$prep4TokStatement = $pdo->prepare($Update4Token);
		$prep4TokStatement->execute(array(':PrimDings' => $Token , ':id' => $UsersID));
 

		$subject = "You were requesting a new password for your cboard-account";
require_once '../sgPHPmailer_newPW.php';
 
// ****************************************************************************************************************************************************************************
        }
// else (= kein Passender Eintrag gefunden), we pop up an alert and redirect to the user-login to prevent bruteforcing
      	else { 
      		$message = "Your entry does not match to any user or email in our member-list. Please re-try or contact your cboard-admin (might be your project manager / PMO / IT-Department or somebody else with admin-rights to the cboard)  ";
				echo "<script type='text/javascript'>alert('$message');</script>";
        
     		}

 
 exit();
?>