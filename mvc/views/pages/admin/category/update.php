<?php
if(!empty($data['msg'])) {
    echo '<div class="alert alert-'.$data['type'].'">'.$data['msg'].'</div>';
}
?>
<form method="POST">
  <div class="mb-3">
    <label for="" class="form-label">Tên danh mục</label>
    <input type="text" class="form-control" name="categoryname" placeholder="Tên danh mục" value="<?php echo $data['category']['name'] ?>">
  </div>
  <input type="hidden" name="update_category" value="update_category">
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>