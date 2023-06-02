<?php
include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;

$auth=Auth::check();


$table=new UsersTable(new MySQL);
$users=$table->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h1 class="h4 my-4">User Admin</h1>
        <table class="table table-dark table-striped"> 
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->phone ?></td>
                    <td>
                        <?php if($user->role_id===3): ?>
                            <span class="badge bg-success">
                                <?= $user->role ?>
                             </span>
                        <?php elseif($user->role_id===2): ?>
                            <span class="badge bg-primary">
                                <?= $user->role ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">
                                <?= $user->role ?>
                            </span>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="btn btn-group dropdown">
                            <?php if($auth->role_id>=1): ?>
                            <a href="#" class="btn btn-outline-primary btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">Change Role</a>

                            <div class="dropdown-menu drop-down menu-dark">
                                <a href="_actions/role.php?role=1&id=<?= $user->id ?>" 
                                class="dropdown-item">User</a>
                                <a href="_actions/role.php?role=2&id=<?= $user->id ?>" 
                                class="dropdown-item">Manager</a>
                                <a href="_actions/role.php?role=3&id=<?= $user->id ?>" 
                                class="dropdown-item">Admin</a>
                            </div>  
                            <?php endif ?> 

                            <?php if($auth->role_id>=2): ?>
                            <?php if($user->suspended): ?>
                                <a href="_actions/unsuspended.php?id=<?= $user->id ?>" 
                                class="btn btn-outline-success">Ban</a>
                            <?php else: ?>
                                <a href="_actions/suspended.php?id=<?= $user->id ?>" 
                                class="btn btn-success">UnBan</a>
                            <?php endif ?>
                            <?php endif ?>
                             
                            <?php if($auth->role_id===3): ?> 
                            <a href="_actions/delete.php?id=<?= $user->id ?>" 
                            class="btn btn-outline-danger btn-sm">Delete</a>
                            <?php endif ?>

                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>