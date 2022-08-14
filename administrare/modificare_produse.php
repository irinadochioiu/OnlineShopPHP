<?php 
	include 'conectare.php';
	$error='';
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['id']))
		{
			if(is_numeric($_POST['id']))
			{
				$id = $_POST['id'];
				$nume = $_POST['nume'];
				$cod = $_POST['cod'];
				$pret = $_POST['pret'];
				$imagine = $_POST['imagine'];
				$categorie = $_POST['categorie'];
				$descriere = $_POST['descriere'];
				if($nume=='' || $cod=='' || $pret=='' || $imagine=='' || $categorie=='' || $descriere=='')
				{
					echo "<div> Eroare: Campuri goale! </div>";
				}
				else
				{
					if($stmt=$mysqli->prepare("UPDATE produse SET nume_produs=?, cod_produs=?, pret_produs=?, imagine_produs=?, categorie_produs=?, descriere_produs=? WHERE id_produs='".$id."'"))
					{
						$stmt->bind_param("sidsss", $nume, $cod, $pret, $imagine, $categorie, $descriere);
						$stmt->execute();
						$stmt->close();
					}
					else
					{
						echo "Eroare: Nu se poate executa UPDATE!";
					}
				}

			}
		}
		else
		{
			echo "Id inc";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php if($_GET['id']!=''){echo "Modificare inregistrare";}?></title>
</head>
<body>
	<h1><?php if($_GET['id']!=''){echo "Modificarea unei inregistrari din tabela PRODUSE";}?></h1>
	<?php
		if($error!='')
		{
			echo "<div style='padding:4px; border:1px solid red; color:red;'>".$error."</div>";
		}
	?>
	<form action="" method="post">
		<div>
			<?php 
				if($_GET['id']!='')
				{
					?><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
					<p>ID: <?php 
						echo $_GET['id'];
						if($result=$mysqli->query("SELECT * FROM produse WHERE id_produs='".$_GET['id']."'"))
						{
							if($result->num_rows>0)
							{
								$row = $result->fetch_object();?></p>
								Nume:<input type="text" name="nume" value="<?php echo $row->nume_produs;?>"/><br>
								Cod:<input type="text" name="cod" value="<?php echo $row->cod_produs;?>"/><br>
								Pret:<input type="text" name="pret" value="<?php echo $row->pret_produs;?>"/><br>
								Imagine:<input type="text" name="imagine" value="<?php echo $row->imagine_produs;?>"/><br>
								Categorie:<input type="text" name="categorie" value="<?php echo $row->categorie_produs;?>"/><br>
								Descriere:<textarea rows="4" cols="50" name="descriere"><?php echo $row->descriere_produs;?></textarea><br>
							<?php } 
						}
				}?>
			<input type="submit" name="submit" value="Submit"/>
			<a href="vizualizare_produse.php">Vizualizare</a>
		</div>
	</form>
</body>
</html>