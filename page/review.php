<?php
$product_id = $_GET['product_id'];

$result = get('product', 'WHERE product_id="'.$product_id.'"', 'product_name');
$data = mysqli_fetch_assoc($result);

if ($data) {
	$name = $data['product_name'];
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
	<link href="css/leave_review.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

</head>

<body>
	<main>
		<div class="container margin_60_35">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="write_review">
						<h1 class="mb-5"><?=$name?></h1>
						<!-- RATING -->
						<div class="rating_submit">
							<div class="form-group">
								<label class="d-block">Overall rating</label>
								<span class="rating mb-0">
									<input type="radio" class="rating-input" id="5_star" name="rating-input" value="5 Stars"><label for="5_star" class="rating-star"></label>
									<input type="radio" class="rating-input" id="4_star" name="rating-input" value="4 Stars"><label for="4_star" class="rating-star"></label>
									<input type="radio" class="rating-input" id="3_star" name="rating-input" value="3 Stars"><label for="3_star" class="rating-star"></label>
									<input type="radio" class="rating-input" id="2_star" name="rating-input" value="2 Stars"><label for="2_star" class="rating-star"></label>
									<input type="radio" class="rating-input" id="1_star" name="rating-input" value="1 Star"><label for="1_star" class="rating-star"></label>
								</span>
							</div>
						</div>
						<!-- REVIEW -->
						<div class="form-group">
							<label>Review title</label>
							<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
						</div>
						<div class="form-group">
							<label>Your review</label>
							<textarea class="form-control" style="height: 180px;" placeholder="Write your review"></textarea>
						</div>
						<div class="form-group">
							<label>Add photo (optional)</label>
							<div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
						</div>
						<div class="form-group">
							<div class="checkboxes float-left add_bottom_15 add_top_15">
								<label class="container_check">Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
						<a href="confirm.html" class="btn_1 mb-5">Submit review</a>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- <div id="toTop"></div> -->

	<!-- <script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script> -->
</body>

</html>