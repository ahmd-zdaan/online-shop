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
										<li>
											<label class="container_check"><?= $category_name ?>
												<?php
												$result = get('subcategory', 'WHERE category_id="' . $category_id . '"', 'count(*)');
												$data = mysqli_fetch_assoc($result);
												$category_count = $data['count(*)'];
												?>
												<small><?= $category_count ?></small>
												<input class="category" type="checkbox" data-categoryId="<?= $category_id ?>" data-subcategoryId="0">
												<span class="checkmark"></span>
												<?php
												$result = get('subcategory', 'WHERE category_id=' . $category_id);
												foreach ($result as $data) :
													$subcategory_id = $data['subcategory_id'];
													$subcategory_name = $data['subcategory_name'];
												?>
													<ul class="m-0 p-0 pt-1">
														<li>
															<label class="container_check m-0"><?= $subcategory_name ?>
																<?php
																$result = get('product', 'WHERE subcategory_id="' . $subcategory_id . '"', 'count(*)');
																$data = mysqli_fetch_assoc($result);
																$subcategory_count = $data['count(*)'];
																?>
																<small><?= $subcategory_count ?></small>
																<input class="subcategory" type="checkbox" data-categoryId="<?= $category_id ?>" data-subcategoryId="<?= $subcategory_id ?>">
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
							<h4><a href="#filter_4" data-toggle="collapse" class="closed">Price</a></h4>
							<div class="collapse" id="filter_4">
								<?php
								$price1 = 0;
								$price2 = 50000;
								$price3 = 250000;
								$price4 = 1000000;
								$price5 = 5000000;
								?>
								<ul>
									<li>
										<label class="container_check"><?= rupiah($price1) . ' - ' . rupiah($price2) ?>
											<?php
											$result = get('product', 'WHERE REPLACE(price,".","") BETWEEN ' . $price1 . ' AND ' . $price2, 'count(product_name)');
											$data = mysqli_fetch_assoc($result);
											$price_count = $data['count(product_name)'];
											?>
											<small><?= $price_count ?></small>
											<input type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check"><?= rupiah($price2) . ' - ' . rupiah($price3) ?>
											<?php
											$result = get('product', 'WHERE REPLACE(price,".","") BETWEEN ' . $price2 . ' AND ' . $price3, 'count(product_name)');
											$data = mysqli_fetch_assoc($result);
											$price_count = $data['count(product_name)'];
											?>
											<small><?= $price_count ?></small>
											<input type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check"><?= rupiah($price3) . ' - ' . rupiah($price4) ?>
											<?php
											$result = get('product', 'WHERE REPLACE(price,".","") BETWEEN ' . $price3 . ' AND ' . $price4, 'count(product_name)');
											$data = mysqli_fetch_assoc($result);
											$price_count = $data['count(product_name)'];
											?>
											<small><?= $price_count ?></small>
											<input type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check"><?= rupiah($price4) . ' - ' . rupiah($price5) ?>
											<?php
											$result = get('product', 'WHERE REPLACE(price,".","") BETWEEN ' . $price4 . ' AND ' . $price5, 'count(product_name)');
											$data = mysqli_fetch_assoc($result);
											$price_count = $data['count(product_name)'];
											?>
											<small><?= $price_count ?></small>
											<input type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
								</ul>
							</div>
						</div>
						<!-- MANIFACTURER -->
						<div class="filter_type version_2">
							<h4><a href="#filter_3" data-toggle="collapse" class="closed">Brands</a></h4>
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
										<li>
											<label class="container_check"><?= $manifacturer_name ?>
												<small><?= $manifacturer_count ?></small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									<?php
									endforeach
									?>
								</ul>
							</div>
						</div>
						<div class="buttons">
							<a href="#0" class="btn_1">Filter</a> <a href="#0" class="btn_1 gray">Reset</a>
						</div>
					</div>
				</aside>
				<div class="col-lg-9 my-5">
					<!-- <div class="top_banner">
						<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
							<div class="container pl-lg-5">
								<h1>Product List</h1>
							</div>
						</div>
						<img src="https://unsplash.it/50/50" class="img-fluid" alt="">
					</div> -->
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

					<!-- PRODUCT -->
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
					<!-- <div class="pagination__wrapper">
						<ul class="pagination">
							<li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
							<li>
								<a href="#0" class="active">1</a>
							</li>
							<li>
								<a href="#0">2</a>
							</li>
							<li>
								<a href="#0">3</a>
							</li>
							<li>
								<a href="#0">4</a>
							</li>
							<li><a href="#0" class="next" title="next page">&#10095;</a></li>
						</ul>
					</div> -->
				</div>
			</div>
		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

	<?php include 'config/filter.php' ?>
</body>