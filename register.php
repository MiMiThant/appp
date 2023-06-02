<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-5 text-center" style="max-width: 600px">
		<h1 class="h4 mb-3">Register</h1>

		<?php if (isset($_GET['error'])) : ?>
			<div class="alert alert-warning">
				Something wrong, please try again
			</div>
		<?php endif ?>

		<form action="_actions/create.php" method="post">
			<div class="mb-2">
				<input type="text" class="form-control" name="name" placeholder="Name" required>
			</div>
			<div class="mb-2">
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="mb-2">
				<input type="text" class="form-control" name="phone" placeholder="Phone" required>
			</div>
			<div class="mb-2">
				<textarea name="address" class="form-control" placeholder="Address"></textarea>
			</div>
			<div class="mb-2">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
			</div>

			<button class="w-100 btn btn-primary mb-2">Register</button>
			<a href="index.php">Login</a>
		</form>
	</div>
</body>
</html>
