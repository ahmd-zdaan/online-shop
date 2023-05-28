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
					<h1 class="pt-3">Add Product</h1>
				</div>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="container pb-5">
						<div class="row">
							<div class="col-3">
								<div>
									<img src="uploads/product/default.jpg" alt="default" width="100%">
								</div>
								<div class="mt-3">
									<label class="form-label">Product Image</label>
									<input class="form-control" type="file" name="image">
								</div>
							</div>
							<div class="col-9">
								<ul style="list-style: none;" class="pl-0">
									<li class="mb-2">
										<label class="form-label">Product Name</label>
										<input type="text" name="name" class="form-control" placeholder="-" required>
									</li>
									<div class="row">
										<div class="col-4">
											<label class="form-label">Category</label>
											<select id="list-category" class="form-control form-select" name="category">
												<option selected disabled hidden>-</option>
												<?php
												$product_category_id = $data['category_id'];
												$result = get('category');
												foreach ($result as $data) :
													$category_id = $data['category_id'];
													$category_name = $data['category_name'];
												?>
													<option value="<?= $category_id ?>"><?= $category_name ?></option>
												<?php
												endforeach
												?>
											</select>
										</div>
										<div class="col-4">
											<label class="form-label">Subcategory</label>
											<select id="list-subcategory" class="form-control form-select" name="subcategory" placeholder="-">
											</select>
										</div>
										<div class="col-4">
											<li class="mb-2">
												<label class="form-label">Price</label>
												<input type="text" name="price" class="form-control" placeholder="-" required>
											</li>
										</div>
									</div>
									<li class="mb-2">
										<label class="form-label">Description</label>
										<textarea name="description" class="form-control" placeholder="-" required></textarea>
									</li>
									<li class="mb-2">
										<label class="form-label">Manifacturer</label>
										<input type="text" name="manifacturer" class="form-control" placeholder="-" required>
									</li>
									<li class="mb-2">
										<label class="form-label">Size (optional)</label>
										<input type="text" name="size" class="form-control" placeholder="-">
									</li>
									<li class="mb-2">
										<label class="form-label">Color (optional)</label>
										<input type="text" name="color" class="form-control" placeholder="-">
									</li>
									<li class="mb-2">
										<label class="form-label">Weight (optional)</label>
										<input type="number" name="weight" class="form-control" placeholder="0 kg">
									</li>
									<li class="mb-2">
										<label class="form-label">Stock</label>
										<input type="number" name="stock" class="form-control" placeholder="0" required>
									</li>
									<!-- <li class="mb-2">
										<label class="form-label">Image</label>
										<input class="form-control" type="file" name="image">
									</li> -->
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
					$name = $_POST['name'];
					$category = $_POST['category'];
					$subcategory = $_POST['subcategory'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$size = $_POST['size'];
					$color = $_POST['color'];
					$weight = $_POST['weight'];
					$stock = $_POST['stock'];

					// Optional
					if ($size == '') {
						$size = '-';
					} elseif ($color == '') {
						$color = '-';
					} elseif ($weight == '') {
						$weight = '-';
					}

					$manifacturer = $_POST['manifacturer'];
					$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $manifacturer)));
					$select = get('manifacturer', 'WHERE slug="' . $slug . '"');
					if (mysqli_num_rows($select) > 0) {
						$data = mysqli_fetch_assoc($select);
						$id = $data['manifacturer_id'];
					} else {
						insert('manifacturer', [
							'manifacturer_name' => $manifacturer,
							'slug' => $slug
						]);
						$id = mysqli_insert_id($connect);
					}

					$result = insert('product', [
						'product_name' => $name,
						'category_id' => $category,
						'subcategory_id' => $subcategory,
						'price' => $price,
						'stock' => $stock,
						'description' => $description,
						'manifacturer_id' => $id,
						'size' => $size,
						'color' => $color,
						'weight' => $weight
					]);

					$id = $connect -> insert_id;

					if (!empty($_FILES['image']['name'])) {
						$name = $_FILES['image']['name'];
						list($file_name, $extension) = explode(".", $name);
						$image_name = time() . "." . $extension;

						$tmp = $_FILES['image']['tmp_name'];
						if (move_uploaded_file($tmp, "uploads/product/" . $image_name)) {
							$query = "INSERT INTO product_image (image_name, product_id) VALUES ('" . $image_name . "', '" . $id . "')";
							$result = mysqli_query($connect, $query);

							if (!$result) {
								unlink("uploads/product/" . $image_name);
							}
						}
					}

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
		<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
		<script>
			function getcategory(categoryId) {
				$.ajax({
					type: "get",
					url: "page/product/data/add.php?category_id=" + categoryId,
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