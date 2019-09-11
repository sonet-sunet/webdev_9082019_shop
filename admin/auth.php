<?php 
    include('parts/header.php');
    if( isset( $_POST['email'] ) ){
        $pass = crypt($_POST['password'], 'nordic');

        $sql_manager = "
            SELECT * FROM managers 
            WHERE 
            email = '{$_POST['email']}' AND password = '{$pass}'
        ";

        $result_manager = mysqli_query($db, $sql_manager);

        if( mysqli_num_rows( $result_manager ) > 0 ){
            // Процедура авторизации
            echo "<div class='alert alert-success'>Вы успешно вошли в систему</div>";
            $_SESSION['auth'] = true;
            $_SESSION['manager'] = mysqli_fetch_assoc($result_manager);
        }else{
            echo "<div class='alert alert-danger'>Логин или пароль не совпадают</div>";
        }
    }
?>
<div class="row mt-5 justify-content-center">
    <div class="col-5">
        <h1>Авторизация</h1>
        <form method="POST">
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Пароль">
            </div>
            <button class="btn btn-primary" type="submit">Войти</button>
        </form>
    </div>
</div>
<?php include('parts/footer.php');?>