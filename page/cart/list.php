<?php
check('login')
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
							<li><a href="#">Cart</a></li>
						</ul>
					</div>
					<h1 class="pt-3">Cart</h1>
				</div>
				<?php
				$email = $_SESSION['email'];

				$result = get('user', 'WHERE email="' . $email . '"');
				$data = mysqli_fetch_assoc($result);
				$user_id = $data['user_id'];

				$result = get('cart', 'WHERE user_id=' . $user_id);
				if (mysqli_num_rows($result) > 0) :
				?>
					<div>
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
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($result as $data) :
									$cart_id = $data['cart_id'];
									$product_id = $data['product_id'];
									$quantity = $data['quantity'];

									$result = get('product', 'WHERE product_id=' . $product_id);
									$data = mysqli_fetch_assoc($result);
									$product_name = $data['product_name'];
									$price = $data['price'];

									$subtotal_product = $quantity * $price;
								?>
									<tr>
										<td>
											<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
												<div class="thumb_cart">
													<?php
												$result = get('product_image', 'WHERE product_id=' . $product_id);
												if (mysqli_num_rows($result) > 0) :
													$data = mysqli_fetch_assoc($result);
													$image_name = $data['image_name'];
													?>
													<img src="uploads/<?= $image_name ?>" class="lazy" alt="image">
													<?php
												else :
													?>
													<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="image">
													<?php endif ?>
												</div>
											</a>
											<span class="item_cart">
												<a href="index.php?page=product_view&product_id=<?= $product_id ?>"><?= $product_name ?></a>
											</span>
										</td>
										<td>
											<strong><?= rupiah($price) ?></strong>
										</td>
										<td>
											<strong><?= $quantity ?></strong>
											<!-- <div class="numbers-row">
												<input type="text" value="<?= $quantity ?>" id="quantity_1" class="qty2" name="quantity_1">
												<div class="inc button_inc">+</div>
												<div class="dec button_inc">-</div>
											</div> -->
										</td>
										<td class="text-center">
											<strong><?= rupiah($subtotal_product) ?></strong>
										</td>
										<td class="options">
											<a href="index.php?page=cart_delete&cart_id=<?= $cart_id ?>&page=cart" onclick="return confirm('Are you sure you want to DELETE this PRODUCT?')" class="ti-trash"></a>
										</td>
									</tr>
								<?php
								endforeach
								?>
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
					<?php
					$subtotal_price = $subtotal_product;
					$shipping_price = 15000;
					$total_price = $subtotal_price + $shipping_price;
					?>
					<div class="box_cart">
						<div class="container">
							<div class="row justify-content-end">
								<div class="col-xl-4 col-lg-4 col-md-6">
									<ul>
										<li>
											<span>Subtotal</span> <?= rupiah($subtotal_price) ?>
										</li>
										<li>
											<span>Shipping</span> <?= rupiah($shipping_price) ?>
										</li>
										<li>
											<span>Total</span> <?= rupiah($total_price) ?>
										</li>
									</ul>
									<a href="index.php?page=checkout" class="btn_1 full-width cart">Proceed to Checkout</a>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>
			</div>
		</main>
</body>

</html>