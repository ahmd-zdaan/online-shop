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

<style>
	.button-menu a {
		width: 100%;
		height: 100%;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li>
								<a href="index.php">Home</a>
							</li>
							<li>Admin Dashboard</li>
						</ul>
					</div>
					<h1 class="pt-3 mb-3">Dashboard</h1>
					<div class="mb-5">
						<div class="button-menu row p-0">
							<div class="col p-1">
								<a class="btn btn-outline-primary py-3" href="index.php?page=category_list">
									<p>Categories and Subcategories</p>
									<i class="ti-layers" style="font-size:70px"></i>
								</a>
							</div>
							<div class="col p-1">
								<a class="btn btn-outline-primary" href="index.php?page=coupon_list">
									<p>Coupon Codes</p>
									<i class="ti-ticket" style="font-size:70px"></i>
								</a>
							</div>
							<div class="col p-1">
								<a class="btn btn-outline-primary" href="index.php?page=report_list">
									<p>Reports</p>
									<i class="ti-announcement" style="font-size:70px"></i>
								</a>
							</div>
							<div class="col p-1">
								<a class="btn btn-outline-primary" href="index.php?page=manifacturer_list">
									<p>Manifacturers</p>
									<i class="ti-package" style="font-size:70px"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
</body>

</html>