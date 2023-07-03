<?php
check('login');

$subcategory_id = $_GET['subcategory_id'];

$get_subcategory = get('subcategory', 'WHERE subcategory_id=' . $subcategory_id);
$data_subcategory = mysqli_fetch_assoc($get_subcategory);

$subcategory_name = $data_subcategory['subcategory_name'];
$category_id = $data_subcategory['category_id'];
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
					<h1 class="pt-3">Edit Subcategory</h1>
				</div>
				<form action="" method="POST">
					<div class="container pb-5">
						<div class="row">
							<div class="col-3">
								<img src="uploads/product/default.jpg" alt="" width="100%">
							</div>
							<div class="col">
								<ul style="list-style: none;" class="pl-0">
									<li class="mb-2">
										<label class="form-label">Subcategory Name</label>
										<input type="text" name="subcategory" value="<?= $subcategory_name ?>" class="form-control">
									</li>
									<li class="mt-3">
										<a type="submit" href="index.php?page=category_edit&category_id=<?= $category_id ?>" class="btn_1">BACK</a>
										<button type="submit" name="submit" class="btn_1">SAVE</button>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</form>

				<?php
				if (isset($_POST['submit'])) {
					$subcategory = $_POST['subcategory'];

					$query = 'UPDATE subcategory SET subcategory_name="' . $subcategory . '" WHERE subcategory_id=' . $subcategory_id;

					if (mysqli_query($connect, $query)) {
						echo '<script>window.location.href = "index.php?page=category_edit&category_id=' . $category_id . '"</script>';
					}
				}
				?>
			</div>
		</main>

		<!-- COMMON SCRIPTS -->
		<script src="js/common_scripts.min.js"></script>
		<script src="js/main.js"></script>
</body>

</html>