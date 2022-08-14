<?php 
	include 'conectare.php';
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		if($stmt=$mysqli->prepare("DELETE FROM produse WHERE id_produs=? LIMIT 1"))
		{
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
		else
		{
			echo "Eroare: Nu se poate executa DELETE";
		}
		$mysqli->close();
		echo "<div>Inregistrarea a fost stearsa!</div><br>";
	}
	echo "<p><a href=\"vizualizare_produse.php\">Vizulizare</a></p>";
?>