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
							<li>List</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-6">
							<h1 class="pt-3">
								<a href="index.php?page=admin" style="color:black">
									<i class="ti-angle-left" style="font-weight:bold; font-size:11pt"></i>
								</a>
								Categories and Subcategories
							</h1>
						</div>
						<div class="col-6 text-right">
							<a href="index.php?page=category_add" class="btn_1">ADD CATEGORY</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-sm">
					<tbody>
						<?php
						$result = get('category');
						foreach ($result as $data) :
							$category_id = $data['category_id'];
							$category_name = $data['category_name'];
						?>
							<tr>
								<td>
									<p><?= $category_name ?></p>
								</td>
								<td>
									<?php
									$result = get('subcategory', 'WHERE category_id=' . $category_id);
									foreach ($result as $data) :
										$subcategories = $data['subcategory_name'];
									?>
										<ul class="m-0">
											<li>
												<p class="m-0"><?= $subcategories ?></p>
											</li>
										</ul>
									<?php endforeach ?>
								</td>
								<td class="row">
									<!-- <div class="btn-group p-0">
										<a class="btn btn-outline-primary col" href="index.php?page=category_edit&category_id=<?= $category_id ?>">EDIT</a>
										<a class="btn btn-outline-danger col" href="index.php?page=category_delete&category_id=<?= $category_id ?>" onclick="return confirm('Are you sure you want to DELETE this category?')">DELETE</a>
									</div> -->
									<div class="col-1 p-0" style="max-width:30px">
										<div class="btn-group-vertical btn-group-sm">
											<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="View" data-placement="left" href="index.php?page=list&view=list">
												<i class="ti-eye"></i>
											</a>
											<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="Edit" data-placement="left" href="index.php?page=category_edit&category_id=<?= $category_id ?>">
												<i class="ti-pencil"></i>
											</a>
											<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-danger tooltip-1" title="Delete" data-placement="left" href="index.php?page=category_delete&category_id=<?= $category_id ?>" onclick="return confirm('Are you sure to DELETE this CATEGORY and it\'s SUBCATEGORIES?')">
												<i class="ti-trash"></i>
											</a>
										</div>
									</div>
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