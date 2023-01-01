<?php
if (!empty($data['msg'])) {
    echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>

<form method="POST" action="<?php echo _WEB_ROOT . '/product/add_product' ?>" enctype="multipart/form-data" class="pb-4">
    <div class="grid-cols-12 grid gap-4">
        <div class="row">
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                <input required type="text" class="form-control" name="productname" placeholder="Tên sản phẩm">
            </div>
            <div class="mb-3 col">
                <label for="exampleInputEmail1" class="form-label">Danh mục</label><br>
                <select name="category" id="category" class="custom-select" required>
                    <option>Lựa chọn....</option>
                    <?php
                    foreach ($data['categories'] as $category) {
                    ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class=" col" id="image-upload">
                <label for="image" class="form-label flex flex-col justify-center" id="upload-img">
                    <span>Ảnh sản phẩm</span>
                    <!-- <div class="flex items-center gap-3mt-2 px-2 py-1 rounded border">
                        <img src="<?php echo _PUBLIC . '/client/assets/image/image_upload.png' ?>" alt="" class="w-7">
                        <span>
                            Tải ảnh lên
                        </span>
                    </div> -->
                </label>
                <input required type="file" id="image" class="form-control hidden" name="product" onchange="readURL(this);"><br>
            </div>
            <div class=" col " id="images-upload">
                <label for="image-multiple" class="form-label flex flex-col justify-center" id="upload-imgs">
                    <span>Các ảnh khác</span>
                    <!-- <div class="flex items-center gap-3 mt-2 px-2 py-1 rounded border">
                        <img src="<?php echo _PUBLIC . '/client/assets/image/image_upload.png' ?>" alt="" class="w-7">
                        <span>
                            Tải ảnh lên
                        </span>
                    </div> -->
                </label>
                <input type="file" id="image-multiple" multiple class="form-control hidden" name="detail_image[]"><br>
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Giá</label>
            <input required type="text" class="form-control" name="price" placeholder="Ví dụ: 2300000">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mô tả</label>
            <textarea rows="4" type="text" class="form-control" name="description" placeholder="Mô tả"></textarea>
        </div>






    </div>
    <input type="hidden" name="add_product" value="add_product">
    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>