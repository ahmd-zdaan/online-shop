<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">


	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
	<link href="css/home_1.css" rel="stylesheet">
</head>

<style>
	ul#banners_grid li {
		width: 25%;
	}

	ul#banners_grid li a.img_container {
		height: 200px;
	}

	ul#banners_grid li a.img_container img {
		height: 100%;
		object-fit: cover;
	}

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
		<main>
			<div id="carousel-home">
				<div class="owl-carousel owl-theme">
					<?php
					$get_product = get('product', 'LIMIT 5');

					foreach ($get_product as $data_product) :
						$product_id = $data_product['product_id'];
						$product_name = $data_product['product_name'];
						$price = $data_product['price'];

						$result_image = get('product_image', 'WHERE product_id=' . $product_id);
						$data_image = mysqli_fetch_assoc($result_image);

						$image_name = $data_image['image_name'];
					?>
						<div class="owl-slide cover" style="background-image: url(uploads/product/<?= $image_name ?>); background-size:contain; background-repeat:no-repeat">
							<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<div class="container">
									<div class="row justify-content-center justify-content-md-end">
										<div class="col-lg-6 static">
											<div class="slide-text text-right white">
												<h2 class="owl-slide-title"><?= $product_name ?></h2>
												<?php
												$get_sale = get('sale', 'WHERE product_id=' . $product_id);
												if (mysqli_num_rows($get_sale) > 0) :
													$data_sale = mysqli_fetch_assoc($get_sale);
													$sale = $data_sale['sale'];
													$price_sale = $price - $price * (int) $sale / 100;
												?>
													<span style="font-size:medium" class="ribbon off ml-3 mt-3 px-3 py-2">- <?= $sale ?>%</span>
													<p class="owl-slide-subtitle mb-0" style="font-size:larger; font-weight:bold">
														<?= rupiah($price) ?>
													</p>
													<p class="old_price" style="color:#9d9d9d">
														<?= rupiah($price) ?>
													</p>
												<?php else : ?>
													<p class="owl-slide-subtitle" style="font-size:larger; font-weight:bold">
														<?= rupiah($price) ?>
													</p>
												<?php endif ?>
												<div class="owl-slide-cta">
													<a class="btn_1" href="index.php?page=product_view&product_id=<?= $product_id ?>" role="button">View Product</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
				<ul id="banners_grid" class="clearfix">
					<li>
						<a href="index.php?page=list&view=list" class="img_container">
							<img src="img/fashion.jpg" alt="" class="lazy">
							<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<h3>FASHION</h3>
								<div>
									<span class="btn_1">Browse Category</span>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a href="index.php?page=list&view=list" class="img_container">
							<img src="img/electronics.jpg" alt="" class="lazy">
							<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<h3>ELECTRONICS</h3>
								<div>
									<span class="btn_1">Browse Category</span>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a href="index.php?page=list&view=list" class="img_container">
							<img src="img/kitchen.jpg" alt="" class="lazy">
							<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<h3>KITCHEN</h3>
								<div>
									<span class="btn_1">Browse Category</span>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a href="index.php?page=list&view=list" class="img_container">
							<img src="img/books.jpg" alt="" class="lazy">
							<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<h3>BOOKS</h3>
								<div>
									<span class="btn_1">Browse Category</span>
								</div>
							</div>
						</a>
					</li>
				</ul>
				<div class="container margin_60_35 pt-5">
					<div class="main_title mb-5">
						<h2>Products on Sale</h2>
						<p>Shop the Best Products on Sale Now!</p>
					</div>
					<div class="owl-carousel owl-theme products_carousel">
						<?php
						$result = get('sale', 'ORDER BY sale DESC LIMIT 12');

						foreach ($result as $data) :
							$product_id = $data['product_id'];

							$get_product = get('product', 'WHERE product_id=' . $product_id);
							$data = mysqli_fetch_assoc($get_product);

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
													<a href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Wishlist" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart-broken"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" title="Add to Wishlist" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart"></i>
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
													<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Cart" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
														<i class="ti-shopping-cart-full"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" title="Add to Cart" data-toggle="tooltip" data-placement="left">
														<i class="ti-shopping-cart"></i>
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
				<div class="featured container-fluid" style="height: 450px;">
					<?php
					$product_id_list = [];

					$get_product = get('product');
					foreach ($get_product as $data_product) {
						$product_id = $data_product['product_id'];
						$product_id_list[] .= $product_id;
					}

					$product_id = $product_id_list[array_rand($product_id_list)];

					$get_product = get('product', 'WHERE product_id=' . $product_id);
					$data_product = mysqli_fetch_assoc($get_product);

					$product_name = $data_product['product_name'];
					$price = $data_product['price'];
					$description = $data_product['description'];

					$get_sale = get('sale', 'WHERE product_id=' . $product_id);
					if (mysqli_num_rows($get_sale) > 0) {
						$data_sale = mysqli_fetch_assoc($get_sale);

						$sale = $data_sale['sale'];
						$price_sale = $price - $price * (int)$sale / 100;
					}

					$get_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
					$data_product_image = mysqli_fetch_assoc($get_product_image);
					$product_image = $data_product_image['image_name'];
					?>
					<img src="uploads/product/<?= $product_image ?>" class="p-5" width="450px">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container margin_60">
							<span class="ribbon off m-3 py-2 px-3" style="font-size: large;">- <?= $sale ?>%</span>
							<div class="row justify-content-end text-right">
								<div class="col-lg-6 wow" data-wow-offset="150">
									<h4 class="mb-3" style="color: white">
										<?= $product_name ?>
									</h4>
									<?php
									$desc_array = explode(' ', $description);
									$desc_count = count($desc_array);

									$desc = '';

									if ($desc_count > 25) :
										for ($i = 0; $i < 25; $i++) {
											$desc .= $desc_array[$i] . ' ';
										}
									?>
										<p class="m-0" style="font-weight: lighter;"><?= $desc ?> ...</p>
									<?php else : ?>
										<p class="m-0" style="font-weight: lighter;"><?= $description ?></p>
									<?php endif ?>
									<div class="my-2">
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($get_sale) > 0) :
										?>
											<span class=" new_price mr-1" style="color: white; font-size:larger; font-weight:bolder">
												<?= rupiah($price_sale) ?>
											</span>
											<span class="old_price" style="color:#9d9d9d">
												<?= rupiah($price) ?>
											</span>
										<?php else : ?>
											<span class=" new_price mr-1" style="color: white; font-size:larger; font-weight:bolder">
												<?= rupiah($price) ?>
											</span>
										<?php endif ?>
									</div>
									<a class="btn_1 mt-2" href="index.php?page=product_view&product_id=<?= $product_id ?>" role="button">View Product</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container margin_60_35 pt-5">
					<div class="main_title mb-5">
						<h2>Top Selling</h2>
						<p>Discover the best selling products</p>
					</div>
					<div class="owl-carousel owl-theme products_carousel">
						<?php
						$result = get('product', 'WHERE sold > 0 ORDER BY sold DESC LIMIT 12');
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
													<a href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Wishlist" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart-broken"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" title="Add to wishlist" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart"></i>
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
													<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Cart" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
														<i class="ti-shopping-cart-full"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" title="Add to Cart" data-toggle="tooltip" data-placement="left">
														<i class="ti-shopping-cart"></i>
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
				<div class="container margin_60_35 pt-0">
					<div class="main_title mb-5">
						<h2>Best Reviews</h2>
						<p>Discover the best products by average reviews</p>
					</div>
					<div class="owl-carousel owl-theme products_carousel">
						<?php
						$get_product = get('review', 'WHERE rating >= 3 GROUP BY product_id LIMIT 12');

						foreach ($get_product as $data) :
							$product_id = $data['product_id'];

							$get_product = get('product', 'WHERE product_id=' . $product_id);
							$data = mysqli_fetch_assoc($get_product);

							$product_name = $data['product_name'];
							$category_id = $data['category_id'];
							$subcategory_id = $data['subcategory_id'];
							$price = $data['price'];
							$sold = $data['sold'];
							$description = $data['description'];
						?>
							<div class="item">
								<div class="grid_item">
									<!-- <span class="ribbon hot">Hot</span>
							<span class="ribbon off">-30%</span>
							<span class="ribbon new">New</span> -->
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
											<?php
											if (isset($_SESSION['email'])) :
												$email = $_SESSION['email'];

												$get_user = get('user', 'WHERE email="' . $email . '"');
												$data_user = mysqli_fetch_assoc($get_user);
												$user_id = $data_user['user_id'];

												$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
												if (mysqli_num_rows($get_wishlist) > 0) :
											?>
													<a href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Wishlist" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart-broken"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" title="Add to Wishlist" data-toggle="tooltip" data-placement="left">
														<i class="ti-heart"></i>
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
													<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" class="tooltip-1" title="Remove from Cart" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
														<i class="ti-shopping-cart-full"></i>
													</a>
												<?php else : ?>
													<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" title="Add to Cart" data-toggle="tooltip" data-placement="left">
														<i class="ti-shopping-cart"></i>
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
				<div class="bg_gray">
					<div class="container margin_30">
						<div id="brands" class="owl-carousel owl-theme">
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/ikea.png" class="owl-lazy" style="width:75px">
								</a>
							</div>
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/microsoft.png" class="owl-lazy" style="width:125px">
								</a>
							</div>
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/canon.png" class="owl-lazy" style="width:125px">
								</a>
							</div>
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/sony.png" class="owl-lazy" style="width:125px">
								</a>
							</div>
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/nike.png" class="owl-lazy" style="width:75px">
								</a>
							</div>
							<div class="item">
								<a href="#0">
									<img data-src="img/brands/adidas.png" class="owl-lazy" style="width:75px">
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="container margin_60_35">
					<div class="main_title">
						<h2>Latest News</h2>
						<span>Blog</span>
						<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<a class="box_news" href="blog.html">
								<figure>
									<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-1.jpg" alt="" width="400" height="266" class="lazy">
									<figcaption><strong>28</strong>Dec</figcaption>
								</figure>
								<ul>
									<li>by Mark Twain</li>
									<li>20.11.2017</li>
								</ul>
								<h4>Pri oportere scribentur eu</h4>
								<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
							</a>
						</div>
						<div class="col-lg-6">
							<a class="box_news" href="blog.html">
								<figure>
									<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-2.jpg" alt="" width="400" height="266" class="lazy">
									<figcaption><strong>28</strong>Dec</figcaption>
								</figure>
								<ul>
									<li>By Jhon Doe</li>
									<li>20.11.2017</li>
								</ul>
								<h4>Duo eius postea suscipit ad</h4>
								<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
							</a>
						</div>
						<div class="col-lg-6">
							<a class="box_news" href="blog.html">
								<figure>
									<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-3.jpg" alt="" width="400" height="266" class="lazy">
									<figcaption><strong>28</strong>Dec</figcaption>
								</figure>
								<ul>
									<li>By Luca Robinson</li>
									<li>20.11.2017</li>
								</ul>
								<h4>Elitr mandamus cu has</h4>
								<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
							</a>
						</div>
						<div class="col-lg-6">
							<a class="box_news" href="blog.html">
								<figure>
									<img src="img/blog-thumb-placeholder.jpg" data-src="img/blog-thumb-4.jpg" alt="" width="400" height="266" class="lazy">
									<figcaption><strong>28</strong>Dec</figcaption>
								</figure>
								<ul>
									<li>By Paula Rodrigez</li>
									<li>20.11.2017</li>
								</ul>
								<h4>Id est adhuc ignota delenit</h4>
								<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum vidisse....</p>
							</a>
						</div>
					</div>
				</div> -->
		</main>
	</div>
</body>

</html>