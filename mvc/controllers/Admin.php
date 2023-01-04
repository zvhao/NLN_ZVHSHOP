<?php

class Admin extends Controller
{
    private $products;
    private $categories;
    private $users;
    private $cart;
    private $bills;
    
    function __construct()
    {
        $this->users = $this->model('UserModel');
        $this->products = $this->model('ProductModel');
        $this->categories = $this->model('CategoryModel');
        $this->bills = $this->model('BillModel');
    }

    function index()
    {
        $countUser = count($this->users->getAll());
        $countCate = count($this->categories->getAllCl());
        $countPro = count($this->products->getAll());
        $countBill = count($this->bills->getAllBill());
        $sumBill = $this->bills->sumBill();
        $sumDetailBill = $this->bills->sumDetailBill();
        // show_array($sumDetailBill);

        return $this->view('admin', [
            'title' => 'QUẢN LÝ',
            'page' => 'manager/list',
            'countUser' => $countUser,
            'countCate' => $countCate,
            'countPro' => $countPro,
            'countBill' => $countBill,
            'sumBill' => $sumBill,
            'sumDetailBill' => $sumDetailBill,
        ]);
    }

    function statistical()
    {
        $dateStart = '2000-01-01 00:00:01';
        $dateEnd = date("Y-m-d H:i:s");
        $id = 0;

        if (isset($_POST['btn-statistical'])) {
            if ($_POST['date_start'] > date("Y-m-d") || $_POST['date_end'] > date("Y-m-d")) {
                $_SESSION['msg'] = 'Vui lòng nhập ngày không lớn hơn ngày hiện tại!';
            } else if (strtotime($_POST['date_start']) > strtotime($_POST['date_end'])) {
                $_SESSION['msg'] = 'Vui lòng nhập ngày bắt đầu nhỏ hơn ngày kết thúc!';
            } else {
                $dateStart = $_POST['date_start'];
                if ($_POST['date_end'] == date("Y-m-d"))
                    $dateEnd = date("Y-m-d H:i:s");
                else $dateEnd = $_POST['date_end'];
                unset($_SESSION['msg']);
            }
        }

        // $id = $_SESSION['idDetailBill'];

        $sumBillStatistical = $this->bills->sumBillStatistical($dateStart, $dateEnd);
        $countBillStatistical = $this->bills->countBillStatistical($dateStart, $dateEnd);
        $BillStatistical = $this->bills->BillStatistical($dateStart, $dateEnd);
        $detailBillStatistical = $this->bills->detailBillStatistical($id);
        // show_array($BillStatistical);
        $billsNew = [];
        foreach ($BillStatistical as $bill) {
            $bill['detail'] = $this->bills->getDetailBill($bill['id']);
            if ($bill['user_id'] > 0) {
                $bill['email_user'] = $this->users->SelectUser($bill['user_id'])['email'];
                $bill['name_user'] = $this->users->SelectUser($bill['user_id'])['name'];
            } else {
                $bill['email_user'] = '';
                $bill['name_user'] = '';
                $bill['user_id'] = 'Không có tài khoản';
            }
            array_push($billsNew, $bill);
        }



        return $this->view('admin', [
            'title' => 'THỐNG KÊ DOANH THU',
            'page' => 'manager/statistical',
            'sumBillStatistical' => $sumBillStatistical,
            'countBillStatistical' => $countBillStatistical,
            'billsNew' => $billsNew,
            'detailBillStatistical' => $detailBillStatistical,
        ]);
    }
}
