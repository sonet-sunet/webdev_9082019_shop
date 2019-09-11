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
<div class="row mt-5 justify-content-center">
    <div class="col-5">
        <h1>Регистрация</h1>
        <form class="mt-3" method="POST">
            <div class="form-group">
                <input class="form-control" type="text" name="fio" placeholder="ФИО">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="tel" name="phone" placeholder="Phone"> 
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Пароль">
            </div> 
            <button class="btn btn-primary" type="submit">Зарегестрироваться</button>
        </form>
    </div>
</div>
<?php include('parts/footer.php');?>