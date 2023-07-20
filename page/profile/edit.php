<?php
check('login');

$email = $_SESSION['email'];

$get_user = get('user', 'WHERE email="' . $email . '"');
$table_user = mysqli_fetch_assoc($get_user);

$user_id = $table_user['user_id'];
$user_name = $table_user['user_name'];
$role = $table_user['role'];
$email = $table_user['email'];
$address = $table_user['address'];
$user_country_id = $table_user['country_id'];
$postal_code = $table_user['postal_code'];
$phone = $table_user['phone'];

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
			<form class="pb-5" action="" method="POST" enctype="multipart/form-data">
				<div class="container mb-5 pb-5">
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
								<img src="uploads/user/default.jpg" class="lazy" style="border-radius:50%" alt="user_image" width="100%">
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
									<label class="form-label">Full Address</label>
									<textarea name="address" class="form-control"><?= $address ?></textarea>
								</li>
								<li>
									<div class="row no-gutters">
										<div class="col">
											<label class="form-label">Country</label>
											<div class="form-group">
												<div class="custom-select-form">
													<select class="wide add_bottom_10" name="country_id" required>
														<option selected disabled hidden value="">Country</option>
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
												</div>
											</div>
										</div>
										<div class="col">
											<label class="form-label">Postal Code</label>
											<input type="number" name="postal_code" class="form-control" value="<?= $postal_code ?>">
										</div>
									</div>
								</li>
								<li class="mb-2">
									<label class="form-label">Phone</label>
									<input type="text" name="phone" class="form-control" value="<?= $phone ?>">
								</li>
								<li class="mt-4">
									<div class="row">
										<div class="col">
											<div class="btn-group btn-sm">
												<a class="btn btn-outline-primary" href="index.php?page=view_profile">BACK</a>
												<button class="btn btn-primary" type="submit" name="submit">SAVE</button>
											</div>
										</div>
										<div class="col text-right">
											<a class="btn btn-outline-danger" href="index.php?page=delete_profile&user_id=<?= $user_id ?>" onclick="confirm('WARNING: This action cannot be undone!\nAre you sure you want to DELETE your PROFILE?\nAll of your profile data will be permanently deleted.')">DELETE PROFILE</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</form>
			<?php
			if (isset($_POST['submit'])) {
				$name = $_POST['user_name'];
				$address = $_POST['address'];
				$country_id = $_POST['country_id'];
				$postal_code = $_POST['postal_code'];
				$phone = $_POST['phone'];

				$query = "UPDATE user SET user_name='" . $name . "', address='" . $address . "', country_id=" . $country_id . ", postal_code=" . $postal_code . ", phone=" . $phone . " WHERE email='" . $email . "'";
				$result = mysqli_query($connect, $query);

				if (!empty($_FILES['image']['name'])) {
					$name = $_FILES['image']['name'];
					list($file_name, $extension) = explode(".", $name);
					$new_user_image = time() . "." . $extension;
					$tmp = $_FILES['image']['tmp_name'];

					if (move_uploaded_file($tmp, "uploads/user/" . $new_user_image)) {
						$old_user_image_get = get('user_image', 'WHERE user_id=' . $user_id);
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
					if ($role == 'seller') {
						echo '<script>window.location.href = "index.php"</script>';
					} else {
						echo '<script>window.location.href = "index.php?page=view_profile"</script>';
					}
				}
			}
			?>
		</main>
</body>

</html>