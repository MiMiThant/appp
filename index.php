<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5 text-center" style="max-width: 600px">
		<h1 class="h4 mb-3">Login</h1>

		<?php if (isset($_GET['incorrect'])) : ?>
			<div class="alert alert-warning">
				Incorrect email or password
			</div>
		<?php endif ?>
		<?php if (isset($_GET['suspended'])) : ?>
			<div class="alert alert-warning">
				Account is Suspended
			</div>
		<?php endif ?>

		<?php if (isset($_GET['register'])) : ?>
			<div class="alert alert-info">
				Register successful, please login
			</div>
		<?php endif ?>

		<form action="_actions/login.php" method="post">
			<div class="mb-2">
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="mb-2">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
			</div>

			<button class="w-100 btn btn-primary mb-2">Login</button>
			<a href="register.php">Register</a>
		</form>
	</div>
</body>

</html>
