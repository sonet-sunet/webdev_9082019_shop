<?php 
    include ('../config/db.php');
    include ('../modules/functions.php');

    $response = [
        'products'=>[],
        'pagination'=>[
            'countPage'=> 1,
            'nowPage'=> 1
        ]
    ];

    $product_on_page = 10;
    $now_page = 1;

    if( !empty( $_GET['id'] ) ){
        if( !empty( $_GET['nowPage'] ) ){
            $now_page = $_GET['nowPage'];    
        }

        if( isset( $_GET['category'] ) ){
            $val = $_GET['category'];
            $category_value = "AND products.category = '$val'";    
        } else {
            $category_value = '';
        }

        if( isset( $_GET['size'] ) ){
            $val = $_GET['size'];
            $size_value = "AND products.size = '$val'";    
        } else {
            $size_value = '';
        }

        if( isset( $_GET['priceMin'] ) ){
            $valMin = $_GET['priceMin'];
            $valMax = $_GET['priceMax'];
            $price_value = "AND products.price > '$valMin' AND products.price < '$valMax'";    
        } else {
            $price_value = '';
        }
       
        $sql_products_all = "SELECT products.* FROM products
        INNER JOIN catalogs_products ON catalogs_products.product_id = products.id
        WHERE catalogs_products.catalog_id = {$_GET['id']} {$category_value} {$size_value} {$price_value}
        ";

        $result_products_all = mysqli_query($db, $sql_products_all);
        $product_counts = mysqli_num_rows($result_products_all);

        //ceil - округление в большую сторону
        $count_page = ceil( $product_counts / $product_on_page );

        $response['pagination']['countPage'] = $count_page;
        $response['pagination']['nowPage'] = $now_page;

        $start_row_page = ($now_page - 1) * $product_on_page;

        $sql_products = "SELECT products.* FROM products
        INNER JOIN catalogs_products ON catalogs_products.product_id = products.id
        WHERE catalogs_products.catalog_id = {$_GET['id']} {$category_value} {$size_value} {$price_value}
        LIMIT {$start_row_page}, {$product_on_page}
        ";

        $result_products = mysqli_query($db, $sql_products);
        
        //кол-во записей в выборке
        $count = mysqli_num_rows($result_products);

        // $count = 4;
        while( $count > 0 ){
            $product = mysqli_fetch_assoc($result_products);
            $response['products'][] = $product;
            $count--;
        }
    }
    //sleep(3);
    echo json_encode($response);
?>