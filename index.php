<?php
include_once 'config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<?php
	if (isset($_GET['page'])) {
		if ($_GET['page'] == 'product_view') {
			$page_product_id = $_GET['product_id'];
			$get_product = get('product', 'WHERE product_id=' . $page_product_id);
			$data_product = mysqli_fetch_assoc($get_product);
			$page_product = $data_product['product_name'];
			$page = 'Online Shop - ' . $page_product;
		} else {
			$page = $_GET['page'];
			$page = str_replace('_', ' ', $page);
			$page = ucwords($page);
			$page = 'Online Shop - ' . $page;
		}
	} else {
		$page = 'Online Shop - Home';
	}
	?>
	<title><?= $page ?></title>

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
	<link href="css/home_1.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
</head>

<style>
	.hover-opacity:hover {
		opacity: 75%;
	}

	.hover-underline:hover {
		text-decoration: underline;
	}

	header.version_1 .main_nav ul.top_tools>li a strong {
		background-color: #083487;
		color: #fff !important;

		font-size: 10px;
		font-size: 0.625rem;
		font-weight: 700;
		width: 16px;
		height: 16px;
		text-indent: 0;
		display: block;
		text-align: center;
		position: absolute;
		bottom: 10px;
		right: -3px;
		line-height: 17px !important;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		-ms-border-radius: 50%;
		border-radius: 50%;
	}

	.discuss strong {
		background-color: #083487;
		color: #fff !important;

		font-size: 0.625rem;
		font-weight: 700;
		width: 16px;
		height: 16px;
		text-indent: 0;
		display: block;
		text-align: center;
		position: absolute;
		bottom: 10px;
		right: -7px;
		line-height: 17px !important;
		-moz-border-radius: 50%;
		-ms-border-radius: 50%;
		border-radius: 50%;
	}
</style>

