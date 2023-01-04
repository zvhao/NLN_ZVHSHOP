<?php
class Bill extends Controller
{

	private $users;
	private $products;
    private $categories;
    private $cart;
    private $bills;
    private $comment;
	function __construct()
	{
		$this->users = $this->model('UserModel');
		$this->products = $this->model('ProductModel');
		$this->categories = $this->model('CategoryModel');
		$this->bills = $this->model('BillModel');
		$this->cart = $this->model('CartModel');
	}

	public function index()
	{

		$keyword = '';
		$status = -1;

		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		}
		if (isset($_GET['status'])) {
			$status = $_GET['status'];
		}
		if (isset($_GET['search'])) {
			$keyword = $_GET['search'];
			if ($keyword == 'khong co tai khoan') {
				$keyword = 0;
			}
		}

		$getAllBill = $this->bills->getAllBill($status, 0, $keyword);
		$count_product = !empty($getAllBill) ? count($getAllBill) : 0;
		// show_array($count_product);

		$num_per_page = 8;
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$start = ($page - 1) * $num_per_page;
		$getAllBillAdmin = $this->bills->getAllBillAdmin($status, $keyword, $start, $num_per_page);
		// show_array($getAllBillAdmin);
		$billsNew = [];
		foreach ($getAllBillAdmin as $bill) {
			$bill['detail'] = $this->bills->getDetailBill($bill['id']);
			if ($bill['user_id'] > 0) {
				$data = $this->users->SelectUser($bill['user_id']);
				// show_array($data);
				$bill['email_user'] = $data['email'];
				$bill['name_user'] = $data['name'];
			} else {
				$bill['email_user'] = '';
				$bill['name_user'] = '';
				$bill['user_id'] = 'Không có tài khoản';
			}
			array_push($billsNew, $bill);
		}
		// show_array($billsNew);
		return $this->view('admin', [
			'page' => 'bill/list',
			// 'getAllBill' => $billsNew,
			'js' => ['deletedata', 'search'],
			'title' => 'DANH SÁCH ĐƠN HÀNG',
			'keyword' => $keyword,
			'billsNew' => $billsNew,
			'num_per_page' => $num_per_page,
			'count_product' => $count_product,
			'keyword' => $keyword,
			'pagePag' => 'bill',
		]);
	}

	public function show_bill()
	{
		// show_array($_SESSION['user']);
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
		$status = -1;
		if (isset($_GET['type'])) {
			$status = $_GET['type'];
		}
		if (isset($_SESSION['user'])) {
			$user_id = $_SESSION['user']['id'];
		}
		$categories = $this->categories->getAllCl();

		$getAllBill = $this->bills->getAllBill($status, $user_id, '');
		// show_array($getAllBill);
		$billsNew = [];

		foreach ($getAllBill as $bill) {
			$bill['detail'] = $this->bills->getDetailBill($bill['id']);
			array_push($billsNew, $bill);
		}

		$this->view("client", [
			'page' => 'bill',
			'title' => 'Đơn hàng',
			'css' => ['base', 'main'],
			'js' => ['main'],
			'getAllBill' => $billsNew,
			'categories' => $categories,
			'infoCart' => $infoCart,
			'detailCart' => $detailCart,

		]);
	}

	public function detail_bill($id) {

		$categories = $this->categories->getAllCl();
		$bill = $this->bills->SelectOneBill($id);
		$detailBill = $this->bills->getDetailBill($id);
		// show_array($detailBill);
		return $this->view("client", [
			'page' => 'detail_bill',
			'title' => 'Chi tiết đơn hàng',
			'css' => ['base', 'main'],
			'js' => ['main'],
			'bill' => $bill,
			'detailBill' => $detailBill,
			'categories' => $categories,

		]);
	}

	public function add_bill()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['id']) {
			$id_user = $_SESSION['user']['id'];
			$detailCart = $this->cart->getAllDetailCart($id_user);
			$infoCart = $this->cart->SelectCart($id_user);
		}
		if (isset($_SESSION['cart']['buy'])) {
			$detailCart = $_SESSION['cart']['buy'];
			$infoCart = $this->cart->infoCart();
		}

		// show_array($detailCart);
		if (isset($_POST['add_bill']) && ($_POST['add_bill']) != " ") {
			$fullname = $_POST['fullname'];
			$tel = $_POST['tel'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$note = $_POST['note'];
			$total = $_POST['total'];
			$method = $_POST['method'];
			if (isset($_SESSION['user'])) {
				$user_id = $_SESSION['user']['id'];
			} else $user_id = 0;
			$created_at = date('Y-m-d H:i:s');

			$idBill = $this->bills->insertBill($fullname, $tel, $email, $address, $note, $total, $method, $user_id, $created_at);

			if ($idBill) {
				if (isset($_SESSION['user'])) {
					foreach ($detailCart as $item) {
						$this->bills->insertDetailBill($item['id_pro'], $item['image'], $item['name'], $item['price'], $item['qty'],  $item['sub_total'], $idBill, $created_at);
					}
					$this->cart->deleteDetailCart(0, $infoCart['id']);
					$this->cart->updateCart($id_user, 0, 0);
				} else {
					foreach ($detailCart as $item) {
						if (isset($item['id']) && $item['id']) {
							$this->bills->insertDetailBill($item['id'], $item['image'], $item['name'], $item['price'], $item['qty'],  $item['sub_total'], $idBill, $created_at);
						}
					}
					unset($_SESSION['cart']);
				}
			}

			// show_array($bill);
			redirectTo("bill/detail_bill/$idBill");
		}
	}

	function update_bill($id)
	{
		$bill = $this->bills->SelectOneBill($id);
		// show_array($bill);

		if (!empty($bill)) {
			$updated_at = ('Y-m-d H:i:s');
			$update = $this->bills->editStatus($id, (int)$bill['status'] + 1, $updated_at);
			header('Location:' . _WEB_ROOT . '/bill');
		}
	}

	function delete_bill($id)
	{
		$status = $this->bills->deleteBill($id);
		if ($status) {
			echo -1;
		} else {
			echo -2;
		}
	}


	function vnPay_return()
	{
		return $this->view('vnpay_return', [
			'js' => ['vn_pay']
		]);
	}
	function vnPay()
	{

		$sum = $_POST['sum'];
		$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$vnp_Returnurl = _WEB_ROOT . "/bill/vnpay_return";
		$vnp_TmnCode = "T8F0OXZG"; //Mã website tại VNPAY 
		$vnp_HashSecret = "CDLYRIZCDZXVAZVTNDSTUBXVFBOXIEOJ"; //Chuỗi bí mật

		$vnp_TxnRef = random_int(0, 9999999999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
		$vnp_OrderInfo = 'Thanh toán đơn hàng test';
		$vnp_OrderType = 'billpayment';
		$vnp_Amount =   (float)$sum * 100;
		$vnp_Locale = 'vn';
		$vnp_BankCode = 'NCB';
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		//Add Params of 2.0.1 Version
		// $vnp_ExpireDate = $_POST['txtexpire'];
		//Billing


		$inputData = array(
			"vnp_Version" => "2.1.0",
			"vnp_TmnCode" => $vnp_TmnCode,
			"vnp_Amount" => $vnp_Amount,
			"vnp_Command" => "pay",
			"vnp_CreateDate" => date('YmdHis'),
			"vnp_CurrCode" => "VND",
			"vnp_IpAddr" => $vnp_IpAddr,
			"vnp_Locale" => $vnp_Locale,
			"vnp_OrderInfo" => $vnp_OrderInfo,
			"vnp_OrderType" => $vnp_OrderType,
			"vnp_ReturnUrl" => $vnp_Returnurl,
			"vnp_TxnRef" => $vnp_TxnRef,
			// "vnp_ExpireDate" => $vnp_ExpireDate

		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
			$inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
			$inputData['vnp_Bill_State'] = $vnp_Bill_State;
		}

		//var_dump($inputData);
		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
			if ($i == 1) {
				$hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
			} else {
				$hashdata .= urlencode($key) . "=" . urlencode($value);
				$i = 1;
			}
			$query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;
		if (isset($vnp_HashSecret)) {
			$vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
			$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array(
			'code' => '00', 'message' => 'success', 'data' => $vnp_Url
		);
		if (isset($_POST['redirect'])) {
			header('Location: ' . $vnp_Url);
			die();
		} else {
			echo json_encode($returnData);
		}
		// vui lòng tham khảo thêm tại code demo
	}
}
