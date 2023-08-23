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
				<div class="page_header m-0">
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?page=admin">Admin</a></li>
							<li>Coupon Codes</li>
						</ul>
					</div>
					<div class="row">
						<div class="col">
							<h1 class="py-3">
								<a href="index.php?page=admin" style="color:black">
									<i class="ti-angle-left" style="font-weight:bold; font-size:11pt"></i>
								</a>
								Coupon Codes
							</h1>
						</div>
						<div class="col mt-3 text-right">
							<a href="index.php?page=coupon_add" class="btn btn-primary btn-sm">Add New a Coupon Code</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-sm">
					<tbody>
						<?php
						$get_coupon = get('coupon');
						foreach ($get_coupon as $data_coupon) :
							$coupon_id = $data_coupon['coupon_id'];
							$code = $data_coupon['code'];
						?>
							<tr>
								<td>
									<p><?= $code ?></p>
								</td>
								<td class="text-right">
									<div class="btn-group-vertical btn-group-sm">
										<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-primary tooltip-1" title="Edit" data-placement="left" href="index.php?page=coupon_edit&coupon_id=<?= $coupon_id ?>">
											<i class="ti-pencil"></i>
										</a>
										<a style="width:40px; max-height:40px; font-size:large" class="pt-2 btn btn-outline-danger tooltip-1" title="Delete" data-placement="left" href="index.php?page=coupon_delete&coupon_id=<?= $coupon_id ?>" onclick="return confirm('Are you sure to DELETE this COUPON CODE?')">
											<i class="ti-trash"></i>
										</a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</main>
</body>

</html>