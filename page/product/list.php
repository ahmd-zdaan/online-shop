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
							<li><a href="index.php">Admin</a></li>
							<li>Product List</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-6">
							<h1 class="pt-3">Product List</h1>
						</div>
						<div class="col-6 text-right">
							<a href="index.php?page=product_add" class="btn_1">ADD</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-sm">
					<thead>
						<tr>
							<th width="150px">
								Name
							</th>
							<th width="150px">
								Price
							</th>
							<th width="150px">
								Category
							</th>
							<th width="150px">
								Subcategory
							</th>
							<th>
								Description
							</th>
							<th width="150px">
								Actions
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$result = get('product');
						foreach ($result as $data) :
							$product_id = $data['product_id'];
							$product_name = $data['product_name'];
							$category_id = $data['category_id'];
							$subcategory_id = $data['subcategory_id'];
							$price = $data['price'];
							$description = $data['description'];
						?>
							<tr style="font-size: medium;">
								<td>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
										<div class="thumb_cart">
											<?php
											$result = get('product_image', 'WHERE product_id=' . $product_id);
											if (mysqli_num_rows($result) > 0) :
												$data = mysqli_fetch_assoc($result);
												$image_name = $data['image_name'];
											?>
												<img src="uploads/product/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
											<?php
											else :
											?>
												<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
											<?php endif ?>
										</div>
										<span class="item_cart">
											<h5 class="mt-2"><?= $product_name ?></h5>
										</span>
									</a>
								</td>
								<td>
									<strong>
										<?php
										$get_sale = get('sale', 'WHERE product_id=' . $product_id);
										if (mysqli_num_rows($get_sale) > 0) :
											$data_sale = mysqli_fetch_assoc($get_sale);
											$sale = $data_sale['sale'];
											$price_sale = $price - $price * (int)$sale / 100;
										?>
											<span class="new_price"><?= rupiah($price_sale) ?></span>
											<span style="color:#9d9d9d" class="old_price mt-2"><?= rupiah($price) ?></span>
										<?php else : ?>
											<span class="new_price"><?= rupiah($price) ?></span>
										<?php endif ?>
									</strong>
								</td>
								<td>
									<?php
									$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
									$data = mysqli_fetch_assoc($result);
									$category_name = $data['category_name'];
									?>
									<p><?= $category_name ?></p>
								</td>
								<td>
									<?php
									$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
									$data = mysqli_fetch_assoc($result);
									$subcategory_name = $data['subcategory_name']
									?>
									<p><?= $subcategory_name ?></p>
								</td>
								<td>
									<p>
										<?php
										if (strlen($description) > 200) {
											echo substr($description, 0, 200);
											echo ' ...';
										} else {
											echo $description;
										}
										?>
									</p>
								</td>
								<td>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>" class="btn_1 col p-3 my-1">VIEW PRODUCT</a>
									<a href="index.php?page=product_edit&product_id=<?= $product_id ?>" class="btn_1 col p-3 my-1">EDIT</a>
									<a href="index.php?page=product_delete&product_id=<?= $product_id ?>" onclick="return confirm('Are you sure to DELETE this PRODUCT?')" class="btn_1 col p-3 my-1">DELETE</a>
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