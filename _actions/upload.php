<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Auth;

$user = Auth::check();

$name = $_FILES['photo']['name'];
$error = $_FILES['photo']['error'];
$type = $_FILES['photo']['type'];
$tmp = $_FILES['photo']['tmp_name'];

if ($error) {
	HTTP::redirect("/profile.php", "error=file");
}

if ($type === "image/jpeg" or $type === "image/png") {
	$table = new UsersTable(new MySQL);
	$table->updatePhoto($user->id, $name);
	$user->photo = $name;
	move_uploaded_file($tmp, "photos/$name");

	HTTP::redirect("/profile.php");
} else {
	HTTP::redirect("/profile.php", "error=type");
}
