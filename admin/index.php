<?php 
    include('parts/header.php');
    if( isset( $_SESSION['auth'] ) && $_SESSION['auth'] ){
        echo 'Вы авторизованы';
        d( $_SESSION['manager'] );
    }else{
        echo 'Вы не авторизованы';
    }

?>
<?php include('parts/footer.php');?>
    
