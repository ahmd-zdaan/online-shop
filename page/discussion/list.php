<?php
$email = $_SESSION['email'];

$get_user = get('user', 'WHERE email="' . $email . '"');
$data_user = mysqli_fetch_assoc($get_user);

$seller_id = $data_user['user_id'];
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
	<!-- <link href="css/product_page.css" rel="stylesheet"> -->
	<!-- <link href="css/cart.css" rel="stylesheet"> -->
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
							<li><a href="index.php">Seller</a></li>
							<li><a href="index.php">Discussion</a></li>
							<li>Product Discussions</li>
						</ul>
					</div>
					<a href="index.php" style="text-decoration:underline;">&lt; Back</a>
					<h1 class="mt-2">Product Discussions</h1>
				</div>
				<table class="table table-striped table-hover table-sm">
					<tbody>
						<?php
						$get_discussion = get('discussion', 'WHERE seller_id=' . $seller_id);
						if (mysqli_num_rows($get_discussion) > 0) :
							foreach ($get_discussion as $data_discussion) :
								$product_id = $data_discussion['product_id'];
								$user_id = $data_discussion['user_id'];
								$seller_id = $data_discussion['seller_id'];
								$date = $data_discussion['date'];

								$get_product = get('product', 'WHERE product_id=' . $product_id);
								$data_product = mysqli_fetch_assoc($get_product);
								$product_name = $data_product['product_name'];
								$description = $data_product['description'];
								$price = $data_product['price'];

								$get_user_discussion = get('user', 'WHERE user_id=' . $user_id);
								$data_user_discussion = mysqli_fetch_assoc($get_user_discussion);
								$user_name = $data_user_discussion['user_name'];
						?>
								<tr style="font-size: medium;">
									<td>
										<div class="row">
											<div class="col-3">
												<?php
												$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
												if (mysqli_num_rows($result) > 0) :
													$data = mysqli_fetch_assoc($result);
													$image_name = $data['image_name'];
												?>
													<img src="uploads/product/<?= $image_name ?>" alt="product_image" style="width:250px; height:250px; object-fit:scale-down">
												<?php
												else :
												?>
													<img src="uploads/product/default.jpg" alt="product_image" style="width:250px; height:250px; object-fit:scale-down">
												<?php endif ?>
											</div>
											<div class="col-2 p-0">
												<h4 class="mt-2"><?= $product_name ?></h5>
													<?php
													$get_sale = get('sale', 'WHERE product_id=' . $product_id);
													if (mysqli_num_rows($get_sale) > 0) :
														$data_sale = mysqli_fetch_assoc($get_sale);
														$sale = $data_sale['sale'];
														$price_sale = $price - $price * (int)$sale / 100;
													?>
														<span style="font-size:larger" class="new_price"><?= rupiah($price_sale) ?></span>
														<span style="color:#9d9d9d" class="old_price"><?= rupiah($price) ?></span>
													<?php else : ?>
														<span style="font-size:larger" class="new_price"><?= rupiah($price) ?></span>
													<?php endif ?>
											</div>
											<div class="col-4 p-0">
												<?= $description ?>
											</div>
											<div class="col-2">
												<?= $user_name ?>
											</div>
											<div class="col-1 p-0" style="max-width:57px">
												<div class="btn-group-vertical btn-group-sm">
													<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="View" data-placement="left" href="#">
														<i class="ti-eye"></i>
													</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</main>
</body>

</html>