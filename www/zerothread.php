<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
require_once("./PDO/connex.php");
    if(empty($_SESSION['user']))
    {
        header("Location: ./login/login.php");
        die("Redirecting to ./login/login.php");
    }
$status = 1;
$setclosed = $pdo->prepare("UPDATE strg SET closed=? WHERE ID=?");
$setclosed->bindParam(1,$status, PDO::PARAM_INT); 
$setclosed->bindParam(2, $_GET['ID']); 
$setclosed->execute();

 header("Location: overview.php");

 exit();
 
 