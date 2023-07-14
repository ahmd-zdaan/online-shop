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
	<link href="css/listing.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<main>
		<div class="container-fluid px-5">
			<!-- <div class="breadcrumbs m-0 pt-3">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
			</div> -->
			<div class="row">
				<aside class="col-lg-3 my-5" id="sidebar_fixed">
					<div class="filter_col">
						<div class="inner_bt">
							<a href="#" class="open_filters">
								<i class="ti-close"></i>
							</a>
						</div>
						<!-- CATEGORY -->
						<div class="filter_type version_2">
							<h4>
								<a href="#filter_1" data-toggle="collapse" class="opened">Categories</a>
							</h4>
							<div class="collapse show" id="filter_1">
								<ul>
									<?php
									$result = get('category');
									foreach ($result as $data) :
										$category_id = $data['category_id'];
										$category_name = $data['category_name'];
									?>
										<li class="category-group">
											<label class="container_check"><?= $category_name ?>
												<?php
												$result = get('product', 'WHERE category_id="' . $category_id . '"', 'count(*)');
												$data = mysqli_fetch_assoc($result);
												$category_count = $data['count(*)'];
												?>
												<small><?= $category_count ?></small>
												<input class="category category-checkbox" type="checkbox" data-categoryId="<?= $category_id ?>" data-subcategoryId="0">
												<span class="checkmark"></span>
												<?php
												$result = get('subcategory', 'WHERE category_id=' . $category_id);
												foreach ($result as $data) :
													$subcategory_id = $data['subcategory_id'];
													$subcategory_name = $data['subcategory_name'];
												?>
													<ul class="m-0 p-0 pt-1 subcategory-group">
														<li>
															<label class="container_check m-0"><?= $subcategory_name ?>
																<?php
																$result = get('product', 'WHERE subcategory_id="' . $subcategory_id . '"', 'count(*)');
																$data = mysqli_fetch_assoc($result);
																$subcategory_count = $data['count(*)'];
																?>
																<small><?= $subcategory_count ?></small>
																<input class="subcategory subcategory-checkbox" type="checkbox" data-categoryId="<?= $category_id ?>" data-subcategoryId="<?= $subcategory_id ?>">
																<span class="checkmark"></span>
														</li>
													</ul>
												<?php endforeach ?>
											</label>
										</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<!-- PRICE -->
						<div class="filter_type version_2">
							<h4>
								<a href="#filter_4" data-toggle="collapse" class="opened">Price</a>
							</h4>
							<div class="collapse" id="filter_4">
								<?php
								$filter_price_1 = 0;
								$filter_price_2 = 0;
								$filter_price_3 = 0;
								$filter_price_4 = 0;
								$filter_price_5 = 0;

								$get_product = get('product');
								foreach ($get_product as $product) {
									$product_id = $product['product_id'];
									$price = (int)$product['price'];

									$get_sale = get('sale', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($get_sale) > 0) {
										$data_sale = mysqli_fetch_assoc($get_sale);
										$sale = (int)$data_sale['sale'];
										$price = $price - $price * $sale / 100;
									}

									if ($price < 50000) {
										$filter_price_1 += 1;
									} elseif ($price > 50000 and $price < 250000) {
										$filter_price_2 += 1;
									} elseif ($price > 250000 and $price < 1000000) {
										$filter_price_3 += 1;
									} elseif ($price > 1000000 and $price < 5000000) {
										$filter_price_4 += 1;
									} elseif ($price > 5000000) {
										$filter_price_5 += 1;
									}
								}
								?>
								<ul>
									<li>
										<label class="container_check">Rp0,00 - Rp50.000,00
											<small><?= $filter_price_1 ?></small>
											<input class="category price-check" type="checkbox" data-min-price="0" data-max-price="50000">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">Rp50.000,00 - Rp250.000,00
											<small><?= $filter_price_2 ?></small>
											<input class="category price-check" type="checkbox" data-min-price="50000" data-max-price="250000">
											<span class="checkmark"></span>
										</label>
									</li>
									<label class="container_check">Rp250.000,00 - Rp1.000.000,00
										<small><?= $filter_price_3 ?></small>
										<input class="category price-check" type="checkbox" data-min-price="250000" data-max-price="1000000">
										<span class="checkmark"></span>
									</label>
									</li>
									</li>
									<label class="container_check">Rp1.000.000,00 - Rp5.000.000,00
										<small><?= $filter_price_4 ?></small>
										<input class="category price-check" type="checkbox" data-min-price="1000000" data-max-price="5000000">
										<span class="checkmark"></span>
									</label>
									</li>
									</li>
									<label class="container_check">Rp5.000.000,00 +
										<small><?= $filter_price_5 ?></small>
										<input class="category price-check" type="checkbox" data-min-price="5000000" data-max-price="-1">
										<span class="checkmark"></span>
									</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="filter_type version_2">
							<h4><a href="#filter_3" data-toggle="collapse" class="opened">Manifacturer</a></h4>
							<div class="collapse" id="filter_3">
								<ul>
									<?php
									$result = get('manifacturer');
									$data = mysqli_fetch_assoc($result);

									foreach ($result as $data) :
										$manifacturer_name = $data['manifacturer_name'];
										$manifacturer_id = $data['manifacturer_id'];

										$result = get('product', 'WHERE manifacturer_id="' . $manifacturer_id . '"', 'count(manifacturer_id)');
										$data = mysqli_fetch_assoc($result);
										$manifacturer_count = $data['count(manifacturer_id)'];
									?>
										<li class="manifacturer-group">
											<label class="container_check"><?= $manifacturer_name ?>
												<small><?= $manifacturer_count ?></small>
												<input class="manifacturer-check" type="checkbox" data-manifacturer="<?= $manifacturer_id ?>">
												<span class="checkmark"></span>
											</label>
										</li>
									<?php
									endforeach
									?>
								</ul>
							</div>
						</div>
						<a href="#0" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
					</div>
				</aside>
				<div class="col-lg-9 my-5">
					<div id="stick_here"></div>
					<div class="toolbox elemento_stick add_bottom_30">
						<div class="container">
							<ul class="clearfix">
								<li>
									<div class="sort_select">
										<select name="sort" id="sort">
											<option value="popularity" selected="selected">Sort by popularity</option>
											<option value="rating">Sort by average rating</option>
											<option value="date">Sort by newness</option>
											<option value="price">Sort by price: low to high</option>
											<option value="price-desc">Sort by price: high to low</option>
										</select>
									</div>
								</li>
								<li>
									<a href="index.php?page=list&view=grid"><i class="ti-view-grid"></i></a>
									<a href="index.php?page=list&view=list"><i class="ti-view-list"></i></a>
								</li>
								<li>
									<a href="#0" class="open_filters">
										<i class="ti-filter"></i><span>Filters</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<?php
					$view = $_GET['view'];
					if ($view == 'grid') :
					?>
						<div class="row small-gutters">
							<?php
							$result = get('product');
							foreach ($result as $data) :
								$product_id = $data['product_id'];
								$product_name = $data['product_name'];
								$price = $data['price'];
							?>

							<?php endforeach ?>
						</div>
					<?php
					elseif ($view == 'list') :
					?>
						<div id="list-product"></div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

	<?php include 'config/filter.php' ?>
</body>