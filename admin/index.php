<?php 
    include('parts/header.php');
    $template = [
        'products'=>[]
    ];

    if( isset( $_SESSION['auth'] ) && $_SESSION['auth'] ){
        $sql_products = "SELECT * FROM products"; 
        $result_products = mysqli_query($db, $sql_products);
        
        while( $row = mysqli_fetch_assoc($result_products) ){
            $template['products'][] = $row;
        }
    }
?>
<?php if( isset( $_SESSION['auth'] ) && $_SESSION['auth'] ): ?>
    <div class="row mt-5">
        <div class="col-8">
            <h1>Товары в БД</h1>
            <table class="table mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>SKU</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($template['products'] as $productItem):?>
                        <tr>
                            <td>
                                <a href="/admin/product.php?id=<?=$productItem['id']?>">
                                    <?=$productItem['id']?>
                                </a>
                            </td>
                            <td><?=$productItem['name']?></td>
                            <td><?=$productItem['sku']?></td>
                            <td><?=$productItem['price']?> руб.</td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">Вы не авторизованы</div>
<?php endif;?>
<?php include('parts/footer.php');?>
    
