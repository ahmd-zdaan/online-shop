<?php
include_once '../../../config/connect.php';

$filter_subcategory_id = $_GET['subcategory_id'];
$filter_category_id = $_GET['category_id'];
$where = ($filter_subcategory_id != 0) ? 'WHERE subcategory_id IN (' . $filter_subcategory_id . ')' : 'WHERE category_id IN (' . $filter_category_id . ')';

if ($filter_category_id == 0 and $filter_subcategory_id == 0) {
    $result = get('product');
} else {
    $result = get('product', $where);
}

foreach ($result as $data) :
    $product_id = $data['product_id'];
    $product_name = $data['product_name'];
    $price = $data['price'];
    $description = $data['description'];

    $category_id = $data['category_id'];
    $result_category = get('category', 'WHERE category_id=' . $category_id);
    $data = mysqli_fetch_assoc($result_category);
    $category_name = $data['category_name'];

    $result_image = get('product_image', 'WHERE product_id=' . $product_id);
    $data_image = mysqli_fetch_assoc($result_image);

    // product image default nggak muncul
    if (mysqli_num_rows($result_image) > 0) {
        $product_image = $data_image['image_name'];
    } else {
        $product_image = "default.jpg";
    }
?>
    <li class="mb-3" style="list-style: none">
        <a href="index.php?page=product_view&product_id=<?= $product_id ?>">
            <div class="row">
                <div class="col-3">
                    <img class="img-fluid lazy" src="uploads/<?= $product_image ?>" alt="product_image" width="100%">
                </div>
                <div class="col">
                    <h3><?= $product_name ?></h3>
                    <div class="price_box">
                        <span class="new_price">Rp<?= $price ?></span>
                    </div>
                    <br>
                    <p><?= $description ?></p>
                    <p><?= $category_name ?></p>
                </div>
            </div>
        </a>
    </li>
<?php
endforeach;

if (mysqli_num_rows($result) == 0) :
?>
    <li class="mb-3" style="list-style: none">
        <p>Produk tidak ditemukan</p>
    </li>
<?php endif ?>