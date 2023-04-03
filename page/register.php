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
								<input type="text" class="form-control" name="name" placeholder="Name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" placeholder="Email">
							</div>
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="password" class="form-control" name="password" value="" placeholder="Password">
										</div>
									</div>
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm Password">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" placeholder="Full Address">
							</div>
							<div class="private box">
								<div class="row no-gutters">
									<div class="col-6 pr-1">
										<div class="form-group">
											<div class="custom-select-form">
												<select class="wide add_bottom_10" name="country" id="country_2">
													<option value="" selected>Country</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Singapore">Singapore</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Australia">Australia</option>
													<option value="Japan">Japan</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-6 pr-1">
										<div class="form-group">
											<input type="number" class="form-control" name="telephone" placeholder="Telephone">
										</div>
									</div>
								</div>
							</div>


							<hr>

							<div class="form-group">
								<label class="container_check">Accept <a href="#0">Terms and conditions</a>
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="text-center">
								<button type="submit" name="submit" class="btn_1 full-width">Register</button>
							</div>
						</div>

						<?php
						if (isset($_POST['submit'])) {
							$name = $_POST['name'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$confirm_password = $_POST['confirm_password'];
							$address = $_POST['address'];
							$country = $_POST['country'];
							$telephone = $_POST['telephone'];

							register($name, $email, $password, $confirm_password, $address, $city, $country, $telephone);
						}
						?>

						<!-- /form_container -->
				</div>
				</form>
				<!-- /box_account -->
			</div>
		</div>
	</div>
</main>