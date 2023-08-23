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
							<h1 class="pt-3">
								<a href="index.php?page=admin" style="color:black">
									<i class="ti-angle-left" style="font-weight:bold; font-size:11pt"></i>
								</a>
								Manifacturers
							</h1>
						</div>
						<div class="col-6 text-right">
							<a href="index.php?page=manifacturer_add" class="btn_1">ADD MANIFACTURER</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">
								ID
							</th>
							<th scope="col">
								Manifacturer Name
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$result = get('manifacturer');
						foreach ($result as $data) :
							$manifacturer_id = $data['manifacturer_id'];
							$manifacturer_name = $data['manifacturer_name'];
						?>
							<tr>
								<td>
									<p><?= $manifacturer_id ?></p>
								</td>
								<td>
									<p><?= $manifacturer_name ?></p>
								</td>
								<td class="row">
									<a href="index.php?page=manifacturer_edit&manifacturer_id=<?= $manifacturer_id ?>" class="btn_1 col p-3 my-1">EDIT</a>
									<a href="index.php?page=manifacturer_delete&manifacturer_id=<?= $manifacturer_id ?>" onclick="return confirm('Are you sure you want to DELETE this manifacturer?')" class="btn_1 col p-3 my-1">DELETE</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</main>
</body>

</html>