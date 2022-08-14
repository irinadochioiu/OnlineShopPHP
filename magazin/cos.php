<?php 
	require_once "cos_cumparaturi.php";
	session_start();
	if(!isset($_SESSION['loggedin']))
	{
		header('Location: inregistrare.php');
		exit;
	}
	$member_id = $_SESSION['loggedin'];
	$shoppingCart = new cos_cumparaturi();
	if(!empty($_GET["action"]))
	{
		switch ($_GET["action"])
		{
			case "add":
				if(!empty($_POST['quantity']))
				{
					$productResult = $shoppingCart->getProductByCode($_GET['code']);
					$cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id_produs"], $member_id);
					if(!empty($cartResult))
					{
						$newQuantity = $cartResult[0]["cantitate_cos"] + $_POST['quantity'];
						$shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id_cos"]);
					}
					else
					{
						$shoppingCart->addToCart($productResult[0]["id_produs"], $_POST['quantity'], $member_id);
					}
				}
			break;
			case "remove":
				$shoppingCart->deleteCartItem($_GET['id']);
				header('Location: cos.php');
				break;
			case "empty":
				$shoppingCart->emptyCart($member_id);
			break;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cos de cumparaturi</title>
</head>
<body>
	<h1>Cos cumparaturi</h1>
	<a href="cos.php?action=empty">Golire cos</a><br>
	<?php
		$cartItem = $shoppingCart->getMemberCartItem($member_id);
		if(!empty($cartItem))
		{
			$item_total = 0;
			?>
			<table cellpadding="10" cellspacing="1">
				<tr>
					<th></th>
					<th>Nume</th>
					<th>Cod</th>
					<th>Cantitate</th>
					<th>Pret</th>
					<th>Actiune</th>
				</tr>
			<?php 
				foreach ($cartItem as $item) 
				{
					?>
					<tr>
						<td><img height="100" width="100" src="<?php echo $item["imagine_produs"]; ?>"</td>
						<td><?php echo $item["nume_produs"]; ?></td>
						<td><?php echo $item["cod_produs"]; ?></td>
						<td><?php echo $item["cantitate_cos"]; ?></td>
						<td><?php echo $item["pret_produs"]; ?></td>
						<td><a href="cos.php?action=remove&id=<?php echo $item["cos_id"]; ?>">Sterge produs</a></td>
					</tr>
					<?php 
					$item_total += ($item["pret_produs"]*$item["cantitate_cos"]);
				}
			?>
				<tr>
					<td>Total: </td>
					<td><?php echo $item_total; ?> Lei</td>
					<td></td>
				</tr>
		<?php
		}
		echo "Username: ".$_SESSION['name'];
		//echo $_SESSION['email'];
	?>
	<a href="inele.php">Inapoi la magazin </a>
	<br>
	<a href="logout.php">Deconectare</a>
</body>
</html>