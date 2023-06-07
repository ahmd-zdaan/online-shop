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
	<link href="css/leave_review.css" rel="stylesheet">
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
							<li><a href="#">Category</a></li>
							<li>Page active</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Subcategory</h1>
				</div>
				<?php
				$review_id = $_GET['review_id'];
				$result = get('review', 'WHERE review_id=' . $review_id);
				$data = mysqli_fetch_assoc($result);
				$product_id = $data['product_id'];
				$user_id = $data['user_id'];
				$rating = $data['rating'];
				$review = $data['review'];

				$get_product = get('product', 'WHERE product_id=' . $product_id);
				$data_product = mysqli_fetch_assoc($get_product);
				$product_name = $data_product['product_name'];

				$get_product_image = get('product_image', 'WHERE product_id=' . $product_id);
				$data_product_image = mysqli_fetch_assoc($get_product_image);
				$image_name = $data_product_image['image_name'];
				?>
				<div class="row mb-3">
					<div class="col-4">
						<img src="uploads/product/<?= $image_name ?>" class="pr-0" alt="product_image" width="100%">
					</div>
					<div class="col-8">
						<h3 class="mt-3 mb-5 pl-0"><?= $product_name ?></h3>
					</div>
				</div>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="rating_submit">
						<div class="form-group">
							<label class="d-block">Overall rating *</label>
							<span class="rating mb-0">
								<input type="radio" class="rating-input" id="5_star" name="rating" value="5">
								<label for="5_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="4_star" name="rating" value="4">
								<label for="4_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="3_star" name="rating" value="3">
								<label for="3_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="2_star" name="rating" value="2">
								<label for="2_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="1_star" name="rating" value="1">
								<label for="1_star" class="rating-star"></label>
							</span>
						</div>
					</div>
					<!-- REVIEW -->
					<div class="form-group">
						<label>Your review</label>
						<textarea name="review" class="form-control"><?= $review ?></textarea>
					</div>
					<div class="form-group">
						<label>Add photo</label>
						<div name="image" class="fileupload">
							<input type="file" name="fileupload">
						</div>
					</div>
					<div class="form-group">
						<div class="checkboxes float-left add_bottom_15 add_top_15">
							<label class="container_check">Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
								<input type="checkbox" required>
								<span class="checkmark"></span>
							</label>
						</div>
					</div>
					<a type="submit" href="index.php?page=product_view&product_id=<?= $product_id ?>" class="btn_1">BACK</a>
					<button type="submit" name="submit" class="btn_1">SUBMIT</button>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					$rating = $_POST['rating'];
					$review = $_POST['review'];

					$query = 'UPDATE review SET rating="' . $rating . '", review="' . $review . '" WHERE review_id=' . $review_id;
					$result = mysqli_query($connect, $query);

					if ($result) {
						echo '<script>window.location.href = "index.php?page=product_view&product_id=' . $product_id . '"</script>';
					}
				}
				?>
			</div>
		</main>
</body>

</html>