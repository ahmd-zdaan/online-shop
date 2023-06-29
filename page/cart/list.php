<?php
check('login')
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
					<h1 class="pt-3">Cart</h1>
				</div>
				<?php
				$email = $_SESSION['email'];

				$result = get('user', 'WHERE email="' . $email . '"');
				$data = mysqli_fetch_assoc($result);
				$user_id = $data['user_id'];

				$result = get('cart', 'WHERE user_id=' . $user_id);
				if (mysqli_num_rows($result) > 0) :
					$result = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,SUM(quantity) AS total_quantity');
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
									<th>
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

								foreach ($result as $data) :
									$cart_id = $data['cart_id'];
									$product_id = $data['product_id'];
									$total_quantity = $data['total_quantity'];

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
													$result = get('product_image', 'WHERE product_id=' . $product_id);
													if (mysqli_num_rows($result) > 0) :
														$data = mysqli_fetch_assoc($result);
														$image_name = $data['image_name'];
													?>
														<img src="uploads/product/<?= $image_name ?>" class="lazy" alt="image">
													<?php
													else :
													?>
														<img src="uploads/product/default.jpg" class="lazy" alt="image">
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
												$get_sale = get('sale', 'WHERE product_id=' . $product_id);
												if (mysqli_num_rows($get_sale) > 0) :
													$data_sale = mysqli_fetch_assoc($get_sale);
													$sale = $data_sale['sale'];
													$price_sale = $price - $price * (int)$sale / 100;
												?>
													<p class="new_price m-0" style="font-size:larger"><?= rupiah($price_sale) ?></p>
													<p class="old_price m-0" style="font-size:small; color:#9d9d9d"><?= rupiah($price) ?></p>
												<?php else : ?>
													<p class="new_price m-0"><?= rupiah($price) ?></p>
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
											<strong><?= rupiah($subtotal_product) ?></strong>
										</td>
										<td class="options">
											<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')" class="ti-trash"></a>
										</td>
									</tr>
								<?php
								endforeach
								?>
							</tbody>
						</table>
						<div class="row add_top_30 flex-sm-row-reverse cart_actions">
							<div class="col-sm-4 text-right">
								<!-- <button type="button" class="btn_1 gray">Update Cart</button> -->
								<!-- <button type="submit" name="submit" class="text-center btn_1">Checkout</button> -->
							</div>
							<div class="col-sm-8">
								<div class="apply-coupon">
									<div class="form-group form-inline">
										<input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control"><button type="button" class="btn_1 outline">Apply Coupon</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$shipping_price = 17000;
					$total_price = $subtotal_price + $shipping_price;
					?>
					<div class="box_cart">
						<div class="container">
							<div class="row justify-content-end">
								<div class="col-xl-4 col-lg-4 col-md-6">
									<ul>
										<li>
											<span>Subtotal</span> <?= rupiah($subtotal_price) ?>
										</li>
										<li>
											<span>Shipping</span> <?= rupiah($shipping_price) ?>
										</li>
										<li>
											<span>Total</span> <?= rupiah($total_price) ?>
										</li>
									</ul>
									<a href="index.php?page=checkout" class="btn_1 full-width cart">Proceed to Checkout</a>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="text-center my-5 pb-5">
						<img src="img/empty.png" alt="empty">
						<h3 class="mt-4">Nothing to see here</h3>
						<p class="mb-5 pb-5">You have not added any products to your cart</p>
					</div>
					<div class="container margin_60_35 mt-5 pb-0" style="background-color: white;">
						<div class="main_title">
							<h3 class="m-0">Products You Might Like</h3>
							<p style="font-size:large;">Browse and Discover Millions of Products</p>
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
												$result = get('product_image', 'WHERE product_id=' . $product_id);
												if (mysqli_num_rows($result) > 0) :
													$data = mysqli_fetch_assoc($result);
													$image_name = $data['image_name'];
												?>
													<img src="uploads/product/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
												<?php
												else :
												?>
													<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
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
													echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
												}
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
											<li><a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
											<li><a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
										</ul>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				<?php endif ?>
			</div>
		</main>
</body>

</html>