<?php

class Cart extends Controller
{
    function __construct()
    {
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->bills = $this->model('BillModel');
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
        $products = $this->products->getAll('', 0, $cate);

        $productNew = [];
        foreach ($products as $item) {
            // $item['detail_img'] = $this->products->getProImg($item['id'])['image'];
            array_push($productNew, $item);
        }

        

        // show_array($_SESSION);

        $this->view("client", [
            'page' => 'cart',
            'title' => 'Giỏ hàng',
            'css' => ['base', 'main'],
            'js' => ['main'],
            'categories' => $categories,
            'products' => $productNew,
            'infoCart' => $infoCart,
            'detailCart' => $detailCart,
        ]);
    }


    public function add_cart()
    {
        $qty = 0;
        $id = 0;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (isset($_POST['num_order']) && isset($_SESSION['cart']['buy'][$id])) {
            $qty = $_POST['num_order'] + $_SESSION['cart']['buy'][$id]['qty'];
        } else if (isset($_POST['num_order'])) {
            $qty = $_POST['num_order'];
        }

        $select = "SELECT * FROM products WHERE id = '$id'";

        $product = $this->products->pdo_query_one($select);

        $id_pro = $product['id'];
        $image = $product['image'];
        $name = $product['name'];
        $price = $product['price'];
        // $qty = $qty;
        $dated_at = date('Y-m-d H:i:s');
        $sub_total = $product['price'] * $qty;

        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            $id_user = $_SESSION['user']['id'];
            $cart = $this->cart->SelectCart($id_user);
            $id_cart = $cart['id'];
            // show_array($_POST);

            $detail_cart = $this->cart->getDetailCart(0, $id_cart, $id_pro);
            $id_detail_cart = $detail_cart[0]['id'];
            
            if (isset($_POST['num_order']) && $detail_cart) {
                $qty = $_POST['num_order'] + $detail_cart[0]['qty'];
                // show_array($detail_cart);
                $price = $detail_cart[0]['price'];
                $sub_total = $price * $qty;
                if($id_detail_cart > 0) {
                    $this->cart->updateDetailCart($id_detail_cart, $qty, $sub_total);
                }
            } else if (isset($_POST['num_order'])) {
                $qty = $_POST['num_order'];
                $this->cart->insertDetailCart($id_cart, $id_pro, $image, $name, $price, $qty, $sub_total, $dated_at);
            }
            // show_array($detail_cart);


            
        } else {
            $_SESSION['cart']['buy'][$id] = array(
                'id' => $product['id'],
                'image' => $product['image'],
                'name' => $product['name'],
                'price' => $product['price'],
                'qty' => $qty,
                'dated_at' => date('Y-m-d H:i:s'),
                'sub_total' => $product['price'] * $qty,
            );
        }


        $this->update_cart();

        // redirectTo('cart');
        redirectTo('cart');
    }

    public function update_cart()
    {
        if (isset($_SESSION['cart'])) {
            $num_order = 0;
            $total = 0;

            foreach ($_SESSION['cart']['buy'] as $item) {
                $num_order += $item['qty'];
                $total += $item['sub_total'];
            }

            $_SESSION['cart']['info'] = array(
                'num_order' => $num_order,
                'total' => $total,
            );
        }

        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            $id_user = $_SESSION['user']['id'];
            $num_order = 0;
            $total = 0;
            $detailCart = $this->cart->getAllDetailCart($id_user);
            foreach ($detailCart as $item) {
                $num_order += $item['qty'];
                $total += $item['sub_total'];
            }
            $this->cart->updateCart($id_user, $num_order, $total);
        }
    }

    public function delete_cart()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (isset($_SESSION['cart'])) {
            if (!empty($id)) {
                unset($_SESSION['cart']['buy'][$id]);
            }
            if (!empty($id) && empty($_SESSION['cart']['buy'])) {
                unset($_SESSION['cart']);
            }
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
            $detail_cart = $this->cart->getDetailCart($id, 0, 0);
            if (isset($detail_cart) && !empty($detail_cart) ) {
                // show_array($detail_cart);
                $this->cart->deleteDetailCart($id, 0);
            }
        }


        $this->update_cart();

        redirectTo('cart');
    }

    public function update()
    {
        if (isset($_SESSION['cart']) && isset($_POST['qty'])) {
            foreach ($_POST['qty'] as $id => $qty) {
                $select = "SELECT * FROM products WHERE id = '$id'";

                $product = $this->products->pdo_query_one($select);

                $_SESSION['cart']['buy'][$id]['qty'] = $qty;
                $_SESSION['cart']['buy'][$id]['sub_total'] = $qty * $product['price'];
            }

            $this->update_cart();
            redirectTo('cart');
        }

        if (isset($_SESSION['user']) && isset($_POST['qty'])) {

            foreach ($_POST['qty'] as $id => $qty) {

                $detailCart = $this->cart->getOneDetailCart($id);
                // show_array($_POST);
                $price = $detailCart['price'];
                $sub_total = $qty * $price;
                $this->cart->updateDetailCart($id, $qty, $sub_total);
            }
            $this->update_cart();
            redirectTo('cart');
        }
    }
}
