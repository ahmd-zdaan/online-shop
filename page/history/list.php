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
	<link href="css/home_1.css" rel="stylesheet">
	<link href="css/product_page.css" rel="stylesheet">
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
							<li><a href="index.php">Profile</a></li>
							<li>History List</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-6">
							<h1 class="pt-3">History List</h1>
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
							<th width="100px">
								Category
							</th>
							<th width="100px">
								Subcategory
							</th>
							<th width="150px">
								Date Purchased
							</th>
							<th>
								Your Review
							</th>
							<th width="150px">
								Actions
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$result = get('history');
						foreach ($result as $data) :
							$user_id = $data['user_id'];
							$product_id = $data['product_id'];
							$date = $data['date'];
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
											<?php
											$product_get = get('product', 'WHERE product_id=' . $product_id);
											$product_data = mysqli_fetch_assoc($product_get);

											$product_name = $product_data['product_name'];
											$category_id = $product_data['category_id'];
											$subcategory_id = $product_data['subcategory_id'];
											$price = $product_data['price'];
											?>
											<h5 class="mt-2"><?= $product_name ?></h5>
										</span>
									</a>
								</td>
								<td>
									<strong>
										<span class="new_price"><?= rupiah($price) ?></span>
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
									<p><?= dateConvert($date) ?></p>
								</td>
								<td>
									<?php
									$review_get = get('review', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
									if (mysqli_num_rows($review_get) > 0) :
										$review_data = mysqli_fetch_assoc($review_get);

										$rating = $review_data['rating'];
										$review = $review_data['review'];
										$review_date = $review_data['date'];

										for ($i = $rating; $i > 0; $i--) {
											echo '<i class="icon-star"></i>';
										}
										if ($rating < 5) {
											$n = 5 - $rating;
											for ($i = $n; $i > 0; $i--) {
												echo '<i class="icon-star empty"></i>';
											}
										}
									?>
										<p class="mt-1"><?= $review ?></p>
										<em class="mt-3" style="float:right; font-size:small; color:#9d9d9d"><?= dateConvert($date) ?></em>
									<?php endif ?>
								</td>
								<td>
									<a href="index.php?page=product_view&product_id=<?= $product_id ?>" class="btn_1 col p-3 my-1">VIEW PRODUCT</a>
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