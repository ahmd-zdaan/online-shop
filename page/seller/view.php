<?php
$seller_id = $_GET['seller_id'];

$get_user = get('user', 'WHERE user_id=' . $seller_id);
$data_user = mysqli_fetch_assoc($get_user);

$user_id = $data_user['user_id'];
$user_name = $data_user['user_name'];
$email = $data_user['email'];
$address = $data_user['address'];
$country_id = $data_user['country_id'];
$telephone = $data_user['telephone'];

$get_country = get('country', 'WHERE country_id=' . $country_id);
$data_country = mysqli_fetch_assoc($get_country);
$country_name = $data_country['country_name'];
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
	.text-link:hover {
		text-decoration: underline;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30 pb-0">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="">Seller</a></li>
							<li><?= $user_name ?></li>
						</ul>
					</div>
					<h1 class="pt-3">View Seller</h1>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-3">
						<?php
						$result = get('user_image', 'WHERE user_id=' . $user_id);

						if (mysqli_num_rows($result) > 0) :
							$data = mysqli_fetch_assoc($result);
							$user_image = $data['user_image'];
						?>
							<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
						<?php
						else :
						?>
							<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
						<?php endif ?>
					</div>
					<div class="col-9">
						<ul style="list-style: none;" class="pl-4">
							<li>
								<h1 class="mb-3"><?= $user_name ?></h1>
							</li>
							<li>
								<h5>Address</h5>
								<p><?= $address ?>, <?= $country_name ?></p>
							</li>
							<li>
								<h5>Telephone</h5>
								<p><?= $telephone ?></p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="container margin_60_35 p-0 mt-5">
				<div>
					<h4 class="m-0"><?= $user_name ?>'s Products</h4>
					<a href="index.php?page=seller_list">
						<p class="m-0 text-right text-link">View All</p>
					</a>
				</div>
				<div class="owl-carousel owl-theme products_carousel px-5">
					<?php
					$result = get('product', 'WHERE seller_id=' . $user_id);
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
									<span class="ribbon off">- <?= $sale ?>%</span>
								<?php endif ?>
								<figure>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
										<?php
										$result = get('product_image', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($result) > 0) :
											$data = mysqli_fetch_assoc($result);
											$image_name = $data['image_name'];
										?>
											<img src="uploads/product/<?= $image_name ?>" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
										<?php
										else :
										?>
											<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
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
										echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
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
										<?php
										if (isset($_SESSION['email'])) :
											$email = $_SESSION['email'];

											$get_user = get('user', 'WHERE email="' . $email . '"');
											$data_user = mysqli_fetch_assoc($get_user);
											$user_id = $data_user['user_id'];

											$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
											if (mysqli_num_rows($get_wishlist) > 0) :
										?>
												<a href="index.php?page=wishlist_remove&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" class="tooltip-1" data-toggle="tooltip" data-placement="left">
													<i class="ti-heart">Remove from wishlist</i>
													<span></span>
												</a>
											<?php else : ?>
												<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left">
													<i class="ti-heart"></i>
													<span>Add to wishlist</span>
												</a>
											<?php endif ?>
										<?php endif ?>
									</li>
									<li>
										<?php
										if (isset($user_id)) :
											$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
											if (mysqli_num_rows($get_cart) > 0) :
										?>
												<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
													<i class="ti-shopping-cart"></i>
													<span>Remove from Cart</span>
												</a>
											<?php else : ?>
												<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left">
													<i class="ti-shopping-cart"></i>
													<span>Add to Cart</span>
												</a>
											<?php endif ?>
										<?php endif ?>
									</li>
								</ul>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</main>

		<div id="toTop"></div><!-- Back to top button -->

		<!-- COMMON SCRIPTS -->
		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>
</body>

</html>