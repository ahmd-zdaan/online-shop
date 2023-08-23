<?php

namespace Midtrans;

require_once 'vendor/Midtrans.php';
require_once 'config/connect.php';

check('login');

Config::$serverKey = 'SB-Mid-server-Qu4bvihLIlPfq5SBf4Cx1MzP';
Config::$clientKey = 'SB-Mid-client-y_QtrBno-npZszyu';

$item_details = $_POST['items'];

$transaction_details = array(
	'order_id' => rand(),
	'gross_amount' => $_POST['details']['gross']
);

$enable_payments = array('credit_card');

$email = $_SESSION['email'];
$get_user = get('user', 'WHERE email="' . $email . '"');
$data_user = mysqli_fetch_assoc($get_user);

$user_id = $data_user['user_id'];
$user_name = $data_user['user_name'];
$address = $data_user['address'];
$country_id = $data_user['country_id'];
$postal_code = $data_user['postal_code'];
$phone = $data_user['phone'];

$get_country = get('country', 'WHERE country_id=' . $country_id);
$data_country = mysqli_fetch_assoc($get_country);

$country_name = $data_country['country_name'];
$code = $data_country['code'];

$billing_address = array(
	'first_name'    => "Andri",
	'last_name'     => "Litani",
	'address'       => "Mangga 20",
	'city'          => "Jakarta",
	'postal_code'   => "16602",
	'phone'         => "081122334455",
	'country_code'  => "IDN"
);

$shipping_address = array(
	'first_name'    => $user_name,
	// 'last_name'     => "Supriadi",
	'address'       => $address,
	'city'          => $country_name,
	'postal_code'   => $postal_code,
	'phone'         => $phone,
	'country_code'  => $code
);

$customer_details = array(
	'first_name'    => $user_name,
	// 'last_name'     => "NAME",
	'email'         => $email,
	'phone'         => $phone,
	'billing_address'  => $billing_address,
	'shipping_address' => $shipping_address
);

$transaction = array(
	'enabled_payments' => $enable_payments,
	'transaction_details' => $transaction_details,
	'customer_details' => $customer_details,
	'item_details' => $item_details
);

$snap_token = '';
$snap_token = Snap::getSnapToken($transaction);
try {
} catch (\Exception $e) {
	echo $e->getMessage();
}

function printExampleWarningMessage()
{
	if (strpos(Config::$serverKey, 'your ') != false) {
		echo "<code>";
		echo "<h4>Please set your server key from sandbox</h4>";
		echo "In file: " . __FILE__;
		echo "<br>";
		echo "<br>";
		echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
		die();
	}
}
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

