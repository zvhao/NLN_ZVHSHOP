<?php

class CartModel extends DB
{
	public function insertCart($id_user, $num_order, $total, $created_at)
	{
		$sql = "INSERT INTO cart(id_user, num_order, total, created_at) VALUES('$id_user', '$num_order', '$total', '$created_at')";
		return $this->pdo_execute($sql);
	}

	public function insertDetailCart($id_cart, $id_pro, $image, $name, $price, $qty, $sub_total, $created_at)
	{
		$sql = "INSERT INTO detail_cart(id_cart, id_pro, image, name, price, qty, sub_total, created_at) VALUES('$id_cart', '$id_pro', '$image', '$name', '$price', '$qty', '$sub_total', '$created_at')";
		return $this->pdo_execute($sql);
	}

	public function SelectCart($id_user)
	{
		$select = "SELECT * FROM cart WHERE id_user = '$id_user'";
		if ($this->pdo_query_one($select)) {
			return $this->pdo_query_one($select);
		} else {
			return [];
		}
	}

	public function getAllDetailCart($id_user)
	{
		$select = "SELECT detail_cart.id, detail_cart.id_cart, detail_cart.id_pro, detail_cart.image, detail_cart.name, detail_cart.price, detail_cart.qty, detail_cart.sub_total, detail_cart.created_at FROM `detail_cart` JOIN cart ON detail_cart.id_cart = cart.id WHERE cart.id_user = '$id_user' ORDER BY created_at DESC";
		return $this->pdo_query($select);
	}

	public function getOneDetailCart($id)
	{
		$select = "SELECT * FROM detail_cart WHERE id = '$id'";
		return $this->pdo_query_one($select);
	}

	public function getDetailCart($id, $id_cart, $id_pro) {
		$select = "SELECT * FROM detail_cart WHERE 1 ";
		if($id > 0) {
			$select .= " AND id = $id ";
		}
		if($id_cart > 0) {
			$select .= " AND id_cart = $id_cart ";
		}
		if($id_pro > 0) {
			$select .= " AND id_pro = $id_pro ";
		}
		return $this->pdo_query($select);
	}

	public function getCart($id_user)
	{
		$select = "SELECT * FROM cart WHERE id_user = '$id_user'";
		return $this->pdo_query($select);
	}

	public function updateCart($id_user, $num_order, $total)
	{
		$sql = "UPDATE cart SET num_order = '$num_order', total = '$total' WHERE id_user = '$id_user'";
		return $this->pdo_execute($sql);
	}

	public function updateDetailCart($id, $qty, $sub_total)
	{
		$sql = "UPDATE detail_cart SET qty = '$qty', sub_total = '$sub_total' WHERE id = '$id'";
		return $this->pdo_execute($sql);
	}

	public function deleteDetailCart($id, $id_cart)
	{
		$sql = "DELETE FROM detail_cart WHERE 1 ";
		if($id > 0) {
			$sql .= " AND id = '$id' ";
		}
		if($id_cart > 0) {
			$sql .= " AND id_cart = '$id_cart' ";
		}
		return $this->pdo_execute($sql);
	}


	function infoCart()
	{
		if (isset($_SESSION['cart'])) {
			return $_SESSION['cart']['info'];
		}
	}

	// function addProductCart($id, $number = 1)
	// {
	// 	$itemPro = $this->SelectProduct($id);
	// 	$itemPro['number'] = $number;
	// 	$itemPro['total'] = $itemPro['number'] * $itemPro['price'];

	// 	$check = 0;
	// 	if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

	// 		foreach ($_SESSION['cart'] as $key => $item) {
	// 			if (isset($item['id']) && $item['id']) {

	// 				if ($item['id'] == $id) {
	// 					if ($number > 1) {
	// 						$item['number'] = $item['number'] + $number;
	// 					} else  if ($number == 1) {

	// 						$item['number']++;
	// 					} else {
	// 						$item['number']--;
	// 					}
	// 					$item['total'] = $item['number'] * $item['price'];
	// 					$itemNew = $item;
	// 					$keyNew  = $key;
	// 					$check = 1;
	// 				}
	// 			}
	// 		}
	// 		if ($check == 1) {
	// 			$_SESSION['cart'][$keyNew] = [];
	// 			$_SESSION['cart'][$keyNew] = $itemNew;
	// 		} else {

	// 			array_push($_SESSION['cart'], $itemPro);
	// 		}
	// 	} else {
	// 		$_SESSION['cart'] = [];
	// 		array_push($_SESSION['cart'], $itemPro);
	// 	}
	// 	return json_encode($_SESSION['cart']);
	// }

	function  removeItem($id)
	{
		if (isset($_SESSION['cart']) && $_SESSION['cart']) {
			$keyRemove = -1;
			foreach ($_SESSION['cart'] as $key => $item) {
				if ($item['id'] == $id) {
					$keyRemove = $key;
				}
			}
			if ($keyRemove > -1) {
				array_splice($_SESSION['cart'], $keyRemove, 1);
			}
		}
		return json_encode($_SESSION['cart']);
	}
}
