<?php // Part of the Open C-BOARD - a CYBR CSCW-SUITE spin-off, (c) 2019 | Florian Strahberger | SUPPORT, CONSULTING & WORKSHOPS | fs@c-cybernetics.com
if (session_status() == PHP_SESSION_NONE) {session_start();}

// for usage wit mySQl-database on your LAMP-stack. (do not use the same example)
$dbconfig['host'] = 'cboardDB'; // check host, often localhost, but not always (e.g. at the free-hoster hostinger.de: mysql.hostinger.de)
$dbconfig['port'] = '3306'; // check port, often 3306
$dbconfig['user'] = 'testuser'; // set a user with your mySQL-database set-up at your provider & use the same db-access-name
$dbconfig['base'] = 'cboardDB';		// create a mySQL-database at your provider & use the same db-name
$dbconfig['pass'] = 'testpw';		// use the same password 
$dbconfig['char'] = 'utf8';

try {
    $pdo = new PDO('mysql:host='.$dbconfig['host'].';port='.$dbconfig['port'].';dbname='.$dbconfig['base'].';charset='.$dbconfig['char'].';', $dbconfig['user'], $dbconfig['pass']);
}
catch(PDOException $e) {
    exit('Unable to connect Database.');
}


?>
