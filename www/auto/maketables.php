<?php
// if you have set the connection-strings to your database (from your server or webspace-provider to the PDO/connex.php and login/common.php files),
// you can create the database-tables by entering in your Browser: 
// http://www.your-domain-or-webspace-folder/auto/maketables.php
// You will see messages with the table-names, if successful. else: you should check if the database, the user and password exists / is correct. 
 require_once("../PDO/connex.php");

$table1 = "wbs";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     id  int(6) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	lev  int(6) NOT NULL DEFAULT 1, 
  L1  int(6) NOT NULL DEFAULT 0, 
 	L2  int(6) NOT NULL DEFAULT 0, 
 	L3  int(6) NOT NULL DEFAULT 0, 
 	L4  int(6) NOT NULL DEFAULT 0, 
 	L5  int(6) NOT NULL DEFAULT 0, 
 	L6  int(6) NOT NULL DEFAULT 0, 
 	nam  varchar(255) DEFAULT 'not set', 
 	des  varchar(255) DEFAULT 'not set',
 	wbsnumber varchar(125) NOT NULL DEFAULT '0',
  	activ int(2) NOT NULL DEFAULT '1',
  	usrsID int(6) );";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (1 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
 
$table1 = "usrsprofiles";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	id  int(255) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
 		username varchar(133) NOT NULL,
  		email varchar(64) NOT NULL,
  		image_type varchar(25) NOT NULL DEFAULT 'nopic',
  		image longblob,
  		image_size varchar(25) NOT NULL DEFAULT '''''',
  		avatar varchar(50) NOT NULL DEFAULT '''''',
  		image_size2 varchar(25) NOT NULL DEFAULT '''''',
  		avatar2 varchar(50) NOT NULL DEFAULT '''''',
  		image_type2 varchar(25) DEFAULT 'nopic',
  		image2 longblob,
  		fname varchar(64) NOT NULL DEFAULT 'myFirstName',
  		lname varchar(64) NOT NULL DEFAULT 'myLastName',
  		phone varchar(64) NOT NULL DEFAULT '+00 0000 000-00',
  		daytime varchar(32) NOT NULL DEFAULT 'daytime',
  		tzone varchar(64) NOT NULL DEFAULT 'timezone',
  		position varchar(666) NOT NULL DEFAULT 'MyRole MyPosition in this project',
  		skills varchar(666) NOT NULL DEFAULT 'MySkills related to MyRole',
  		interestedin varchar(666) NOT NULL DEFAULT 'MyInterests private or business',
  		comment varchar(666) NOT NULL DEFAULT 'No Stereotypes, but myCulture, myPassion, myPreferences',
  		thorie_nearness varchar(11) NOT NULL DEFAULT '0',
  		thorie_risk varchar(11) NOT NULL DEFAULT '0');";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (2 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}

$table1 = "cflags";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	id  int(255) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
 		username varchar(133) NOT NULL, 
		qr varchar(333), 
		im varchar(333), 
		ap varchar(333),
		statstat varchar(333) );";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (3 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}


$table1 = "forum_posts";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	ID  int(255) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  		tid int(255) NOT NULL,
  		Pid int(255) NOT NULL,
  		activ int(2) NOT NULL DEFAULT '1',
  		reAW int(255) DEFAULT NULL,
  		project varchar(133) NOT NULL DEFAULT 'not set',
  		wbsnom varchar(133) NOT NULL DEFAULT 'not set',
  		wbsnr varchar(33) NOT NULL DEFAULT '0',
  		actnom varchar(133) NOT NULL DEFAULT 'not set',
  		actnr varchar(33) NOT NULL DEFAULT '0',
  		username varchar(133) NOT NULL,
  		email varchar(133) NOT NULL DEFAULT 'not set',
  		topic varchar(133) NOT NULL DEFAULT 'not set',
  		text text,
  		created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  		qr text,
  		im text,
  		ap text,
  		statstat text);";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (4 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
 
$table1 = "strg";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	ID  int(255) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
 		Pid int(255) NOT NULL DEFAULT '0',
  		topic varchar(255) NOT NULL DEFAULT 'not set',
  		dscrption varchar(255) NOT NULL DEFAULT 'not set',
  		closed int(3) NOT NULL DEFAULT '0',
		created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (5 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}


$table1 = "reg";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	id  int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
     	permission int(4) NOT NULL DEFAULT '0',
     	SecToken int(33) NOT NULL DEFAULT '0',
 		username varchar(255) NOT NULL, 
		password char(64) NOT NULL, 
		salt char(16) NOT NULL, 
		email varchar(255) NOT NULL);";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (6 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}



$table1 = "cflxmails";
try {     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
      emailID int(255) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	    project varchar(133) NOT NULL DEFAULT 'not set',
	     wbsnom varchar(133) NOT NULL DEFAULT 'not set',
	     wbsnr varchar(33) NOT NULL DEFAULT '0',
	     lev int(2) NOT NULL DEFAULT '0',
	     username varchar(133) NOT NULL DEFAULT 'not set',
  	   email varchar(133) NOT NULL DEFAULT 'not set',
  	   subject varchar(133) NOT NULL DEFAULT 'not set',
  	   receiver varchar(133) NOT NULL DEFAULT 'not set',
  	   fact text,
  	   created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  	   qr text,
  	   im text,
  	   ap text
      );";
     $pdo->exec($sqlwbs);
     print("Created $table1 Table (7 of 8).\n");
  
    } catch(PDOException $e) {
       echo $e->getMessage();//Remove or change message in production code
      }



$table1 = "mailrex";
try {
     
     $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sqlwbs ="CREATE TABLE IF NOT EXISTS $table1(
     	id  int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
     	port int(4) NOT NULL DEFAULT '587',
     	host varchar(255) NOT NULL, 
    	username varchar(255) NOT NULL, 
		password char(64) NOT NULL,  
		SecToken int(33) NOT NULL DEFAULT '0',
		salt char(16) NOT NULL, 
		protocoll varchar(255) NOT NULL);";
  $pdo->exec($sqlwbs);
   print("Created $table1 Table (8 of 8).\n");
  
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}


