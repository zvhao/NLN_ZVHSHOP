<a href="<?php echo _WEB_ROOT . '/group/add_group' ?>" class="btn btn-primary mb-2">Thêm Nhóm người dùng</a>

<div class="mb-3">
    <form action="<?= _WEB_ROOT . '/group' ?>" method="get">
        <input type="text" class="form-control" placeholder="Tìm kiếm nhóm người dùng" name="search" value="<?= $data['keyword'] ?>">
    </form>
</div>


<?php
if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
?>
    <div class="alert alert-success"><?php echo  $_SESSION['msg'] ?></div>
<?php
    $_SESSION['msg'] = '';
}
?>

<table class="table table-striped table_group">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NHÓM NGƯỜI DÙNG</th>
            <th scope="col">THỜI GIAN TẠO</th>
            <th scope="col">THỜI GIAN CẬP NHẬT</th>
            <th scope="col">SỬA</th>
            <th scope="col">XOÁ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['groups'])) {
            foreach ($data['groups'] as $group) {
        ?>
                <tr>
                    <td><?= $group['id'] ?></td>
                    <td><?= $group['name'] ?></td>
                    <td><?= $group['created_at'] ?></td>
                    <td><?= $group['updated_at'] ?></td>
                    <td>
                        <a href="<?= _WEB_ROOT . '/group/update_group/' . $group['id'] ?>" class="btn-outline-primary btn rounded">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a class="handle_delete btn-outline-danger btn round" href="<?php echo _WEB_ROOT . '/group/delete_group/' . $group['id'] ?>">
                            <i class="fas fa-user-times"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" class="text-center">KHÔNG CÓ DỮ LIỆU</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>