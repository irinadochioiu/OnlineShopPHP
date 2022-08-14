<?php
	session_start();
	if(!isset($_SESSION['loggedin']))
	{
		header('Location: autentificare.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrare Magazin</title>
</head>
<body>
	<h1>Bine ai venit, <?php echo $_SESSION['name']; ?>. Alege tabela pe care doresti sa o administrezi:</h1>
	<h2><a href="vizualizare_produse.php">PRODUSE</a></h2>
	<h2><a href="vizualizare_clienti.php">CLIENTI</a></h2>
	<a href="logout.php">Deconectare</a>

</body>
</html>