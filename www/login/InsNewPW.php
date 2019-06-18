
<?php 
$UsrID4new=$_POST["postID"];
$PWersatzP =$_POST["password"];
$Token=$_POST["token"];
$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
$defTok = 0;
 include_once('../PDO/connex.php');
 
 			
        
        
        $PWersatz = hash('sha256', $PWersatzP . $salt);          
        for($round = 0; $round < 65536; $round++)
        		{
            $PWersatz = hash('sha256', $PWersatz . $salt);
        		} 
		$sqluppe = 'UPDATE reg set password=:pw , salt=:salt , SecToken=:defTok where (id=:id AND SecToken=:PrimDings)'; 
		 
		$upStatement = $pdo->prepare($sqluppe);
		$upStatement->execute(array(':pw' => $PWersatz ,':salt' => $salt ,':defTok' => $defTok , ':PrimDings' => $Token , ':id' => $UsrID4new));
 

header('location:login.php');

 exit();
?>