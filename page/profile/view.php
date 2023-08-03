<?php
if (isset($_SESSION['email'])) {
	if (isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
		$get_user = get('user', 'WHERE user_id="' . $user_id . '"');
	} else {
		$email = $_SESSION['email'];
		$get_user = get('user', 'WHERE email="' . $email . '"');
	}
} else {
	check('login');
}

$table_user = mysqli_fetch_assoc($get_user);

$user_id = $table_user['user_id'];
$name = $table_user['user_name'];
$role = $table_user['role'];
$email = $table_user['email'];
$address = $table_user['address'];
$country_id = $table_user['country_id'];
$postal_code = $table_user['postal_code'];
$phone = $table_user['phone'];

$get_country = get('country', 'WHERE country_id=' . $country_id);
$table_country = mysqli_fetch_assoc($get_country);
$country_name = $table_country['country_name'];

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
			<div class="container margin_30 pb-0">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=view_profile">Profile</a></li>
							<li>View</li>
						</ul>
					</div>
					<?php
					if (isset($_SESSION['email']) && $email == $_SESSION['email']) :
					?>
						<h1 class="pt-3 m-0">Your Profile</h1>
					<?php else : ?>
						<h1 class="pt-3 m-0">View Profile</h1>
					<?php endif ?>
				</div>
			</div>
			<div class="container pb-5 mb-5">
				<div class="row">
					<div class="col-3">
						<?php
						$result = get('user_image', 'WHERE user_id=' . $user_id);

						if (mysqli_num_rows($result) > 0) :
							$data = mysqli_fetch_assoc($result);
							$user_image = $data['user_image'];
						?>
							<img src="uploads/user/<?= $user_image ?>" style="width:280px; height:280px; border-radius:50%" alt="user_image">
						<?php
						else :
						?>
							<img src="uploads/user/default.jpg" style="width:280px; height:280px; border-radius:50%" alt="user_image">
						<?php endif ?>
					</div>
					<div class="col-9">
						<ul style="list-style:none">
							<li>
								<h1 class="m-0"><?= $name ?></h1>
								<?php if ($role == 'user') : ?>
									<span class="mb-4 badge text-bg-primary">User</span>
								<?php elseif ($role == 'seller') : ?>
									<span class="mb-4 badge text-bg-warning">Seller</span>
								<?php elseif ($role == 'admin') : ?>
									<span class="mb-4 badge text-bg-danger">Admin</span>
								<?php endif ?>
							</li>
							<li>
								<h5 class="m-0">Address</h5>
								<p class="mb-2"><?= $address ?>, <?= $country_name ?></p>
							</li>
							<li>
								<h5 class="m-0">Postal Code</h5>
								<p class="mb-2"><?= $postal_code ?></p>
							</li>
							<li>
								<h5 class="m-0">Phone</h5>
								<p class="mb-2"><?= $phone ?></p>
							</li>
							<?php
							if (isset($_SESSION['email']) && $email == $_SESSION['email']) :
							?>
								<li>
									<a href="index.php?page=edit_profile" class="mt-3 btn btn-outline-primary">Edit Profile</a>
								</li>
							<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
			<!-- <div class="container mt-5 p-5" style="background-color: white;">
				<div class="mb-4">
					<h3 class="m-0">Create Your Dream Wishlist</h3>
					<p style="font-size:large;">Explore and Save Your Favorite Products</p>
				</div>
				<div class="owl-carousel owl-theme products_carousel">
					<?php
					$result = get('product');
					foreach ($result as $data) :
						$product_id = $data['product_id'];
						$product_name = $data['product_name'];
						$category_id = $data['category_id'];
						$subcategory_id = $data['subcategory_id'];
						$price = $data['price'];
						$sold = $data['sold'];
						$description = $data['description'];
					?>
						<div class="item">
							<div class="grid_item">
								<?php
								$get_sale = get('sale', 'WHERE product_id=' . $product_id);
								if (mysqli_num_rows($get_sale) > 0) :
									$data_sale = mysqli_fetch_assoc($get_sale);
									$sale = $data_sale['sale'];
									$price_sale = $price - $price * (int) $sale / 100;
								?>
									<span class="ribbon off">-
										<?= $sale ?>
									</span>
								<?php endif ?>
								<figure>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
										<?php
										$result = get('product_image', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($result) > 0) :
											$data = mysqli_fetch_assoc($result);
											$image_name = $data['image_name'];
										?>
											<img src="uploads/product/<?= $image_name ?>" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
										<?php
										else :
										?>
											<img src="img/products/product_placeholder_square_medium.jpg" width="100%" style="width: 250px; height: 250px; object-fit: scale-down;">
										<?php endif ?>
									</a>
								</figure>
								<div class="rating">
									<?php
									$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'sum(rating)');
									$data_review = mysqli_fetch_assoc($get_review);
									$total_rating = (int)$data_review['sum(rating)'];

									$get_review = get('review', 'WHERE product_id="' . $product_id . '"', 'count(rating)');
									$data_review = mysqli_fetch_assoc($get_review);
									$count_rating = (int)$data_review['count(rating)'];

									if ($count_rating > 0) {
										$average_rating = round($total_rating / $count_rating);

										for ($i = $average_rating; $i > 0; $i--) {
											echo '<i class="icon-star voted"></i>';
										}
									}

									if ($count_rating == 0) {
										echo '<p class="mb-0">No review</p>';
									} else {
										$n = 5 - $average_rating;
										for ($i = $n; $i > 0; $i--) {
											echo '<i class="icon-star"></i>';
										}
										echo '<em class="ml-1" style="color:#9d9d9d">(' . $count_rating . ')</em>';
									}
									?>
								</div>
								<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
									<h3>
										<?= $product_name ?>
									</h3>
								</a>
								<div class="price_box mb-0">
									<?php
									$get_sale = get('sale', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($get_sale) > 0) :
										$data_sale = mysqli_fetch_assoc($get_sale);
										$sale = $data_sale['sale'];
										$price_sale = $price - $price * (int) $sale / 100;
									?>
										<span class="new_price">
											<?= rupiah($price_sale) ?>
										</span>
										<span class="old_price" style="font-size:small">
											<?= rupiah($price) ?>
										</span>
									<?php else : ?>
										<span class="new_price">
											<?= rupiah($price) ?>
										</span>
									<?php endif ?>
								</div>
								<div>
									<p style="color: #9d9d9d;" class="mb-3">
										<?= $sold ?> sold • 0 discussions
									</p>
								</div>
								<ul>
									<li>
										<a href="index.php?page=wishlist_add&product_id=<?= $product_id ?>" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
											<i class="ti-heart"></i>
										</a>
									</li>
									<li>
										<a href="index.php?page=cart_add&product_id=<?= $product_id ?>&quantity=1" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart">
											<i class="ti-shopping-cart"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div> -->
		</main>
</body>

</html>