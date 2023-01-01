<a href="<?php echo _WEB_ROOT . '/category/add_category' ?>" class="btn btn-primary mb-2">Thêm danh mục sản phẩm</a>
<div class="mb-3">
    <form action="<?= _WEB_ROOT . '/category' ?>" method="get">
        <input type="text" class="form-control" placeholder="Tìm kiếm danh mục sản phẩm" name="search" value="<?= $data['keyword'] ?>">
    </form>
</div>

<?php
if (!empty($_SESSION['msg'])) {
    echo '<div class="alert alert-success" id="toast-success">' . $_SESSION['msg'] . '</div>';
    $_SESSION['msg'] = '';
}
?>

<table class="table table-striped table_category">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">TÊN DANH MỤC</th>
            <th scope="col">SỐ SẢN PHẨM</th>
            <th scope="col">THỜI GIAN TẠO</th>
            <th class="text-center" scope="col">SỬA</th>
            <th class="text-center" scope="col">XOÁ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['categories'])) {
            foreach ($data['categories'] as $category) {
        ?>
                <tr>
                    <th scope="row"><?php echo $category['id'] ?></th>
                    <td><?php echo $category['name'] ?></td>
                    <th scope="row"><?php
                    echo $data['getAllCl'][$category['id']-1]['count_cate'];
                    ?></th>
                    <td><?php echo $category['created_at'] ?></td>
                    <td class="text-center"><a class="btn btn-outline-primary" href="<?php echo _WEB_ROOT . '/category/update_category/' . $category['id'] ?>"><i class="far fa-edit"></i></a></td>
                    <td class="text-center"><a class="handle_delete btn btn-outline-danger" href="<?php echo _WEB_ROOT . '/category/delete_category/' . $category['id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a></td>
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