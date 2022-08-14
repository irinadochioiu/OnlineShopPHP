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
				$username = $_POST['nume'];
				$parola = $_POST['parola'];
				if($username=='' || $parola=='')
				{
					echo "<div> Eroare: Campuri goale! </div>";
				}
				else
				{
					if($stmt=$mysqli->prepare("UPDATE clienti SET username_client=?, parola_client=? WHERE id_client='".$id."'"))
					{
						$stmt->bind_param("ss", $username, $parola);
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
	<h1><?php if($_GET['id']!=''){echo "Modificarea unei inregistrari din tabela CLIENTI";}?></h1>
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
						if($result=$mysqli->query("SELECT * FROM clienti WHERE id_client='".$_GET['id']."'"))
						{
							if($result->num_rows>0)
							{
								$row = $result->fetch_object();?></p>
								Username:<input type="text" name="nume" value="<?php echo $row->username_client;?>"/><br>
								Parola:<input type="text" name="parola" value="<?php echo $row->parola_client;?>"/><br>
								<br>
							<?php } 
						}
				}?>
			<input type="submit" name="submit" value="Submit"/>
			<a href="vizualizare_clienti.php">Vizualizare</a>
		</div>
	</form>
</body>
</html>