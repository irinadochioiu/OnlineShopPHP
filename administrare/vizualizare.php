<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vizualizare inregistrari PRODUSE</title>
</head>
<body>
	<h1>Vizualizarea inregistrarilor din tabela PRODUSE</h1>
	<?php 
		include 'conectare.php';
		if($result=$mysqli->query("SELECT * FROM produse ORDER BY id_produs"))
		{
			if($result->num_rows > 0)
			{
				echo "<table border='1' cellpadding='10'>";
				echo "<tr><th>ID</th> <th>Nume Produs</th> <th>Cod</th> <th>Pret</th> <th>Imagine</th> <th>Categorie</th> <th>Descriere</th>";
				while($row = $result->fetch_object())
				{
					echo "<tr>";
					echo "<td>".$row->id_produs."</td>";
					echo "<td>".$row->nume_produs."</td>";
					echo "<td>".$row->cod_produs."</td>";
					echo "<td>".$row->pret_produs."</td>";
					echo "<td>".$row->imagine_produs."</td>";
					echo "<td>".$row->categorie_produs."</td>";
					echo "<td>".$row->descriere_produs."</td>";
					echo "<td><a href='modificare_produse.php?id=".$row->id.">Modificare</a></td>";
					echo "<td><a href='stergere_produse.php?id=".$row->id.">Stergere</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "Nu sunt inregistrari in tabela PRODUSE.</br>";
			}
		}
		else
		{
			echo "Eroare: ".$mysqli->error();
		}
		$mysqli->close();
	?>
	<a href="inserare_produse.php">Adauga inregistare noua</a>
</body>
</html>