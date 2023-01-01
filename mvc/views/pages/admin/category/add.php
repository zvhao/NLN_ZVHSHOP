<?php
if (!empty($data['msg'])) {
    echo '<div class="alert alert-' . $data['type'] . '">' . $data['msg'] . '</div>';
}
?>
<form method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" name="categoryname" placeholder="Tên danh mục" required>
    </div>
    <input type="hidden" name="add_category" value="add_category">
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>