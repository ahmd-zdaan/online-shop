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
	<link href="css/cart.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

</head>

<body>

	<div id="page">

		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Category</a></li>
							<li>Page active</li>
						</ul>
					</div>
					<h1 class="pt-3">Cart</h1>
				</div>
				<!-- /page_header -->
				<table class="table table-striped cart-list">
					<thead>
						<tr>
							<th>
								Product
							</th>
							<th>
								Price
							</th>
							<th>
								Quantity
							</th>
							<th>
								Subtotal
							</th>
							<th>

							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="thumb_cart">
									<img src="img/products/product_placeholder_square_small.jpg" data-src="img/products/shoes/1.jpg" class="lazy" alt="Image">
								</div>
								<span class="item_cart">Armor Air x Fear</span>
							</td>
							<td>
								<strong>$140.00</strong>
							</td>
							<td>
								<div class="numbers-row">
									<input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
									<div class="inc button_inc">+</div>
									<div class="dec button_inc">-</div>
								</div>
							</td>
							<td>
								<strong>$140.00</strong>
							</td>
							<td class="options">
								<a href="#"><i class="ti-trash"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								<div class="thumb_cart">
									<img src="img/products/product_placeholder_square_small.jpg" data-src="img/products/shoes/2.jpg" class="lazy" alt="Image">
								</div>
								<span class="item_cart">Armor Okwahn II</span>
							</td>
							<td>
								<strong>$110.00</strong>
							</td>
							<td>
								<div class="numbers-row">
									<input type="text" value="1" id="quantity_2" class="qty2" name="quantity_2">
									<div class="inc button_inc">+</div>
									<div class="dec button_inc">-</div>
								</div>
							</td>
							<td>
								<strong>$110.00</strong>
							</td>
							<td class="options">
								<a href="#"><i class="ti-trash"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								<div class="thumb_cart">
									<img src="img/products/product_placeholder_square_small.jpg" data-src="img/products/shoes/3.jpg" class="lazy" alt="Image">
								</div>
								<span class="item_cart">Armor Air Wildwood ACG</span>
							</td>
							<td>
								<strong>$90.00</strong>
							</td>

							<td>
								<div class="numbers-row">
									<input type="text" value="1" id="quantity_3" class="qty2" name="quantity_3">
									<div class="inc button_inc">+</div>
									<div class="dec button_inc">-</div>
								</div>
							</td>
							<td>
								<strong>$90.00</strong>
							</td>
							<td class="options">
								<a href="#"><i class="ti-trash"></i></a>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="row add_top_30 flex-sm-row-reverse cart_actions">
					<div class="col-sm-4 text-right">
						<!-- <button type="button" class="btn_1 gray">Update Cart</button> -->
						<!-- <button type="submit" name="submit" class="text-center btn_1">Checkout</button> -->
					</div>
					<div class="col-sm-8">
						<div class="apply-coupon">
							<div class="form-group form-inline">
								<input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control"><button type="button" class="btn_1 outline">Apply Coupon</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box_cart">
				<div class="container">
					<div class="row justify-content-end">
						<div class="col-xl-4 col-lg-4 col-md-6">
							<ul>
								<li>
									<span>Subtotal</span> $240.00
								</li>
								<li>
									<span>Shipping</span> $7.00
								</li>
								<li>
									<span>Total</span> $247.00
								</li>
							</ul>
							<a href="cart-2.html" class="btn_1 full-width cart">Proceed to Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</main>

		<div id="toTop"></div><!-- Back to top button -->

		<!-- COMMON SCRIPTS -->
		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>
</body>

</html>