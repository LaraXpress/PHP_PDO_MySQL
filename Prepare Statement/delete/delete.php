<?php 
	require_once 'database.php';
	$sql  = "DELETE FROM users where id = :id";
	$stmt = $pdo->prepare($sql);
	$id   = 1;	
	$stmt->execute([
		':id' => $id		
	])
?>
