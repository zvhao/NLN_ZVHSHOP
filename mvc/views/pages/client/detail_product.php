

<div class="grid wide">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/home' ?>">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/product/show_product' ?>">Sản phẩm</a></li>
            <?php
            // show_array($data['nameCate']);
            ?>
            <li class="breadcrumb-item"><a href="<?= _WEB_ROOT . '/product/show_product?cate=' . $data['product']['cate_id'] ?>"><?php echo getNameCate($data['product']['cate_id'])['name'] ?></a></li>

            <li class="breadcrumb-item "><?= $data['product']['name'] ?></li>
        </ol>
    </nav>

    <div class="detail-product">
        <?php
        ?>
        <div class="info-product row">
            <div class="left-product col-5 d-flex" data-aos="fade-right">
                <div thumbsSlider="" class="col-3 swiper mySwiper">
                    <div class="swiper-wrapper d-flex">
                        <div class="swiper-slide swiper-slide-l">
                            <img class="w-100" style="width: 120px; height: 120px; max-width: 100%; object-fit: cover; object-position: center;" src="<?= _PATH_IMG_PRODUCT . $data['product']['image'] ?>" />
                        </div>
                        <?php
                        if (isset($data['img_product']) && $data['img_product'] != '') {
                            foreach ($data['img_product'] as $img_product) {
                        ?>
                                <div class="swiper-slide swiper-slide-l">
                                    <img class="w-100" style="width: 120px; height: 120px; max-width: 100%; object-fit: cover; object-position: center;" src="<?= _PATH_IMG_PRODUCT . $img_product['image'] ?>" />

                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="col-9 swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide swiper-slide-r">
                            <img class="col w-100" style="width: 330px; height: 400px; max-width: 100%; object-fit: cover; object-position: center;" src="<?php echo _PATH_IMG_PRODUCT . $data['product']['image'] ?>" alt="">
                        </div>
                        <?php
                        if (isset($data['img_product']) && $data['img_product'] != '') {
                            foreach ($data['img_product'] as $item) {
                        ?>
                                <div class="swiper-slide swiper-slide-r">
                                    <img class="col w-100" style="width: 330px; height: 330px; max-width: 100%; object-fit: cover; object-position: center;" src="<?php echo _PATH_IMG_PRODUCT . $item['image'] ?>" alt="">

                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>


            </div>
            <div class="right-product col-7" data-aos="fade-left">

                <form class="form-add-to-cart" action="<?= _WEB_ROOT . '/cart/add_cart?id=' . $data['product']['id'] ?>" method="post">

                    <p class="title-product"><?= $data['product']['name'] ?></p>
                    <p class="code-product">Mã sản phẩm:
                        <span><?= $data['product']['id'] ?></span>
                    </p>
                    <p class="price-product"><?php numberFormat($data['product']['price']) ?></p>
                    <div class="num-order-product">
                        <span>Số lượng:</span>
                        <input type="number" name="num_order" value="1" min="1" class="num-order mb-3 ">
                        <p><input type="submit" name="add-to-cart" href="" title="" class="add-to-cart mt-3" value="Thêm vào giỏ hàng"></p>

                </form>
            </div>
        </div>




    </div>
    <div class="content-detail">
        <p class="mb-5 heading-detail-section">CHI TIẾT SẢN PHẨM</p>
        <div class="desc-short-product" style="height: auto; overflow: hidden;">
            <p><?= $data['product']['description'] ?></p>
        </div>
    </div>


    <div class="" style="text-align: center;margin: 20px 0 40px 0;">
        <button type="button" class="btn btn-outline-primary border-radius-main p-3" style="width: 100px; font-size: 1.4rem" id="btn1">Thu Gọn</button>
        <button type="button" class="btn btn-outline-primary border-radius-main p-3" style="width: 100px; font-size: 1.4rem" id="btn2">Xem thêm</button>
    </div>


    <div class="comment-detail-product">
        <p class="mb-5 heading-detail-section">ĐÁNH GIÁ SẢN PHẨM</p>
        <div class="row">
            <div class="col-3 fs-2">
                <p class="mb-0 text-color-main text-center lh-1"><span style="font-size: 4rem;"><?= $data['avgRating'] ?></span> trên 5</p>
                <p class="icon-main text-center">
                    <?= getRatingStarRound($data['avgRating']) ?>
                </p>
            </div>
            <div class="col-9">

            </div>
            <hr>
        </div>
        <div class="comments p-3">

            <form action="<?= _WEB_ROOT . '/comment/add_comment' ?>" method="post" class="form-comment row">

                <div class="col-1">
                    <img class="rounded-circle" src="<?php if (!empty($_SESSION['user']['avatar'])) {
                                                            echo _PATH_AVATAR . $_SESSION['user']['avatar'];
                                                        } else echo _PATH_IMG_PUBLIC . '/profile.jpg'; ?>" alt="" style="width: 60px; height: 60px; max-width: 100%; object-fit: cover; object-position: center; margin-bottom: 5px;">

                </div>
                <fieldset class="col-11 font-size-14 mb-5"  >
                    <div class="icon-detail">
                        <span class="fs-4">Chất lượng sản phẩm:</span>
                        <div class="rating">
                            <label>
                                <input type="radio" name="stars" class="d-none" value="5" />
                                <i class="icon-rating text-color-main icon fa-star fa-solid"></i>

                                <i class="icon-rating text-color-main icon fa-star fa-solid"></i>

                                <i class="icon-rating text-color-main icon fa-star fa-solid"></i>

                                <i class="icon-rating text-color-main icon fa-star fa-solid"></i>

                                <i class="icon-rating text-color-main icon fa-star fa-solid"></i>

                            </label>
                        </div>
                    </div>
                    <div class="d-flex align-items-end">
                        <textarea name="comment" class="form-control w-75 me-5" rows="3" placeholder="<?php if (isset($_SESSION['msg_check_is_buy'])) echo $_SESSION['msg_check_is_buy'] ?>"></textarea>
                        <input type="hidden" name="id_user" value="<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>">
                        <input type="hidden" name="id_pro" value="<?= $data['product']['id'] ?>">
                        <button type="submit" name="btn_submit" class="btn btn-main border-radius-main py-3" style="width: 80px; font-size: 1.4rem" value="yes">GỬI</button>
                    </div>
                </fieldset>
            </form>

            <div class="table-comments">
                <?php
                if (isset($data['comments']) && $data['comments']) {
                    foreach ($data['comments'] as $item) {
                ?>
                        <div class="detail-comment">
                            <div class="row header-detail-comment">
                                <div class="col-1">
                                    <img class=" rounded-circle" src="<?php if (!empty($item['avatar'])) {
                                                                            echo _PATH_AVATAR . $item['avatar'];
                                                                        } else echo _PATH_IMG_PUBLIC . '/profile.jpg'; ?> ?> " alt="" style="width: 60px; height: 60px; max-width: 100%; object-fit: cover; object-position: center; margin-bottom: 5px;">
                                </div>
                                <div class="col-11 ">
                                    <span class="fs-3" style="white-space: nowrap;"><?= $item['name'] ?></span>
                                    <p class="icon-detail">
                                        <?php getRatingStar($item['rating']) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row content-detail-comment font-size-14">
                                <div class="col-1"></div>
                                <div class="col-11">
                                    <p class="" style="color: #666"><?= $item['created_at'] ?></p>
                                    <p class=""><?= $item['comment'] ?></p>
                                </div>
                            </div>
                            <hr>
                        </div>

                <?php
                    }
                }
                ?>

            </div>




        </div>

    </div>

</div>
