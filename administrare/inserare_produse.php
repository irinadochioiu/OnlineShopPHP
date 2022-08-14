<?php
	include 'conectare.php';
	$error='';
	if(isset($_POST['submit']))
	{
		$nume = $_POST['nume'];
		$cod = $_POST['cod'];
		$pret = $_POST['pret'];
		$imagine = $_POST['imagine'];
		$categorie = $_POST['categorie'];
		$descriere = $_POST['descriere'];

		if($nume=='' || $cod=='' || $imagine=='' || $categorie=='' || $descriere=='')
		{
			$error="Eroare: Campuri goale!";
		}
		else
		{
			if($stmt = $mysqli->prepare("INSERT INTO produse (nume_produs, cod_produs, imagine_produs, categorie_produs, descriere_produs) VALUES ( ?, ?, ?, ?, ?)"))
			{
				$stmt->bind_param("sisss", $nume, $cod, $imagine, $categorie, $descriere);
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
	<title>Inserare inregistrare PRODUSE</title>
</head>
<body>
	<h1>Inserare inregistare in tabela produse</h1>
	<?php 
		if($error!='')
		{
			echo "<div style='padding:4px; border:1px solid red; color:red;'>".$error."</div>";
		}
	?>
	<form method="post" action="">
		<div>
			<strong>Nume:</strong><input type="text" name="nume" required/><br>
			<strong>Cod:</strong><input type="text" name="cod" required/><br>
			<strong>Pret:</strong><input type="text" name="pret" /><br>
			<strong>Imagine:</strong><input type="text" name="imagine" required value="../imagini/"/><br>
			<strong>Categorie:</strong><input type="text" name="categorie" required/><br>
			<strong>Descriere:</strong><textarea name="descriere" cols="20" rows="5" required></textarea>
			<input type="submit" name="submit" value="Salveaza"/><br>
			<a href="vizualizare_produse.php">Vizualizare</a>
		</div>
	</form>
</body>
</html>