<?php
check('login');

$email = $_SESSION['email'];
$user_get = get('user', 'WHERE email="' . $email . '"');
$user_table = mysqli_fetch_assoc($user_get);

$user_id = $user_table['user_id'];

$review_id = $_GET['review_id'];
$get_review = get('review', 'WHERE review_id=' . $review_id);
$data_review = mysqli_fetch_assoc($get_review);

$product_id = $data_review['product_id'];
$user_id = $data_review['user_id'];
$rating = $data_review['rating'];
$review = $data_review['review'];
$date = $data_review['date'];

$product_get = get('product', 'WHERE product_id=' . $product_id);
$product_table = mysqli_fetch_assoc($product_get);

$product_name = $product_table['product_name'];
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

<style>
	.product:hover {
		text-decoration: underline;
	}

	.rating-input {
		display: inline-block;
		position: fixed;
		opacity: 0;
		pointer-events: none;
	}

	.review-image {
		position: relative;
		display: inline-block;
	}

	.review-image img {
		width: 200px;
		height: 200px;
		object-fit: scale-down;
	}

	.review-image a {
		position: absolute;
		padding: 0px 7px;
		top: 7px;
		right: 5px;
		font-size: 12pt;
		font-weight: bold;
	}
</style>

<body>
	<div id="page">
		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Product</a></li>
							<li><a href="#"><?= $product_name ?></a></li>
							<li>Edit Review</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Review</h1>
				</div>
				<div class="row mb-5">
					<div class="col-3">
						<?php
						$get_product_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');
						foreach ($get_product_image as $data_product_image) :
							$image_name = $data_product_image['image_name'];
						?>
							<img src="uploads/product/<?= $image_name ?>" class="mb-3" style="width:100%; height:auto; object-fit:scale-down;">
						<?php endforeach ?>
					</div>
					<div class="col-9">
						<a href="index.php?page=product_view&product_id=<?= $product_id ?>">
							<h4 class="mb-3 product"><?= $product_name ?></h4>
						</a>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="p-0">
								<div class="rating_submit">
									<div class="form-group mb-2">
										<label class="d-block mb-1">Overall rating</label>
										<span class="rating mb-0">
											<input type="radio" class="rating-input" required id="5_star" name="rating" value="5" <?php echo ($rating == 5) ? 'checked' : ''; ?>>
											<label for="5_star" class="rating-star"></label>
											<input type="radio" class="rating-input" required id="4_star" name="rating" value="4" <?php echo ($rating == 4) ? 'checked' : ''; ?>>
											<label for="4_star" class="rating-star"></label>
											<input type="radio" class="rating-input" required id="3_star" name="rating" value="3" <?php echo ($rating == 3) ? 'checked' : ''; ?>>
											<label for="3_star" class="rating-star"></label>
											<input type="radio" class="rating-input" required id="2_star" name="rating" value="2" <?php echo ($rating == 2) ? 'checked' : ''; ?>>
											<label for="2_star" class="rating-star"></label>
											<input type="radio" class="rating-input" required id="1_star" name="rating" value="1" <?php echo ($rating == 1) ? 'checked' : ''; ?>>
											<label for="1_star" class="rating-star"></label>
										</span>
									</div>
								</div>
								<div class="mb-3">
									<label>Add a photo</label>
									<div>
										<input style="width:280px" type="file" name="image[]" multiple>
									</div>
									<div class="mt-2">
										<?php
										$get_review_image = get('review_image', 'WHERE review_id=' . $review_id . ' ORDER BY image_index DESC');
										if (mysqli_num_rows($get_product_image) > 0) :
											foreach ($get_review_image as $data_review_image) :
												$review_image_id = $data_review_image['review_image_id'];
												$image_name = $data_review_image['image_name'];
										?>
												<div class="review-image">
													<img src="uploads/review/<?= $image_name ?>">
													<a class="btn btn-danger" href="index.php?page=review_delete_image&review_image_id=<?=$review_image_id?>" onclick="return confirm('Are you sure you want to DELETE this IMAGE?')">&times;</a>
												</div>
											<?php endforeach ?>
										<?php endif ?>
									</div>
								</div>
								<div class="mb-3">
									<label class="form-label mb-1">Write your review (optional)</label>
									<textarea name="review" style="height:150px" class="form-control"><?= $review ?></textarea>
								</div>
								<div class="checkboxes mb-3">
									<label class="container_check">Accept
										<a href="index.php?page=terms">Terms and Conditions</a>
										<input type="checkbox" required>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="btn-group">
									<a class="btn btn-outline-primary" type="submit" href="index.php?page=product_view&product_id=<?= $product_id ?>">CANCEL</a>
									<button class="btn btn-primary" type="submit" name="submit">SAVE</button>
								</div>
							</div>
						</form>
						<?php
						if (isset($_POST['submit'])) {
							$rating = $_POST['rating'];
							$review = $_POST['review'];

							if ((int)$_FILES['image']['size'][0] > 0) {
								$get_image = get('review_image', 'WHERE review_id=' . $review_id);
								if (mysqli_num_rows($get_image) > 0) {
									foreach ($get_image as $data_image) {
										$image_name = $data_image['image_name'];
			
										unlink("uploads/review/" . $image_name);
									}
			
									$query = "DELETE FROM review_image WHERE review_id=" . $review_id;
									$result = mysqli_query($connect, $query);
								}
		
								$i = 0;
								$image_index = 1;
								$file_name_array = array_reverse($_FILES['image']['name']);
		
								foreach ($file_name_array as $file_name) {
									list($file_name, $extension) = explode(".", $file_name);
									$image_name = uniqid() . "." . $extension;
		
									$tmp_path = $_FILES['image']['tmp_name'][$i];
									$upload = move_uploaded_file($tmp_path, "uploads/review/" . $image_name);
		
									$result_image = insert('review_image', [
										'image_name' => $image_name,
										'review_id' => $review_id,
										'image_index' => $image_index
									]);
		
									$i++;
									$image_index++;
								}
							}

							$query = 'UPDATE review SET rating="' . $rating . '", review="' . $review . '" WHERE review_id=' . $review_id;
							$result = mysqli_query($connect, $query);

							if ($result) {
								echo '<script>window.location.href = "index.php?page=product_view&product_id=' . $product_id . '"</script>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</main>
</body>

</html>