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
$telephone = $table_user['telephone'];

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
					if (isset($_SESSION['email'])) :
					?>
						<h1 class="pt-3">Your Profile</h1>
					<?php
					else :
					?>
						<h1 class="pt-3">View Profile</h1>
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
							<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
						<?php
						else :
						?>
							<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
						<?php endif ?>
					</div>
					<div class="col-9">
						<ul style="list-style: none;" class="pl-4">
							<li>
								<h1 class="m-0"><?= $name ?></h1>
								<?php if ($user_role == 'user') : ?>
									<span class="mb-4 badge text-bg-primary">User</span>
								<?php elseif ($user_role == 'seller') : ?>
									<span class="mb-4 badge text-bg-warning">Seller</span>
								<?php elseif ($user_role == 'admin') : ?>
									<span class="mb-4 badge text-bg-danger">Admin</span>
								<?php endif ?>
							</li>
							<li>
								<h5>Address</h5>
								<p><?= $address ?>, <?= $country_name ?></p>
							</li>
							<li>
								<h5>Telephone</h5>
								<p><?= $telephone ?></p>
							</li>
							<?php
							if (isset($_SESSION['email'])) :
								if ($email == $_SESSION['email']) :
							?>
									<li>
										<a href="index.php?page=edit_profile" class="mt-3 btn btn-outline-primary">Edit Profile</a>
									</li>
								<?php endif ?>
							<?php endif ?>
						</ul>
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