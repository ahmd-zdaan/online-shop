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
					<h3 class="client">Login</h3>
					<form action="" method="POST">
						<div class="form_container">
							<div class="form-group">
								<input required type="email" class="form-control" name="email" id="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input required type="password" class="form-control" name="password" id="password_in" value="" placeholder="Password">
							</div>
							<div class="clearfix add_bottom_15 mt-4">
								<div class="checkboxes float-left">
									<label class="container_check">Remember me
										<input type="checkbox">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="float-right">
									<a id="forgot" href="javascript:void(0);">Forgot Password?</a>
								</div>
							</div>
							<button type="submit" name="submit" class="text-center btn_1 full-width">Login</button>
							<div id="forgot_pw" class="p-5">
								<p class="mb-2">You will recieve a link to create a new password via email.</p>
								<div class="form-group">
									<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
								</div>
								<div class="text-center">
									<input type="submit" value="Send Email" class="btn_1">
								</div>
							</div>
						</div>

						<div class="text-center mt-3">
							<span>New to Online Shop?</span>
							<a href="index.php?page=register">Join now</a>
						</div>

						<?php
						if (isset($_POST['submit'])) {
							$email = $_POST['email'];
							$password = $_POST['password'];

							login($email, $password);
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>