<?php
$product_id = $_GET['product_id'];

$result_product = get('product', 'WHERE product_id=' . $product_id);
$data_product = mysqli_fetch_assoc($result_product);

if ($data_product) {
	$product_name = $data_product['product_name'];
	$seller_id = $data_product['seller_id'];
	$category_id = $data_product['category_id'];
	$subcategory_id = $data_product['subcategory_id'];
	$price = $data_product['price'];
	$stock = $data_product['stock'];
	$sold = $data_product['sold'];
	$description = $data_product['description'];
	$manifacturer_id = $data_product['manifacturer_id'];
	$variant = $data_product['variant'];
	$weight = $data_product['weight'];
	$date = $data_product['date'];

	$get_user = get('user', 'WHERE user_id=' . $seller_id);
	$data_user = mysqli_fetch_assoc($get_user);

	$seller_id = $data_user['user_id'];
	$seller_name = $data_user['user_name'];

	$get_seller_image = get('user_image', 'WHERE user_id=' . $seller_id);
	if (mysqli_num_rows($get_seller_image) > 0) {
		$data_seller_image = mysqli_fetch_assoc($get_seller_image);

		$seller_image = $data_seller_image['user_image'];
	} else {
		$seller_image = 'default.jpg';
	}
}

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

	<style>
		/* READ MORE */
		#more {
			display: none;
		}

		.all .slider-two .left-t,
		.all .slider-two .right-t {
			transition: none;
		}

		.all .slider-two .item.active {
			border: solid 3px #004dda;
		}

		/* ENLARGE REVIEW IMAGE */
		.review-image {
			cursor: pointer;
			transition: opacity .1s;
		}

		.review-image:hover {
			opacity: 75%;
		}

		#myImg {
			border-radius: 5px;
			cursor: pointer;
			transition: 0.3s;
		}

		#myImg:hover {
			opacity: 0.7;
		}

		/* The Modal (background) */
		.modal {
			display: none;
			position: fixed;
			/* Stay in place */
			z-index: 1;
			/* Sit on top */
			padding-top: 50px;
			/* Location of the box */
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			/* overflow: auto; */
			/* Enable scroll if needed */
			background-color: rgb(0, 0, 0);
			/* Fallback color */
			background-color: rgba(0, 0, 0, 0.5);
			/* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
		}

		#caption {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			text-align: center;
			color: #ccc;
			padding: 10px 0;
			height: 150px;
		}

		.modal-content,
		#caption {
			-webkit-animation-name: zoom;
			-webkit-animation-duration: 0.6s;
			animation-name: zoom;
			animation-duration: 0.1s;
		}

		@-webkit-keyframes zoom {
			from {
				-webkit-transform: scale(0)
			}

			to {
				-webkit-transform: scale(1)
			}
		}

		@keyframes zoom {
			from {
				transform: scale(0)
			}

			to {
				transform: scale(1)
			}
		}

		.close {
			position: absolute;
			top: 75px;
			right: 25px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}

		.close:hover,
		.close:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}

		/* 100% Image Width on Smaller Screens */
		@media only screen and (max-width: 700px) {
			.modal-content {
				width: 100%;
			}
		}

		.disabled-button:hover {
			cursor: not-allowed;
		}
	</style>
</head>

<body>
	<main>
		<div class="container margin_30 pt-0">
			<a class="b-5" style="text-decoration:underline" href="index.php">&lt; Back</a>
			<div class="mt-2 row">
				<div class="col-md-6">
					<div class="all">
						<div class="slider">
							<div class="owl-carousel owl-theme main">
								<?php
								$get_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
								foreach ($get_product_image as $data_product_image) :
									$image_name = $data_product_image['image_name'];
								?>
									<img src="uploads/product/<?= $image_name ?>" alt="" class="item-box" style="object-fit: scale-down">
								<?php endforeach ?>
							</div>
							<div class="left nonl"><i class="ti-angle-left"></i></div>
							<div class="right"><i class="ti-angle-right"></i></div>
							<?php
							$get_sale = get('sale', 'WHERE product_id=' . $product_id);
							if (mysqli_num_rows($get_sale) > 0) :
								$data_sale = mysqli_fetch_assoc($get_sale);
								$sale = $data_sale['sale'];
								$price_sale = $price - $price * (int)$sale / 100;
							?>
								<span style="font-size:medium;" class="ribbon off ml-3 mt-3 px-3 py-2">- <?= $sale ?>%</span>
							<?php endif ?>
						</div>
						<div class="slider-two">
							<div class="owl-carousel owl-theme thumbs">
								<?php
								$i = 0;

								$get_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
								foreach ($get_product_image as $data_product_image) :
									$image_name = $data_product_image['image_name'];
									if ($i == 0) :
								?>
										<img src="uploads/product/<?= $image_name ?>" alt="" class="item active hover-opacity" style="object-fit: scale-down; transition:none;" draggable="false">
									<?php else : ?>
										<img src="uploads/product/<?= $image_name ?>" alt="" class="item hover-opacity" style="object-fit: scale-down; transition:none;" draggable="false">
								<?php
									endif;
									$i++;
								endforeach
								?>
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
							<li><a href="index.php?page=list&view=list">Product</a></li>
							<li><a href="index.php?page=list&view=list"><?= $category_name ?></a></li>
							<li><a href="index.php?page=list&view=list"><?= $subcategory_name ?></a></li>
							<?php
							$product_name_array = explode(' ', $product_name);
							$product_name_count = count($product_name_array);

							$product_name_cut = '';
							if ($product_name_count > 5) :
								for ($i = 0; $i < 5; $i++) {
									$product_name_cut .= $product_name_array[$i] . ' ';
								}
							?>
								<li><?= $product_name_cut ?>...</li>
							<?php else : ?>
								<li><?= $product_name ?></li>
							<?php endif ?>
						</ul>
					</div>
					<div class="prod_info p-0">
						<h1 class="mt-3"><?= $product_name ?></h1>
						<span class="rating mb-3">
							<?php
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
								echo '<p class="mb-0" style="color:#9d9d9d">No review</p>';
							} else {
								$n = 5 - $average_rating;
								for ($i = $n; $i > 0; $i--) {
									echo '<i class="icon-star"></i>';
								}
								echo '<em class="ml-1" style="font-size:9pt; color:#9d9d9d">( ' . $average_rating . ' / 5 )</em>';
								if ($count_rating == 1) {
									echo '<span class="ml-2" style="color:#9d9d9d">' . $count_rating . ' review • ' . $sold . ' sold • 0 discussions</span>';
								} else {
									echo '<span class="ml-2" style="color:#9d9d9d">' . $count_rating . ' reviews</span>';
								}
							}
							?>
						</span>
						<ul style="list-style: none;" class="p-0">
							<p class="mb-1">
								<b>Description</b>
							</p>
							<li>
								<?php
								$desc_array = explode(' ', $description);
								$desc_count = count($desc_array);

								$desc1 = '';
								$desc2 = '';

								if ($desc_count > 55) :
									for ($i = 0; $i < 55; $i++) {
										$desc1 .= $desc_array[$i] . ' ';
									}
									for ($i = 55; $i < $desc_count; $i++) {
										$desc2 .= $desc_array[$i] . ' ';
									}
								?>
									<p class="m-0 description">
										<?= $desc1 ?>
										<span id="dots">...</span>
										<span id="more"><?= $desc2 ?></span>
									</p>
									<button onclick="readMore()" id="readMoreBtn" class="btn btn-link p-0" style="font-size:small;">read more</button>
								<?php else : ?>
									<p><?= $description ?></p>
								<?php endif ?>
							</li>
							<hr class="hr border-3 m-0 mb-3">
							<p class="mb-1">
								<b>Details</b>
							</p>
							<li>
								<div class="row">
									<div class="col-2">
										<p class="mb-0">Seller</p>
										<p class="mb-0">Stock</p>
										<p class="mb-0">Manifacturer</p>
										<p class="mb-0">Category</p>
										<p class="mb-0">Subcategory</p>
									</div>
									<div class="col-1 pr-0">
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
										<p class="mb-0">:</p>
									</div>
									<div class="col-9 pl-0">
										<p class="mb-0"><?= $seller_name ?></p>
										<p class="mb-0"><?= $stock ?></p>
										<?php
										$manifacturer = get('manifacturer', 'WHERE manifacturer_id=' . $manifacturer_id, 'manifacturer_name');
										$data_manifacturer = mysqli_fetch_assoc($manifacturer);
										$manifacturer_name = $data_manifacturer['manifacturer_name'];
										?>
										<p class="mb-0"><?= $manifacturer_name ?></p>
										<p class="mb-0"><?= $category_name ?></p>
										<p class="mb-0"><?= $subcategory_name ?></p>
									</div>
								</div>
							</li>
						</ul>
						<hr class="hr border-3 m-0">
						<div class="prod_options">
							<div class="row">
								<label class="pt-2 col-6">
									<span style="font-weight:bolder; font-size:0.875rem">Variant</span>
									<a href="" data-toggle="modal" data-target="#size-modal">
										<i class="ti-help-alt"></i>
									</a>
								</label>
								<div class="col-4">
									<select class="form-select">
										<?php
										$variant_explode = explode(', ', $variant);
										foreach ($variant_explode as $variant_string) :
											for ($i = 0; $i < 0; $i++) :
										?>
												<option value="" selected><?= $variant_string ?></option>
											<?php endfor ?>
											<option value=""><?= $variant_string ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="row">
								<label class="pt-2 col-6">
									<span style="font-weight:bolder; font-size:0.875rem">Quantity</span>
								</label>
								<div class="col-4">
									<div class="numbers-row">
										<input disabled type="number" value="1" min="1" max="<?= $stock ?>" class="qty2">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="price_main">
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($get_sale) > 0) :
											$data_sale = mysqli_fetch_assoc($get_sale);
											$sale = $data_sale['sale'];
											$price_sale = $price - $price * (int)$sale / 100;
										?>
											<span style="font-size:x-large" class="new_price"><?= rupiah($price_sale) ?></span>
											<span style="color:#9d9d9d" class="old_price mt-2"><?= rupiah($price) ?></span>
										<?php else : ?>
											<span class="new_price"><?= rupiah($price) ?></span>
										<?php endif ?>
									</div>
								</div>
								<div class="col">
									<div class="btn_add_to_cart">
										<button class="btn_1 px-5 disabled-button" style="width:230px; font-size:12px">ADD TO CART</button>
									</div>
								</div>
							</div>
						</div>
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
				</ul>
			</div>
		</div>
		<div class="tab_content_wrapper py-5">
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
									<div class="col pr-5">
										<h3 class="mb-2">
											<b>Description</b>
										</h3>
										<p><?= $description ?></p>
									</div>
									<div class="col-5">
										<div>
											<img class="mb-3 mr-3" src="uploads/user/<?= $seller_image ?>" style="border-radius:50%; float:left" width="60px" alt="seller_image">
											<h4 class="pt-3"><?= $seller_name ?></h4>
										</div>
										<div class="mt-1" style="clear:left">
											<h3 class="mb-2">
												<b>Specifications</b>
											</h3>
											<div class="table-responsive">
												<table class="table table-sm table-striped">
													<tbody>
														<tr>
															<td>
																<strong>Stock</strong>
															</td>
															<td><?= $stock ?></td>
														</tr>
														<tr>
															<td>
																<strong>Manifacturer</strong>
															</td>
															<td><?= $manifacturer_name ?></td>
														</tr>
														<tr>
															<td>
																<strong>Variants</strong>
															</td>
															<td><?= $variant ?></td>
														</tr>
														<tr>
															<td>
																<strong>Weight</strong>
															</td>
															<?php
															if ($weight == 0) :
															?>
																<td>-</td>
															<?php else : ?>
																<td><?= $weight ?>kg</td>
															<?php endif ?>
														</tr>
														<tr>
															<td>
																<strong>Date added</strong>
															</td>
															<td><?= dateConvert($date)	 ?></td>
														</tr>
														<tr>
															<td>
																<strong>Sold</strong>
															</td>
															<td><?= $sold ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</main>

	<div id="toTop"></div><!-- Back to top button -->

	<script>
		var modal = document.getElementById("myModal");

		var img = document.getElementById("image-1");
		var modalImg = document.getElementById("image-modal-1");
		var captionText = document.getElementById("caption");

		img.onclick = function() {
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		var span = document.getElementsByClassName("close")[0];

		span.onclick = function() {
			modal.style.display = "none";
		}



		function readMore() {
			let dots = document.getElementById("dots");
			let moreText = document.getElementById("more");
			let btnText = document.getElementById("readMoreBtn");

			if (dots.style.display == "none") {
				dots.style.display = "inline";
				btnText.innerHTML = "read more";
				moreText.style.display = "none";
			} else {
				dots.style.display = "none";
				btnText.innerHTML = "read less";
				moreText.style.display = "inline";
			}
		}
	</script>

	<!-- COMMON SCRIPTS -->
	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>
	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel_with_thumbs.js"></script>
</body>

</html>