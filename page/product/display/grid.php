<style>
    .sale {
        background-color: #F33;
        color: white;
        font-weight: 450;
        padding: 2px 4px;
        font-size: 11px;
    }
</style>

<?php
include_once '../../../config/connect.php';

$search = $_GET['search'];

$filter_subcategory_id = $_GET['subcategory_id'];
$filter_category_id = $_GET['category_id'];
$filter_min_price = $_GET['min_price'];
$filter_max_price = $_GET['max_price'];
$filter_manifacturer_id = $_GET['manifacturer_id'];

$where = 'WHERE ';

if ($filter_subcategory_id != 0) {
    if ($where == 'WHERE ') {
        $where .= 'subcategory_id IN (' . $filter_subcategory_id . ')';
    } else {
        $where .= ' AND subcategory_id IN (' . $filter_subcategory_id . ')';
    }
}
if ($filter_category_id != 0) {
    if ($where == 'WHERE ') {
        $where .= 'category_id IN (' . $filter_category_id . ')';
    } else {
        $where .= ' AND category_id IN (' . $filter_category_id . ')';
    }
}
if ($filter_max_price != 0) {
    if ($filter_max_price == -1) {
        if ($where == 'WHERE ') {
            $where .= 'price > ' . $filter_min_price;
        } else {
            $where .= ' AND price > ' . $filter_min_price;
        }
    } else {
        if ($where == 'WHERE ') {
            $where .= 'price BETWEEN ' . $filter_min_price . ' AND ' . $filter_max_price;
        } else {
            $where .= ' AND price BETWEEN ' . $filter_min_price . ' AND ' . $filter_max_price;
        }
    }
}
if ($filter_manifacturer_id != 0) {
    if ($where == 'WHERE ') {
        $where .= 'manifacturer_id IN (' . $filter_manifacturer_id . ')';
    } else {
        $where .= ' AND manifacturer_id IN (' . $filter_manifacturer_id . ')';
    }
}

if ($where != 'WHERE ') {
    $result = get('product', $where . ' AND product_name LIKE "%' . $search . '%"');
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
    <a href="index.php?page=product_view&product_id=<?= $product_id ?>">
        <div style="float:left; width:178px; height:330px" class="shadow m-1">
            <img class="px-3 pt-3" src="uploads/product/<?= $product_image ?>" alt="product_image" style="width:178px; height:178px; object-fit:scale-down;">
            <div class="m-3">
                <?php
                $product_name_array = explode(' ', $product_name);
                $product_name_count = count($product_name_array);

                $product_name_cut = '';
                if ($product_name_count > 5) :
                    for ($i = 0; $i < 5; $i++) {
                        $product_name_cut .= $product_name_array[$i] . ' ';
                    }
                ?>
                    <h5 class="mb-1" style="font-size:13pt"><?= $product_name_cut ?>...</h5>
                <?php else : ?>
                    <h5 class="mb-1" style="font-size:13pt"><?= $product_name ?></h5>
                <?php endif ?>
                <?php
                $get_sale = get('sale', 'WHERE product_id=' . $product_id);
                if (mysqli_num_rows($get_sale) > 0) :
                    $data_sale = mysqli_fetch_assoc($get_sale);
                    $sale = $data_sale['sale'];
                    $price_sale = $price - $price * (int)$sale / 100;
                ?>
                    <span class="sale"><?= $sale ?>%</span>
                    <span class="old_price mb-1" style="font-size:10pt; color:#9d9d9d;"><?= rupiah($price) ?></span>
                    <span class="new_price mb-1" style="font-weight:500; font-size:13pt"><?= rupiah($price_sale) ?></span>
                <?php else : ?>
                    <span class="new_price mb-1" style="font-weight:500; font-size:13pt"><?= rupiah($price) ?></span>
                <?php endif ?>
                <?php
                $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
                $data_product_list = mysqli_fetch_assoc($get_product_list);
                $total_rating = (int)$data_product_list['sum(rating)'];

                $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
                $data_product_list = mysqli_fetch_assoc($get_product_list);
                $count_rating = (int)$data_product_list['count(rating)'];
                ?>
                <div class="mb-3">
                    <?php
                    if ($count_rating > 0) :
                        $average_rating = round($total_rating / $count_rating);

                        for ($i = $average_rating; $i > 0; $i--) {
                            echo '<i class="icon-star voted m-0" style="color:#fec348"></i>';
                        }
                    endif;
                    if ($count_rating == 0) :
                    ?>
                        <i style="color:#9d9d9d">No review</i>
                        <?php else :
                        $n = 5 - $average_rating;
                        for ($i = $n; $i > 0; $i--) :
                        ?>
                            <i class="icon-star m-0" style="color:#cccccc"></i>
                        <?php endfor ?>
                        <span style="font-size:small; color:#9d9d9d">(<?= $total_rating ?>)</span>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </a>
<?php
endforeach;

if (mysqli_num_rows($result) == 0) :
?>
    <li class="mb-3" style="list-style: none">
        <p class="m-5" style="color: #c1c1c1; font-size:20px">No product found</p>
    </li>
<?php endif ?>