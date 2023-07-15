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
		#more {
			display: none;
		}

		.profile:hover {
			text-decoration: underline;
			text-decoration-thickness: 2px;
		}

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
			/* Hidden by default */
			position: fixed;
			/* Stay in place */
			z-index: 1;
			/* Sit on top */
			padding-top: 100px;
			/* Location of the box */
			left: 0;
			top: 0;
			width: 100%;
			/* Full width */
			height: 100%;
			/* Full height */
			overflow: auto;
			/* Enable scroll if needed */
			background-color: rgb(0, 0, 0);
			/* Fallback color */
			background-color: rgba(0, 0, 0, 0.9);
			/* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
		}

		/* Caption of Modal Image */
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

		/* Add Animation */
		.modal-content,
		#caption {
			-webkit-animation-name: zoom;
			-webkit-animation-duration: 0.6s;
			animation-name: zoom;
			animation-duration: 0.6s;
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

		/* The Close Button */
		.close {
			position: absolute;
			top: 15px;
			right: 35px;
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
	</style>
</head>

<body>
	<main>
		<div class="container margin_30">
			<div class="row">
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
										<img src="uploads/product/<?= $image_name ?>" alt="" class="item active" style="object-fit: scale-down; transition:none;" draggable="false">
									<?php else : ?>
										<img src="uploads/product/<?= $image_name ?>" alt="" class="item" style="object-fit: scale-down; transition:none;" draggable="false">
								<?php
									endif;
									$i++;
								endforeach
								?>
							</div>
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
						<span class="rating my-0">
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
								echo '<p class="ml-2" style="float:right; color:#9d9d9d">( ' . $average_rating . ' / 5 )</p>';
								if ($count_rating == 1) {
									echo '<em class="mx-2" style="color:#9d9d9d">' . $count_rating . ' review</em>';
								} else {
									echo '<em class="mx-2" style="color:#9d9d9d">' . $count_rating . ' reviews</em>';
								}
							}
							?>
							<p style="color:#9d9d9d" class="mb-3"><?= $sold ?> sold • 0 discussions</p>
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
							<p class="mb-2">
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
										<a href="index.php?page=seller_view&seller_id=<?= $seller_id ?>">
											<p class="mb-0"><?= $seller_name ?></p>
										</a>
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
							<!-- <div class="row">
								<label class="col-xl-5 col-lg-5 col-md-6 col-6">
									<strong>Color</strong>
								</label>
								<div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
									<ul>
										<li>
											<a href="" class="color color_1"></a>
										</li>
									</ul>
								</div>
							</div> -->
							<form action="" method="POST">
								<input type="text" hidden name="product_id" value="<?= $product_id ?>">
								<div class="row">
									<label class="col-xl-5 col-lg-5 col-md-6 col-6">
										<strong>VARIANT</strong>
										<a href="" data-toggle="modal" data-target="#size-modal">
											<i class="ti-help-alt"></i>
										</a>
									</label>
									<div class="col-xl-4 col-lg-5 col-md-6 col-6">
										<select class="form-select" name="size">
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
									<label class="col-xl-5 col-lg-5 col-md-6 col-6">
										<strong>Quantity</strong>
									</label>
									<div class="col-xl-4 col-lg-5 col-md-6 col-6">
										<div class="numbers-row">
											<input type="number" name="quantity" value="1" min="1" max="<?= $stock ?>" class="qty2">
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
												<span style="font-size:x-large" class="new_price"><?= rupiah($price_sale) ?></span>
												<span style="color:#9d9d9d" class="old_price mt-2"><?= rupiah($price) ?></span>
											<?php else : ?>
												<span class="new_price"><?= rupiah($price) ?></span>
											<?php endif ?>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="btn_add_to_cart">
											<button type="submit" name="submit" class="btn_1 px-5" style="font-size:12px">ADD TO CART</button>
										</div>
									</div>
								</div>
							</form>
							<?php
							if (isset($_POST['submit'])) {
								if (isset($_SESSION['email'])) {
									$quantity = $_POST['quantity'];

									echo '<script>window.location.href = "index.php?page=cart_add&product_id=' . $product_id . '&quantity=' . $quantity . '"</script>';
								} else {
									echo '<script>window.location.href = "index.php?page=login"</script>';
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
										<a style="float: left;" class="mr-4" href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')">
											<i class="ti-heart-broken"></i>
											<span>Remove from Wishlist</span>
										</a>
									<?php else : ?>
										<a style="float: left;" class="mr-4" href="index.php?page=wishlist_add&product_id=<?= $product_id ?>">
											<i class="ti-heart"></i>
											<span>Add to Wishlist</span>
										</a>
									<?php endif ?>
								<?php endif ?>
							</li>
							<li>
								<a href="index.php?page=report_product_add&product_id=<?= $product_id ?>">
									<i class="ti-announcement mr-2"></i>
									<span>Report Product</span>
								</a>
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
									<div class="col-6">
										<h3 class="mb-2">
											<b>Description</b>
										</h3>
										<p><?= $description ?></p>
									</div>
									<div class="col-5">
										<div class="mb-5">
											<a href="index.php?page=seller_view&seller_id=<?= $seller_id ?>">
												<img class="mb-4 mr-3" src="uploads/user/<?= $seller_image ?>" style="border-radius:50%; float:left" width="60px" alt="seller_image">
												<h4 class="pt-3"><?= $seller_name ?></h4>
											</a>
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
													</tbody>
												</table>
											</div>
										</div>
										<div class="mt-2">
											<a href="index.php?page=discussion_add&product_id=<?= $product_id ?>">
												<img width="30px" src="img/whatsapp.png" alt="">
												<span class="ml-1">Disscuss with <?= $seller_name ?> on Whatsapp</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
											$review_get = get('review', 'WHERE product_id=' . $product_id);

											foreach ($review_get as $review_data) :
												$review_id = $review_data['review_id'];
												$review_user_id = $review_data['user_id'];
												$rating = $review_data['rating'];
												$review = $review_data['review'];
												$date = $review_data['date'];

												$review_user_get = get('user', 'WHERE user_id=' . $review_user_id);
												$review_user_table = mysqli_fetch_assoc($review_user_get);

												$review_user_name = $review_user_table['user_name'];
												$review_user_role = $review_user_table['role'];

												if (isset($user_id)) :
													if ($review_user_id == $user_id) :
											?>
														<div class="row mb-3 border border-primary border-2 rounded rounded-3 p-3">
														<?php else : ?>
															<div class="row mb-3 border border-3 rounded rounded-3 p-3">
															<?php endif ?>
														<?php else : ?>
															<div class="row mb-3 border border-3 rounded rounded-3 p-3">
															<?php endif ?>
															<div class="col-1 pr-3 pl-0">
																<?php
																$get_review_user_image = get('user_image', 'WHERE user_id=' . $review_user_id);
																if (mysqli_num_rows($get_review_user_image) > 0) :
																	$data = mysqli_fetch_assoc($get_review_user_image);
																	$user_image = $data['user_image'];
																?>
																	<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
																<?php else : ?>
																	<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
																<?php endif ?>
															</div>
															<div class="col-11 pl-2 pt-2 mb-2">
																<?php if ($review_user_role == 'seller') : ?>
																	<a href="index.php?page=seller_view&seller_id=<?= $review_user_id ?>">
																	<?php else : ?>
																		<a href="index.php?page=view_profile&user_id=<?= $review_user_id ?>">
																		<?php endif ?>
																		<h3 style="font-weight: bold" class="mb-2 profile"><?= $review_user_name ?></h3>
																		</a>
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
																				<em>( <?= $rating ?> / 5 )</em>
																			</span>
																			<em style="font-weight:normal"><?= dateConvert($date) ?></em>
																		</div>
																		<?php
																		$get_review_image = get('review_image', 'WHERE review_id=' . $review_id);
																		if (mysqli_num_rows($get_review_image) > 0) :
																			$i = 0;

																			foreach ($get_review_image as $data_review_image) :
																				$review_image_name = $data_review_image['image_name'];
																		?>
																				<img class="mb-3 review-image" id="image-1" src="uploads/review/<?= $review_image_name ?>" alt="" width="150px">
																			<?php
																				$i++;
																			endforeach;
																			?>
																			<div id="myModal" class="modal">
																				<span class="close">&times;</span>
																				<img class="modal-content" id="image-modal-1">
																				<div id="caption"></div>
																			</div>
																		<?php endif ?>
																		<p class="m-0"><?= $review ?></p>
																		<div class="row">
																			<div class="col-4">
																				<?php
																				$get_review_helpful = get('review_helpful', 'WHERE review_id=' . $review_id, '*,count(user_id) as total_helpful');
																				$data_review_helpful = mysqli_fetch_assoc($get_review_helpful);
																				$helpful = $data_review_helpful['total_helpful'];

																				if ($helpful > 1) :
																				?>
																					<p class="mb-0 mt-4" style="font-weight:normal; color:#9d9d9d; font-size:smaller"><?= $helpful ?> people found this hepful</p>
																				<?php elseif ($helpful == 1) : ?>
																					<p class="mb-0 mt-4" style="font-weight:normal; color:#9d9d9d; font-size:smaller"><?= $helpful ?> person found this hepful</p>
																				<?php endif ?>
																			</div>
																			<div class="col">
																				<?php
																				if (isset($user_id)) :
																					if ($user_id == $review_user_id) :
																				?>
																						<div class="btn-group btn-group-sm mt-3" role="group" style="float:right">
																							<a href="index.php?page=review_edit&review_id=<?= $review_id ?>" style="float:right" class="btn btn-outline-primary">EDIT</a>
																							<a href="index.php?page=review_delete&review_id=<?= $review_id ?>&product_id=<?= $product_id ?>" style="float: right" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to DELETE this REVIEW?')">DELETE</a>
																						</div>
																					<?php else : ?>
																						<div class="btn-group btn-group-sm mt-3" role="group" style="float:right">
																							<?php
																							$get_review_helpful = get('review_helpful', 'WHERE user_id=' . $user_id . ' AND review_id=' . $review_id);

																							if (mysqli_num_rows($get_review_helpful) > 0) :
																							?>
																								<a href="index.php?page=review_helpful_delete&review_id=<?= $review_id ?>" style="float:right" class="btn btn-outline-primary">REMOVE HELPFUL</a>
																							<?php else : ?>
																								<?php
																								$get_report = get('review_report', 'WHERE user_id=' . $user_id . ' AND review_id=' . $review_id);

																								if (mysqli_num_rows($get_report) == 0) :
																								?>
																									<a href="index.php?page=review_helpful_add&review_id=<?= $review_id ?>" style="float:right" class="btn btn-outline-primary">HELPFUL</a>
																								<?php endif ?>
																							<?php endif ?>
																							<?php
																							$get_report = get('review_report', 'WHERE user_id=' . $user_id . ' AND review_id=' . $review_id);

																							if (mysqli_num_rows($get_report) > 0) :
																							?>
																								<button href="index.php?page=report_review_add&review_id=<?= $review_id ?>&product_id=<?= $product_id ?>" style="float:right" class="btn btn-outline-danger">REPORTED</button>
																							<?php else : ?>
																								<a href="index.php?page=report_review_add&review_id=<?= $review_id ?>&product_id=<?= $product_id ?>" style="float:right" class="btn btn-outline-danger">REPORT</a>
																							<?php endif ?>
																						</div>
																					<?php endif ?>
																				<?php endif ?>
																			</div>
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
				<div class="container margin_60_35 pb-0">
					<div class="row">
						<div class="col">
							<h2 class="m-0">More from <?= $seller_name ?></h2>
							<p>Browse more products from <?= $seller_name ?></p>
						</div>
						<div class="col text-right mt-4">
							<a href="index.php?page=seller_view&seller_id=<?= $seller_id ?>" style="text-decoration:underline;">Show All</a>
						</div>
					</div>
					<div class="owl-carousel owl-theme products_carousel">
						<?php
						$get_product_seller = get('product', 'WHERE seller_id=' . $seller_id);

						foreach ($get_product_seller as $data_product_seller) :
							$product_id_seller = $data_product_seller['product_id'];
							if ($product_id_seller != $product_id) :
								$product_name_seller = $data_product_seller['product_name'];
								$price_seller = $data_product_seller['price'];

								$get_product_image_seller = get('product_image', 'WHERE product_id=' . $product_id_seller);
								$data_product_image_seller = mysqli_fetch_assoc($get_product_image_seller);

								$image_name_seller = $data_product_image_seller['image_name'];
						?>
								<div class="item">
									<div class="grid_item">
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id_seller);
										if (mysqli_num_rows($get_sale) > 0) :
											$data_sale = mysqli_fetch_assoc($get_sale);
											$sale = $data_sale['sale'];
											$price_sale = $price_seller - $price_seller * (int)$sale / 100;
										?>
											<span class="ribbon off">- <?= $sale ?>%</span>
										<?php endif ?>
										<figure>
											<a href="index.php?page=product_view&product_id=<?= $product_id_seller ?>">
												<img src="uploads/product/<?= $image_name_seller ?>" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;" alt="product_image_related">
											</a>
										</figure>
										<div class="rating">
											<?php
											$get_review_seller = get('review', 'WHERE product_id="' . $product_id_seller . '"', 'sum(rating)');
											$data_review_seller = mysqli_fetch_assoc($get_review_seller);

											$total_rating = (int)$data_review_seller['sum(rating)'];

											$get_review_seller = get('review', 'WHERE product_id="' . $product_id_seller . '"', 'count(rating)');
											$data_review_seller = mysqli_fetch_assoc($get_review_seller);

											$count_rating = (int)$data_review_seller['count(rating)'];

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
										<a href="index.php?page=product_view&product_id=<?= $product_id_seller ?>">
											<h3><?= $product_name_seller ?></h3>
										</a>
										<div class="price_box">
											<?php
											$get_sale = get('sale', 'WHERE product_id=' . $product_id_seller);
											if (mysqli_num_rows($get_sale) > 0) :
											?>
												<span class="new_price"><?= rupiah($price_sale) ?></span>
												<span class="old_price" style="font-size:small"><?= rupiah($price) ?></span>
											<?php else : ?>
												<span class="new_price"><?= rupiah($price_seller) ?></span>
											<?php endif ?>
										</div>
										<ul>
											<li>
												<?php
												if (isset($_SESSION['email'])) :
													$email = $_SESSION['email'];

													$get_user = get('user', 'WHERE email="' . $email . '"');
													$data_user = mysqli_fetch_assoc($get_user);

													$role = $data_user['role'];
													if ($role != 'seller') :

														$user_id = $data_user['user_id'];

														$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id_seller);
														if (mysqli_num_rows($get_wishlist) > 0) :
												?>
															<a href="index.php?page=wishlist_remove&product_id=<?= $product_id_seller ?>" class="tooltip-1" title="Remove from Wishlist" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" data-toggle="tooltip" data-placement="left">
																<i class="ti-heart-broken"></i>
															</a>
														<?php else : ?>
															<a href="index.php?page=wishlist_add&product_id=<?= $product_id_seller ?>" class="tooltip-1" title="Add to Wishlist" data-toggle="tooltip" data-placement="left">
																<i class="ti-heart"></i>
															</a>
														<?php endif ?>
													<?php endif ?>
												<?php endif ?>
											</li>
											<li>
												<?php
												if (isset($user_id) and $role != 'seller') :
													$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id_seller);
													if (mysqli_num_rows($get_cart) > 0) :
												?>
														<a href="index.php?page=cart_add&product_id=<?= $product_id_seller ?>&quantity=1" class="tooltip-1" title="Remove from Cart" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
															<i class="ti-shopping-cart-full"></i>
														</a>
													<?php else : ?>
														<a href="index.php?page=cart_add&product_id=<?= $product_id_seller ?>&quantity=1" class="tooltip-1" title="Add to Cart" data-toggle="tooltip" data-placement="left">
															<i class="ti-shopping-cart"></i>
														</a>
													<?php endif ?>
												<?php endif ?>
											</li>
										</ul>
									</div>
								</div>
						<?php endif;
						endforeach ?>
					</div>
				</div>
				<?php
				$get_product_related = get('product', 'WHERE category_id=' . $category_id . ' AND NOT product_id=' . $product_id);
				if (mysqli_num_rows($get_product_related) > 0) :
				?>
					<div class="container margin_60_35 pt-0">
						<div class="row">
							<div class="col">
								<h2 class="m-0">Related Products</h2>
								<p>Browse other products in this category</p>
							</div>
							<div class="col text-right mt-4">
								<a href="index.php?page=list&view=list" style="text-decoration:underline;">Show All</a>
							</div>
						</div>
						<div class="owl-carousel owl-theme products_carousel">
							<?php
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
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id_related);
										if (mysqli_num_rows($get_sale) > 0) :
											$data_sale = mysqli_fetch_assoc($get_sale);
											$sale = $data_sale['sale'];
											$price_sale = $price_related - $price_related * (int)$sale / 100;
										?>
											<span class="ribbon off">- <?= $sale ?>%</span>
										<?php endif ?>
										<figure>
											<a href="index.php?page=product_view&product_id=<?= $product_id_related ?>">
												<img src="uploads/product/<?= $image_name_related ?>" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;" alt="product_image_related">
											</a>
										</figure>
										<div class="rating">
											<?php
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
												echo '<em class="ml-2" style="color:#9d9d9d">(' . $count_rating . ')</em>';
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
												<span class="new_price"><?= rupiah($price_related) ?></span>
											<?php endif ?>
										</div>
										<ul>
											<li>
												<?php
												if (isset($user_id) and $role != 'seller') :
													$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id_related);
													if (mysqli_num_rows($get_wishlist) > 0) :
												?>
														<a href="index.php?page=wishlist_remove&product_id=<?= $product_id_related ?>" class="tooltip-1" title="Remove from Wishlist" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" data-toggle="tooltip" data-placement="left">
															<i class="ti-heart-broken"></i>
														</a>
													<?php else : ?>
														<a href="index.php?page=wishlist_add&product_id=<?= $product_id_related ?>" class="tooltip-1" title="Add to Wishlist" data-toggle="tooltip" data-placement="left">
															<i class="ti-heart"></i>
														</a>
													<?php endif ?>
												<?php endif ?>
											</li>
											<li>
												<?php
												if (isset($user_id) and $role != 'seller') :
													$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id_related);
													if (mysqli_num_rows($get_cart) > 0) :
												?>
														<a href="index.php?page=cart_add&product_id=<?= $product_id_related ?>&quantity=1" class="tooltip-1" title="Remove from Cart" data-toggle="tooltip" data-placement="left" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')">
															<i class="ti-shopping-cart-full"></i>
														</a>
													<?php else : ?>
														<a href="index.php?page=cart_add&product_id=<?= $product_id_related ?>&quantity=1" class="tooltip-1" title="Add to Cart" data-toggle="tooltip" data-placement="left">
															<i class="ti-shopping-cart"></i>
														</a>
													<?php endif ?>
												<?php endif ?>
											</li>
											<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
										</ul>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				<?php endif ?>
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

			if (dots.style.display === "none") {
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