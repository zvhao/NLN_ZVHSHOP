<?php

class checkOut extends Controller
{
	private $products;
	private $categories;
	private $bills;
	private $user;
	private $cart;

	function __construct()
	{
		$this->products = $this->model('ProductModel');
		$this->categories = $this->model('CategoryModel');
		$this->bills = $this->model('BillModel');
		$this->user = $this->model('UserModel');
		$this->cart = $this->model('CartModel');
	}

	public function index()
	{
		// show_array($_SESSION);
		$categories = $this->categories->getAllCl();
		if (isset($_SESSION['user'])) {
			$email = $_SESSION['user']['email'];
			$user = $this->user->SelectOneUser($email);
			$id_user = $user['id'];
			// $detailCart = $this->cart->getAllDetailCart($id_user);
		} else $user = '';

		if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
			$id_user = $_SESSION['user']['id'];
			$detailCart = $this->cart->getAllDetailCart($id_user);
			$infoCart = $this->cart->SelectCart($id_user);
		}
		if (isset($_SESSION['cart']['buy'])) {
			$detailCart = $_SESSION['cart']['buy'];
			$infoCart = $this->cart->infoCart();
		}

		if (isset($_SESSION['cart']) || $detailCart) {
			$this->view("client", [
				'page' => 'checkout',
				'title' => 'Thanh toán',
				'css' => ['base', 'main'],
				'js' => ['main'],
				'categories' => $categories,
				'user' => $user,
				'detailCart' => $detailCart,
				'infoCart' => $infoCart,
				'js' => ['main', 'jquery.validate', 'form_validate', 'vn_pay'],




			]);
		} else {
			redirectTo('');
		}
	}
}
