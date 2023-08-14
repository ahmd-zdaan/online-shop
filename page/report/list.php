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
	<link href="../../../css/bootstrap.custom.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/cart.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="../../../css/custom.css" rel="stylesheet">
</head>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header m-0">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=admin">Admin</a></li>
							<li>Reports</li>
						</ul>
					</div>
					<h1 class="py-3">Reports List</h1>
				</div>
				<div>
					<div class="row">
						<div class="col">
							<h5>Product</h5>
						</div>
						<div class="col text-right">
							<a href="index.php?page=report_product_list" class="btn btn-link" style="font-size:11pt">Show All</a>
						</div>
					</div>
					<div style="height:500px; overflow:auto">
						<?php
						$get_product_report = get('product_report');
						if (mysqli_num_rows($get_product_report) > 0) :
						?>
							<table class="table table-striped table-hover table-sm">
								<tbody>
									<?php
									foreach ($get_product_report as $data) :
										$user_id = $data['user_id'];
										$product_id = $data['product_id'];
										$report = $data['report'];
										$date = $data['date'];

										$get_user = get('user', 'WHERE user_id=' . $user_id);
										$data_user = mysqli_fetch_assoc($get_user);
										$user_name = $data_user['user_name'];

										$get_product = get('product', 'WHERE product_id=' . $product_id);
										$data_product = mysqli_fetch_assoc($get_product);
										$product_name = $data_product['product_name'];
									?>
										<tr>
											<td class="p-3" style="width:130px">
												<a href="index.php?page=view_profile&user_id=<?= $user_id ?>">
													<?php
													$get_user_image = get('user_image', 'WHERE user_id=' . $user_id);
													if (mysqli_num_rows($get_user_image) > 0) :
														$data_user_image = mysqli_fetch_assoc($get_user_image);
														$user_image = $data_user_image['user_image'];
													?>
														<img src="uploads/user/<?= $user_image ?>" class="hover-opacity" style="width:40px; height:40px; border-radius:50%" alt="user_image">
													<?php else : ?>
														<img src="uploads/user/default.jpg" class="hover-opacity" style="width:40px; height:40px; border-radius:50%" alt="user_image">
													<?php endif ?>
													<span class="ml-1 hover-underline" style="font-weight:bolder; color:black"><?= $user_name ?></span>
												</a>
											</td>
											<td style="width:180px">
												<a class="hover-underline" style="font-weight:bolder; color:black" href="index.php?page=product_view&product_id=<?= $product_id ?>">
													<?php
													$get_product_image = get('product_image', 'WHERE product_id=' . $product_id);
													if (mysqli_num_rows($get_product_image) > 0) :
														$data_product_image = mysqli_fetch_assoc($get_product_image);
														$product_image = $data_product_image['image_name'];
													?>
														<img src="uploads/product/<?= $product_image ?>" class="hover-opacity" style="width:100%; max-height:100%" alt="product_image">
													<?php else : ?>
														<img src="uploads/product/default.jpg" class="hover-opacity" style="width:100%; max-height:100%" alt="product_image">
													<?php endif ?>
													<p><?= $product_name ?></p>
												</a>
											</td>
											<td class="p-3">
												<p><?= $report ?></p>
											</td>
											<td class="p-3" style="width:130px">
												<p><?= dateConvert($date) ?></p>
											</td>
											<td>
												<div class="btn-group-vertical btn-group-sm">
													<a class="pt-2 btn btn-outline-success tooltip-1" style="width:40px; max-height:40px; font-size:large" title="Accept" data-placement="left" href="index.php?page=report_product_accept&product_report_id=<?= $product_report_id ?>" onclick="return confirm('Are you sure you want to ACCEPT this REPORT?')">
														<i class="ti-check"></i>
													</a>
													<a class="pt-2 btn btn-outline-danger tooltip-1" style="width:40px; max-height:40px; font-size:large" title="Ignore" data-placement="left" href="index.php?page=report_product_ignore&product_report_id=<?= $product_report_id ?>" onclick="return confirm('Are you sure you want to IGNORE this REPORT?')">
														<i class="ti-close"></i>
													</a>
												</div>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						<?php else : ?>
							<div class="text-center my-5">
								<img src="img/empty.png" alt="empty">
								<h3 class="mt-4">Nothing to see here</h3>
								<p>No product has been reported</p>
							</div>
						<?php endif ?>
					</div>
				</div>
				<div></div>
			</div>
		</main>
</body>

</html>