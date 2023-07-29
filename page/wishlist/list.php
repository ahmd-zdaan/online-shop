<?php
check('login');

$user_email = $_SESSION['email'];

$get_user = get('user', 'WHERE email="' . $user_email . '"');
$data_user = mysqli_fetch_assoc($get_user);

$user_id = $data_user['user_id'];
$user_name = $data_user['user_name'];
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

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header mb-3">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=view_profile"><?= $user_name ?></a></li>
							<li>Wishlist</li>
						</ul>
					</div>
					<a href="index.php" style="text-decoration:underline;">&lt; Back</a>
					<h1 class="pt-3">Your Wishlist</h1>
				</div>
				<?php
				$get_wishlist = get('wishlist', 'WHERE user_id=' . $user_id);
				if (mysqli_num_rows($get_wishlist) > 0) :
				?>
					<table class="table table-striped table-hover table-sm">
						<tbody>
							<?php
							foreach ($get_wishlist as $data_wishlist) :
								$product_id_wishlist = $data_wishlist['product_id'];

								$get_product = get('product', 'WHERE product_id=' . $product_id_wishlist);
								$data_product = mysqli_fetch_assoc($get_product);

								$product_id = $data_product['product_id'];
								$product_name = $data_product['product_name'];
								$category_id = $data_product['category_id'];
								$subcategory_id = $data_product['subcategory_id'];
								$price = $data_product['price'];
								$stock = $data_product['stock'];
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
												<a class="product-image" href="index.php?page=product_view&product_id=<?= $product_id ?>">
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
												<p>Stock: <?= $stock ?></p>
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
														<span id="dots<?= $product_id ?>">...</span>
														<span style="display:none" id="more<?= $product_id ?>"><?= $description2 ?></span>
													</p>
													<button onclick="readMore(<?= $product_id ?>)" id="readmore<?= $product_id ?>" class="btn btn-link p-0" style="font-size:small;">read more</button>
												<?php else : ?>
													<p><?= $description ?></p>
												<?php endif ?>
											</div>
											<div class="col-1 p-0" style="max-width:57px">
												<div class="btn-group-vertical btn-group-sm">
													<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="View" data-placement="left" href="index.php?page=product_view&product_id=<?= $product_id ?>">
														<i class="ti-eye"></i>
													</a>
													<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-danger tooltip-1" title="Delete" data-placement="left" href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')">
														<i class="ti-trash"></i>
													</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php else : ?>
					<div class="text-center my-5 py-5">
						<img src="img/empty.png" alt="empty">
						<h3 class="mt-4">Nothing to see here</h3>
						<p class="mb-5 pb-5">You have not wishlisted any products</p>
					</div>
					<div class="container mt-5 p-5" style="background-color: white;">
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
												$result = get('product_image', 'WHERE product_id=' . $product_id);
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
				<div class="row add_top_30 flex-sm-row-reverse">
				</div>
			</div>
		</main>
</body>

<script>
	function readMore(product_id) {
		let dots = document.getElementById("dots" + product_id);
		let moreText = document.getElementById("more" + product_id);
		let btnText = document.getElementById("readmore" + product_id);

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

</html>