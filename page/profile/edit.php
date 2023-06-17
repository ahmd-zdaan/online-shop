<?php
check('login');

$email = $_SESSION['email'];

// $result = get('user', 'JOIN country ON user.country_id=country.id_country WHERE email="' . $_SESSION['email'] . '"');
$get_user = get('user', 'WHERE email="' . $email . '"');
$table_user = mysqli_fetch_assoc($get_user);

$user_id = $table_user['user_id'];
$user_name = $table_user['user_name'];
$email = $table_user['email'];
$address = $table_user['address'];
$user_country_id = $table_user['country_id'];
$telephone = $table_user['telephone'];

$get_country = get('country', 'WHERE country_id=' . $user_country_id);
$table_country = mysqli_fetch_assoc($get_country);
$user_country_name = $table_country['country_name'];
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
							<li><a href="#">Profile</a></li>
							<li>Edit</li>
						</ul>
					</div>
					<h1 class="pt-3">Edit Profile</h1>
				</div>
			</div>
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="container pb-5">
					<div class="row">
						<div class="col-3">
							<?php
							$result = get('user_image', 'WHERE user_id=' . $user_id);

							if (mysqli_num_rows($result) > 0) :
								$data = mysqli_fetch_assoc($result);
								$user_image = $data['user_image'];
							?>
								<img src="uploads/user/<?= $user_image ?>" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
							<?php
							else :
							?>
								<img src="uploads/user/default.jpg" class="lazy" alt="user_image" width="100%">
							<?php endif ?>
							<div class="mt-3">
								<label class="form-label">Profile Image</label>
								<input class="form-control" type="file" name="image">
							</div>
						</div>
						<div class="col-9">
							<ul style="list-style: none;" class="pl-0">
								<li class="mb-2">
									<label class="form-label">Profile Name</label>
									<input type="text" name="user_name" class="form-control" value="<?= $user_name ?>">
								</li>
								<li class="mb-2">
									<label class="form-label">Country</label>
									<select class="form-control form-select" name="country">
										<option selected disabled hidden>-</option>
										<?php
										$result = get('country');
										foreach ($result as $data) :
											$country_id = $data['country_id'];
											$country_name = $data['country_name'];
										?>
											<option value="<?= $country_id ?>" <?= ($country_id == $user_country_id) ? 'selected' : '' ?>><?= $country_name ?></option>
										<?php
										endforeach
										?>
									</select>
								</li>
								<li class="mb-2">
									<label class="form-label">Full Address</label>
									<textarea name="address" class="form-control"><?= $address ?></textarea>
								</li>
								<li class="mb-2">
									<label class="form-label">Telephone</label>
									<input type="text" name="telephone" class="form-control" value="<?= $telephone ?>">
								</li>
								<li class="mt-3">
									<a type="submit" href="index.php?page=view_profile" class="btn_1">BACK</a>
									<button type="submit" name="submit" class="btn_1">SAVE</button>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</form>
			<?php
			if (isset($_POST['submit'])) {
				$name = $_POST['user_name'];
				$country = $_POST['country'];
				$address = $_POST['address'];
				$telephone = $_POST['telephone'];

				$query = "UPDATE user SET user_name='" . $name . "', address='" . $address . "', country_id='" . $country . "' WHERE email='" . $email . "'";
				$result = mysqli_query($connect, $query);

				if (!empty($_FILES['image']['name'])) {
					$name = $_FILES['image']['name'];
					list($file_name, $extension) = explode(".", $name);
					$new_user_image = time() . "." . $extension;
					$tmp = $_FILES['image']['tmp_name'];

					if (move_uploaded_file($tmp, "uploads/user/" . $new_user_image)) {
						$old_user_image_get = get('user_image', 'WHERE user_id='.$user_id);
						if (mysqli_num_rows($old_user_image_get) > 0) {
							$old_user_image_table = mysqli_fetch_assoc($old_user_image_get);
							$old_user_image = $old_user_image_table['user_image'];
							unlink("uploads/user/" . $old_user_image);

							$query = "UPDATE user_image SET user_image='" . $new_user_image . "' WHERE user_id=" . $user_id;
							$result = mysqli_query($connect, $query);
						} else {
							$result = insert('user_image', [
								'user_image' => $new_user_image,
								'user_id' => $user_id
							]);
						}

						if (!$result) {
							unlink("uploads/user/" . $image_name);
						}
					}
				}

				if ($result) {
					echo '<script>window.location.href = "index.php?page=view_profile"</script>';
				}
			}
			?>
		</main>
		<div id="toTop"></div><!-- Back to top button -->
</body>

</html>