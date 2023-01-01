<?php
class ProductModel extends DB
{
    function getAll($keyword = '', $id = 0, $cate_id = 0)
    {
        $select = "SELECT * FROM products WHERE 1";
        if (!empty($keyword)) {
            $select .= " AND  name like '%" . $keyword . "%'";
        }

        if ($id > 0) {
            $select .= " AND id <> $id";
        }
        if ($cate_id > 0) {
            $select .= " AND cate_id = $cate_id";
        }
        $select .= " ORDER BY id DESC";
        return $this->pdo_query($select);
    }

    function countProduct() {
        return $this->pdo_query_value('SELECT count(*) FROM products');
    }

    function SelectProByPage($start, $num_per_page, $keyword = '', $id = 0, $cate_id = 0) {
        $select = "SELECT * FROM products ";
        if (!empty($keyword)) {
            $select .= " WHERE  name like '%" . $keyword . "%'";
        }

        if ($id > 0) {
            $select .= " WHERE id <> $id";
        }
        if ($cate_id > 0) {
            $select .= " WHERE cate_id = $cate_id";
        }
        $select .= "  ORDER BY id DESC LIMIT $start, $num_per_page";
        return $this->pdo_query($select);
    }

    function getNewProduct($cate_id = 0){
        $select = "SELECT * from products WHERE 1 order by created_at DESC";
        return $this->pdo_query($select);
    }

    function insertPro($name, $image, $cate_id, $price, $desc, $created_at)
    {
        $pro = "INSERT INTO products(name, image, cate_id, price, description, created_at) VALUES('$name', '$image', '$cate_id','$price', '$desc', '$created_at')";
        return $this->pdo_execute_lastInsertID($pro);
    }

    function addImageProduct($productId, $image, $created_at)
    {
        $insert = "INSERT INTO img_product(product_id, image, created_at) VALUES('$productId', '$image', '$created_at')";
        return $this->pdo_execute($insert);
    }

    function deletePro($id)
    {
        $delete_img = "DELETE FROM img_product WHERE product_id = '$id'";
        $delete = "DELETE FROM products WHERE id = '$id'";
        $this->pdo_execute($delete_img);
        return $this->pdo_execute($delete);
    }

    function SelectProduct($id)
    {
        $select = "SELECT * FROM products WHERE id = '$id'";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }





    function SelectProductImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id'";
        if ($this->pdo_query($select)) {
            return $this->pdo_query($select);
        } else {
            return [];
        }
    }

    function updateProduct($id, $name, $image, $cate_id, $price, $desc, $updated_at)
    {
        if (empty($image)) {
            $update = "UPDATE products SET name = '$name', cate_id = '$cate_id', price = '$price', description = '$desc', updated_at = '$updated_at' WHERE id = '$id'";
        } else {
            $update = "UPDATE products SET name = '$name', image = '$image', cate_id = '$cate_id', price = '$price', description = '$desc', updated_at = '$updated_at' WHERE id = '$id'";
        }
        return $this->pdo_execute($update);
    }

    function deleteImgPro($id)
    {
        $delete = "DELETE FROM img_product WHERE product_id = '$id'";
        return $this->pdo_execute($delete);
    }

    function updateImgProduct($productId, $image, $updated_at)
    {
        $update = "UPDATE img_product SET image = '$image', updated_at = '$updated_at' WHERE product_id = '$productId'";
        return $this->pdo_execute($update);
    }

    function getTrendPro()
    {
        $pro = "SELECT * FROM products ORDER BY view DESC LIMIT 3 ";
        return $this->pdo_query($pro);
    }

    function getTrendProImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id' LIMIT 1";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }

    function getProImg($id)
    {
        $select = "SELECT * FROM img_product WHERE product_id = '$id'";
        if ($this->pdo_query_one($select)) {
            return $this->pdo_query_one($select);
        } else {
            return [];
        }
    }

    function addCart($id) {
        
        
        // return $this->pdo_query_one($select);
        $select = "SELECT * FROM products WHERE id = '$id'";
        $qty = 1;
        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
        }
        $product = $this->pdo_query_one($select);
        // show_array($product);
        $_SESSION['cart']['buy'][$id] = array(
            'id' => $product['id'],
            'image' => $product['image'],
            'name' => $product['name'],
            'price' => $product['price'],
            'qty' => $qty,
            
            'sub_total' => $product['price'] * $qty,
        );
        

    }

    public function updateRating($id, $totalRating)
    {
        $sql = "UPDATE products SET total_rating = '$totalRating' WHERE id = '$id'";
        return $this->pdo_execute($sql);
    }

    public function getOneRating($id) {
        $select = "SELECT total_rating FROM products WHERE id = '$id'";
        return $this->pdo_query_value($select);
    }


}
