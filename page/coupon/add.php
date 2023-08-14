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
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=admin">Admin</a></li>
							<li><a href="index.php?page=coupon_list">Coupon Codes</a></li>
							<li>Add</li>
						</ul>
					</div>
					<h1 class="pt-3">Add Coupon Code</h1>
				</div>
				<form action="" method="POST">
					<div class="container pb-5">
						<div class="mb-3">
							<label class="form-label">Coupon Code</label>
							<input type="text" name="code" class="form-control">
						</div>
						<div class="btn-group mt-3" role="group">
							<a class="btn btn-outline-primary" href="index.php?page=coupon_list">CANCEL</a>
							<button class="btn btn-primary" type="submit" name="submit">ADD</button>
						</div>
					</div>
				</form>
				<?php
				if (isset($_POST['submit'])) {
					$code = $_POST['code'];

					$result = insert('coupon', [
						'code' => $code
					]);

					if ($result) {
						echo '<script>window.location.href = "index.php?page=coupon_list"</script>';
					}
				}
				?>
			</div>
		</main>

		<!-- COMMON SCRIPTS -->
		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>
</body>

</html>