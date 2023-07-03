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
				$variant = $data['variant'];
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
										<img src="uploads/product/<?= $image_name ?>" class="lazy" alt="Image" width="100%">
									<?php
									else :
									?>
										<img src="uploads/product/default.jpg" class="lazy" alt="Image" width="100%">
									<?php endif ?>
								</div>
								<div class="mt-3">
									<label class="form-label">Product Image</label>
									<input class="form-control" type="hidden" name="image_id" value="<?= $image_name ?>">
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
											<select id="list-category" class="form-control form-select" name="category">
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
											<select id="list-subcategory" class="form-control form-select" name="subcategory"></select>
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
										<label class="form-label">Variants</label>
										<input type="text" name="variant" class="form-control" value="<?= $variant ?>">
									</li>
									<li class="mb-2">
										<label class="form-label">Weight</label>
										<input type="number" name="weight" class="form-control" value="<?= $weight ?>">
									</li>
									<li class="mb-2">
										<label class="form-label">Stock</label>
										<input type="number" name="stock" class="form-control" value="<?= $stock ?>">
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
					$email = $_SESSION['email'];
					$get_user = get('user', 'WHERE email="'.$email.'"');
					$data_user = mysqli_fetch_assoc($get_user);

					$product_name = $_POST['name'];
					$seller_id = $data_user['user_id'];
					$category = $_POST['category'];
					$subcategory = $_POST['subcategory'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$variant = $_POST['variant'];
					$weight = $_POST['weight'];
					$stock = $_POST['stock'];

					$manifacturer = $_POST['manifacturer'];
					$result = get('manifacturer', 'WHERE manifacturer_name="' . $manifacturer . '"');
					$data = mysqli_fetch_assoc($result);
					$manifacturer_id = $data['manifacturer_id'];

					if (!empty($_FILES['image']['name'])) {
						$image_file_name = $_FILES['image']['name'];

						$explode = explode(".", $image_file_name);
						list($file_name, $extension) = $explode;
						$image_name = time() . "." . $extension;
						
						$tmp = $_FILES['image']['tmp_name'];
						if (move_uploaded_file($tmp, "uploads/product/" . $image_name)) {
							$image_name_new = $_POST['image_id'];

							// Deletes previous image
							$old_image = get('product_image', 'WHERE product_id=' . $product_id);
							if (mysqli_num_rows($old_image) > 0) {
								$data = mysqli_fetch_assoc($old_image);
								$image_name_old = $data['image_name'];
								unlink("uploads/product/" . $image_name_old);

								$query = "UPDATE product_image SET image_name='" . $image_name_new . "' WHERE product_id=" . $product_id;
								$result = mysqli_query($connect, $query);
							} else {
								insert('product_image', [
									'image_name' => $image_name,
									'product_id' => $product_id
								]);
							}
						}
					}

					$product_name = str_replace('"', '\"', $product_name);
					$product_name = str_replace("'", "\'", $product_name);
					$description = str_replace('"', '\"', $description);
					$description = str_replace("'", "\'", $description);

					$query = 'UPDATE product SET 
					product_name="' . $product_name . '", 
					seller_id="' . $seller_id . '", 
					category_id="' . $category . '", 
					subcategory_id="' . $subcategory . '", 
					price="' . $price . '", 
					description="' . $description . '", 
					manifacturer_id="' . $manifacturer_id . '", 
					variant="' . $variant . '", 
					weight="' . $weight . '", 
					stock="' . $stock . '"
					WHERE product_id=' . $product_id;

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
		<script>
			function getcategory(categoryId) {
				$.ajax({
					type: "get",
					url: "page/product/data/edit.php?category_id=" + categoryId,
					dataType: "html",
					success: function(response) {
						$('#list-subcategory').html(response);
					}
				});
			}

			$(document).ready(function() {
				let idcategory = $('#list-category').val();

				getcategory(idcategory);

				$('#list-category').change(function(e) {
					e.preventDefault();
					let idcategory = $('#list-category').val();

					getcategory(idcategory);
				});
			});
		</script>
</body>

</html>