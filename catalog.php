<?php 
    $headerConfig = [
        'title'=>'Каталог',
        'styles'=>['style.css', 'catalog.css']
    ];
    include('modules/header.php');

    $template = [
        'title'=>'Мужчинам',
        'id'=>1,
        'products'=> []
    ];

    if( !empty( $_GET['id'] ) ){
        // Формируем запрос к БД
        $sql_catalog = "SELECT * FROM catalogs WHERE id = {$_GET['id']}";
        
        //Отправляем запрос в БД и получаем результат
        $result_catalog = mysqli_query($db, $sql_catalog);

        //Преобразуем результат к ассоц. массиву
        $catalog = mysqli_fetch_assoc($result_catalog);

        //Заполняем значения массива $template значениями из БД
        $template['title'] = $catalog['name'];
        $template['id'] = $catalog['id'];

    }
?>

<div data-catalog-id="<?=$template['id']?>" class="catalog">
    <h1 class="catalog-head"><?=$template['title']?></h1>
    <div class="catalog-desc">Все товары</div>
    <div class="catalog-filters">
        <select name="category" id="category" class="catalog-filters-select category">
            <option class="filterValues" value="all" disabled <?php if( !isset ($_GET['category'])) {echo " selected";}?>>Категория</option>
            <option class="filterValues" value="1" <?php if( isset ($_GET['category']) && $_GET['category'] == '1'){echo " selected";}?> >Одежда</option>
            <option class="filterValues" value="2" <?php if( isset ($_GET['category']) && $_GET['category'] == '2'){echo " selected";}?>>Обувь</option>
            <option class="filterValues" value="all">Все</option>
        </select>
        <select name="size" id="size" class="catalog-filters-select size">
            <option class="filterValues" value="all" disabled <?php if( !isset ($_GET['size'])){echo " selected";}?> >Размер</option>
            <option class="filterValues" value="S" <?php if( isset ($_GET['size']) && $_GET['size'] == 'S'){echo " selected";}?>>S</option>
            <option class="filterValues" value="M" <?php if( isset ($_GET['size']) && $_GET['size'] == 'M'){echo " selected";}?> >M</option>
            <option class="filterValues" value="L" <?php if( isset ($_GET['size']) && $_GET['size'] == 'L'){echo " selected";}?> >L</option>
            <option class="filterValues" value="all">Все</option>
        </select>
        <select name="price" id="" class="catalog-filters-select price">
        <option value="all" disabled <?php if( !isset ($_GET['priceMin'])){echo " selected";}?> >Стоимость</option>
            <option class="filterValues" value="0-1000" <?php if( isset ($_GET['priceMin']) && $_GET['priceMin'] == '0' && $_GET['priceMax'] == '1000'){echo " selected";}?> >0 - 1000 руб.</option>
            <option class="filterValues" value="1000-3000" <?php if( isset ($_GET['priceMin']) && $_GET['priceMin'] == '1000' && $_GET['priceMax'] == '3000'){echo " selected";}?> >1000 - 3000 руб.</option>
            <option class="filterValues" value="3000-6000" <?php if( isset ($_GET['priceMin']) && $_GET['priceMin'] == '3000' && $_GET['priceMax'] == '6000'){echo " selected";}?> >3000 - 6000 руб.</option>
            <option class="filterValues" value="6000-20000" <?php if( isset ($_GET['priceMin']) && $_GET['priceMin'] == '6000' && $_GET['priceMax'] == '20000'){echo " selected";}?> >6000 - 20000 руб.</option>
            <option class="filterValues" value="all">Все</option>
        </select>
    </div>
    <div class="catalog-products"></div>
    <div class="catalog-pagination"></div>
    <div class="catalog-preloader">Загрузка</div>
</div>

<?php 
    $footerConfig = [
        'scripts'=>['script.js', 'catalog.js']    
    ];
    include('modules/footer.php');
?>