<?php
if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];

	$get_user = get('user', 'WHERE email="' . $email . '"');
	$data_user = mysqli_fetch_assoc($get_user);

	$role = $data_user['role'];

	if ($role != 'seller') {
		echo '<script>window.location.href = "index.php"</script>';
	}

	$user_id = $data_user['user_id'];
}
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

<style>
	.product:hover {
		text-decoration: underline;
	}

	.product-image img:hover {
		opacity: 75%;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php">Seller</a></li>
							<li><a href="index.php">Dashboard</a></li>
							<li>Your Products</li>
						</ul>
					</div>
					<div class="row">
						<div class="col">
							<a href="index.php" style="text-decoration:underline;">&lt; Back</a>
							<h1 class="mt-2">Your Products</h1>
						</div>
						<div class="col-3 text-right">
							<a href="index.php?page=product_add" class="mt-3 btn btn-outline-primary">Add New Product</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-sm">
					<tbody>
						<?php
						$result = get('product', 'WHERE seller_id=' . $user_id);
						foreach ($result as $data) :
							$product_id = $data['product_id'];
							$product_name = $data['product_name'];
							$category_id = $data['category_id'];
							$subcategory_id = $data['subcategory_id'];
							$price = $data['price'];
							$stock = $data['stock'];
							$description = $data['description'];

							$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
							$data = mysqli_fetch_assoc($result);
							$category_name = $data['category_name'];

							$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
							$data = mysqli_fetch_assoc($result);
							$subcategory_name = $data['subcategory_name']
						?>
							<tr style="font-size: medium;">
								<td>
									<div class="row">
										<div class="col-3">
											<a class="product-image" href="index.php?page=product_view&product_id=<?= $product_id ?>">
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
											</a>
										</div>
										<div class="col-3 p-0">
											<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
												<h4 class="mt-2 product"><?= $product_name ?></h5>
											</a>
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
											<p>Stock: <?= $stock ?></p>
											<p style="color:#9d9d9d"><?= $category_name ?> > <?= $subcategory_name ?></p>
										</div>
										<div class="col pl-0 pr-4 pb-3">
											<?php
											$description_array = explode(' ', $description);
											$description_count = count($description_array);

											$description1 = '';
											$description2 = '';

											if ($description_count > 55) :
												for ($i = 0; $i < 55; $i++) {
													$description1 .= $description_array[$i] . ' ';
												}
												for ($i = 55; $i < $description_count; $i++) {
													$description2 .= $description_array[$i] . ' ';
												}
											?>
												<p class="m-0 description">
													<?= $description1 ?>
													<span id="dots<?= $product_id ?>">...</span>
													<span style="display:none" id="more<?= $product_id ?>"><?= $description2 ?></span>
												</p>
												<button onclick="readMore(<?= $product_id ?>)" id="readmore<?= $product_id ?>" class="btn btn-link p-0" style="font-size:small;">read more</button>
											<?php else : ?>
												<p><?= $description ?></p>
											<?php endif ?>
										</div>
										<div class="col-1 p-0" style="max-width:57px">
											<div class="btn-group-vertical btn-group-sm">
												<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="View" data-placement="left" href="index.php?page=product_view&product_id=<?= $product_id ?>">
													<i class="ti-eye"></i>
												</a>
												<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="Edit" data-placement="left" href="index.php?page=product_edit&product_id=<?= $product_id ?>">
													<i class="ti-pencil"></i>
												</a>
												<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-danger tooltip-1" title="Delete" data-placement="left" href="index.php?page=product_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to DELETE this PRODUCT?')">
													<i class="ti-trash"></i>
												</a>
											</div>
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="row add_top_30 flex-sm-row-reverse">
				</div>
			</div>
		</main>

		<script>
			function readMore(i) {
				let dots = document.getElementById("dots" + i);
				let moreText = document.getElementById("more" + i);
				let btnText = document.getElementById("readmore" + i);

				if (dots.style.display == "none") {
					dots.style.display = "inline";
					btnText.innerHTML = "read more";
					moreText.style.display = "none";
				} else {
					dots.style.display = "none";
					btnText.innerHTML = "read less";
					moreText.style.display = "inline";
				}
			}
		</script>
</body>

</html>