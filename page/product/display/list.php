<?php
include_once '../../../config/connect.php';

$search = $_GET['search'];

$filter_subcategory_id = $_GET['subcategory_id'];
$filter_category_id = $_GET['category_id'];
$filter_min_price = $_GET['min_price'];
$filter_max_price = $_GET['max_price'];
$filter_manifacturer_id = $_GET['manifacturer_id'];

$filter = '';

if ($filter_subcategory_id != 0) {
    if ($filter == '') {
        $filter .= ' WHERE subcategory_id IN (' . $filter_subcategory_id . ')';
    } else {
        $filter .= ' AND subcategory_id IN (' . $filter_subcategory_id . ')';
    }
}
if ($filter_category_id != 0) {
    if ($filter == '') {
        $filter .= ' WHERE category_id IN (' . $filter_category_id . ')';
    } else {
        $filter .= ' AND category_id IN (' . $filter_category_id . ')';
    }
}
if ($filter_max_price != 0) {
    if ($filter_max_price == -1) {
        if ($filter == '') {
            $filter .= ' WHERE price > ' . $filter_min_price;
        } else {
            $filter .= ' AND price > ' . $filter_min_price;
        }
    } else {
        if ($filter == '') {
            $filter .= ' WHERE price BETWEEN ' . $filter_min_price . ' AND ' . $filter_max_price;
        } else {
            $filter .= ' AND price BETWEEN ' . $filter_min_price . ' AND ' . $filter_max_price;
        }
    }
}
if ($filter_manifacturer_id != 0) {
    if ($filter == '') {
        $filter .= ' WHERE manifacturer_id IN (' . $filter_manifacturer_id . ')';
    } else {
        $filter .= ' AND manifacturer_id IN (' . $filter_manifacturer_id . ')';
    }
}

$filter_sort = $_GET['sort'];

$sort = '';

switch ($filter_sort) {
    case 'relevance':
        $sort = ' ORDER BY sold DESC';
        break;
    case 'newest':
        $sort = ' ORDER BY date DESC';
        break;
    case 'oldest':
        $sort = ' ORDER BY date ASC';
        break;
    case 'low-to-high':
        $sort = ' ORDER BY price ASC';
        break;
    case 'high-to-low':
        $sort = ' ORDER BY price DESC';
        break;
}

if ($filter != '') {
    $get_product = get('product', $filter . ' AND product_name LIKE "%' . $search . '%"' . $sort);
} else {
    $get_product = get('product', 'WHERE product_name LIKE "%' . $search . '%"' . $sort);
}

foreach ($get_product as $data) :
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
                    <?php
                    $get_sale = get('sale', 'WHERE product_id=' . $product_id);
                    if (mysqli_num_rows($get_sale) > 0) :
                        $data_sale = mysqli_fetch_assoc($get_sale);
                        $sale = $data_sale['sale'];
                    ?>
                        <span class="ribbon off"><?= $sale ?>%</span>
                    <?php endif ?>
                    <img class="img-fluid lazy pl-4" src="uploads/product/<?= $product_image ?>" alt="product_image" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
                </div>
                <div class="col-9 pl-3 py-4">
                    <div class="row">
                        <div class="col pr-0">
                            <h3><?= $product_name ?></h3>
                            <p class="mt-2 mb-0" style="color:black"><?= $manifacturer_name ?></p>
                        </div>
                        <div class="col-6 pl-0">
                            <div class="text-right pr-4">
                                <?php
                                if (mysqli_num_rows($get_sale) > 0) :
                                    $price_sale = $price - $price * (int)$sale / 100;
                                ?>
                                    <span class="old_price mr-1" style="color:#9d9d9d;"><?= rupiah($price) ?></span>
                                    <span class="new_price" style="font-size:x-large"><?= rupiah($price_sale) ?></span>
                                <?php else : ?>
                                    <span class="new_price" style="font-size:x-large"><?= rupiah($price) ?></span>
                                <?php endif ?>
                                <?php
                                $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
                                $data_product_list = mysqli_fetch_assoc($get_product_list);
                                $count_rating = (int)$data_product_list['count(rating)'];
                                ?>
                                <div>
                                    <?php
                                    if ($count_rating > 0) {
                                        $get_product_list = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
                                        $data_product_list = mysqli_fetch_assoc($get_product_list);

                                        $total_rating = (int)$data_product_list['sum(rating)'];

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
                                        echo '<span class="ml-1" style="color:#9d9d9d">(' . $total_rating . ')</span>';
                                    }
                                    ?>
                                </div>
                                <p style="color:gray;" class="mb-0"><?= $sold ?> sold • 0 discussions</p>
                            </div>
                        </div>
                    </div>
                    <hr class="hr hr-blurry border-5 mt-2 mb-2">
                    <?php
                    $description_array = explode(' ', $description);
                    $description_count = count($description_array);

                    $description_cut = '';

                    if ($description_count > 50) :
                        for ($i = 0; $i < 50; $i++) {
                            $description_cut .= $description_array[$i] . ' ';
                        }
                    ?>
                        <p class="pr-4" style="color:black"><?= $description_cut ?> ...</p>
                    <?php
                    else :
                    ?>
                        <p class="pr-4" style="color:black"><?= $description ?></p>

                    <?php endif ?>
                    <p class="m-0 pr-4" style="color:#9d9d9d; font-size:small;"><?= $category_name ?> > <?= $subcategory_name ?></p>
                    <!-- <a href="">wishlist, add to cart</a> -->
                </div>
            </div>
        </a>
    </li>
<?php
endforeach;

if (mysqli_num_rows($get_product) == 0) :
?>
    <li class="mb-3" style="list-style: none">
        <p class="m-5" style="color: #c1c1c1; font-size:20px">No product found</p>
    </li>
<?php endif ?>