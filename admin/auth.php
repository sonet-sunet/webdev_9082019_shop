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
            echo 'Вы успешно вошли в систему';
            $_SESSION['auth'] = true;
            $_SESSION['manager'] = mysqli_fetch_assoc($result_manager);
        }else{
            echo 'Логин или пароль не совпадают';
        }
    }
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Войти</button>
</form>
<?php include('parts/footer.php');?>