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
							<li><a href="#">Home</a></li>
							<li><a href="#">Category</a></li>
							<li>Page active</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Product</h1>
				</div>

				<?php
				$product_id = $_GET['product_id'];
				$result = get('product', 'WHERE product_id=' . $product_id);
				$data = mysqli_fetch_assoc($result);
				$product_name = $data['product_name'];
				$product_category_id = $data['category_id'];
				$product_subcategory_id = $data['subcategory_id'];
				$price = $data['price'];
				$stock = $data['stock'];
				$description = $data['description'];
				$manifacturer_id = $data['manifacturer_id'];
				$size = $data['size'];
				$color = $data['color'];
				$weight = $data['weight'];
				?>

				<form action="" method="POST" enctype="multipart/form-data">
					<div class="container pb-5">
						<div class="row">
							<div class="col-3">
								<div>
									<?php
									$result = get('product_image', 'WHERE product_id=' . $product_id);
									if (mysqli_num_rows($result) > 0) :
										$data = mysqli_fetch_assoc($result);
										$image_name = $data['image_name'];
									?>
										<img src="uploads/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
									<?php
									else :
									?>
										<img src="img/products/product_placeholder_square_medium.jpg" class="lazy" alt="Image" width="100%">
									<?php endif ?>
								</div>
								<div class="mt-3">
									<label class="form-label">Product Image</label>
									<input class="form-control" type="hidden" name="image_id" value="<?=$data['id']?>">
									<input class="form-control" type="file" name="image">
								</div>
							</div>
							<div class="col-9">
								<ul style="list-style: none;" class="pl-0">
									<li class="mb-2">
										<label class="form-label">Product Name</label>
										<input type="text" name="name" class="form-control" value="<?= $product_name ?>">
									</li>
									<div class="row">
										<div class="col-4">
											<label class="form-label">Category</label>
											<select class="form-control form-select" name="category">
												<?php
												$result = get('category');
												foreach ($result as $data) :
													$category_id = $data['category_id'];
													$category_name = $data['category_name'];
												?>
													<option value="<?= $category_id ?>" <?= ($product_category_id == $category_id) ? 'selected' : '' ?>><?= $category_name ?></option>
												<?php
												endforeach
												?>
											</select>
										</div>
										<div class="col-4">
											<label class="form-label">Subcategory</label>
											<select class="form-control form-select" name="subcategory">
												<?php
												$result = get('subcategory');
												foreach ($result as $data) :
													$subcategory_id = $data['subcategory_id'];
													$subcategory_name = $data['subcategory_name'];
												?>
													<option value="<?= $subcategory_id ?>" <?= ($product_subcategory_id == $subcategory_id) ? 'selected' : '' ?>><?= $subcategory_name ?></option>
												<?php
												endforeach
												?>
											</select>
										</div>
										<div class="col-4">
											<li class="mb-2">
												<label class="form-label">Price</label>
												<input type="text" name="price" class="form-control" value="<?= $price ?>">
											</li>
										</div>
									</div>
									<li class="mb-2">
										<label class="form-label">Description</label>
										<textarea name="description" class="form-control"><?= $description ?></textarea>
									</li>
									<li class="mb-2">
										<label class="form-label">Manifacturer</label>
										<?php
										$result = get('manifacturer', 'WHERE manifacturer_id=' . $manifacturer_id);
										$data = mysqli_fetch_assoc($result);
										$manifacturer_name = $data['manifacturer_name'];
										?>
										<input type="text" name="manifacturer" class="form-control" value="<?= $manifacturer_name ?>">
									</li>
									<li class="mb-2">
										<label class="form-label">Size</label>
										<input type="text" name="size" class="form-control" value="<?= $size ?>">
									</li>
									<li class="mb-2">
										<label class="form-label">Color</label>
										<input type="text" name="color" class="form-control" value="<?= $color ?>">
									</li>
									<li class="mb-2">
										<label class="form-label">Weight</label>
										<input type="number" name="weight" class="form-control" value="<?= $weight ?>">
									</li>
									<li class="mt-3">
										<a type="submit" href="index.php?page=product_list" class="btn_1">BACK</a>
										<button type="submit" name="submit" class="btn_1">SAVE</button>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					$product_name = $_POST['name'];
					$category = $_POST['category'];
					$subcategory = $_POST['subcategory'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$size = $_POST['size'];
					$color = $_POST['color'];
					$weight = $_POST['weight'];

					$manifacturer = $_POST['manifacturer'];
					$result = get('manifacturer', 'WHERE manifacturer_name="' . $manifacturer . '"');
					$data = mysqli_fetch_assoc($result);
					$manifacturer_id = $data['manifacturer_id'];

					if (!empty($_FILES['image']['name'])) {
						$image_file_name = $_FILES['image']['name'];
						list($file_name, $extension) = explode(".", $image_file_name);
						$image_name = time() . "." . $extension;
						$tmp = $_FILES['image']['tmp_name'];

						if (move_uploaded_file($tmp, "uploads/" . $image_name)) {
							$image_id = $_POST['image_id'];

							$query = get('product_image', 'WHERE id='.$image_id);
							$data = mysqli_fetch_assoc($query);
							$image_name_old = $data['image_name'];
							unlink("uploads/" . $image_name_old);

							$query = "UPDATE product_image SET image_name='".$image_name."' WHERE id=".$image_id;
							$result = mysqli_query($connect, $query);
						}
					}

					$query = "UPDATE product SET 

					product_name=\"" . $product_name . "\", 
					category_id='" . $category . "', 
					subcategory_id='" . $subcategory . "', 
					price='" . $price . "', 
					description=\"" . $description . "\", 
					manifacturer_id='" . $manifacturer_id . "', 
					size='" . $size . "', 
					color='" . $color . "', 
					weight='" . $weight . "'

					WHERE product_id=" . $product_id;

					// var_dump($query); die;

					$result = mysqli_query($connect, $query);

					if ($result) {
						echo '<script>window.location.href = "index.php?page=product_list"</script>';
					}
				}
				?>
			</div>
		</main>

		<div id="toTop"></div> <!-- Back to top button -->

		<!-- COMMON SCRIPTS -->
		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>


</body>

</html>