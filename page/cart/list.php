<?php
check('login');

$email = $_SESSION['email'];
$result = get('user', 'WHERE email="' . $email . '"');
$data = mysqli_fetch_assoc($result);
$user_id = $data['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/bootstrap.custom.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/cart.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<style>
	.products_carousel .owl-item {
		width: 190px !important;
	}

	.owl-item img {
		width: 190px;
		height: 190px;
		object-fit: scale-down;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Cart</a></li>
						</ul>
					</div>
					<h1>
						<a href="index.php" style="color:black">
							<i class="ti-angle-left" style="font-weight:bold; font-size:11pt"></i>
						</a>
						Your Cart
					</h1>
				</div>
				<?php
				$get_cart = get('cart', 'WHERE user_id=' . $user_id);
				if (mysqli_num_rows($get_cart) > 0) :
					$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,SUM(quantity) AS total_quantity');
				?>
					<div>
						<table class="table table-striped cart-list">
							<thead>
								<tr>
									<th>
										Product
									</th>
									<th>
										Price
									</th>
									<th style="width:100px">
										Quantity
									</th>
									<th>
										Subtotal
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$subtotal_price = 0;
								$checkout = [];
								$i = 0;

								foreach ($get_cart as $data_cart) :
									$product_id = $data_cart['product_id'];
									$cart_id = $data_cart['cart_id'];
									$quantity = $data_cart['quantity'];
									$total_quantity = $data_cart['total_quantity'];

									$result = get('product', 'WHERE product_id=' . $product_id);
									$data = mysqli_fetch_assoc($result);
									$product_name = $data['product_name'];
									$price = $data['price'];
								?>
									<tr>
										<td>
											<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
												<div class="thumb_cart">
													<?php
													$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
													if (mysqli_num_rows($result) > 0) :
														$data = mysqli_fetch_assoc($result);
														$image_name = $data['image_name'];
													?>
														<img src="uploads/product/<?= $image_name ?>" alt="image">
													<?php else : ?>
														<img src="uploads/product/default.jpg" alt="image">
													<?php endif ?>
												</div>
											</a>
											<span class="item_cart">
												<a style="font-size:large" href="index.php?page=product_view&product_id=<?= $product_id ?>"><?= $product_name ?></a>
											</span>
										</td>
										<td>
											<strong>
												<?php
												$price_sale = 0;

												$get_sale = get('sale', 'WHERE product_id=' . $product_id);
												if (mysqli_num_rows($get_sale) > 0) :
													$data_sale = mysqli_fetch_assoc($get_sale);
													$sale = $data_sale['sale'];
													$price_sale = $price - $price * (int)$sale / 100;
												?>
													<p class="new_price m-0" style="color:black"><?= rupiah($price_sale) ?></p>
													<p class="old_price m-0" style="font-size:small; color:#9d9d9d"><?= rupiah($price) ?></p>
												<?php else : ?>
													<p class="new_price m-0" style="color:black"><?= rupiah($price) ?></p>
												<?php endif ?>
											</strong>
										</td>
										<td>
											<strong><?= $total_quantity ?></strong>
										</td>
										<td class="text-center">
											<?php
											$get_sale = get('sale', 'WHERE product_id=' . $product_id);
											if (mysqli_num_rows($get_sale) > 0) {
												$subtotal_product = $total_quantity * $price_sale;
												$subtotal_price += $subtotal_product;
											} else {
												$subtotal_product = $total_quantity * $price;
												$subtotal_price += $subtotal_product;
											}
											?>
											<strong style="color:#004dda"><?= rupiah($subtotal_product) ?></strong>
										</td>
										<td class="options">
											<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')" class="ti-trash"></a>
										</td>
									</tr>
								<?php
									$checkout['items'][$i] = [
										'id' => $product_id,
										'price' => $price,
										'price_sale' => $price_sale,
										'quantity' => $quantity,
										'name' => $product_name
									];

									$i++;
								endforeach
								?>
							</tbody>
						</table>
					</div>
			</div>
			<div class="box_cart pt-3">
				<div class="container">
					<div class="row">
						<div class="col-4 text-left">
							<form method="POST" action="">
								<label>Coupon Code</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="code" placeholder="Insert code" aria-describedby="button-addon2">
									<button class="btn btn-outline-primary btn-sm" name="apply_coupon">Apply Coupon</button>
								</div>
								<?php
								$shipping_price = 17000;

								if (isset($_POST['apply_coupon'])) {
									$code = $_POST['code'];

									$get_coupon = get('coupon', 'WHERE code="' . $code . '" AND status=1');
									if (mysqli_num_rows($get_coupon) > 0) {
										$data_coupon = mysqli_fetch_assoc($get_coupon);

										$coupon_name = $data_coupon['coupon_name'];
										$promo = $data_coupon['%'];

										$total_price_promo = $subtotal_price + $shipping_price;
										$promo_price = $total_price_promo * (int)$promo / 100;
										$total_price_promo = $total_price_promo - $promo_price;
									} else {
										$total_price = $subtotal_price + $shipping_price;
									}
								}
								?>
							</form>
						</div>
						<div class="col"></div>
						<div class="col-4 justify-content-right">
							<ul>
								<?php
								$checkout['details']['subtotal_price'] = $subtotal_price;
								$checkout['details']['shipping_price'] = $shipping_price;
								$checkout['details']['gross'] = $total_price;

								if (isset($promo)) :
									$checkout['details']['gross'] = $total_price_promo;
									$checkout['details']['coupon_name'] = $coupon_name;
									$checkout['details']['promo'] = $promo;
									$checkout['details']['promo_price'] = $promo_price;
								?>
									<li><span>Subtotal</span><?= rupiah($subtotal_price) ?></li>
									<li><span>Shipping</span><?= rupiah($shipping_price) ?></li>
									<li style="color:red">
										<span>Promo (<?= $coupon_name ?>)</span>-<?= rupiah($promo_price) ?>
									</li>
									<li class="my-4" style="color:red"><span>Total</span><?= rupiah($total_price_promo) ?></li>
								<?php else : ?>
									<li><span>Subtotal</span><?= rupiah($subtotal_price) ?></li>
									<li><span>Shipping</span><?= rupiah($shipping_price) ?></li>
									<li class="my-4" style="color:red"><span>Total</span><?= rupiah($total_price) ?></li>
								<?php endif ?>
							</ul>
							<form method="POST" action="index.php?page=checkout">
								<?php
								$i = 0;
								foreach ($checkout['items'] as $checkout_items) :
								?>
									<input name="items[<?= $i ?>][id]" value="<?= $checkout_items['id'] ?>" type="hidden">
									<input name="items[<?= $i ?>][price]" value="<?= $checkout_items['price'] ?>" type="hidden">
									<input name="items[<?= $i ?>][price_sale]" value="<?= $checkout_items['price_sale'] ?>" type="hidden">
									<input name="items[<?= $i ?>][quantity]" value="<?= $checkout_items['quantity'] ?>" type="hidden">
									<input name="items[<?= $i ?>][name]" value="<?= $checkout_items['name'] ?>" type="hidden">
								<?php
									$i++;
								endforeach;
								?>
								<input name="details[subtotal_price]" value="<?= $checkout['details']['subtotal_price'] ?>" type="hidden">
								<input name="details[shipping_price]" value="<?= $checkout['details']['shipping_price'] ?>" type="hidden">
								<input name="details[gross]" value="<?= $checkout['details']['gross'] ?>" type="hidden">
								<?php if (isset($promo)) : ?>
									<input name="details[coupon_name]" value="<?= $checkout['details']['coupon_name'] ?>" type="hidden">
									<input name="details[promo]" value="<?= $checkout['details']['promo'] ?>" type="hidden">
									<input name="details[promo_price]" value="<?= $checkout['details']['promo_price'] ?>" type="hidden">
								<?php endif ?>
								<button href="index.php?page=checkout" class="btn_1 full-width cart" name="checkout">Proceed to Checkout</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="text-center my-5 py-5">
				<img src="img/empty.png" alt="empty">
				<h3 class="mt-4 mb-1">Nothing to see here</h3>
				<p class="mb-5 pb-5">You have not added any products into your cart</p>
			</div>
			<div class="container p-5" style="background-color: white;">
				<div class="mb-4">
					<h3 class="m-0">Fill up your cart</h3>
					<p style="font-size:large;">Browse Thousands of Products</p>
				</div>
				<div class="owl-carousel owl-theme products_carousel">
					<?php
					$result = get('product');
					foreach ($result as $data) :
						$product_id = $data['product_id'];
						$product_name = $data['product_name'];
						$category_id = $data['category_id'];
						$subcategory_id = $data['subcategory_id'];
						$price = $data['price'];
						$sold = $data['sold'];
						$description = $data['description'];
					?>
						<div class="item">
							<div class="grid_item">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($get_sale) > 0) :
									$data_sale = mysqli_fetch_assoc($get_sale);
									$sale = $data_sale['sale'];
									$price_sale = $price - $price * (int) $sale / 100;
								?>
									<span class="ribbon off">-
										<?= $sale ?>
									</span>
								<?php endif ?>
								<figure>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
										<?php
										$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
										if (mysqli_num_rows($result) > 0) :
											$data = mysqli_fetch_assoc($result);
											$image_name = $data['image_name'];
										?>
											<img src="uploads/product/<?= $image_name ?>">
										<?php else : ?>
											<img src="img/products/product_placeholder_square_medium.jpg">
										<?php endif ?>
									</a>
								</figure>
								<div class="rating">
									<?php
									$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
									$data_review = mysqli_fetch_assoc($get_review);
									$total_rating = (int)$data_review['sum(rating)'];

									$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
									$data_review = mysqli_fetch_assoc($get_review);
									$count_rating = (int)$data_review['count(rating)'];

									if ($count_rating > 0) {
										$average_rating = round($total_rating / $count_rating);

										for ($i = $average_rating; $i > 0; $i--) {
											echo '<i class="icon-star voted"></i>';
										}
									}

									if ($count_rating == 0) {
										echo '<p class="mb-0">No review</p>';
									} else {
										$n = 5 - $average_rating;
										for ($i = $n; $i > 0; $i--) {
											echo '<i class="icon-star"></i>';
										}
										echo '<em class="ml-1" style="color:#9d9d9d">(' . $count_rating . ')</em>';
									}
									?>
								</div>
								<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
									<h3>
										<?= $product_name ?>
									</h3>
								</a>
								<div class="price_box mb-0">
									<?php
									$get_sale = get('sale', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($get_sale) > 0) :
										$data_sale = mysqli_fetch_assoc($get_sale);
										$sale = $data_sale['sale'];
										$price_sale = $price - $price * (int) $sale / 100;
									?>
										<span class="new_price">
											<?= rupiah($price_sale) ?>
										</span>
										<span class="old_price" style="font-size:small">
											<?= rupiah($price) ?>
										</span>
									<?php else : ?>
										<span class="new_price">
											<?= rupiah($price) ?>
										</span>
									<?php endif ?>
								</div>
								<div>
									<p style="color: #9d9d9d;" class="mb-3">
										<?= $sold ?> sold • 0 discussions
									</p>
								</div>
								<ul>
									<li>
										<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
											<i class="ti-heart"></i>
										</a>
									</li>
									<li>
										<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
											<i class="ti-shopping-cart"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		<?php endif ?>
		</main>
	</div>
</body>

</html>