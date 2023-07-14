<?php
$seller_id = $_GET['seller_id'];

$get_seller = get('user', 'WHERE user_id=' . $seller_id);
$data_seller = mysqli_fetch_assoc($get_seller);

$seller_id = $data_seller['user_id'];
$seller_name = $data_seller['user_name'];
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

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php">Seller</a></li>
							<li><a href="index.php?page=seller_view&seller_id=<?=$seller_id?>"><?= $seller_name ?></a></li>
							<li>All Products</li>
						</ul>
					</div>
					<a href="index.php?page=seller_view&seller_id=<?=$seller_id?>" style="text-decoration:underline;">&lt; Back</a>
					<h1 class="mt-2">All <?= $seller_name ?>'s Products</h1>
				</div>
				<table class="table table-striped table-hover table-sm">
					<tbody>
						<?php
						$get_product = get('product', 'WHERE seller_id=' . $seller_id);
						foreach ($get_product as $data_product) :
							$product_id = $data_product['product_id'];
							$product_name = $data_product['product_name'];
							$category_id = $data_product['category_id'];
							$subcategory_id = $data_product['subcategory_id'];
							$price = $data_product['price'];
							$stock = $data_product['stock'];
							$description = $data_product['description'];

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
										<a class="col-3" href="index.php?page=product_view&product_id=<?= $product_id ?>">
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
										<div class="col-3 p-0">
											<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
												<h4 class="mt-2"><?= $product_name ?></h5>
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
										<div class="col p-0">
											<?= $description ?>
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
</body>

</html>