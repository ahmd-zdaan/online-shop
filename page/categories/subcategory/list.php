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
							<li><a href="#">Subcategory</a></li>
							<li>List</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-6">
							<h1 class="pt-3">Subcategory List</h1>
						</div>
						<div class="col-6 text-right">
							<a href="index.php?page=subcategory_add" class="btn_1">ADD SUBCATEGORY</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-sm">
					<thead>
						<tr>
							<th scope="col" style="width: 50px">
								ID
							</th>
							<th scope="col">
								Name
							</th>
							<th scope="col">
								Category
							</th>
							<th scope="col" style="width: 250px">
								Actions
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$result = get('subcategory');
						foreach ($result as $data) :
							$subcategory_id = $data['subcategory_id'];
							$subcategory_name = $data['subcategory_name'];

							$category_id = $data['category_id'];
							$result = get('category', 'WHERE category_id='.$category_id);
							$data = mysqli_fetch_assoc($result);
							$category_name = $data['category_name'];
						?>
							<tr>
								<td>
									<p><?= $subcategory_id ?></p>
								</td>
								<td>
									<p><?= $subcategory_name ?></p>
								</td>
								<td>
									<p><?= $category_name ?></p>
								</td>
								<!-- OPTIONS -->
								<td class="row">
									<a href="index.php?page=subcategory_edit&subcategory_id=<?= $subcategory_id ?>" class="btn_1 col p-3 my-1">EDIT</a>
									<a href="index.php?page=subcategory_delete&subcategory_id=<?= $subcategory_id ?>" onclick="return confirm('Are you sure you want to DELETE this subcategory?')" class="btn_1 col p-3 my-1">DELETE</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="row add_top_30 flex-sm-row-reverse">
				</div>
			</div>
		</main>
</body>

</html>