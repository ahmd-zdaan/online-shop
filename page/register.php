<?php
check('register');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<!-- GOOGLE WEB FONT -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

<!-- BASE CSS -->
<link href="css/bootstrap.custom.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- SPECIFIC CSS -->
<link href="css/account.css" rel="stylesheet">

<!-- YOUR CUSTOM CSS -->
<link href="css/custom.css" rel="stylesheet">

<main class="bg_gray py-5">
	<div class="container margin_30">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Register</h3>
					<form action="" method="POST">
						<div class="form_container">
							<div class="form-group">
								<input type="text" class="form-control" name="name" required placeholder="Name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" required placeholder="Email">
							</div>
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="password" class="form-control" required name="password" value="" placeholder="Password">
										</div>
									</div>
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="password" class="form-control" required name="confirm_password" value="" placeholder="Confirm Password">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" required placeholder="Full Address">
							</div>
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<div class="custom-select-form">
												<select class="wide add_bottom_10" name="country" required>
													<option selected disabled hidden value="">Country</option>
													<option value="1">Indonesia</option>
													<option value="2">Singapore</option>
													<option value="3">Malaysia</option>
													<option value="4">Australia</option>
													<option value="5">Japan</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="number" class="form-control" required name="telephone" placeholder="Telephone">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group mt-2 mb-3">
								<label class="container_check">Accept
									<a href="index.php?page=terms">Terms and Conditions</a>
									<input required type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="text-center">
								<button type="submit" name="submit" class="btn_1 full-width">Register</button>
							</div>
						</div>
						<div class="text-center mt-3">
							<span>Already have an account?</span>
							<a href="index.php?page=login">Sign in</a>
						</div>
						<?php
						if (isset($_POST['submit'])) {
							$user_name = $_POST['name'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$confirm_password = $_POST['confirm_password'];
							$address = $_POST['address'];
							$country_id = $_POST['country'];
							$telephone = $_POST['telephone'];

							register($user_name, 'user', $email, $password, $confirm_password, $address, $country_id, $telephone);
						}
						?>
				</div>
				</form>
			</div>
		</div>
	</div>
</main>