<?php 
    include('parts/header.php');
    $template = [
        'products'=>[]
    ];

    if( isset( $_SESSION['auth'] ) && $_SESSION['auth'] ){
        if( !empty( $_POST['id'] ) ){
            $sql_update = "
                UPDATE products
                SET
                    name = '{$_POST['name']}',
                    sku = '{$_POST['sku']}',
                    price = {$_POST['price']},
                    pic = '{$_POST['pic']}',
                    text = '{$_POST['text']}'
                WHERE id={$_POST['id']}
            ";

            $result_update = mysqli_query( $db, $sql_update );
            if( $result_update ){
                echo "Успешно";
            }else{
                echo "Ошибка";
            }


        }

        if( !empty( $_GET['id'] ) ){
            $sql_products = "SELECT * FROM products WHERE id = {$_GET['id']}"; 
            $result_product = mysqli_query($db, $sql_products);
            $template['products'] = mysqli_fetch_assoc($result_product);
        }
    }
?>
<div class="row">
    <div class="col-8">
        <h1>Редактирование товара</h1>
        <form class="mt-5" method="POST">
            <div class="form-group">
                <input class="form-control" name="id" readonly  type="text" value="<?=$template['products']['id']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="name"  type="text" value="<?=$template['products']['name']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="sku"  type="text" value="<?=$template['products']['sku']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="pic"  type="text" value="<?=$template['products']['pic']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="price"  type="text" value="<?=$template['products']['price']?>">
            </div>
            <textarea name="text" class="form-control"><?=$template['products']['text']?></textarea>
            <button  type="submit" class="btn btn-primary mt-3">Изменить</button>
        </form>
    </div>
</div>
<?php include('parts/footer.php');?>