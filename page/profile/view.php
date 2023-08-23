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
$purchased = $table_user['purchased'];
$user_date = $table_user['date'];

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
						<?php else : ?>
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
				<div class="row mt-5">
					<div class="col-8">
						<h5 class="mb-3">Recent Reviews</h5>
						<div style="height:300px; overflow:auto">
							<?php
							$get_review = get('review', 'WHERE user_id=' . $user_id);
							if (mysqli_num_rows($get_review) > 0) :
							?>
								<table class="table table-striped table-hover table-sm">
									<tbody>
										<?php
										foreach ($get_review as $data_review) :
											$user_id = $data_review['user_id'];
											$product_id = $data_review['product_id'];
											$rating = $data_review['rating'];
											$review = $data_review['review'];
											$date = $data_review['date'];

											$get_product = get('product', 'WHERE product_id=' . $product_id);
											$data_product = mysqli_fetch_assoc($get_product);
											$product_name = $data_product['product_name'];
										?>
											<tr>
												<td class="p-3" style="width:500px">
													<a style="color:black" href="index.php?page=product_view&product_id=<?= $product_id ?>">
														<?php
														$get_product_image = get('product_image', 'WHERE product_id=' . $product_id);
														if (mysqli_num_rows($get_product_image) > 0) :
															$data_product_image = mysqli_fetch_assoc($get_product_image);
															$product_image = $data_product_image['image_name'];
														?>
															<img src="uploads/product/<?= $product_image ?>" class="hover-opacity" style="width:100px; max-height:100px" alt="product_image">
														<?php else : ?>
															<img src="uploads/product/default.jpg" class="hover-opacity" style="width:100px; max-height:100px" alt="product_image">
														<?php endif ?>
														<span class="hover-underline ml-2" style="font-weight:bold"><?= $product_name ?></span>
													</a>
													<p class="m-0 mt-2">Purchased at <?= dateConvert($date) ?></p>
												</td>
												<td>
													<div class="mt-1">
														<?php
														for ($i = $rating; $i > 0; $i--) {
															echo '<i class="icon-star"></i>';
														}
														if ($rating < 5) {
															$n = 5 - $rating;
															for ($i = $n; $i > 0; $i--) {
																echo '<i class="icon-star empty"></i>';
															}
														}
														?>
														<em>( <?= $rating ?> / 5 )</em>
													</div>
													<p><?= $review ?></p>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							<?php else : ?>
								<div class="text-center my-5">
									<img src="img/empty.png" alt="empty">
									<h3 class="mt-4">Nothing to see here</h3>
									<p>No review has been reported</p>
								</div>
							<?php endif ?>
						</div>
					</div>
					<div class="col">
						<h5 class="mb-2">Statistics</h5>
						<div class="table-responsive">
							<table class="table table-sm table-striped">
								<tbody>
									<tr>
										<td>
											<strong>Joined at</strong>
										</td>
										<td><?= dateConvert($user_date)	?></td>
									</tr>
									<tr>
										<td>
											<strong>Products purchased</strong>
										</td>
										<td><?= $purchased ?></td>
									</tr>
									<?php
									$get_user_review = get('review', 'WHERE user_id=' . $user_id, 'count(review_id)');
									$data_user_review = mysqli_fetch_assoc($get_user_review);

									$user_review = $data_user_review['count(review_id)']
									?>
									<tr>
										<td>
											<strong>Reviews</strong>
										</td>
										<td><?= $user_review ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
</body>

</html>