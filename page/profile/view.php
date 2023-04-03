<?php
check('login');

$result = get('user', 'JOIN country ON user.country_id=country.id_country WHERE email="' . $_SESSION['email'] . '"');
$data = mysqli_fetch_assoc($result);

$name = $data['name_user'];
$address = $data['address'];
$country = $data['name_country'];
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
							<li><a href="#">Category</a></li>
							<li>Page active</li>
						</ul>
					</div>
					<h1 class="pt-3">Profile</h1>
				</div>
			</div>

			<div class="container pb-5">
				<div class="row">
					<div class="col-3">
						<img src="assets/images/profile/1.jpg" alt="" width="100%">
					</div>
					<div class="col-9">
						<ul style="list-style: none;" class="pl-4">
							<li>
								<h3><?= $name ?></h3>
							</li>
							<li>
								<p class="mb-2"><?= $address ?></p>
							</li>
							<li>
								<p><?= $country ?></p>
							</li>
							<li>
								<a href="index.php?page=edit" class="btn_1">Edit</a>
							</li>
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