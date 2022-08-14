<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'magazin_proiect';
	$mysqli = new mysqli($hostname, $username, $password, $db);
	if (mysqli_connect_errno())
	{
		echo 'Nu s-a putut face conexiunea la baza de date.';
		exit();
	}
?>