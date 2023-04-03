<?php
$product_id = $_GET['product_id'];

// $result = get('product', 'JOIN category ON product.category_id=category.category_id WHERE product_id="' . $product_id . '"');
$result = get('product', 'WHERE product_id='.$product_id);
$data = mysqli_fetch_assoc($result);

if ($data) {
	$name = $data['product_name'];
	// $image = $data['image'];
	$subcategory_id = $data['subcategory_id'];
	$price = $data['price'];
	$stock = $data['stock'];
	$description = $data['description'];
	$manifacturer = $data['manifacturer_id'];
	$size = $data['size'];
	$color = $data['color'];
	$weight = $data['weight'];
}
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
								<img src="https://unsplash.it/50/50" alt="" class="item-box" style="object-fit: cover;">
								<img src="https://unsplash.it/50/50" alt="" class="item-box" style="object-fit: cover;">
								<img src="https://unsplash.it/50/50" alt="" class="item-box" style="object-fit: cover;">
							</div>
							<div class="left nonl"><i class="ti-angle-left"></i></div>
							<div class="right"><i class="ti-angle-right"></i></div>
						</div>
						<div class="slider-two">
							<div class="owl-carousel owl-theme thumbs">
								<img src="https://unsplash.it/50/50" alt="" class="item active" style="object-fit: cover;">
								<img src="https://unsplash.it/50/50" alt="" class="item" style="object-fit: cover;">
								<img src="https://unsplash.it/50/50" alt="" class="item" style="object-fit: cover;">
								<img src="https://unsplash.it/50/50" alt="" class="item" style="object-fit: cover;">
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
							<li><?= $name ?></li>
						</ul>
					</div>
					<!-- PRODUCT -->
					<div class="prod_info">
						<h1><?= $name ?></h1>
						<span class="rating">
							<?php
							// Rating
							$result = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
							$data = mysqli_fetch_assoc($result);
							$total_rating = (int)$data['sum(rating)'];

							$result = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
							$data = mysqli_fetch_assoc($result);
							$count_rating = (int)$data['count(rating)'];
							
							if ($count_rating > 0) {
								$average_rating = $total_rating / $count_rating;
								
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

							// Reviews
							// $result = count_col('review', 'WHERE product_id="'.$id.'"');
							// $reviews = mysqli_fetch_assoc($result);
							?>
							<!-- <em><?= $reviews['count(*)'] ?> reviews</em> -->
						</span>
						<!-- DETAILS -->
						<ul style="list-style: none;" class="p-0">
							<p class="mb-1">
								<strong>Description</strong>
							</p>
							<li>
								<p><?= $description ?></p>
							</li>
							<hr class="hr m-0 mb-3">
							<p class="mb-1">
								<strong>Details</strong>
							</p>
							<li>
								<div class="row">
									<div class="col-2">
										<p class="mb-0">Category</p>
										<p class="mb-0">Subcategory</p>
										<p class="mb-0">Stock</p>
									</div>
									<div class="col-1">
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
									</div>
									<div class="col-9">
										<?php
										$result = get('subcategory', 'WHERE subcategory_id='.$subcategory_id, 'category_id');
										$data = mysqli_fetch_assoc($result);
										$category_id = $data['category_id'];
										$result = get('category', 'WHERE category_id='.$category_id, 'category_name');
										$data = mysqli_fetch_assoc($result);
										$category_name = $data['category_name'];
										?>
										<p class="mb-0"><?= $category_name ?></p>
										<?php
										$result = get('subcategory', 'WHERE subcategory_id='.$subcategory_id, 'subcategory_name');
										$data = mysqli_fetch_assoc($result);
										$subcategory_name = $data['subcategory_name'];
										?>
										<p class="mb-0"><?= $subcategory_name ?></p>
										<p class="mb-0"><?= $stock ?></p>
									</div>
								</div>
							</li>
						</ul>
						<hr class="hr m-0">
						<!-- OPTIONS -->
						<div class="prod_options">
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
							<form action="" method="POST">
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
							</form>
							<div class="row">
								<label class="col-xl-5 col-lg-5  col-md-6 col-6">
									<strong>Quantity</strong>
								</label>
								<div class="col-xl-4 col-lg-5 col-md-6 col-6">
									<div class="numbers-row">
										<input type="number" value="1" class="qty2">
									</div>
								</div>
							</div>
						</div>
						<!-- PAYMENT -->
						<div class="row">
							<div class="col-lg-5 col-md-6">
								<div class="price_main">
									<span class="new_price">Rp<?= $price ?></span>
									<!-- SALE -->
									<!-- <span class="new_price">$148.00</span>
									<span class="percentage">-20%</span> <span class="old_price">$160.00</span> -->
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="btn_add_to_cart"><a href="index.php?page=checkout" class="btn_1">Add to Cart</a></div>
							</div>
						</div>
					</div>

					<div class="product_actions">
						<ul>
							<li>
								<a href="index.php?page=add_wishlist"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
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
										<h3>Description</h3>
										<p><?= $description ?></p>
									</div>
									<div class="col-lg-5">
										<h3>Specifications</h3>
										<div class="table-responsive">
											<table class="table table-sm table-striped">
												<tbody>
													<tr>
														<td><strong>Manifacturer</strong></td>
														<td><?= $manifacturer ?></td>
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
									<?php
									$result = get('review');
									foreach ($result as $data) :
										$product_id = $data['product_id'];
										$user_id = $data['user_id'];
										$title = $data['title'];
										$rating = $data['rating'];
										$review = $data['review'];
										$date = $data['date'];
									?>
										<div class="col-lg-6">
											<div class="review_content">
												<div class="clearfix add_bottom_10">
													<span class="rating">
														<?php
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
														<em><?=$rating?>.0/5.0</em>
													</span>
													<!-- <em>Published 54 minutes ago</em> -->
													<em><?= $date ?></em>
												</div>
												<h4><?=$title?></h4>
												<p><?= $review ?></p>
											</div>
										</div>
									<?php endforeach ?>
								</div>
								<p class="text-right"><a href="index.php?page=review" class="btn_1">Leave a review</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Related</h2>
				<!-- <span>Products</span> -->
				<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				<div class="item">
					<div class="grid_item">
						<span class="ribbon new">New</span>
						<figure>
							<a href="product-detail-1.html">
								<img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/4.jpg" alt="">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3>ACG React Terra</h3>
						</a>
						<div class="price_box">
							<span class="new_price">$110.00</span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
				<div class="item">
					<div class="grid_item">
						<span class="ribbon new">New</span>
						<figure>
							<a href="product-detail-1.html">
								<img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/5.jpg" alt="">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3>Air Zoom Alpha</h3>
						</a>
						<div class="price_box">
							<span class="new_price">$140.00</span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
				<div class="item">
					<div class="grid_item">
						<span class="ribbon hot">Hot</span>
						<figure>
							<a href="product-detail-1.html">
								<img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/8.jpg" alt="">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3>Air Color 720</h3>
						</a>
						<div class="price_box">
							<span class="new_price">$120.00</span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
				<div class="item">
					<div class="grid_item">
						<span class="ribbon off">-30%</span>
						<figure>
							<a href="product-detail-1.html">
								<img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/2.jpg" alt="">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3>Okwahn II</h3>
						</a>
						<div class="price_box">
							<span class="new_price">$90.00</span>
							<span class="old_price">$170.00</span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
				<div class="item">
					<div class="grid_item">
						<span class="ribbon off">-50%</span>
						<figure>
							<a href="product-detail-1.html">
								<img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="img/products/shoes/3.jpg" alt="">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3>Air Wildwood ACG</h3>
						</a>
						<div class="price_box">
							<span class="new_price">$75.00</span>
							<span class="old_price">$155.00</span>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
							<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
				<!-- /item -->
			</div>
			<!-- /products_carousel -->
		</div>
		<!-- /container -->

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
					<!-- /table -->
				</div>
			</div>
		</div>
	</div>

	<!-- COMMON SCRIPTS -->
	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel_with_thumbs.js"></script>
</body>

</html>