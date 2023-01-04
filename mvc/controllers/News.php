<?php

class News extends Controller
{
    private $cart;
    function __construct()
    {
		$this->cart = $this->model('CartModel');

    }

    public function index()
    {
        $infoCart = [];
        $detailCart = [];
        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            $id_user = $_SESSION['user']['id'];
            $detailCart = $this->cart->getAllDetailCart($id_user);
            $infoCart = $this->cart->SelectCart($id_user);
            // show_array($infoCart);
        }
        if (isset($_SESSION['cart']['buy'])) {
            $detailCart = $_SESSION['cart']['buy'];
            $infoCart = $this->cart->infoCart();
        }
        $this->view("client", [
            'page' => 'news',
            'title' => 'Tin tức',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'infoCart' => $infoCart,
            'detailCart' => $detailCart,

        ]);
    }
}
