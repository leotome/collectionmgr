<?php
	define('DB_HOST','fdb20.freehostingeu.com:3306');
	define('DB_USER','2709247_collectionmgr');
	define('DB_PASS','*T%Jnc.(9:10?.tc');
	define('DB_NAME','2709247_collectionmgr');

	// Establish database connection.
	try{
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	catch (PDOException $e){
		exit("Error: " . $e->getMessage());
	}
?>
