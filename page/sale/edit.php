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
							<li><a href="#">Home</a></li>
							<li><a href="#">Sale</a></li>
							<li>Edit</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Sale</h1>
				</div>

				<?php
				$sale_id = $_GET['sale_id'];

				$get_sale = get('sale', 'WHERE id=' . $sale_id);
				$data_sale = mysqli_fetch_assoc($get_sale);
				$product_id = $data_sale['product_id'];
				$sale = $data_sale['sale'];
				?>

				<form action="" method="POST">
					<div class="container pb-5">
						<ul style="list-style: none;" class="pl-0">
							<li class="mb-2">
								<div class="row">
									<div class="col-6">
										<label class="form-label">Product Name</label>
										<select class="form-control form-select" name="product">
											<?php
											$result = get('product');
											foreach ($result as $data) :
												$product_id_select = $data['product_id'];
												$product_name = $data['product_name'];
											?>
												<option value="<?= $product_id ?>" <?= ($product_id == $product_id_select) ? 'selected' : '' ?>><?= $product_name ?></option>
											<?php
											endforeach
											?>
										</select>
									</div>
									<div class="col-6">
										<label class="form-label">Sale</label>
										<input type="text" name="sale" value="<?= $sale ?>" class="form-control">
									</div>
								</div>
							</li>
							<li class="mt-3">
								<a type="submit" href="index.php?page=sale_list" class="btn_1">BACK</a>
								<button type="submit" name="submit" class="btn_1">SAVE</button>
							</li>
						</ul>
					</div>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					$product = $_POST['product'];
					$sale = $_POST['sale'];

					$query = 'UPDATE sale SET product_id="' . $product . '", sale=' . $sale . ' WHERE sale_id=' . $sale_id;

					if (mysqli_query($connect, $query)) {
						echo '<script>window.location.href = "index.php?page=sale_list"</script>';
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