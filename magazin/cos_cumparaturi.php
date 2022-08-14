<?php 
	require_once "dbController.php";
	class cos_cumparaturi extends dbController
	{
		function getAllProducts()
		{
			$query = "SELECT * FROM produse";
			$productResult = $this->getDBResult($query);
			return $productResult;
		}
		function getMemberCartItem($member_id)
		{
			$query = "SELECT produse.*, cos.id_cos as cos_id, cos.cantitate_cos FROM produse, cos WHERE produse.id_produs = cos.id_produs AND cos.id_client = ?";
			$params = array(array("param_type"=>"i", "param_value"=>$member_id));
			$cartResult = $this->getDBResult($query, $params);
			return $cartResult;
		}
		function getProductByCode($product_code)
		{
			$query = "SELECT * FROM produse WHERE cod_produs = ?";
			$params = array(array("param_type"=>"s", "param_value" => $product_code));
			$productResult = $this->getDBResult($query, $params);
			return $productResult;
		}
		function getCartItemByProduct($product_id, $member_id)
		{
			$query = "SELECT * FROM cos WHERE id_produs = ? AND id_client = ?";
			$params = array(array("param_type"=>"i", "param_value"=>$product_id), array("param_type"=>"i", "param_value"=>$member_id));
			$cartResult = $this->getDBResult($query, $params);
			return $cartResult;
		}
		function addToCart($product_id, $quantity, $member_id)
		{
			$query = "INSERT INTO cos(id_produs, cantitate_cos, id_client) VALUES (?,?,?)";
			$params = array(array("param_type"=>"i", "param_value"=>$product_id), array("param_type"=>"i", "param_value"=>$quantity), array("param_type"=>"i", "param_value"=>$member_id));
			$this->updateDB($query, $params);
		}
		function updateCartQuantity($quantity, $cart_id)
		{
			$query = "UPDATE cos SET cantitate_cos = ? WHERE id_cos = ?";
			$params = array(array("param_type"=>"i", "param_value"=>$quantity), array("param_type"=>"i", "param_value"=>$cart_id));
			$this->updateDB($query, $params);
		}
		function deleteCartItem($cart_id)
		{
			 $query = "DELETE FROM cos WHERE id_cos=?";
			 $params = array(array("param_type"=>"i", "param_value"=>$cart_id));
			 $this->updateDB($query, $params);
		}
		function emptyCart($member_id)
		{
			$query = "DELETE FROM cos WHERE id_client = ?";
			$params = array(array("param_type"=>"i", "param_value"=>$member_id));
			$this->updateDB($query, $params);
		}
	}
?>