<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">

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

	.items li {
		list-style: none;
	}

	.items .item {
		float: left;
	}

	.items .item span {
		color: black;
	}

	.price li {
		list-style: none;
		font-size: 11pt;
		font-weight: 500;
	}

	.price li span {
		float: left;
	}

	.price .total {
		color: red;
		font-size: 16pt;
		font-weight: bold;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php">Profile</a></li>
							<li>Transaction</li>
						</ul>
					</div>
					<h1 class="pt-3">Transactions</h1>
				</div>
				<div class="mb-5">
					<?php
					$email = $_SESSION['email'];
					$get_user = get('user', 'WHERE email="' . $email . '"');
					$data_user = mysqli_fetch_assoc($get_user);
					$user_id = $data_user['user_id'];

					$get_transaction = get('transaction', 'WHERE user_id=' . $user_id);
					if (mysqli_num_rows($get_transaction) > 0) :
					?>
						<?php
						$collapse_id = 0;

						foreach ($get_transaction as $transaction_data) :
							$transaction_id = $transaction_data['transaction_id'];
							$shipping_price = $transaction_data['shipping_price'];
							$subtotal_price = $transaction_data['subtotal_price'];
							$gross = $transaction_data['gross'];
							$date = $transaction_data['date'];
						?>
							<div class="accordion" id="accordionExample">
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading<?= $collapse_id ?>">
										<button class="accordion-button <?php echo ($collapse_id > 0) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $collapse_id ?>" aria-expanded="true" aria-controls="collapse<?= $collapse_id ?>">
											<?php
											$product_names = [];
											$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id);
											foreach ($get_details as $data_details) {
												$details_product_id = $data_details['product_id'];
												$details_price = $data_details['price'];
												$details_quantity = $data_details['quantity'];

												$get_product = get('product', 'WHERE product_id=' . $details_product_id);
												$data_product = mysqli_fetch_assoc($get_product);

												$product_id = $data_product['product_id'];
												$product_name = $data_product['product_name'];

												$product_names[] = $product_name;
											}
											?>
											<div>
												<p class="m-0"><?= implode(', ', $product_names) ?></p>
												<em class="mt-1" style="font-size:10pt">Purchased at <?= dateConvert($date) ?></em>
											</div>
										</button>
									</h2>
								</div>
							</div>
							<div id="collapse<?= $collapse_id ?>" class="accordion-collapse collapse <?php echo ($collapse_id > 0) ? '' : 'show' ?>" aria-labelledby="heading<?= $collapse_id ?>" data-bs-parent="#accordionExample">
								<div class="accordion-body px-4">
									<?php
									$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id, '*,SUM(price)');
									$data_details = mysqli_fetch_assoc($get_details);
									$total_price = $data_details['SUM(price)'];
									?>
									<div class="mt-4">
										<div class="my-3 text-right">
											<div class="row">
												<div class="col">
													<ul class="p-0">
														<?php
														$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id);
														foreach ($get_details as $data_details) :
															$details_product_id = $data_details['product_id'];
															$details_price = $data_details['price'];
															$details_quantity = $data_details['quantity'];

															$get_product = get('product', 'WHERE product_id=' . $details_product_id);
															$data_product = mysqli_fetch_assoc($get_product);

															$product_id = $data_product['product_id'];
															$product_name = $data_product['product_name'];
															$category_id = $data_product['category_id'];
															$subcategory_id = $data_product['subcategory_id'];
															$description = $data_product['description'];

															$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
															$data = mysqli_fetch_assoc($result);
															$category_name = $data['category_name'];

															$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
															$data = mysqli_fetch_assoc($result);
															$subcategory_name = $data['subcategory_name'];
														?>
															<li style="list-style:none; clear:both">
																<ul class="items">
																	<li class="item">
																		<span style="font-weight:bold; color:#004cd7"><?= $details_quantity ?>x</span>
																		<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
																			<?php
																			$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
																			if (mysqli_num_rows($result) > 0) :
																				$data = mysqli_fetch_assoc($result);
																				$image_name = $data['image_name'];
																			?>
																				<img src="uploads/product/<?= $image_name ?>" alt="product_image" style="width:50px; height:50px; object-fit:scale-down">
																			<?php else : ?>
																				<img src="uploads/product/default.jpg" alt="product_image" style="width:50px; height:50px; object-fit:scale-down">
																			<?php endif ?>
																			<span class="hover-underline"><?= $product_name ?></span>
																		</a>
																	</li>
																	<li>
																		(<?= $details_quantity ?>x <?= rupiah($details_price) ?>)<span class="ml-2" style="font-weight:bold"><?= rupiah($subtotal_price) ?></span>
																	</li>
																</ul>
															</li>
														<?php endforeach ?>
													</ul>
												</div>
												<div class="col-4">
													<ul class="price">
														<li>
															<span>Shipping</span><?= rupiah($shipping_price) ?>
														</li>
														<li>
															<span>Subtotal</span><?= rupiah($subtotal_price) ?>
														</li>
														<li class="my-4 total">
															<span>TOTAL</span><?= rupiah($gross) ?>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
							$collapse_id++;
						endforeach
						?>
					<?php else : ?>
						<div class="text-center my-5 py-5">
							<img src="img/empty.png" alt="empty">
							<h3 class="mt-4 mb-1">Nothing to see here</h3>
							<p class="mb-5 pb-5">You have not added any products into your cart</p>
						</div>
						<div class="container p-5" style="background-color: white;">
							<div class="mb-4">
								<h3 class="m-0">Create Your Dream Wishlist</h3>
								<p style="font-size:large;">Explore and Save Your Favorite Products</p>
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
				</div>
			</div>
		</main>
	</div>
</body>

</html>