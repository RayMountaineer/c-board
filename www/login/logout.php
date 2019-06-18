<?php
 
require_once "../PDO/connex.php";
   
     
    unset($_SESSION['user']);    
    unset($_SESSION['url']);
     

$URL = "login.php";
if( headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
else { header("Location: $URL"); }
exit;   
die("Redirecting to: login.php"); 
