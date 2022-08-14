<?php 
	include 'conectare.php';
	if(isset($_POST['submit']))
	{
		if(empty($_POST['username']) || empty($_POST['parola']) || empty($_POST['parolarep']))
		{
			echo 'Completati toate campurile!';
		}
		else
		{
			if(!preg_match('/^[A-Za-z0-9]+$/', $_POST['username']))
			{
				echo 'Username invalid!';
			}
			else
			{
				if(strlen($_POST['parola'])>20 || strlen($_POST['parola'])<5)
				{
					echo 'Parola trebuie sa aiba intre 5 si 20 de caractere!';
				}
				else
				{
					if($_POST['parola']!=$_POST['parolarep'])
					{
						echo 'Parolele nu corespund!';
					}
					else
					{
						if($stmt = $mysqli->prepare('SELECT id_client, parola_client FROM clienti WHERE username_client=?'))
						{
							$stmt->bind_param('s', $_POST['username']);
							$stmt->execute();
							$stmt->store_result();
							if($stmt->num_rows>0)
							{
								echo 'Username deja existent.';
							}
							else
							{
								if($stmt=$mysqli->prepare('INSERT INTO clienti(username_client, parola_client) VALUES(?, ?)'))
								{
									$stmt->bind_param('ss', $_POST['username'], $_POST['parola']);
									$stmt->execute();
									echo 'V-ati inregistrat cu succes! ';
									echo "<a href=\"autentificare.php\"> Autentificare</a>";
								}
								else
								{
									echo 'Eroare: nu se poate executa INSERT.';
								}
								$stmt->close();
							}
					    }
						else
						{
							echo 'Nu se poate executa SELECT';
						}
					}
				}
			}
		}
	}
	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inregistrare</title>
</head>
<body>
	<div>
		<h1>Inregistrare client nou</h1>
		<form action="inregistrare.php" method="post">
			Username: <input type="text" name="username"/><br>
			Parola: <input type="password" name="parola"/><br>
			Repeta parola: <input type="password" name="parolarep"/><br>
			<input type="submit" name="submit" value="Inregistrare"/>
		</form>
	</div>

</body>
</html>