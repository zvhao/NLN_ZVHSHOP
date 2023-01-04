<?php

?>

<div class="grid wide">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active"><?= $data['title'] ?></li>
		</ol>
	</nav>


	<div class="intro-heading">
		<span class="title">Giỏ hàng</span>
	</div>


	<?php
	if (isset($data['detailCart']) && $data['detailCart']) {

	?>
	<div class="section-render">
		<form action="<?= _WEB_ROOT . '/cart/update' ?>" method="POST" class="form-update-cart bg-form-control p-4 border-radius-main border-main">
			<table class="w-100 mb-3 table-render" data-aos="fade-down">
				<thead class="fs-3">
					<tr class="">
						<!-- <th>Mã sản phẩm</th> -->
						<th class="text-center">Ảnh sản phẩm</th>
						<th class="text-center">Tên sản phẩm</th>
						<th class="text-center">Giá sản phẩm</th>
						<th class="text-center">Số lượng</th>
						<th class="text-center" colspan="2">Thành tiền</th>
					</tr>
				</thead>
				<tbody class="fs-4 border-bottom-main border-top-main">

					<?php

					foreach ($data['detailCart'] as $item) {
					?>
						<tr class="">
							<td class="text-center">
								<a href="<?php echo _WEB_ROOT . '/detailproduct/product/'; if(isset($_SESSION['user'])) echo $item['id_pro']; else echo $item['id'];  ?>" title="" class=" m-3">
									<img class="border" width="60px" height="60pxtext-color-main " style="object-fit: cover; object-position: center;" src="<?= _PATH_IMG_PRODUCT . $item['image'] ?>" alt="">
								</a>
							</td>
							<td>
								<a href="<?php echo _WEB_ROOT . '/detailproduct/product/'; if(isset($_SESSION['user'])) echo $item['id_pro']; else echo $item['id'];  ?>" title="" class="name-product text-truncate"><?= $item['name'] ?></a>
							</td>
							<td class="text-end pe-5"><?= numberFormat($item['price']) ?></td>
							<td>
								<input type="number" data-id="<?= $item['id'] ?>" name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" class="num-order" min="1">
							</td>
							<td class=" text-end pe-5" id="sub_total-<?= $item['id'] ?>"><?= numberFormat($item['sub_total']) ?></td>
							<td>
								<a href="<?= _WEB_ROOT .  '/cart/delete_cart?id=' . $item['id']  ?>" title="Xoá sản phẩm" class="del-product"><i class="fa-solid fa-trash-can"></i></a>
							</td>
						</tr>
					<?php
					}
					?>

				</tbody>
			</table>
			<div class="fs-3">

				<p id="total-price" class="d-flex justify-content-end gap-3 fs-2 font">Tổng giá:
					<span class="ml-4 fw-bold" id="total-cart">
						<?php if (isset($data['infoCart'])) {
							echo numberFormat($data['infoCart']['total']);
						}
						?></span>
				</p>


				<div class="row" >
					<div class="col d-flex justify-content-start gap-3" >
						<a href="<?= _WEB_ROOT . '/bill/show_bill' ?>" title="" id="buy-more" class="text-color-main outline-main p-3">Đơn hàng của tôi</a>
						<a href="<?= _WEB_ROOT . '/product/show_product' ?>" title="" id="buy-more" class="text-color-main outline-main p-3">Mua tiếp</a>
					</div>
					<div class="col d-flex justify-content-end gap-3" >
						<button type="submit" name="" id="update-cart" class="outline-main p-3 btn-update-cart">Cập nhật giỏ hàng</button>
						<a href="<?= _WEB_ROOT . '/checkout' ?>" title="" class="fs-3 px-5 btn-main" id="checkout-cart">Thanh toán</a>
					</div>
				</div>

			</div>
		</form>

	</div>

		<div class="section-detail fs-4 mt-3">
			<p class="title">Click vào <span class="text-color-main">“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn vào thanh toán để vào trang thanh toán.</p>
			<!-- <a href="" title="" id="delete-cart">Xóa giỏ hàng</a> -->
		</div>

	<?php

	}
	if (empty($data['detailCart']) && empty($data['detailCart'])) {
		// show_array($data['detailCart']);
	?>
		<span class="fs-3">Không có sản phẩm nào trong giỏ hàng, click <a href="home">vào đây</a> để về trang chủ</span>
	<?php
	}
	?>


</div>