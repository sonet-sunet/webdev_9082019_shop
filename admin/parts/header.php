<?php 
    include('../modules/functions.php'); 
    include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админка</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-8">
                <h2>Административная панель</h2>
            </div>
            <div class="col-4">
                <?php if(isset( $_SESSION['auth'] ) && $_SESSION['auth']):  ?>
                    <a class="btn btn-danger" href="/admin/exit.php">Выйти</a>
                <?php else: ?>
                    <a class="btn btn-warning" href="/admin/reg.php">Регистрация</a>
                    <a class="btn btn-success" href="/admin/auth.php">Авторизация</a>
                <?php endif;?>
            </div>
        </div>