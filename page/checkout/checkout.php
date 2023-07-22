<?php

namespace Midtrans;

check('login');

require_once 'vendor/Midtrans.php';

Config::$serverKey = 'SB-Mid-server-Qu4bvihLIlPfq5SBf4Cx1MzP';
Config::$clientKey = 'SB-Mid-client-y_QtrBno-npZszyu';

$result = get('user', 'WHERE email="' . $email . '"');
$data = mysqli_fetch_assoc($result);
$user_id = $data['user_id'];

$item_details = [];

$get_cart = get('cart', 'WHERE user_id=' . $user_id);
foreach ($get_cart as $data_cart) :
	$product_id = $data_cart['product_id'];
	$quantity = $data_cart['quantity'];

	$get_product = get('product', 'WHERE product_id=' . $product_id);
	$data_product = mysqli_fetch_assoc($get_product);

	$product_name_50 = $data_product['product_name'];

	if (strlen($product_name_50) > 50) {
		$product_name_50 = cutFromEnd($product_name_50, 4);
		$product_name_50 .= '...';
	}

	$price = $data_product['price'];

	$get_sale = get('sale', 'WHERE product_id=' . $product_id);
	if (mysqli_num_rows($get_sale) > 0) {
		$data_sale = mysqli_fetch_assoc($get_sale);

		$sale = $data_sale['sale'];

		$price = $price - $price * (int)$sale / 100;
	}

	$item_details[] = [
		'id' => $product_id,
		'price' => $price,
		'quantity' => $quantity,
		'name' => $product_name_50,
	];
endforeach;

$total_price = 0;
foreach ($item_details as $item) {
	$price = (int)$item['price'];
	$quantity = (int)$item['quantity'];

	$total_price = $price * $quantity;
}

$transaction_details = array(
	'order_id' => rand(),
	'gross_amount' => $total_price + 17000
);

$enable_payments = array('credit_card', 'mandiri_clickpay', 'gopay', 'indomaret', 'kredivo', 'echannel');

$get_user = get('user', 'WHERE user_id=' . $user_id);
$data_user = mysqli_fetch_assoc($get_user);

$user_name = $data['user_name'];
$address = $data['address'];
$country_id = $data['country_id'];
$postal_code = $data['postal_code'];
$phone = $data['phone'];

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
	'country_code'  => 'IDN'
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
							<h3>Shipping Methods</h3>
							<ul>
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
					<div class="col p-0 mx-3">
						<div class="step middle payments">
							<h3 class="pl-4">Order Summary</h3>
							<div class="box_general summary px-4 pb-3" style="font-size:11pt">
								<ul class="mb-4" style="border:none">
									<?php
									$subtotal_price = 0;

									foreach ($item_details as $item) :
										$product_id = $item['id'];
										$product_price = $item['price'];
										$quantity = $item['quantity'];
										$product_name_50 = $item['name'];

										$get_sale = get('sale', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($get_sale) > 0) {
											$data_sale = mysqli_fetch_assoc($get_sale);

											$sale = $data_sale['sale'];

											$total_product = $quantity * $price_sale;
											$subtotal_price += $total_product;
										} else {
											$total_product = $quantity * $product_price;
											$subtotal_price += $total_product;
										}
									?>
										<li class="mb-3" style="border:none">
											<div class="row">
												<div class="col">
													<p class="m-0 mr-1" style="color:#004cd7; float:left">
														<?= $quantity ?>x
													</p>
													<p class="m-0 mr-1" style="float:left; font-weight:normal">

														<?= $product_name_50 ?>
													</p>
													<p class="m-0" style="font-weight:normal">

														(<?= rupiah($product_price) ?>)
													</p>
												</div>
												<div class="col-3">
													<p class="m-0 text-right">
														<?= rupiah($total_product) ?>
													</p>
												</div>
											</div>
										</li>
									<?php endforeach ?>
								</ul>
								<?php
								$shipping_price = 17000;
								$total_price = $subtotal_price + $shipping_price;
								?>
								<hr class="hr border-3 m-0 mb-3">
								<div class="row mb-3" style="font-weight:bold">
									<div class="col">
										<p class="m-0">Subtotal</p>
										<p class="m-0">Shipping</p>
									</div>
									<div class="col text-right">
										<p class="m-0"><?= rupiah($subtotal_price) ?></p>
										<p class="m-0"><?= rupiah($shipping_price) ?></p>
									</div>
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
							<h3 class="pl-4">Total Price</h3>
							<div style="font-size: 11pt;" class="box_general summary">
								<div class="total clearfix">Total
									<span><?= rupiah($total_price) ?></span>
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
						window.location.href = 'index.php?page=checkout_confirm&user_id=<?= $user_id ?>';
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