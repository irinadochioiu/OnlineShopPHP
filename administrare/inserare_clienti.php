<?php
	include 'conectare.php';
	$error='';
	if(isset($_POST['submit']))
	{
		$username = $_POST['nume'];
		$parola = $_POST['parola'];

		if($username=='' || $parola=='')
		{
			$error="Eroare: Campuri goale!";
		}
		else
		{
			if($stmt = $mysqli->prepare("INSERT INTO clienti(username_client, parola_client) VALUES (?,?)"))
			{
				$stmt->bind_param('ss', $username, $parola);
				$stmt->execute();
				$stmt->close();
			}
			else
			{
				echo "Nu se poate executa insert!";
			}
		}



	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inserare inregistrare CLIENTI</title>
</head>
<body>
	<h1>Inserare inregistare in tabela CLIENTI</h1>
	<?php 
		if($error!='')
		{
			echo "<div style='padding:4px; border:1px solid red; color:red;'>".$error."</div>";
		}
	?>
	<form method="post" action="">
		<div>
			<strong>Username:</strong><input type="text" name="nume" required/><br>
			<strong>Parola:</strong><input type="text" name="parola" required/><br>
			<input type="submit" name="submit" value="Salveaza"/><br>
			<a href="vizualizare_clienti.php">Vizualizare</a>
		</div>
	</form>
</body>
</html>