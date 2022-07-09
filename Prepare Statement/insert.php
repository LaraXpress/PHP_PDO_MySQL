<?php 
	require_once('./database.php');
	$sql  	  = "INSERT INTO users(user_name, user_email, user_password) values(:name, :email, :password)";
	$stmt 	  = $pdo->prepare($sql);
	$name 	  = 'john';
	$email    = 'john@gmail.com';
	$password = 'secretKey';
	$stmt->execute([
		':name'		=> $name,
		':email'	=> $email,
		':password'	=> $password
	]);
?>
