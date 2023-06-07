<?php
$product_id = $_GET['product_id'];

// $result = get('product', 'JOIN category ON product.category_id=category.category_id WHERE product_id="' . $product_id . '"');
$result_product = get('product', 'WHERE product_id=' . $product_id);
$data_product = mysqli_fetch_assoc($result_product);

if ($data_product) {
	$name = $data_product['product_name'];
	$category_id = $data_product['category_id'];
	$subcategory_id = $data_product['subcategory_id'];
	$price = $data_product['price'];
	$stock = $data_product['stock'];
	$description = $data_product['description'];
	$manifacturer_id = $data_product['manifacturer_id'];
	$size = $data_product['size'];
	$color = $data_product['color'];
	$weight = $data_product['weight'];
}

$result_product_image = get('product_image', 'WHERE product_id=' . $product_id);
$data_product_image = mysqli_fetch_assoc($result_product_image);

$image_name = $data_product_image['image_name'];

$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
$data = mysqli_fetch_assoc($result);
$category_name = $data['category_name'];

$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id, 'subcategory_name');
$data = mysqli_fetch_assoc($result);
$subcategory_name = $data['subcategory_name'];
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
	<link href="css/product_page.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<main>
		<div class="container margin_30">
			<!-- SALE -->
			<!-- <div class="countdown_inner">-20% This offer ends in
				<div data-countdown="2019/05/15" class="countdown"></div>
			</div> -->
			<div class="row">
				<!-- IMAGES -->
				<div class="col-md-6">
					<div class="all">
						<div class="slider">
							<div class="owl-carousel owl-theme main">
								<img src="uploads/product/<?= $image_name ?>" alt="" class="item-box" style="object-fit: scale-down;">
								<img src="uploads/product/<?= $image_name ?>" alt="" class="item-box" style="object-fit: scale-down;">
							</div>
							<div class="left nonl"><i class="ti-angle-left"></i></div>
							<div class="right"><i class="ti-angle-right"></i></div>
						</div>
						<div class="slider-two">
							<div class="owl-carousel owl-theme thumbs">
								<img src="uploads/product/<?= $image_name ?>" alt="" class="item active" style="object-fit: cover;">
								<img src="uploads/product/<?= $image_name ?>" alt="" class="item" style="object-fit: cover;">
							</div>
							<div class="left-t nonl-t"></div>
							<div class="right-t"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Product</a></li>
							<li><a href="#"><?= $category_name ?></a></li>
							<li><a href="#"><?= $subcategory_name ?></a></li>
							<li><?= $name ?></li>
						</ul>
					</div>
					<!-- PRODUCT -->
					<div class="prod_info">
						<h1><?= $name ?></h1>
						<span class="rating my-0">
							<?php
							// Rating
							$result = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
							$data = mysqli_fetch_assoc($result);
							$total_rating = (int)$data['sum(rating)'];

							$result = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
							$data = mysqli_fetch_assoc($result);
							$count_rating = (int)$data['count(rating)'];

							if ($count_rating > 0) {
								$average_rating = round($total_rating / $count_rating);

								for ($i = $average_rating; $i > 0; $i--) {
									echo '<i class="icon-star voted"></i>';
								}
							}

							if ($count_rating == 0) {
								echo '<p>No review</p>';
							} else {
								$n = 5 - $average_rating;
								for ($i = $n; $i > 0; $i--) {
									echo '<i class="icon-star"></i>';
								}
								echo '<p class="ml-2" style="float: right">( ' . $average_rating . ' / 5 )</p>';
								echo '<em class="mx-2">' . $count_rating . ' reviews</em>';
							}
							?>
						</span>
						<!-- DETAILS -->
						<ul style="list-style: none;" class="p-0">
							<p class="mb-1">
								<b>Description</b>
							</p>
							<li>
								<p><?= $description ?></p>
							</li>
							<hr class="hr m-0 mb-3">
							<p class="mb-2">
								<b>Details</b>
							</p>
							<li>
								<div class="row">
									<div class="col-2">
										<p class="mb-0">Manifacturer</p>
										<p class="mb-0">Stock</p>
										<p class="mb-0">Category</p>
										<p class="mb-0">Subcategory</p>
									</div>
									<div class="col-1 pr-0">
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
									</div>
									<div class="col-9 pl-0">
										<?php
										$manifacturer = get('manifacturer', 'WHERE manifacturer_id=' . $manifacturer_id, 'manifacturer_name');
										$data_manifacturer = mysqli_fetch_assoc($manifacturer);
										$manifacturer_name = $data_manifacturer['manifacturer_name'];
										?>
										<p class="mb-0"><?= $manifacturer_name ?></p>
										<p class="mb-0"><?= $stock ?></p>
										<p class="mb-0"><?= $category_name ?></p>
										<p class="mb-0"><?= $subcategory_name ?></p>
									</div>
								</div>
							</li>
						</ul>
						<hr class="hr m-0">
						<!-- OPTIONS -->
						<div class="prod_options pb-0">
							<!-- COLOR -->
							<!-- <div class="row">
								<label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Color</strong></label>
								<div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
									<ul>
										<li>
											<a href="index.php?page=product&product_id=<?= $product_id ?>&type=1" class="color color_1"></a>
										</li>
									</ul>
								</div>
							</div> -->
							<!-- PAYMENT -->
							<form action="" method="POST">
								<input type="text" hidden name="product_id" value="<?= $product_id ?>">
								<div class="row">
									<label class="col-xl-5 col-lg-5 col-md-6 col-6">
										<strong>Size</strong> - Size Guide
										<a href="#0" data-toggle="modal" data-target="#size-modal">
											<i class="ti-help-alt"></i>
										</a>
									</label>
									<div class="col-xl-4 col-lg-5 col-md-6 col-6">
										<div class="custom-select-form">
											<select class="form-select wide">
												<option value="" selected>Small (S)</option>
												<option value="">M</option>
												<option value="">L</option>
												<option value="">XL</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-xl-5 col-lg-5  col-md-6 col-6">
										<strong>Quantity</strong>
									</label>
									<div class="col-xl-4 col-lg-5 col-md-6 col-6">
										<div class="numbers-row">
											<input type="number" name="quantity" value="1" class="qty2">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-5 col-md-6">
										<div class="price_main">
											<?php
											$get_sale = get('sale', 'WHERE product_id=' . $product_id);
											if (mysqli_num_rows($get_sale) > 0) :
												$data_sale = mysqli_fetch_assoc($get_sale);
												$sale = $data_sale['sale'];
												$price_sale = $price - $price * (int)$sale / 100;
											?>
												<span class="new_price"><?= rupiah($price_sale) ?></span>
												<span style="color:#9d9d9d" class="old_price mt-2"><?= rupiah($price) ?></span>
											<?php else : ?>
												<span class="new_price"><?= rupiah($price) ?></span>
											<?php endif ?>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="btn_add_to_cart">
											<button type="submit" name="submit" class="btn_1 px-5" style="font-size:12px">ADD TO CART</button>
											<!-- <a href="index.php?page=cart_add" class="btn_1">Add to Cart</a> -->
										</div>
									</div>
								</div>
							</form>
							<?php
							if (isset($_POST['submit'])) {
								if (isset($_SESSION['email'])) {
									$user_email = $_SESSION['email'];
									$result = get('user', 'WHERE email="' . $user_email . '"');
									$data = mysqli_fetch_assoc($result);

									$user_id = $data['user_id'];
								} else {
									echo '<script>window.location.href = "index.php?page=login"</script>';
								}
								
								$quantity = $_POST['quantity'];


								$result_add_to_cart = insert('cart', [
									'user_id' => $user_id,
									'product_id' => $product_id,
									'quantity' => $quantity
								]);

								if ($result_add_to_cart) {
									echo '<script>window.location.href = "index.php?page=cart_list"</script>';
								}
							}
							?>
						</div>
					</div>
					<div class="product_actions">
						<ul>
							<li>
								<?php
								if (isset($user_id)) :
									$wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
									if (mysqli_num_rows($wishlist) > 0) :
								?>
										<a href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>">
											<i class="ti-heart"></i>
											<span>Remove from Wishlist</span>
										</a>
									<?php else : ?>
										<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>">
											<i class="ti-heart"></i>
											<span>Add to Wishlist</span>
										</a>
									<?php endif ?>
								<?php endif ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="tabs_product">
			<div class="container">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
					</li>
					<li class="nav-item">
						<a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="tab_content_wrapper">
			<div class="container">
				<div class="tab-content" role="tablist">
					<div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
						<div class="card-header" role="tab" id="heading-A">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
									Description
								</a>
							</h5>
						</div>
						<div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
							<div class="card-body">
								<div class="row justify-content-between">
									<div class="col-lg-6">
										<h3 class="mb-2">
											<b>Description</b>
										</h3>
										<p><?= $description ?></p>
									</div>
									<div class="col-lg-5">
										<h3 class="mb-2">
											<b>Specifications</b>
										</h3>
										<div class="table-responsive">
											<table class="table table-sm table-striped">
												<tbody>
													<tr>
														<td><strong>Manifacturer</strong></td>
														<?php

														?>
														<td><?= $manifacturer_id ?></td>
													</tr>
													<tr>
														<td><strong>Size</strong></td>
														<td><?= $size ?></td>
													</tr>
													<tr>
														<td><strong>Color</strong></td>
														<td><?= $color ?></td>
													</tr>
													<tr>
														<td><strong>Weight</strong></td>
														<td><?= $weight ?>kg</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- REVIEW -->
					<div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
						<div class="card-header" role="tab" id="heading-B">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
									Reviews
								</a>
							</h5>
						</div>
						<div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
							<div class="card-body">
								<div class="row justify-content-between">
									<div class="col-lg-6">
										<div class="review_content">
											<?php
											$review_get = get('review');

											foreach ($review_get as $review_data) :
												$review_id = $review_data['review_id'];
												$review_user_id = $review_data['user_id'];
												$review_user_get = get('user', 'WHERE user_id=' . $review_user_id);
												$review_user_table = mysqli_fetch_assoc($review_user_get);
												$review_user_name = $review_user_table['user_name'];

												$rating = $review_data['rating'];
												$review = $review_data['review'];
												$date = $review_data['date'];
											?>
												<div class="row mb-3">
													<div class="col-1 pr-3">
														<?php
														$result = get('user_image', 'WHERE user_id=' . $review_user_id);
														if (mysqli_num_rows($result) > 0) :
															$data = mysqli_fetch_assoc($result);
															$user_image = $data['user_image'];
														?>
															<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
														<?php
														else :
														?>
															<img src="uploads/user/default.jpg" class="lazy" alt="user_image" width="35px">
														<?php endif ?>
													</div>
													<div class="col-11 mb-3">
														<div class="clearfix add_bottom_10">
															<span class="rating">
																<?php
																// Stars
																for ($i = $rating; $i > 0; $i--) {
																	echo '<i class="icon-star"></i>';
																}
																if ($rating < 5) {
																	$n = 5 - $rating;
																	for ($i = $n; $i > 0; $i--) {
																		echo '<i class="icon-star empty"></i>';
																	}
																}
																?>
																<em>( <?= $rating ?> / 5 )</em>
															</span>
															<em><?= $date ?></em>
														</div>
														<h3 style="font-weight: bold" class="mb-0"><?= $review_user_name ?></h3>
														<p class="mb-1"><?= $review ?></p>
														<div>
															<?php
															if ($review_user_id == $user_id) :
															?>
																<a href="index.php?page=review_edit&review_id=<?= $review_id ?>" style="float: right" class="ml-2">EDIT</a>
																<a href="index.php?page=review_delete&review_id=<?= $review_id ?>&product_id=<?= $product_id ?>" style="float: right" onclick="return confirm('Are you sure you want to DELETE this REVIEW?')">DELETE</a>
															<?php endif ?>
														</div>
													</div>
												</div>
											<?php endforeach ?>
										</div>
									</div>
								</div>
								<p class="text-right">
									<a href="index.php?page=review_add&product_id=<?= $product_id ?>" class="btn_1">Leave a review</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Related</h2>
				<span>Products</span>
				<p>Discover related products.</p>
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				<?php
				$get_product_related = get('product', 'WHERE category_id=' . $category_id);

				foreach ($get_product_related as $data_related) :
					$product_id_related = $data_related['product_id'];
					$product_name_related = $data_related['product_name'];
					$price_related = $data_related['price'];

					$get_product_image_related = get('product_image', 'WHERE product_id=' . $product_id_related);
					$data_product_image_related = mysqli_fetch_assoc($get_product_image_related);

					$image_name_related = $data_product_image_related['image_name'];
				?>
					<div class="item">
						<div class="grid_item">
							<!-- <span class="ribbon hot">Hot</span>
						<span class="ribbon off">-30%</span>
						<span class="ribbon new">New</span> -->
							<?php
							$get_sale = get('sale', 'WHERE product_id=' . $product_id_related);
							if (mysqli_num_rows($get_sale) > 0) :
								$data_sale = mysqli_fetch_assoc($get_sale);
								$sale = $data_sale['sale'];
								$price_sale = $price_related - $price_related * (int)$sale / 100;
							?>
								<span class="ribbon off">- <?= $sale ?></span>
							<?php endif ?>
							<figure>
								<a href="index.php?page=product_view&product_id=<?= $product_id_related ?>">
									<img src="uploads/product/<?= $image_name_related ?>" width="100%" alt="product_image_related">
								</a>
							</figure>
							<div class="rating">
								<?php
								// Rating
								$get_review_related = get('review', 'WHERE product_id="' . $product_id_related . '"', 'sum(rating)');
								$data_review_related = mysqli_fetch_assoc($get_review_related);
								$total_rating = (int)$data_review_related['sum(rating)'];

								$get_review_related = get('review', 'WHERE product_id="' . $product_id_related . '"', 'count(rating)');
								$data_review_related = mysqli_fetch_assoc($get_review_related);
								$count_rating = (int)$data_review_related['count(rating)'];

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
								}
								?>
							</div>
							<a href="index.php?page=product_view&product_id=<?= $product_id_related ?>">
								<h3><?= $product_name_related ?></h3>
							</a>
							<div class="price_box">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id_related);
								if (mysqli_num_rows($get_sale) > 0) :
								?>
									<span class="new_price"><?= rupiah($price_sale) ?></span>
									<span class="old_price" style="font-size:small"><?= rupiah($price) ?></span>
								<?php else : ?>
									<span class="new_price"><?= rupiah($price_sale) ?></span>
								<?php endif ?>
							</div>
							<ul>
								<li>
									<a href="index.php?page=wishlist_add&product_id=<?= $product_id_related ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
										<i class="ti-heart"></i>
										<span>Add to favorites</span>
									</a>
								</li>
								<li>
									<a href="index.php?page=cart_add&product_id=<?= $product_id_related ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
										<i class="ti-shopping-cart"></i>
										<span>Add to cart</span>
									</a>
								</li>
								<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
							</ul>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="feat">
			<div class="container">
				<ul>
					<li>
						<div class="box">
							<i class="ti-gift"></i>
							<div class="justify-content-center">
								<h3>Free Shipping</h3>
								<p>For all oders over $99</p>
							</div>
						</div>
					</li>
					<li>
						<div class="box">
							<i class="ti-wallet"></i>
							<div class="justify-content-center">
								<h3>Secure Payment</h3>
								<p>100% secure payment</p>
							</div>
						</div>
					</li>
					<li>
						<div class="box">
							<i class="ti-headphone-alt"></i>
							<div class="justify-content-center">
								<h3>24/7 Support</h3>
								<p>Online top support</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</main>
	<!-- SIZE -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="size-modal" id="size-modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Size guide</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="ti-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, et velit propriae invenire mea, ad nam alia intellegat. Aperiam mediocrem rationibus nec te. Tation persecuti accommodare pro te. Vis et augue legere, vel labitur habemus ocurreret ex.</p>
					<div class="table-responsive">
						<table class="table table-striped table-sm sizes">
							<tbody>
								<tr>
									<th scope="row">US Sizes</th>
									<td>6</td>
									<td>6,5</td>
									<td>7</td>
									<td>7,5</td>
									<td>8</td>
									<td>8,5</td>
									<td>9</td>
									<td>9,5</td>
									<td>10</td>
									<td>10,5</td>
								</tr>
								<tr>
									<th scope="row">Euro Sizes</th>
									<td>39</td>
									<td>39</td>
									<td>40</td>
									<td>40-41</td>
									<td>41</td>
									<td>41-42</td>
									<td>42</td>
									<td>42-43</td>
									<td>43</td>
									<td>43-44</td>
								</tr>
								<tr>
									<th scope="row">UK Sizes</th>
									<td>5,5</td>
									<td>6</td>
									<td>6,5</td>
									<td>7</td>
									<td>7,5</td>
									<td>8</td>
									<td>8,5</td>
									<td>9</td>
									<td>9,5</td>
									<td>10</td>
								</tr>
								<tr>
									<th scope="row">Inches</th>
									<td>9.25"</td>
									<td>9.5"</td>
									<td>9.625"</td>
									<td>9.75"</td>
									<td>9.9375"</td>
									<td>10.125"</td>
									<td>10.25"</td>
									<td>10.5"</td>
									<td>10.625"</td>
									<td>10.75"</td>
								</tr>
								<tr>
									<th scope="row">CM</th>
									<td>23,5</td>
									<td>24,1</td>
									<td>24,4</td>
									<td>24,8</td>
									<td>25,4</td>
									<td>25,7</td>
									<td>26</td>
									<td>26,7</td>
									<td>27</td>
									<td>27,3</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="toTop"></div><!-- Back to top button -->
	<!-- COMMON SCRIPTS -->
	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>
	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel_with_thumbs.js"></script>
</body>

</html>