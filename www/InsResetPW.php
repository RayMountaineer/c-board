<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com

$UsrID4reset=$_POST["UsrID"];
$PWersatz ="PWreset00";
$USridGenerated = mt_rand();
 include_once('./PDO/connex.php');
$sqlInsert = 'UPDATE reg set password=:pw , SecToken=:PrimDings where id=:id';
		$preparedStatement = $pdo->prepare($sqlInsert);
		$preparedStatement->execute(array(':pw' => $PWersatz , ':PrimDings' => $USridGenerated , ':id' => $UsrID4reset));

header('location:usrAdminPanel_all4.php');

 exit();
?>