<body>
	<div id="page">
		<header class="version_1">
			<div class="main_nav Sticky">
				<div class="container">
					<div class="row small-gutters">
						<div class="col-xl-3 col-lg-3 col-md-3">
							<nav class="categories">
								<ul class="clearfix">
									<li>
										<span>
											<a>
												<button class="hamburger hamburger--spin" type="button">
													<span class="hamburger-box">
														<span class="hamburger-inner"></span>
													</span>
												</button>
											</a>
										</span>
										<span>
											<a href="index.php" class="pl-3">LOGO</a>
										</span>
										<div id="menu">
											<ul class="pb-4">
												<a href="index.php?page=list&view=list">
													<h5 class="pt-3 px-3 m-0 hover-underline">Categories</h5>
												</a>
												<?php
												$result = get('category');
												foreach ($result as $data) :
													$category_id = $data['category_id'];
													$category_name = $data['category_name'];
												?>
													<li class="my-2" style="height:20px">
														<span>
															<a href="index.php?page=list&view=list&category_id=<?= $category_id ?>"><?= $category_name ?></a>
														</span>
														<?php
														$result = get('subcategory', 'WHERE category_id=' . $category_id);
														if (mysqli_num_rows($result) > 0) :
														?>
															<ul>
																<?php foreach ($result as $data) :
																	$subcategory_id = $data['subcategory_id'];
																	$subcategory_name = $data['subcategory_name'];
																?>
																	<li class="my-2" style="height:20px">
																		<a href="index.php?page=list&view=list&category_id=<?= $category_id ?>&subcategory_id=<?= $subcategory_id ?>"><?= $subcategory_name ?></a>
																	</li>
																<?php endforeach ?>
															</ul>
														<?php endif ?>
													</li>
												<?php
												endforeach
												?>
											</ul>
										</div>
									</li>
								</ul>
							</nav>
						</div>
						<form id="form_search" class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block" method="GET" action="">
							<div class="custom-search-input">
								<input type="hidden" name="page" value="list">
								<input type="hidden" name="view" value="list">
								<input id="search_input" name="search_input" type="text" placeholder="Search over 10.000 products">
								<button name="search_submit" type="submit">
									<i style="font-size:smaller" class="header-icon_search_custom"></i>
								</button>
							</div>
						</form>
						<div class="col-xl-3 col-lg-2 col-md-3">
							<ul class="top_tools">
								<?php
								if (isset($_SESSION['email'])) :
									$email = $_SESSION['email'];

									$result = get('user', 'WHERE email="' . $email . '"');
									$data = mysqli_fetch_assoc($result);

									$user_id = $data['user_id'];
									$user_role = $data['role'];

									if ($user_role != 'seller') :
								?>
										<li>
											<div class="dropdown dropdown-cart">
												<a href="index.php?page=cart_list" style="padding-top:8px">
													<i class="ti-shopping-cart" style="font-size:21pt"></i>
													<?php
													$result = get('cart', 'WHERE user_id=' . $user_id);
													if (mysqli_fetch_assoc($result) > 0) :
														$result = get('cart', 'WHERE user_id=' . $user_id, '*,SUM(quantity) AS total_quantity');
														$data = mysqli_fetch_assoc($result);
														$total_quantity = $data['total_quantity'];
														if ($total_quantity > 0) :
													?>
															<strong><?= $total_quantity ?></strong>
														<?php endif ?>
													<?php endif ?>
												</a>
												<?php
												$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,SUM(quantity) AS total_quantity');

												if (mysqli_num_rows($get_cart) > 0) :
												?>
													<div class="dropdown-menu" style="width: 300px;">
														<ul>
															<?php
															$subtotal_price = 0;

															foreach ($get_cart as $data_cart) :
																$cart_id = $data_cart['cart_id'];
																$product_id = $data_cart['product_id'];
																$total_quantity = $data_cart['total_quantity'];

																$get_cart_product = get('product', 'WHERE product_id=' . $product_id);
																$data_cart_product = mysqli_fetch_assoc($get_cart_product);

																$cart_product_name = $data_cart_product['product_name'];
																$cart_product_price = $data_cart_product['price'];

																$get_cart_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');

																if (mysqli_num_rows($get_cart_product_image) > 0) {
																	$data_cart_product_image = mysqli_fetch_assoc($get_cart_product_image);

																	$product_image = $data_cart_product_image['image_name'];
																}

																$get_sale = get('sale', 'WHERE product_id=' . $product_id);
																if (mysqli_num_rows($get_sale) > 0) {
																	$data_sale = mysqli_fetch_assoc($get_sale);
																	$sale = $data_sale['sale'];
																	$price_sale = $cart_product_price - $cart_product_price * (int)$sale / 100;

																	$subtotal_product = $total_quantity * $price_sale;
																	$subtotal_price += $subtotal_product;
																} else {
																	$subtotal_product = $total_quantity * $cart_product_price;
																	$subtotal_price += $subtotal_product;
																}

															?>
																<li style="border:none">
																	<a style="border-bottom:1px solid #ededed" href="index.php?page=product_view&product_id=<?= $product_id ?>">
																		<figure style="width:70px; height:70px;">
																			<?php
																			if (mysqli_num_rows($get_cart_product_image) > 0) :
																			?>
																				<img src="uploads/product/<?= $product_image ?>" alt="product_image" width="100%" style="width:60px; height:60px; object-fit:scale-down">
																			<?php else : ?>
																				<img src="uploads/product/default.jpg" alt="product_image" width="100%" style="width:60px; height:60px; object-fit:scale-down">
																			<?php endif ?>
																		</figure>
																		<div class="ml-4">
																			<p class="m-0" style="font-size:larger; font-weight:500">
																				<span style="color:#004cd7">
																					<?= $total_quantity . '&times; ' ?>
																				</span>
																				<?= $cart_product_name ?>
																			</p>
																			<?php
																			$get_sale = get('sale', 'WHERE product_id=' . $product_id);
																			if (mysqli_num_rows($get_sale) > 0) :
																			?>
																				<p class="new_price m-0"><?= rupiah($price_sale) ?></p>
																				<p class="old_price m-0" style="font-size:small"><?= rupiah($cart_product_price) ?></p>
																			<?php else : ?>
																				<p class="new_price m-0"><?= rupiah($cart_product_price) ?></p>
																			<?php endif ?>
																		</div>
																	</a>
																	<a href="index.php?page=cart_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure you want to REMOVE this PRODUCT from your cart?')" class="action">
																		<i class="ti-trash"></i>
																	</a>
																</li>
															<?php endforeach ?>
														</ul>
														<?php
														$shipping_price = 17000;
														$total_price = $subtotal_price + $shipping_price;
														?>
														<div class="row mt-4">
															<div class="col-6">
																<p class="m-0">Subtotal</p>
																<p class="m-0">Shipping</p>
															</div>
															<div class="col-6">
																<span style="float: right"><?= rupiah($subtotal_price) ?></span>
																<span style="float: right"><?= rupiah($shipping_price) ?></span>
															</div>
														</div>
														<div style="font-size: large; font-weight:bold;" class="mt-2 row">
															<div class="col-6">
																<p class="m-0">Total</p>
															</div>
															<div class="col-6">
																<span style="float: right"><?= rupiah($total_price) ?></span>
															</div>
														</div>
														<a href="index.php?page=cart_list" class="btn_1 mt-2">View Cart</a>
													</div>
												<?php endif ?>
											</div>
										</li>
										<li>
											<a href="index.php?page=wishlist_list" style="padding-top:8px">
												<i class="ti-heart" style="font-size:18pt"></i>
											</a>
										</li>
									<?php else : ?>
										<li>
											<a class="discuss pt-1" href="index.php?page=seller_notification">
												<i style="font-size:14pt" class="ti-announcement"></i>
												<?php
												$get_report_review = get(
													'review_report',
													'INNER JOIN review ON review_report.review_id = review.review_id INNER JOIN product ON review.product_id = product.product_id WHERE product.seller_id =' . $user_id,
													'count(seller_id)'
												);
												$data_discussion = mysqli_fetch_assoc($get_report_review);

												$discussion_count = $data_discussion['count(seller_id)'];
												if ($discussion_count > 0) :
												?>
													<strong><?= $discussion_count ?></strong>
												<?php endif ?>
											</a>
										</li>
									<?php endif ?>
								<?php else : ?>
									<a href="index.php?page=login" class="btn_1  mt-2">
										<b>Login</b> or <b>Register</b>
									</a>
								<?php endif ?>
								<li>
									<div class="dropdown dropdown-access">
										<?php
										if (isset($email)) :
											$get_user = get("user", "WHERE email='" . $email . "'");
											$data_user = mysqli_fetch_assoc($get_user);

											$user_name = $data_user['user_name'];
											$user_role = $data_user['role'];
											$address = $data_user['address'];
											$country_id = $data_user['country_id'];
											$phone = $data_user['phone'];

											$get_country = get('country', 'WHERE country_id=' . $country_id);
											$data_country = mysqli_fetch_assoc($get_country);

											$country_name = $data_country['country_name'];

											$get_user_image = get('user_image', 'WHERE user_id=' . $user_id);
											if (mysqli_num_rows($get_user_image) > 0) :
												$data_user_image = mysqli_fetch_assoc($get_user_image);
												$user_image = $data_user_image['user_image'];
										?>
												<a class="access_link mt-3" style="width:30px; height:30px; content:url('uploads/user/<?= $user_image ?>'); border-radius:50%"></a>
											<?php else : ?>
												<a class="access_link mt-3" style="width:30px; height:30px; content:url('uploads/user/default.jpg'); border-radius:50%"></a>
											<?php endif ?>
											<div class="dropdown-menu">
												<ul class="mt-0">
													<div class="row">
														<div class="col-5">
															<?php if ($user_role == 'seller') : ?>
																<a class="pl-3 pb-3" href="index.php">
																<?php else : ?>
																	<a class="pl-3 pb-3" href="index.php?page=view_profile">
																	<?php endif ?>
																	<?php if (mysqli_num_rows($get_user_image) > 0) : ?>
																		<img src="uploads/user/<?= $user_image ?>" class="hover-opacity" style="width:73px; height:73px; border-radius:50%" alt="user_image">
																	<?php else : ?>
																		<img src="uploads/user/default.jpg" class="hover-opacity" style="width:73px; height:73px; border-radius:50%" alt="user_image">
																	<?php endif ?>
																	</a>
														</div>
														<div class="col pl-0 mb-2">
															<a href="index.php?page=view_profile">
																<h5 class="m-0 hover-underline"><?= $user_name ?></h5>
															</a>
															<div class="mb-1">
																<?php if ($user_role == 'user') : ?>
																	<span class="badge text-bg-primary">User</span>
																<?php elseif ($user_role == 'seller') : ?>
																	<span class="badge text-bg-warning">Seller</span>
																<?php elseif ($user_role == 'admin') : ?>
																	<span class="badge text-bg-danger">Admin</span>
																<?php endif ?>
															</div>
															<p class="m-0 pr-4" style="font-size:smaller"><?= $address ?>, <?= $country_name ?></p>
															<p class="m-0" style="font-size:smaller"><?= $phone ?></p>
														</div>
													</div>
													<?php
													if ($user_role == 'admin') :
													?>
														<li>
															<a href="index.php?page=admin">
																<i><img src="img/admin.png" alt="" width="20px" class="pb-2" draggable="false"></i>
																Admin
															</a>
														</li>
													<?php endif ?>
													<!-- <li>
														<a href="index.php?page=order">
															<i class="ti-package"></i>
															Orders
														</a>
													</li> -->
													<?php
													if ($user_role != 'seller') :
													?>
														<li>
															<a href="index.php?page=transaction_list">
																<i class="ti-timer"></i>
																Transactions
															</a>
														</li>
													<?php endif ?>
													<li>
														<a href="index.php?page=help">
															<i class="ti-help-alt"></i>
															Help & FAQ
														</a>
													</li>
													<li>
														<a href="index.php?page=log-out" onclick="return confirm('Are you sure you want to LOG OUT?')">
															<i>
																<img src="img/logout.png" alt="" width="21px" class="pt-0 pb-3 pl-1" draggable="false">
															</i>
															Log Out
														</a>
													</li>
												</ul>
											</div>
										<?php endif ?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="search_mob_wp">
					<input type="text" class="form-control" placeholder="Search over 10.000 products">
					<input type="submit" class="btn_1 full-width" value="Search">
				</div>
			</div>
		</header>

		<?php include 'config/page.php' ?>

		<footer class="revealed pt-5 pb-2">
			<div class="container">
				<div class="row">
					<div class="col-2">
						<h3 data-target="#collapse_1">Quick Links</h3>
						<div class="collapse dont-collapse-sm links" id="collapse_1">
							<ul>
								<li class="mb-1"><a href="index.php?page=view_profile">My Profile</a></li>
								<li class="mb-1"><a href="index.php?page=about">About Us</a></li>
								<li class="mb-1"><a href="index.php?page=help">Help & FAQ</a></li>
								<li class="mb-1"><a href="index.php?blog">Blog</a></li>
							</ul>
						</div>
					</div>
					<div class="col-4">
						<h3 data-target="#collapse_2">Categories</h3>
						<div class="collapse dont-collapse-sm links" id="collapse_2">
							<div class="row">
								<div class="col">
									<ul>
										<?php
										$get_category = get('category');
										foreach ($get_category as $i => $data_category) :
											$category_id = $data_category['category_id'];
											$category_name = $data_category['category_name'];

											if ($i == round(mysqli_num_rows($get_category) / 2)) :
										?>
									</ul>
								</div>
								<div class="col">
									<ul>
									<?php endif ?>
									<li class="mb-1"><a href="index.php?page=list&view=list"><?= $category_name ?></a></li>
								<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3">
						<h3 data-target="#collapse_3">Details</h3>
						<div class="collapse dont-collapse-sm contacts" id="collapse_3">
							<ul>
								<li class="mb-1">
									<i class="ti-home"></i>12345 Jl. Jalan no. 0<br>Malang - Indonesia
								</li>
								<!-- <li class="mb-1">
									<i class="ti-headphone-alt"></i>+00 123-456-789
								</li> -->
								<li class="mb-1">
									<i class="ti-email"></i><a href="#">online@shop.com</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-3">
						<h3 data-target="#collapse_4">Keep in touch</h3>
						<div class="collapse dont-collapse-sm" id="collapse_4">
							<form action="" method="POST">
								<div id="newsletter">
									<div class="form-group">
										<input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
										<button type="submit" id="submit-newsletter">
											<i class="ti-angle-double-right"></i>
										</button>
									</div>
								</div>
							</form>
							<div class="follow_us">
								<h5>Follow Us</h5>
								<ul>
									<li>
										<a href="https://www.youtube.com/">
											<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy">
										</a>
									</li>
									<li>
										<a href="https://www.instagram.com/">
											<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy">
										</a>
									</li>
									<!-- <li>
										<a href="#0">
											<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy">
										</a>
									</li>
									<li>
										<a href="#0">
											<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy">
										</a>
									</li> -->
								</ul>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row add_bottom_25">
					<div class="col-lg-6">
						<ul class="footer-selector clearfix">
							<!-- <li>
								<div class="styled-select lang-selector">
									<select>
										<option value="en" selected style="color:black">English</option>
										<option value="in" style="color:black">Bahasa Indonesia</option>
										<option value="cn" style="color:black">中国</option>
										<option value="fr" style="color:black">French</option>
										<option value="es" style="color:black">Spanish</option>
										<option value="de" style="color:black">German</option>
										<option value="jp" style="color:black">日本語</option>
										<option value="sa" style="color:black">العربية</option>
										<option value="ru" style="color:black">Russian</option>
									</select>
								</div>
							</li>
							<li>
								<div class="styled-select currency-selector">
									<select>
										<option value="usd" selected style="color:black">(USD) US Dollars</option>
										<option value="idr" style="color:black">(IDR) Indonesian Rupiah</option>
										<option value="eur" style="color:black">(EUR) Euro</option>
									</select>
								</div>
							</li> -->
							<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
						</ul>
					</div>
					<div class="col-lg-6">
						<ul class="additional_links">
							<li>
								<a href="index.php?page=terms">Terms and conditions</a>
							</li>
							<li>
								<a href="index.php?page=help">Help and FAQ</a>
							</li>
							<li>
								<span>&copy; 2023 Online_Shop</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

	<div id="toTop"></div>

	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>

	<script src="js/carousel-home.min.js"></script>
</body>

</html>