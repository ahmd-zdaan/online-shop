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
	<title>Online Shop</title>

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
												<span class="hamburger hamburger--spin">
													<span class="hamburger-box">
														<span class="hamburger-inner"></span>
													</span>
												</span>
											</a>
										</span>
										<span>
											<a href="index.php" class="pl-3">LOGO</a>
										</span>
										<div id="menu">
											<ul>
												<h5 class="p-3 m-0">Categories</h5>
												<?php
												$result = get('category');
												foreach ($result as $data) :
													$category_id = $data['category_id'];
													$name = $data['category_name'];
												?>
													<li>
														<span><a href="index.php?page=list&category=<?= strtolower($name) ?>&view=list"><?= $name ?></a></span>
														<?php
														$result = get('subcategory', 'WHERE category_id=' . $category_id);
														if (mysqli_num_rows($result) > 0) :
														?>
															<ul>
																<?php foreach ($result as $data) :
																	$subcategory_name = $data['subcategory_name'];
																?>
																	<li><a href="index.php?page=list&view=list"><?= $subcategory_name ?></a></li>
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
						<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
							<div class="custom-search-input">
								<input type="text" placeholder="Search over 10.000 products">
								<button type="submit"><i class="header-icon_search_custom"></i></button>
							</div>
						</div>
						<div class="col-xl-3 col-lg-2 col-md-3">
							<ul class="top_tools">
								<?php
								if (isset($_SESSION['email'])) :
									$email = $_SESSION['email'];

									$result = get('user', 'WHERE email="' . $email . '"');
									$data = mysqli_fetch_assoc($result);
									$user_id = $data['user_id'];
								?>
									<li>
										<div class="dropdown dropdown-cart">
											<a href="index.php?page=cart_list" class="cart_bt">
												<?php
												$result = get('cart', 'WHERE user_id="' . $user_id . '"', 'count(product_id)');
												$data = mysqli_fetch_assoc($result);
												$count_product = (int)$data['count(product_id)'];
												if ($count_product > 0) :
												?>
													<strong><?= $count_product ?></strong>
												<?php endif ?>
											</a>
											<?php
											$result = get('cart', 'WHERE user_id=' . $user_id);

											if (mysqli_num_rows($result) > 0) :
											?>
												<div class="dropdown-menu">
													<ul>
														<?php
														foreach ($result as $data) :
															$cart_id = $data['cart_id'];
															$product_id = $data['product_id'];
															$quantity = $data['quantity'];

															$result = get('product', 'WHERE product_id=' . $product_id);
															$data = mysqli_fetch_assoc($result);
															$product_name = $data['product_name'];
															$price = $data['price'];

															$result = get('product_image', 'WHERE product_id=' . $product_id);
															$data = mysqli_fetch_assoc($result);
															if (isset($data['image_name'])) {
																$product_image = $data['image_name'];
															}

															$subtotal_product = $quantity * $price;
															$shipping_price = 19000;
															$total_price = $subtotal_product + $shipping_price;
														?>
															<li>
																<a href="product-detail-1.html">
																	<figure>
																		<?php
																		$result = get('product_image', 'WHERE product_id=' . $product_id);
																		if (mysqli_num_rows($result) > 0) :
																			$data = mysqli_fetch_assoc($result);
																			$image_name = $data['image_name'];
																		?>
																			<img src="uploads/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
																		<?php else : ?>
																			<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
																		<?php endif ?>
																	</figure> <strong>
																		<span><?= $quantity . 'x ' . $product_name ?></span>
																		<?= rupiah($price) ?>
																	</strong>
																</a>
																<a href="index.php?page=cart_delete&cart_id=<?= $cart_id ?>$page=index" onclick="return confirm('Are you sure you want to DELETE this PRODUCT?')" class="action">
																	<i class="ti-trash"></i>
																</a>
															</li>
														<?php endforeach ?>
													</ul>
													<div class="row mt-4">
														<div class="col-6">
															<p class="m-0">Subtotal</p>
															<p class="m-0">Shipping</p>
														</div>
														<div class="col-6">
															<span style="float: right"><?= rupiah($subtotal_product) ?></span>
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
													<a href="index.php?page=cart_list" class="btn_1 outline mt-3">View Cart</a>
													<a href="index.php?page=checkout" class="btn_1 mt-1">Checkout</a>
												</div>
											<?php endif ?>
										</div>
									</li>
								<?php else : ?>
									<li>
										<div class="dropdown dropdown-cart">
											<a href="index.php?page=cart_list" class="cart_bt"></a>
										</div>
									</li>
								<?php endif ?>
								<li>
									<a href="index.php?page=wishlist_list" class="wishlist"></a>
								</li>
								<li>
									<div class="dropdown dropdown-access">
										<a class="access_link"></a>
										<div class="dropdown-menu">
											<?php
											if (isset($_SESSION['email'])) :
												$result = get("user", "WHERE email='" . $_SESSION['email'] . "'");
												$result = mysqli_fetch_assoc($result);
												$role = $result['role'];
											?>
												<ul class="mt-0">
													<li>
														<a href="index.php?page=view"><i class="ti-user"></i>Profile</a>
													</li>
													<?php
													if ($role == 'admin') :
													?>
														<li>
															<a href="index.php?page=admin">
																<i>
																	<img src="img/admin.png" alt="" width="20px" class="pb-2" draggable="false">
																</i>
																Admin
															</a>
														</li>
													<?php endif ?>
													<li>
														<a href="index.php?page=order">
															<i class="ti-package"></i>
															Orders
														</a>
													</li>
													<li>
														<a href="index.php?page=help">
															<i class="ti-help-alt"></i>
															Help & Faq
														</a>
													</li>
													<li>
														<a href="index.php?page=log-out">
															<i>
																<img src="img/logout.png" alt="" width="21px" class="pt-0 pb-3 pl-1" draggable="false">
															</i>
															Log Out
														</a>
													</li>
												</ul>
											<?php else : ?>
												<a href="index.php?page=login" class="btn_1">
													<b>Sign In</b> or <b>Register</b>
												</a>
											<?php endif ?>
										</div>
									</div>
								</li>
								<li>
									<a href="#menu" class="btn_cat_mob">
										<div class="hamburger hamburger--spin" id="hamburger">
											<div class="hamburger-box">
												<div class="hamburger-inner"></div>
											</div>
										</div>
										Categories
									</a>
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

		<?php
		include 'config/page.php'
		?>

		<footer class="revealed">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_1">Quick Links</h3>
						<div class="collapse dont-collapse-sm links" id="collapse_1">
							<ul>
								<li><a href="index.php?page=account">My account</a></li>
								<li><a href="index.php?page=about">About us</a></li>
								<li><a href="index.php?page=help">Help & Faq</a></li>
								<li><a href="index.php?blog">Blog</a></li>
								<!-- <li><a href="contacts.html">Contacts</a></li> -->
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_2">Categories</h3>
						<div class="collapse dont-collapse-sm links" id="collapse_2">
							<ul>
								<?php
								$result = get('category');
								foreach ($result as $data) :
									$category_name = $data['category_name'];
								?>
									<li><a href="index.php?page=list&view=list"><?= $category_name ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3">Contacts</h3>
						<div class="collapse dont-collapse-sm contacts" id="collapse_3">
							<ul>
								<li><i class="ti-home"></i>97845 Baker st. 567<br>Malang - Indonesia</li>
								<li><i class="ti-headphone-alt"></i>+00 123-456-789</li>
								<li><i class="ti-email"></i><a href="#">email@email.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_4">Keep in touch</h3>
						<div class="collapse dont-collapse-sm" id="collapse_4">
							<div id="newsletter">
								<div class="form-group">
									<input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
									<button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
								</div>
							</div>
							<div class="follow_us">
								<h5>Follow Us</h5>
								<ul>
									<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li>
									<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li>
									<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li>
									<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /row-->
				<hr>
				<div class="row add_bottom_25">
					<div class="col-lg-6">
						<ul class="footer-selector clearfix">
							<li>
								<div class="styled-select lang-selector">
									<select>
										<option value="English" selected>English</option>
										<option value="French">French</option>
										<option value="Spanish">Spanish</option>
										<option value="Russian">Russian</option>
									</select>
								</div>
							</li>
							<li>
								<div class="styled-select currency-selector">
									<select>
										<option value="US Dollars" selected>(USD) US Dollars</option>
										<option value="Euro">(EUR) Euro</option>
										<option value="Euro">(IDR) Indonesian Rupiah</option>
									</select>
								</div>
							</li>
							<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
						</ul>
					</div>
					<div class="col-lg-6">
						<ul class="additional_links">
							<li><a href="#0">Terms and conditions</a></li>
							<li><a href="#0">Privacy</a></li>
							<li><span>&copy; 2023 Online_Shop</span></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel-home.min.js"></script>

</body>

</html>