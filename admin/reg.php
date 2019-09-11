<?php 
    include('parts/header.php');
    if( isset( $_POST['fio'] ) ){
        $pass = crypt($_POST['password'], 'nordic');
        
        $sql_manager = "
            INSERT INTO managers (id, fio, phone, email, password)
            VALUE
            (NULL, '{$_POST['fio']}','{$_POST['phone']}', '{$_POST['email']}', '{$pass}' )
        ";
        $result_manager = mysqli_query($db, $sql_manager);
        
        if( $result_manager ){
            echo 'Пользователь успешно добавлен';
        }
    }
?>
<form method="POST">
    <input type="text" name="fio" placeholder="ФИО">
    <input type="email" name="email" placeholder="Email">
    <input type="tel" name="phone" placeholder="Phone">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Зарегестрироваться</button>
</form>
<?php include('parts/footer.php');?>