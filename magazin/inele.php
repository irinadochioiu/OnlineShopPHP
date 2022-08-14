<?php
	require_once "cos_cumparaturi.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inele</title>
</head>
<body>
	<h1>Produse</h1>
	<?php 
		$shoppingCart = new cos_cumparaturi();
		$product_array = $shoppingCart->getAllProducts();
		if(!empty($product_array))
		{
			foreach ($product_array as $key => $value) 
			{
				?>
				<form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["cod_produs"]; ?>">
					<img height="100" width="100" src="<?php echo $product_array[$key]["imagine_produs"]; ?>">
					<?php echo $product_array[$key]["nume_produs"]." <br>";
					echo $product_array[$key]["pret_produs"]." RON";?><br>
					<?php echo $product_array[$key]["descriere_produs"]." ";?><br>
					<input type="text" name="quantity" value="1" size="2"/>
					<input type="submit" name="submit" value="Adauga in cos">
				</form>
				<?php
			}
		}
		echo "Username: ".$_SESSION['name'];
		//echo &_SESSION['email'];
	?>
</body>
</html>