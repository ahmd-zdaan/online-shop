<?php
check('login');

$product_id = $_GET['product_id'];

$get_sale = get('sale', 'WHERE product_id=' . $product_id);
$data_sale = mysqli_fetch_assoc($get_sale);

$product_id = $data_sale['product_id'];
$sale = $data_sale['sale'];

$get_product = get('product', 'WHERE product_id=' . $product_id);
$data_product = mysqli_fetch_assoc($get_product);

$product_name = $data_product['product_name'];
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

<style>
	.product:hover {
		text-decoration: underline;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Seller</a></li>
							<li>Edit Sale</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Review</h1>
				</div>
				<div class="row mb-5">
					<div class="col-3">
						<?php
						$get_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
						foreach ($get_product_image as $data_product_image) :
							$image_name = $data_product_image['image_name'];
						?>
							<img src="uploads/product/<?= $image_name ?>" class="mb-3" style="width:100%; height:auto; object-fit:scale-down;">
						<?php endforeach ?>
					</div>
					<div class="col-9">
						<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
							<h4 class="mb-3 product"><?= $product_name ?></h4>
						</a>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="p-0">
								<div class="mb-3">
									<label class="form-label mb-1">Sale</label>
									<input type="number" name="sale" class="form-control" value="<?= $sale ?>" required>
								</div>
								<!-- <div class="checkboxes mb-3">
									<label class="container_check" style="color:#444">Timed Sale
										<input type="checkbox" name="timed">
										<span class="checkmark"></span>
									</label>
								</div> -->
								<div class="btn-group">
									<a class="btn btn-outline-primary" type="submit" href="index.php?page=sale_list">CANCEL</a>
									<button class="btn btn-primary" type="submit" name="submit">SAVE</button>
								</div>
							</div>
						</form>
						<?php
						if (isset($_POST['submit'])) {
							$sale = $_POST['sale'];

							$query = 'UPDATE sale SET sale=' . $sale . ' WHERE product_id=' . $product_id;
							$result = mysqli_query($connect, $query);

							if ($result) {
								echo '<script>window.location.href = "index.php?page=sale_list"</script>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</main>
</body>

</html>