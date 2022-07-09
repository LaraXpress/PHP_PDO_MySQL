<?php 
	$dsn = "mysql:host=localhost; dbname=blog";
	try {
		$pdo = new PDO($dsn, 'root', 'admin1234');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>
