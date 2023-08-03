<?php
check('login');

$email = $_SESSION['email'];

$user_get = get('user', 'WHERE email="' . $email . '"');
$user_table = mysqli_fetch_assoc($user_get);
$user_id = $user_table['user_id'];

$product_id = $_GET['product_id'];
$product_get = get('product', 'WHERE product_id=' . $product_id);
$product_table = mysqli_fetch_assoc($product_get);
$product_name = $product_table['product_name'];

$product_image_get = get('product_image', 'WHERE product_id=' . $product_id);
$product_image_table = mysqli_fetch_assoc($product_image_get);
$image_name = $product_image_table['image_name'];
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
	<link href="css/leave_review.css" rel="stylesheet">
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
							<li><a href="#">Home</a></li>
							<li><a href="#">Report</a></li>
							<li>Product</li>
						</ul>
					</div>
					<h1 class="pt-3">Report Product</h1>
				</div>
			</div>
			<div class="container pb-5 mb-5">
				<div class="write_review">
					<div class="row mb-3">
						<div class="col-3">
							<img src="uploads/product/<?= $image_name ?>" class="pr-0" alt="product_image" width="100%">
						</div>
						<div class="col">
							<h3 class="mt-3 mb-5 pl-0"><?= $product_name ?></h3>
						</div>
					</div>
					<form action="" method="POST">
						<div class="form-group">
							<label>Your report</label>
							<textarea name="report" class="form-control" placeholder="Write your report" required></textarea>
						</div>
						<div class="form-group">
							<div class="checkboxes add_bottom_15 add_top_15">
								<label class="container_check">Accept
									<a href="#0">Terms and conditions</a>
									<input required type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
						<a type="submit" href="index.php?page=product_view&product_id=<?= $product_id ?>" class="btn_1">BACK</a>
						<button type="submit" name="submit" class="btn_1">SUBMIT</button>
					</form>
					<?php
					if (isset($_POST['submit'])) {
						$report = $_POST['report'];

						$result = insert('product_report', [
							'user_id' => $user_id,
							'product_id' => $product_id,
							'report' => $report,
							'date' => date("d-m-Y")
						]);

						if ($result) {
							echo '<script>window.location.href = "index.php?page=product_view&product_id=' . $product_id . '"</script>';
						}
					}
					?>
				</div>
			</div>
		</main>
</body>

</html>