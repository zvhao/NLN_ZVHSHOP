<?php

function getMethodPayment($method) {
	if($method == 'payment-cod') {
		$msg = "<p class='text-end'> Bạn sẽ được thanh toán khi nhận hàng </p>";
	}
	else if($method == 'payment-bank') {
		$msg = "<div class=' d-flex w-auto justify-content-end'>
		<p class='fs-4 border-main p-3'>Ngân hàng <b>Vietinbank</b> <br>
			Số TK: <b>109869594957</b> <br>
			Chủ TK: <b>Nguyễn Văn Hào</b> <br>
			Nội dung chuyển khoản: Tên + Số ĐT đặt hàng</p>
	</div>";
	} else if($method == 'payment-bank') {
		$msg = "<p>Bạn đã thanh toán thành công bằng ví điện tử</p>";
	}
	return $msg;
}