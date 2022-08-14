<?php 
	session_start();
	include 'conectare.php';
	if(isset($_POST['submit']))
	{
		if(!isset($_POST['username'], $_POST['parola']))
		{
			echo 'Completati numele de utilizator si parola.';
		}
		if($stmt=$mysqli->prepare('SELECT id_utilizator, parola_utilizator FROM utilizatori WHERE username_utilizator=?'))
		{
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0)
			{
				$stmt->bind_result($id, $parola);
				$stmt->fetch();
				if($_POST['parola']==$parola)
				{
					session_regenerate_id();
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['name'] = $_POST['username'];
					$_SESSION['id'] = $id;
					header('Location: home.php');
					exit;
				}
				else
				{
					echo 'Parola nu este corecta!';
				}
			}
			else
			{
				echo 'Numele de utilizator nu exista!';
			}
			$stmt->close();
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Autentificare administrator</title>
</head>
<body>
	<h1>Autentificare administrator</h1>
	<form action="autentificare.php" method="post">
		Nume de utilizator: <input type="text" name="username" required/><br>
		Parola: <input type="password" name="parola"><br>
		<input type="submit" name="submit" value="Submit"/><br>
	</form><br>
	<a href="inregistrare.php">Utilizator nou</a>
</body>
</html>