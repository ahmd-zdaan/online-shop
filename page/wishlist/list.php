<?php
check('login');
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
	<!-- <link href="css/cart.css" rel="stylesheet"> -->

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30 pb-0">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li>Wishlist</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-6">
							<h1 class="pt-3">Wishlist</h1>
						</div>
					</div>
				</div>
				<?php
				$user_email = $_SESSION['email'];
				$result = get('user', 'WHERE email="' . $user_email . '"');
				$data = mysqli_fetch_assoc($result);

				$user_id = $data['user_id'];

				$result = get('wishlist', 'WHERE user_id=' . $user_id);
				if (mysqli_num_rows($result) > 0) :
				?>
					<table class="table table-striped table-hover table-sm">
						<thead>
							<tr>
								<th width="150px">
									Name
								</th>
								<th width="150px">
									Price
								</th>
								<th width="150px">
									Category
								</th>
								<th width="150px">
									Subcategory
								</th>
								<th>
									Description
								</th>
								<th width="150px">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($result as $data) :
								$product_id = $data['product_id'];

								$result_product = get('product', 'WHERE product_id=' . $product_id);
								$data_product = mysqli_fetch_assoc($result_product);

								$product_id = $data_product['product_id'];
								$product_name = $data_product['product_name'];
								$category_id = $data_product['category_id'];
								$subcategory_id = $data_product['subcategory_id'];
								$price = $data_product['price'];
								$description = $data_product['description'];
							?>
								<tr style="font-size: medium;">
									<td>
										<div class="thumb_cart">
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
										</div>
										<span class="item_cart">
											<h5 class="mt-2"><?= $product_name ?></h5>
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
												<span class="new_price"><?= rupiah($price_sale) ?></span>
												<span style="color:#9d9d9d" class="old_price mt-2"><?= rupiah($price) ?></span>
											<?php else : ?>
												<span class="new_price"><?= rupiah($price) ?></span>
											<?php endif ?>
										</strong>
									</td>
									<td>
										<?php
										$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
										$data = mysqli_fetch_assoc($result);
										$category_name = $data['category_name'];
										?>
										<p><?= $category_name ?></p>
									</td>
									<td>
										<?php
										$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
										$data = mysqli_fetch_assoc($result);
										$subcategory_name = $data['subcategory_name']
										?>
										<p><?= $subcategory_name ?></p>
									</td>
									<td>
										<p>
											<?php
											if (strlen($description) > 400) {
												echo substr($description, 0, 400);
												echo ' ...';
											} else {
												echo $description;
											}
											?>
										</p>
									</td>
									<td>
										<a href="index.php?page=product_view&product_id=<?= $product_id ?>" class="btn_1 col p-3 my-1">VIEW PRODUCT</a>
										<a href="index.php?page=wishlist_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to REMOVE this product from your WISHLIST?')" class="btn_1 col p-3 my-1">REMOVE</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php else : ?>
					<div class="text-center my-5 pb-5">
						<img src="img/empty.png" alt="empty">
						<h3 class="mt-4">Nothing to see here</h3>
						<p class="mb-5 pb-5">You have not wishlisted any products</p>
					</div>
					<div class="container margin_60_35 mt-5 pb-0" style="background-color: white;">
						<div class="main_title">
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
											<!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
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

</html>