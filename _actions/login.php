<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$email = $_POST['email'];
$password = $_POST['password'];

$table = new UsersTable(new MySQL);
$user = $table->findByEmailAndPassword($email, $password);

if($user) {
	if($table->suspended($user->id)){
		HTTP::redirect("/index.php","suspended=0");
	}

	// if($user->suspended){
	// 	HHTP::redirect("/index.php","suspended=true");
	// }
	
	session_start();
	$_SESSION['user'] = $user;
	HTTP::redirect("/profile.php");
} else {
	HTTP::redirect("/index.php", "incorrect=login");
}
