<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vizualizare inregistrari CLIENTI</title>
</head>
<body>
	<h1>Vizualizarea inregistrarilor din tabela CLIENTI</h1>
	<?php 
		include 'conectare.php';
		if($result=$mysqli->query("SELECT * FROM clienti ORDER BY id_client"))
		{
			if($result->num_rows > 0)
			{
				echo "<table border='1' cellpadding='10'>";
				echo "<tr><th>ID</th> <th>Username</th> <th>Parola</th>";
				while($row = $result->fetch_object())
				{
					echo "<tr>";
					echo "<td>".$row->id_client."</td>";
					echo "<td>".$row->username_client."</td>";
					echo "<td>".$row->parola_client."</td>";
					echo "<td><a href='modificare_clienti.php?id=".$row->id_client."'>Modificare</a></td>";
					echo "<td><a href='stergere_clienti.php?id=".$row->id_client."'>Stergere</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "Nu sunt inregistrari in tabela CLIENTI.<br>";
			}
		}
		else
		{
			echo "Eroare: ".$mysqli->error();
		}
		$mysqli->close();
	?>
	<a href="inserare_clienti.php">Adauga inregistare noua</a>
	<br><a href="logout.php">Deconectare</a>
</body>
</html>