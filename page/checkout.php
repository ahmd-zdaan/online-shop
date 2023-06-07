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
	<link href="css/checkout.css" rel="stylesheet">

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
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=cart_list">Cart</a></li>
							<li>Checkout</li>
						</ul>
					</div>
					<h1>Checkout</h1>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="step first payments">
							<h3>1. Payment</h3>
							<ul>
								<li>
									<label class="container_radio">Credit Card<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment" checked>
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Paypal<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Cash on delivery<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Bank Transfer<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="payment">
										<span class="checkmark"></span>
									</label>
								</li>
							</ul>
							<div class="payment_info d-none d-sm-block">
								<figure><img src="img/cards_all.svg" alt=""></figure>
								<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae adipisci fugit labore rerum quibusdam neque, exercitationem unde similique pariatur quia, distinctio aspernatur. Quisquam voluptate magni esse molestias laborum deserunt earum.
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="step middle payments">
							<h3>2. Shipping Method</h3>
							<h6 class="pb-2">Shipping Method</h6>
							<ul>
								<li>
									<label class="container_radio">Standard shipping<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="shipping" checked>
										<span class="checkmark"></span>
									</label>
								</li>
								<li>
									<label class="container_radio">Express shipping<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
										<input type="radio" name="shipping">
										<span class="checkmark"></span>
									</label>
								</li>
							</ul>
							<div class="payment_info d-none d-sm-block">
								<p>
									Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="step last">
							<h3>2. Order Summary</h3>
							<?php
							$email = $_SESSION['email'];

							$result = get('user', 'WHERE email="' . $email . '"');
							$data = mysqli_fetch_assoc($result);
							$user_id = $data['user_id'];

							// $result = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,COUNT(user_id) AS total_quantity');
							$result = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,SUM(quantity) AS total_quantity');

							if (mysqli_num_rows($result) > 0) :
							?>
								<div class="box_general summary">
									<?php
									$subtotal_price = 0;
									foreach ($result as $data) :
										$cart_id = $data['cart_id'];
										$product_id = $data['product_id'];
										$quantity = $data['total_quantity'];

										$result = get('product', 'WHERE product_id=' . $product_id);
										$data = mysqli_fetch_assoc($result);
										$product_name = $data['product_name'];
										$price = $data['price'];

										$subtotal_product = $total_quantity * $price;
										$subtotal_price += $subtotal_product;
									?>
										<div class="row">
											<div class="col-6" style="font-weight: bold;">
												<p><?= $quantity . 'x ' . $product_name ?></p>
											</div>
											<div class="col-6 text-right">
												<p><?= rupiah($subtotal_product) ?></p>
											</div>
										</div>
									<?php endforeach ?>
									<hr class="m-0 mb-3">
									<?php
									$shipping_price = 17000;
									$total_price = $subtotal_price + $shipping_price;
									?>
									<ul>
										<div class="row mb-3" style="font-weight: bold;">
											<div class="col-6">
												<p class="m-0">Subtotal</p>
												<p class="m-0">Shipping</p>
											</div>
											<div class="col-6 text-right">
												<span><?= rupiah($subtotal_price) ?></span>
												<span><?= rupiah($shipping_price) ?></span>
											</div>
										</div>
									</ul>
									<ul>
										<div class="form-group">
											<label class="container_check">Shipping insurance (optional)
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</div>
									</ul>
									<div class="total clearfix">TOTAL
										<span><?= rupiah($total_price) ?></span>
									</div>
									<a href="index.php?page=checkout_confirm" class="text-center btn_1 full-width">CONFIRM AND PAY</a>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</main>

		<div id="toTop"></div><!-- Back to top button -->
		<div class="modal fade" id="payments_method" tabindex="-1" role="dialog" aria-labelledby="payments_method_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="payments_method_title">Payments Methods</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Lorem ipsum dolor sit amet, oratio possim ius cu. Labore prompta nominavi sea ei. Sea no animal saperet gloriatur, ius iusto ullamcorper ad. Qui ignota reformidans ei, vix in elit conceptam adipiscing, quaestio repudiandae delicatissimi vis ei. Fabulas accusamus no has.</p>
						<p>Et nam vidit zril, pri elaboraret suscipiantur ut. Duo mucius gloriatur at, in vis integre labitur dolores, mei omnis utinam labitur id. An eum prodesset appellantur. Ut alia nemore mei, at velit veniam vix, nonumy propriae conclusionemque ea cum.</p>
					</div>
				</div>
			</div>
		</div>

		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>

		<script>
			// Other address Panel
			$('#other_addr input').on("change", function() {
				if (this.checked)
					$('#other_addr_c').fadeIn('fast');
				else
					$('#other_addr_c').fadeOut('fast');
			});
		</script>

</body>

</html>