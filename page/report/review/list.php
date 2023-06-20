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
							<li><a href="#">Review</a></li>
							<li>List</li>
						</ul>
					</div>
					<h1 class="pt-3">Review Report List</h1>
				</div>
				<?php
				$get_review_report = get('review_report');
				if (mysqli_num_rows($get_review_report) > 0) :
				?>
					<table class="table table-striped table-hover table-sm">
						<thead>
							<tr>
								<th scope="col" style="width: 30px">
									ID
								</th>
								<th scope="col" style="width: 120px">
									User
								</th>
								<th scope="col" style="width: 500px">
									Reported Review
								</th>
								<th scope="col" style="width: 300px">
									Report Details
								</th>
								<th scope="col" style="width: 140px"">
									Date Reported
								</th>
								<th scope="col">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($get_review_report as $data) :
								$review_report_id = $data['review_report_id'];
								$user_id = $data['user_id'];
								$review_id = $data['review_id'];
								$report = $data['report'];
								$date = $data['date'];

								$get_user = get('user', 'WHERE user_id=' . $user_id);
								$data_user = mysqli_fetch_assoc($get_user);
								$user_name = $data_user['user_name'];

								$get_review = get('review', 'WHERE review_id=' . $review_id);
								$data_review = mysqli_fetch_assoc($get_review);
								
								$product_id = $data_review['product_id'];
								$rating = $data_review['rating'];
								$review = $data_review['review'];
								$review_date = $data_review['date'];

								$review_user_id = $data_review['user_id'];
								$get_user_review = get('user', 'WHERE user_id=' . $review_user_id);
								$data_user_review = mysqli_fetch_assoc($get_user_review);
								$review_user_name = $data_user_review['user_name'];
							?>
								<tr>
									<td>
										<p><?= $review_report_id ?></p>
									</td>
									<td>
										<?php
										$result = get('user_image', 'WHERE user_id=' . $user_id);
										if (mysqli_num_rows($result) > 0) :
											$data = mysqli_fetch_assoc($result);
											$user_image = $data['user_image'];
										?>
											<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
										<?php
										else :
										?>
											<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
										<?php endif ?>
										<b class="ml-1"><?= $user_name ?></b>
									</td>
									<td>
										<div>
											<?php
											$result = get('user_image', 'WHERE user_id=' . $review_user_id);
											if (mysqli_num_rows($result) > 0) :
												$data = mysqli_fetch_assoc($result);
												$user_image = $data['user_image'];
											?>
												<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
											<?php
											else :
											?>
												<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="35px">
											<?php endif ?>
											<b class="font-weight-bold mb-1 ml-1"><?= $review_user_name ?></b>
										</div>
										<div class="rating mt-2 mb-1">
											<?php
											// Stars
											for ($i = $rating; $i > 0; $i--) {
												echo '<i class="icon-star voted"></i>';
											}
											if ($rating < 5) {
												$n = 5 - $rating;
												for ($i = $n; $i > 0; $i--) {
													echo '<i class="icon-star"></i>';
												}
											}
											?>
											<em style="color:#9d9d9d">( <?= $rating ?> / 5 )</em>
										</div>
										<p><?= $review ?></p>
										<em style="float:right; color:#9d9d9d"><?= dateConvert($review_date) ?></em>
									</td>
									<td>
										<p><?= $report ?></p>
									</td>
									<td>
										<p><?= dateConvert($date) ?></p>
									</td>
									<td>
										<a class="col btn btn-outline-success" href="index.php?page=report_review_accept&review_report_id=<?= $review_report_id ?>">ACCEPT</a>
										<a class="col btn btn-outline-danger" href="index.php?page=report_review_ignore&review_report_id=<?= $review_report_id ?>" onclick="return confirm('Are you sure you want to IGNORE this REPORT?')">IGNORE</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php else : ?>
					<div class="text-center my-5">
						<img src="img/empty.png" alt="empty">
						<h3 class="mt-4">Nothing to see here</h3>
						<p>No review has been reported</p>
					</div>
				<?php endif ?>
			</div>
		</main>
</body>

</html>