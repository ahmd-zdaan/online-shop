<?php
include_once '../../../config/connect.php';

$search = $_GET['search'];

$filter_subcategory_id = $_GET['subcategory_id'];
$filter_category_id = $_GET['category_id'];

$filter_min_price = $_GET['min_price'];
$filter_max_price = $_GET['max_price'];

$filter_manifacturer_id = $_GET['manifacturer_id'];

if ($filter_subcategory_id != 0) {
    $where = 'WHERE subcategory_id IN (' . $filter_subcategory_id . ')';
} elseif ($filter_category_id != 0) {
    $where = 'WHERE category_id IN (' . $filter_category_id . ')';
} elseif ($filter_max_price != 0) {
    if ($filter_max_price == -1) {
        $where = 'WHERE price > ' . $filter_min_price;
    } else {
        $where = 'WHERE price BETWEEN ' . $filter_min_price . ' AND ' . $filter_max_price;
    }
} elseif ($filter_manifacturer_id != 0) {
    $where = 'WHERE manifacturer_id IN (' . $filter_manifacturer_id . ')';
}

// belum bisa gabung dengan category/subcategory
// cek langsung dari produk, produk yang diskon tidak terdeteksi
if (isset($where)) {
    $result = get('product', $where . ' AND product_name LIKE "%' . $search . '%"');
    // $result = get('product WHERE manifacturer_id IN (' . $filter_manifacturer_id . ')');
} else {
    $result = get('product', 'WHERE product_name LIKE "%' . $search . '%"');
}

foreach ($result as $data) :
    $product_id = $data['product_id'];
    $product_name = $data['product_name'];
    $price = $data['price'];
    $sold = $data['sold'];
    $description = $data['description'];

    $category_id = $data['category_id'];
    $result_category = get('category', 'WHERE category_id=' . $category_id);
    $data_category = mysqli_fetch_assoc($result_category);
    $category_name = $data_category['category_name'];

    $subcategory_id = $data['subcategory_id'];
    $result_subcategory = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
    $data_subcategory = mysqli_fetch_assoc($result_subcategory);
    $subcategory_name = $data_subcategory['subcategory_name'];

    $manifacturer_id = $data['manifacturer_id'];
    $result_manifacturer = get('manifacturer', 'WHERE manifacturer_id=' . $manifacturer_id);
    $data_manifacturer = mysqli_fetch_assoc($result_manifacturer);
    $manifacturer_name = $data_manifacturer['manifacturer_name'];

    $get_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
    if (mysqli_num_rows($get_image) > 0) {
        $data_image = mysqli_fetch_assoc($get_image);

        $product_image = $data_image['image_name'];
    } else {
        $product_image = "default.jpg";
    }
?>
    <li class="shadow mb-3" style="list-style: none">
        <a href="index.php?page=product_view&product_id=<?= $product_id ?>">
            <div class="row">
                <div class="col">
                    <img class="img-fluid lazy" src="uploads/product/<?= $product_image ?>" alt="product_image" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
                </div>
                <div class="col-9 pl-4">
                    <div class="row">
                        <div class="col pr-0">
                            <h3 class="mt-4"><?= $product_name ?></h3>
                            <p class="mt-2 mb-0" style="color:black"><?= $manifacturer_name ?></p>
                        </div>
                        <div class="col-6 pl-0">
                            <div class="mt-5 text-right pr-4">
                                <?php
                                $get_sale = get('sale', 'WHERE product_id=' . $product_id);
                                if (mysqli_num_rows($get_sale) > 0) :
                                    $data_sale = mysqli_fetch_assoc($get_sale);
                                    $sale = $data_sale['sale'];
                                    $price_sale = $price - $price * (int)$sale / 100;
                                ?>
                                    <span class="old_price mr-1" style="color:#9d9d9d;"><?= rupiah($price) ?></span>
                                    <span class="new_price" style="font-size:x-large"><?= rupiah($price_sale) ?></span>
                                <?php else : ?>
                                    <span class="new_price" style="font-size:x-large"><?= rupiah($price) ?></span>
                                <?php endif ?>
                                <?php
                                $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
                                $data_product_list = mysqli_fetch_assoc($get_product_list);
                                $total_rating = (int)$data_product_list['sum(rating)'];

                                $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
                                $data_product_list = mysqli_fetch_assoc($get_product_list);
                                $count_rating = (int)$data_product_list['count(rating)'];
                                ?>
                                <div>
                                    <?php
                                    if ($count_rating > 0) {
                                        $average_rating = round($total_rating / $count_rating);

                                        for ($i = $average_rating; $i > 0; $i--) {
                                            echo '<i class="icon-star voted" style="color:#fec348"></i>';
                                        }
                                    }
                                    if ($count_rating == 0) {
                                        echo '<p class="mb-1" style="color:#9d9d9d">No review</p>';
                                    } else {
                                        $n = 5 - $average_rating;
                                        for ($i = $n; $i > 0; $i--) {
                                            echo '<i class="icon-star" style="color:#cccccc"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <p style="color:#9d9d9d;" class="mb-0"><?= $sold ?> sold • 0 discussions</p>
                            </div>
                        </div>
                    </div>
                    <hr class="hr hr-blurry border-5 mt-2 mb-2">
                    <!-- <b class="m-0" style="font-size:smaller; color:black">Description</b> -->
                    <?php
                    $desc_array = explode(' ', $description);
                    $desc_count = count($desc_array);

                    $desc_cut = '';

                    if ($desc_count > 50) :
                        for ($i = 0; $i < 50; $i++) {
                            $desc_cut .= $desc_array[$i] . ' ';
                        }
                    ?>
                        <p style="color:black"><?= $desc_cut ?> ...</p>
                    <?php
                    else :
                    ?>
                        <p style="color:black"><?= $description ?></p>

                    <?php endif ?>
                    <p style="color:#9d9d9d; font-size:small;"><?= $category_name ?> > <?= $subcategory_name ?></p>
                </div>
            </div>
        </a>
    </li>
<?php
endforeach;

if (mysqli_num_rows($result) == 0) :
?>
    <li class="mb-3" style="list-style: none">
        <p class="m-5" style="color: #c1c1c1; font-size:20px">No product found</p>
    </li>
<?php endif ?>