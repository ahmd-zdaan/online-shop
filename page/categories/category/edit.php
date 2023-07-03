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
					<h1 class="pt-3">Edit Category</h1>
				</div>
				<?php
				$category_id = $_GET['category_id'];

				$get_category = get('category', 'WHERE category_id=' . $category_id);
				$data_category = mysqli_fetch_assoc($get_category);

				$category_name = $data_category['category_name'];
				?>
				<form action="" method="POST">
					<div class="container pb-5">
						<div class="row">
							<div class="col-3">
								<img src="uploads/product/default.jpg" alt="" width="100%">
							</div>
							<div class="col">
								<ul style="list-style: none;" class="pl-0">
									<li class="mb-4">
										<label class="form-label">Category</label>
										<input type="text" name="category" class="form-control" value="<?= $category_name ?>">
									</li>
									<li>
										<label class="form-label">Subcategory</label>
										<a style="float: right;" class="btn btn-outline-primary btn-sm mb-3" href="index.php?page=subcategory_add&category_id=<?= $category_id ?>">Add Subcategory</a>
										<table class="table table-striped table-hover table-sm">
											<thead>
												<tr>
													<th scope="col" style="width: 50px">
														ID
													</th>
													<th scope="col">
														Name
													</th>
													<th scope="col" style="width: 100px">
														Actions
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$get_subcategory = get('subcategory', 'WHERE category_id=' . $category_id);
												foreach ($get_subcategory as $data_subcategory) :
													$subcategory_id = $data_subcategory['subcategory_id'];
													$subcategory_name = $data_subcategory['subcategory_name'];
												?>
													<tr>
														<td>
															<p><?= $subcategory_id ?></p>
														</td>
														<td>
															<p><?= $subcategory_name ?></p>
														</td>
														<td class="row">
															<div class="btn-group btn-group-sm p-0">
																<a class="btn btn-outline-primary col" href="index.php?page=subcategory_edit&subcategory_id=<?= $subcategory_id ?>">EDIT</a>
																<a class="btn btn-outline-danger col" href="index.php?page=subcategory_delete&subcategory_id=<?= $subcategory_id ?>" onclick="return confirm('Are you sure you want to DELETE this SUBCATEGORY?')">DELETE</a>
															</div>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</li>
									<li class="mt-3">
										<a type="submit" href="index.php?page=category_list" class="btn_1">BACK</a>
										<button type="submit" name="submit" class="btn_1">SAVE</button>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</form>
				<?php
				if (isset($_POST['submit'])) {
					$category = $_POST['category'];

					$query = 'UPDATE category SET category_name="' . $category . '" WHERE category_id=' . $category_id;
					$result = mysqli_query($connect, $query);

					if ($result) {
						echo '<script>window.location.href = "index.php?page=category_list"</script>';
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