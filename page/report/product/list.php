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
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Admin</a></li>
							<li><a href="#">Report</a></li>
							<li><a href="#">Product</a></li>
							<li>List</li>
						</ul>
					</div>
					<h1 class="pt-3">Product Report List</h1>
				</div>
				<?php
				$get_product_report = get('product_report');
				if (mysqli_num_rows($get_product_report) > 0) :
				?>
					<table class="table table-striped table-hover table-sm">
						<thead>
							<tr>
								<th scope="col" style="width: 50px">
									ID
								</th>
								<th scope="col" style="width: 150px">
									User
								</th>
								<th scope="col">
									Product
								</th>
								<th scope="col">
									Report
								</th>
								<th scope="col" style="width: 150px"">
									Date
								</th>
								<th scope="col" style="width: 200px">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($get_product_report as $data) :
								$product_report_id = $data['product_report_id'];
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
									<td>
										<p><?= $product_report_id ?></p>
									</td>
									<td>
										<p><?= $user_name ?></p>
									</td>
									<td>
										<p><?= $product_name ?></p>
									</td>
									<td>
										<p><?= $report ?></p>
									</td>
									<td>
										<p><?= dateConvert($date) ?></p>
									</td>
									<td>
										<div class="btn-group">
											<a class="col btn btn-outline-success" href="index.php?page=report_product_accept&product_report_id=<?= $product_report_id ?>">ACCEPT</a>
											<a class="col btn btn-outline-danger" href="index.php?page=report_product_ignore&product_report_id=<?= $product_report_id ?>" onclick="return confirm('Are you sure you want to IGNORE this REPORT?')">IGNORE</a>
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
		</main>
</body>

</html>