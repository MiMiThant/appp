<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$table = new UsersTable(new MySQL);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

$result = $table->insert([
	"name" => $name,
	"email" => $email,
	"phone" => $phone,
	"address" => $address,
	"password" => $password,
]);

if($result) {
	HTTP::redirect("/index.php", "register=success");
} else {
	HTTP::redirect("/register.php", "error=register");
}
