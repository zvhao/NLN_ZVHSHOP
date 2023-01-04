<?php

class Introduce extends Controller
{
    private $products;
    private $categories;
    private $cart;
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
		$this->cart = $this->model('CartModel');

    }

    public function index()
    {
        $infoCart = [];
        $detailCart= [];
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
        $categories = $this->categories->getAllCl();
        $cate = 0;
        $products = $this->products->getAll('',0,$cate);
        
        $productNew = [];
        foreach($products as $item) {
            // $item['detail_img'] = $this->products->getProImg($item['id'])['image'];
            array_push($productNew, $item);
        }
        $this->view("client", [
            'page' => 'introduce',
            'title' => 'Giới thiệu',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'categories' => $categories,
            'products' => $productNew,
            'infoCart' => $infoCart,
            'detailCart' => $detailCart,
        ]);
    }
}
