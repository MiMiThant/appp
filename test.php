<?php

include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);
$table->insert([
	"name" => "Alice",
	"email" => "alice@gmail.com",
	"phone" => "239840928432",
	"address" => "Yangon",
	"password" => "password",
]);

echo "Done";
