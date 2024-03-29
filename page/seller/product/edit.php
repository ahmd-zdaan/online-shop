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

				$get_product = get('product', 'WHERE product_id=' . $product_id);

				$data_product = mysqli_fetch_assoc($get_product);

				$product_name = $data_product['product_name'];
				$product_category_id = $data_product['category_id'];
				$product_subcategory_id = $data_product['subcategory_id'];
				$price = $data_product['price'];
				$stock = $data_product['stock'];
				$description = $data_product['description'];
				$manifacturer_id = $data_product['manifacturer_id'];
				$variant = $data_product['variant'];
				$weight = $data_product['weight'];
				?>

				<form action="" method="POST" enctype="multipart/form-data">
					<div class="container pb-5">
						<div class="row">
							<div class="col-3">
								<div>
									<?php
									$get_image = get('product_image', 'WHERE product_id=' . $product_id . ' ORDER BY image_index DESC');

									foreach ($get_image as $data_image) :
										$image_name = $data_image['image_name'];
									?>
										<img src="uploads/product/<?= $image_name ?>" class="mb-3" style="width:100%; height:auto" alt="product_image">
									<?php endforeach ?>
								</div>
								<div class="mt-3">
									<label class="form-label">Product Image</label>
									<input class="form-control" type="hidden" name="image_id" value="<?= $image_name ?>">
									<input class="form-control" type="file" name="image[]" multiple>
								</div>
							</div>
							<div class="col-9">
								<div class="mb-2">
									<label class="form-label">Product Name</label>
									<input type="text" name="name" class="form-control" value="<?= $product_name ?>">
								</div>
								<div class="row mb-2">
									<div class="col">
										<label class="form-label">Category</label>
										<select id="list-category" class="form-control form-select" name="category">
											<?php
											$get_category = get('category');
											foreach ($get_category as $data_category) :
												$category_id = $data_category['category_id'];
												$category_name = $data_category['category_name'];
											?>
												<option value="<?= $category_id ?>" <?= ($product_category_id == $category_id) ? 'selected' : '' ?>><?= $category_name ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col">
										<label class="form-label">Subcategory</label>
										<select id="list-subcategory" class="form-control form-select" name="subcategory"></select>
									</div>
									<div class="col">
										<label class="form-label">Price</label>
										<input type="text" name="price" class="form-control" value="<?= $price ?>">
									</div>
								</div>
								<div class="mb-2">
									<label class="form-label">Description</label>
									<textarea style="height:300px" name="description" class="form-control"><?= $description ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label">Manifacturer</label>
									<?php
									$get_manifacturer = get('manifacturer', 'WHERE manifacturer_id=' . $manifacturer_id);
									$data_manifacturer = mysqli_fetch_assoc($get_manifacturer);
									$manifacturer_name = $data_manifacturer['manifacturer_name'];
									?>
									<input type="text" name="manifacturer" class="form-control" value="<?= $manifacturer_name ?>">
								</div>
								<div class="mb-2">
									<label class="form-label">Variants</label>
									<input type="text" name="variant" class="form-control" value="<?= $variant ?>">
								</div>
								<div class="row mb-2">
									<div class="col">
										<label class="form-label">Weight</label>
										<input type="number" name="weight" class="form-control" value="<?= $weight ?>">
									</div>
									<div class="col">
										<label class="form-label">Stock</label>
										<input type="number" name="stock" class="form-control" value="<?= $stock ?>">
									</div>
								</div>
								<div class="mt-4">
									<div class="btn-group mb-3" role="group">
										<a class="btn btn-outline-primary" href="index.php?page=seller_product">BACK</a>
										<button class="btn btn-primary" type="submit" name="submit">SAVE</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					$email = $_SESSION['email'];
					$get_user = get('user', 'WHERE email="' . $email . '"');
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
					$get_manifacturer = get('manifacturer', 'WHERE manifacturer_name="' . $manifacturer . '"');
					$data_manifacturer = mysqli_fetch_assoc($get_manifacturer);

					$manifacturer_id = $data_manifacturer['manifacturer_id'];

					if ((int)$_FILES['image']['size'][0] > 0) {
						$get_image = get('product_image', 'WHERE product_id=' . $product_id);
						if (mysqli_num_rows($get_image) > 0) {
							foreach ($get_image as $data_image) {
								$image_name = $data_image['image_name'];

								unlink("uploads/product/" . $image_name);
							}

							$query = "DELETE FROM product_image WHERE product_id=" . $product_id;
							$result = mysqli_query($connect, $query);
						}

						$i = 0;
						$image_index = 1;
						$file_name_array = array_reverse($_FILES['image']['name']);

						foreach ($file_name_array as $file_name) {
							$list = explode(".", $file_name);
							$extension = $list[count($list) - 1];
							$image_name = uniqid() . "." . $extension;

							$tmp_path = $_FILES['image']['tmp_name'][$i];
							$upload = move_uploaded_file($tmp_path, "uploads/product/" . $image_name);

							$result_image = insert('product_image', [
								'image_name' => $image_name,
								'product_id' => $product_id,
								'image_index' => $image_index
							]);

							$i++;
							$image_index++;
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

					$result = mysqli_query($connect, $query);

					if ($result) {
						echo '<script>window.location.href = "index.php?page=seller_product"</script>';
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