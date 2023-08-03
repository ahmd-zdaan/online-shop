<?php
$email = $_SESSION['email'];

$get_user = get('user', 'WHERE email="' . $email . '"');
$data_user = mysqli_fetch_assoc($get_user);

$user_id = $data_user['user_id'];
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
	<!-- <link href="css/product_page.css" rel="stylesheet"> -->
	<!-- <link href="css/cart.css" rel="stylesheet"> -->
	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<style>
	#more {
		display: none;
	}

	.product:hover {
		text-decoration: underline;
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
							<li>Purchase History</li>
						</ul>
					</div>
					<a href="index.php" style="text-decoration:underline;">&lt; Back</a>
					<h1 class="pt-3">Your Purchase History</h1>
				</div>
				<?php
				$get_history = get('history', 'WHERE user_id=' . $user_id);

				if (mysqli_num_rows($get_history) > 0) :
				?>
					<table class="table table-striped table-hover table-sm">
						<tbody>
							<?php
							foreach ($get_history as $history_data) :
								$history_product_id = $history_data['product_id'];
								$date = $history_data['date'];

								$get_product = get('product', 'WHERE product_id=' . $history_product_id);
								$data_product = mysqli_fetch_assoc($get_product);

								$product_id = $data_product['product_id'];
								$product_name = $data_product['product_name'];
								$category_id = $data_product['category_id'];
								$subcategory_id = $data_product['subcategory_id'];
								$price = $data_product['price'];
								$description = $data_product['description'];

								$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
								$data = mysqli_fetch_assoc($result);
								$category_name = $data['category_name'];

								$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
								$data = mysqli_fetch_assoc($result);
								$subcategory_name = $data['subcategory_name']
							?>
								<tr style="font-size: medium;">
									<td>
										<div class="row">
											<div class="col-3">
												<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
													<?php
													$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
													if (mysqli_num_rows($result) > 0) :
														$data = mysqli_fetch_assoc($result);
														$image_name = $data['image_name'];
													?>
														<img src="uploads/product/<?= $image_name ?>" alt="product_image" style="width:250px; height:250px; object-fit:scale-down">
													<?php
													else :
													?>
														<img src="uploads/product/default.jpg" alt="product_image" style="width:250px; height:250px; object-fit:scale-down">
													<?php endif ?>
												</a>
											</div>
											<div class="col-3 p-0">
												<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
													<h4 class="mt-2 product"><?= $product_name ?></h5>
												</a>
												<div class="mb-5">
													<?php
													$get_sale = get('sale', 'WHERE product_id=' . $product_id);
													if (mysqli_num_rows($get_sale) > 0) :
														$data_sale = mysqli_fetch_assoc($get_sale);
														$sale = $data_sale['sale'];
														$price_sale = $price - $price * (int)$sale / 100;
													?>
														<span style="font-size:larger" class="new_price"><?= rupiah($price_sale) ?></span>
														<span style="color:#9d9d9d" class="old_price"><?= rupiah($price) ?></span>
													<?php else : ?>
														<span style="font-size:larger" class="new_price"><?= rupiah($price) ?></span>
													<?php endif ?>
												</div>
												<p class="m-0" style="font-size:smaller">Purchased at <?= dateConvert($date) ?></p>
												<p style="color:#9d9d9d"><?= $category_name ?> > <?= $subcategory_name ?></p>
											</div>
											<div class="col pl-0 pr-4 pb-3">
												<?php
												$description_array = explode(' ', $description);
												$description_count = count($description_array);

												$description1 = '';
												$description2 = '';

												if ($description_count > 55) :
													for ($i = 0; $i < 55; $i++) {
														$description1 .= $description_array[$i] . ' ';
													}
													for ($i = 55; $i < $description_count; $i++) {
														$description2 .= $description_array[$i] . ' ';
													}
												?>
													<p class="m-0 description">
														<?= $description1 ?>
														<span id="dots">...</span>
														<span id="more"><?= $description2 ?></span>
													</p>
													<button onclick="readMore(<?= $product_id ?>)" id="readmore<?= $product_id ?>" class="btn btn-link p-0" style="font-size:small;">read more</button>
												<?php else : ?>
													<p><?= $description ?></p>
												<?php endif ?>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						<?php else : ?>
							<div class="text-center my-5 py-5">
								<img src="img/empty.png" alt="empty">
								<h3 class="mt-4">Nothing to see here</h3>
								<p class="mb-5 pb-5">You have not purchased any products</p>
							</div>
							<div class="container mt-5 px-5 pt-5" style="background-color: white;">
								<div class="row mb-4">
									<div class="col">
										<h3 class="m-0">Fill up Your Cart</h3>
										<p style="font-size:large">Explore Millions of Products</p>
									</div>
									<div class="col-2">
										<a href="index.php?page=list&view=list">
											<p class="m-0 text-right" style="text-decoration:underline">View All</p>
										</a>
									</div>
								</div>
								<div class="owl-carousel owl-theme products_carousel">
									<?php
									$result = get('product', 'LIMIT 12');
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
															<img src="uploads/product/<?= $image_name ?>" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
														<?php
														else :
														?>
															<img src="img/products/product_placeholder_square_medium.jpg" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
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
						</tbody>
					</table>
			</div>
		</main>

		<script>
			function readMore(i) {
				let dots = document.getElementById("dots");
				let moreText = document.getElementById("more");
				let btnText = document.getElementById("readmore" + i);

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
</body>

</html>