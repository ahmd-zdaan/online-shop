<?php
include_once '../../../config/connect.php';

$filter_category_id = $_GET['category_id'];
$result = get('product', 'WHERE category_id=' . $filter_category_id);

foreach ($result as $data) :
    $product_id = $data['product_id'];
    $product_name = $data['product_name'];
    $price = $data['price'];
?>
    <div class="col-6 col-md-4">
        <div class="grid_item">
            <!-- <span class="ribbon off">-30%</span> -->
            <!-- <figure>
											<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
												<img class="img-fluid lazy" src="<?= $image ?>/1.png" alt="">
											</a>
											<div data-countdown="2019/05/15" class="countdown"></div>
										</figure> -->
            <a href="index.php?page=product_view&product_id=<?= $product_id ?>">
                <!-- <img class="img-fluid lazy" src="https://unsplash.it/50/50" alt="" width="100%"> -->
                <img class="img-fluid lazy" src="" alt="image" width="100%">
                <div>
                    <h3><?= $product_name ?></h3>
                </div>
                <div class="price_box">
                    <span class="new_price">Rp<?= $price ?></span>
                    <!-- <span class="old_price">$60.00</span> -->
                </div>
            </a>
            <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                <!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
            </ul>
        </div>
    </div>
<?php
endforeach;

if (mysqli_num_rows($result) < 1) :
?>
    <li class="mb-3" style="list-style: none">
        <p>Produk tidak ditemukan</p>
    </li>
<?php endif ?>