<?php

class Contact extends Controller
{
    private $products;
    private $categories;
    private $users;
    private $cart;
    private $contacts;
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->contacts = $this->model('ContactModel');
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
        $categories = $this->categories->getAllCl();
        $cate = 0;
        $products = $this->products->getAll('', 0, $cate);

        $productNew = [];
        foreach ($products as $item) {
            // $item['detail_img'] = $this->products->getProImg($item['id'])['image'];
            array_push($productNew, $item);
        }


        $this->view("client", [
            'page' => 'contact',
            'title' => 'Liên hệ',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'categories' => $categories,
            'products' => $productNew,
            'infoCart' => $infoCart,
            'detailCart' => $detailCart,
        ]);
    }

    public function send_contact()
    {
        if (isset($_POST['send_contact']) && $_POST['send_contact']) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $created_at = date("Y-m-d H:i:s");

            $status = $this->contacts->insertContact($name, $phone, $email, $content, $created_at);

            if ($status) {
                $_SESSION['msg'] = "Bạn đã gửi thành công!";
            } else {
                $_SESSION['msg'] = "Gửi thất bại";
            }

            redirectTo('contact');
        }
    }
}
