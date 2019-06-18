<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

	$ForUsr= ($_SESSION['user']['username']); //, ENT_QUOTES, 'UTF-8');
	//	$ForUsr= htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
	
	$newqr = trim($_POST["newqr"]);
	$newqr =strip_tags($newqr, '<b><u><i></b></u></i>');
	
	$newim = trim($_POST["newim"]);
	$newim =strip_tags($newim, '<b><u><i></b></u></i>');
	
	$newap = trim($_POST["newap"]);
	$newap =strip_tags($newap, '<b><u><i></b></u></i>');
	
	
	$newstatstat = trim($_POST["newstat"]);
	$newstatstat =strip_tags($newstatstat, '<b><u><i></b></u></i>');
//$ForUsr = $_SESSION["usr"];
 include_once('./PDO/connex.php');

 

 if(!empty($_POST))
    {             
   $insquery = "
            INSERT INTO cflags (
                username,
                qr,
                im,
                ap,
                statstat
                
               
            ) VALUES (
            	:username,
            	:newqr,
            	:newim,
            	:newap,
            	:newstatstat
                
            )
            
        ";  
  $insquery_params = array(
  				
            
            ':username' => $ForUsr,
            ':newqr' =>  $newqr,
            ':newim' =>  $newim,
            ':newap' =>  $newap,
             ':newstatstat' =>  $newstatstat
           
        );
 try
        {
            // Execute the query to create the user
            $insstmt = $pdo->prepare($insquery);
            $result = $insstmt->execute($insquery_params);
         }
        catch(PDOException $ex)
        {
            
            die("Failed to run query -e.g. database, connection, table error etc ");
        }   

    header("Location: persProfile.php#adminCFLX");
    die("Redirecting to persProfile.php#adminCFLX");
        
    }
 