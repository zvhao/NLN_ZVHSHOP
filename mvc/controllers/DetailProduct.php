<?php

class DetailProduct extends Controller
{
    private $products;
    private $categories;
    private $cart;
    private $bills;
    private $comment;
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->cart = $this->model('CartModel');
        $this->bills = $this->model('BillModel');
        $this->comment = $this->model('CommentModel');
    }

    function product($id)
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
        $product = $this->products->SelectProduct($id);
        $img_product = $this->products->SelectProductImg($id);
        $products = $this->products->getAll();
        $categories = $this->categories->getAllCl();
        $nameCate = $this->categories->getNameCate($id);
        $avgRating = $this->products->getOneRating($id);
        $comments = $this->comment->getAllComment($id);
        // show_array($comments);

        if (isset($_SESSION['user'])) {
            $boughtById = $this->bills->boughtById($_SESSION['user']['id'], $id);
            $evaluated = $this->comment->getComment($_SESSION['user']['id'], $id);
            // show_array($evaluated);
            if ($boughtById && empty($evaluated)) {
                $isBuy = '';
                $_SESSION['msg_check_is_buy'] = "Hãy chia sẻ những điều bạn thích về sản phẩm này với những người mua khác nhé.";
            } else if ($boughtById && $evaluated) {
                $isBuy = 'disabled';
                $_SESSION['msg_check_is_buy'] = "Bạn đã đánh giá.";
            } else {
                $isBuy = 'disabled';
                $_SESSION['msg_check_is_buy'] = "Bạn chưa mua sản phẩm này!";
            }
        } else {
            $isBuy = 'disabled';
            $_SESSION['msg_check_is_buy'] = "Vui lòng đăng nhập để được đánh giá!";
        }

        // show_array($avgRating);

        return $this->view("client", [
            'page' => 'detail_product',
            'title' => 'Chi tiết sản phẩm',
            'css' => ['base', 'main'],
            'js' => ['main', 'detail_product'],
            'products' => $products,
            'categories' => $categories,
            'product' => $product,
            'img_product' => $img_product,
            'nameCate' => $nameCate,
            'infoCart' => $infoCart,
            'infoCart' => $infoCart,
            'detailCart' => $detailCart,
            'comments' => $comments,
            'isBuy' => $isBuy,
            'avgRating' => $avgRating,

        ]);
    }
}
