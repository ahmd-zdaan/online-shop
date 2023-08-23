<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">

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
	#more {
		display: none;
	}

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
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php">Profile</a></li>
							<li>Transaction</li>
						</ul>
					</div>
					<h1 class="pt-3">Transactions</h1>
				</div>
				<div class="mb-5">
					<?php
					$email = $_SESSION['email'];
					$get_user = get('user', 'WHERE email="' . $email . '"');
					$data_user = mysqli_fetch_assoc($get_user);
					$user_id = $data_user['user_id'];

					$get_transaction = get('transaction', 'WHERE user_id=' . $user_id);
					if (mysqli_num_rows($get_transaction) > 0) :
					?>
						<?php
						$collapse_id = 0;

						foreach ($get_transaction as $transaction_data) :
							$transaction_id = $transaction_data['transaction_id'];
							$date = $transaction_data['date'];
						?>
							<div class="accordion" id="accordionExample">
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading<?= $collapse_id ?>">
										<button class="accordion-button <?php echo ($collapse_id > 0) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $collapse_id ?>" aria-expanded="true" aria-controls="collapse<?= $collapse_id ?>">
											<?php
											$product_names = [];
											$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id);
											foreach ($get_details as $data_details) {
												$details_product_id = $data_details['product_id'];
												$details_price = $data_details['price'];

												$get_product = get('product', 'WHERE product_id=' . $details_product_id);
												$data_product = mysqli_fetch_assoc($get_product);

												$product_id = $data_product['product_id'];
												$product_name = $data_product['product_name'];

												$product_names[] = $product_name;
											}
											?>
											<div>
												<p class="m-0"><?= implode(', ', $product_names) ?></p>
												<em class="mt-1" style="font-size:10pt">Purchased at <?= dateConvert($date) ?></em>
											</div>
										</button>
									</h2>
								</div>
							</div>
							<div id="collapse<?= $collapse_id ?>" class="accordion-collapse collapse <?php echo ($collapse_id > 0) ? '' : 'show' ?>" aria-labelledby="heading<?= $collapse_id ?>" data-bs-parent="#accordionExample">
								<div class="accordion-body px-4">
									<?php
									$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id, '*,SUM(price)');
									$data_details = mysqli_fetch_assoc($get_details);
									$total_price = $data_details['SUM(price)'];
									?>
									<div class="mt-4">
										<ul class="p-0" style="list-style-type:none">
											<?php
											$get_details = get('transaction_details', 'WHERE transaction_id=' . $transaction_id);
											foreach ($get_details as $data_details) :
												$details_product_id = $data_details['product_id'];
												$details_price = $data_details['price'];
												$details_quantity = $data_details['quantity'];

												$get_product = get('product', 'WHERE product_id=' . $details_product_id);
												$data_product = mysqli_fetch_assoc($get_product);

												$product_id = $data_product['product_id'];
												$product_name = $data_product['product_name'];
												$category_id = $data_product['category_id'];
												$subcategory_id = $data_product['subcategory_id'];
												$description = $data_product['description'];

												$result = get('category', 'WHERE category_id=' . $category_id, 'category_name');
												$data = mysqli_fetch_assoc($result);
												$category_name = $data['category_name'];

												$result = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
												$data = mysqli_fetch_assoc($result);
												$subcategory_name = $data['subcategory_name'];
											?>
												<li>
													<div class="row" style="font-size:11pt">
														<div class="col">
															<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
																<?php
																$result = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
																if (mysqli_num_rows($result) > 0) :
																	$data = mysqli_fetch_assoc($result);
																	$image_name = $data['image_name'];
																?>
																	<img src="uploads/product/<?= $image_name ?>" alt="product_image" style="width:50px; height:50px; object-fit:scale-down">
																<?php else : ?>
																	<img src="uploads/product/default.jpg" alt="product_image" style="width:50px; height:50px; object-fit:scale-down">
																<?php endif ?>
															</a>
															<span style="font-weight:bold; color:#004cd7"><?= $details_quantity ?>x</span>
															<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
																<span class="hover-underline" style="color:black"><?= $product_name ?></span>
															</a>
														</div>
														<div class="col-3 text-right">
															<p class="m-0" style="float:right; font-weight:bold"><?= rupiah($details_price) ?></p>
															<p class="m-0 mr-2" style="float:right">(<?= $details_quantity ?>x <?= rupiah($details_price) ?>)</p>
														</div>
													</div>
												</li>
											<?php endforeach ?>
										</ul>
										<div class="my-3 text-right" style="font-weight:bold">
											<span class="m-0" style="color:red; font-size:large">Total</span>
											<h4 class="m-0" style="color:red"><?= rupiah($total_price) ?></h4>
										</div>
									</div>
								</div>
							</div>
						<?php
							$collapse_id++;
						endforeach
						?>
					<?php endif ?>
				</div>
			</div>
		</main>
	</div>

	<script>
		function readMore(i) {
			let dots = document.getElementById("dots");
			let moreText = document.getElementById("more");
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