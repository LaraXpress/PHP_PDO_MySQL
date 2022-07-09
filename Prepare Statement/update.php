<?php 
	require_once 'database.php';
	$sql  = "UPDATE users SET user_name = :name, user_email = :email, user_password = :password where id = :id";
	$stmt = $pdo->prepare($sql);
	$id   = 1;
	$name = 'john';
	$email= 'john@gmail.com';
	$password = '123654';
	$stmt->execute([
		':id'		=> $id,
		':name'		=> $name,
		':email'	=> $email,
		':password'	=> $password
	])
?>