<style>
	.step h3 {
		background: #172134;
	}

	.step h3:after {
		width: 0;
		height: 0;
		border-top: 20px inset transparent;
		border-bottom: 20px inset transparent;
		border-left: 10px solid #172134;
		position: absolute;
		content: "";
		top: 0;
		right: -10px;
		z-index: 2;
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
							<li><a href="index.php?page=cart_list">Cart</a></li>
							<li>Checkout</li>
						</ul>
					</div>
					<h1>Checkout</h1>
				</div>
				<div class="row">
					<div class="col-3 p-0">
						<div class="step first payments">
							<h3>Methods</h3>
							<div class="box_general px-4 pb-3" style="background-color:#fff">
								<ul class="mb-3">
									<li>
										<label class="container_radio">Standard shipping
											<a href="#0" class="info ml-1" data-toggle="modal" data-target="#payments_method"></a>
											<input type="radio" name="shipping" checked>
											<span class="checkmark"></span>
										</label>
									</li>
									<li style="border:none">
										<label class="container_radio">Express shipping
											<a href="#0" class="info ml-1" data-toggle="modal" data-target="#payments_method"></a>
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
					</div>
					<div class="col p-0 mx-3">
						<div class="step middle payments">
							<h3 class="pl-4">Order Summary</h3>
							<div class="box_general summary px-4 pb-3" style="font-size:11pt">
								<ul class="mb-4" style="border:none">
									<?php
									foreach ($_POST['items'] as $item) :
										$product_id = $item['id'];
										$price = $item['price'];
										$price_sale = $item['price_sale'];
										$quantity = $item['quantity'];
										$product_name = $item['name'];

										if ($price_sale > 0) {
											$total_product = $quantity * $price_sale;
										} else {
											$total_product = $quantity * $price;
										}
									?>
										<li class="mb-3" style="border:none">
											<div class="row">
												<div class="col-1 pr-0">
													<p class="m-0" style="color:#004cd7; float:left">
														<?= $quantity ?>x
													</p>
												</div>
												<div class="col px-0">
													<p class="m-0" style="float:left; font-weight:normal">
														<?= $product_name ?>
													</p>
												</div>
												<div class="col pl-0">
													<p class="m-0" style="float:right">
														<?= rupiah($total_product) ?>
													</p>
													<p class="m-0 mr-2" style="float:right; font-weight:normal">
														<?php if ($price_sale > 0) : ?>
															(<?= $quantity ?>&times; <?= rupiah($price_sale) ?>)
														<?php else : ?>
															(<?= $quantity ?>&times; <?= rupiah($price) ?>)
														<?php endif ?>
													</p>
												</div>
											</div>
										</li>
									<?php
									endforeach;

									if (isset($_POST['details']['coupon_name'])) {
										$coupon_name = $_POST['details']['coupon_name'];
										$promo = $_POST['details']['promo'];
										$promo_price = $_POST['details']['promo_price'];
									}

									$shipping_price = $_POST['details']['shipping_price'];
									$subtotal_price = $_POST['details']['subtotal_price'];
									$gross = $_POST['details']['gross'];
									?>
								</ul>
								<hr class="hr border-3 m-0 mb-3">
								<div class="row mb-3" style="font-weight:bold">
									<?php if (isset($promo)) : ?>
										<div class="col">
											<p class="m-0">Subtotal</p>
											<p class="m-0">Shipping</p>
											<p class="m-0" style="color:red">Promo (<?= $coupon_name ?>)</p>
										</div>
										<div class="col text-right">
											<p class="m-0"><?= rupiah($subtotal_price) ?></p>
											<p class="m-0"><?= rupiah($shipping_price) ?></p>
											<p class="m-0" style="color:red">-<?= rupiah($promo_price) ?></p>
										</div>
									<?php else : ?>
										<div class="col">
											<p class="m-0">Subtotal</p>
											<p class="m-0">Shipping</p>
										</div>
										<div class="col text-right">
											<p class="m-0"><?= rupiah($subtotal_price) ?></p>
											<p class="m-0"><?= rupiah($shipping_price) ?></p>
										</div>
									<?php endif ?>
								</div>
								<hr class="hr border-3 m-0 mb-3">
								<div class="form-group">
									<label class="container_check m-0">Shipping insurance (optional)
										<input type="checkbox">
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3 p-0">
						<div class="step last">
							<h3 class="pl-4">Confirm Purchase</h3>
							<div style="font-size: 11pt;" class="box_general summary">
								<div class="total clearfix">Total
									<span><?= rupiah($gross) ?></span>
								</div>
								<button class="text-center btn_1 full-width" id="pay-button">CONFIRM AND PAY</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="modal fade" id="payments_method" tabindex="-1" role="dialog" aria-labelledby="payments_method_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="payments_method_title">Shipping Methods</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body pt-4">
						<p>Lorem ipsum dolor sit amet, oratio possim ius cu. Labore prompta nominavi sea ei. Sea no animal saperet gloriatur, ius iusto ullamcorper ad. Qui ignota reformidans ei, vix in elit conceptam adipiscing, quaestio repudiandae delicatissimi vis ei. Fabulas accusamus no has.</p>
						<p>Et nam vidit zril, pri elaboraret suscipiantur ut. Duo mucius gloriatur at, in vis integre labitur dolores, mei omnis utinam labitur id. An eum prodesset appellantur. Ut alia nemore mei, at velit veniam vix, nonumy propriae conclusionemque ea cum.</p>
					</div>
				</div>
			</div>
		</div>

		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>

		<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= Config::$clientKey; ?>"></script>

		<script>
			document.getElementById('pay-button').onclick = function() {
				// SnapToken acquired from previous step
				snap.pay('<?= $snap_token ?>', {
					onSuccess: function(result) {
						// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
						window.location.href = `index.php?page=checkout_confirm&user_id=<?= $user_id ?>&order_id=${result.order_id}`;
						// window.location.href = 'index.php?page=checkout_confirm&user_id=<?= $user_id ?>';
					},
					onPending: function(result) {
						// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
						console.log('pending');
					},
					onError: function(result) {
						// document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
						console.log('error');
					}
				});
			};

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