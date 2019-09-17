<?php 
    $headerConfig = [
        'title'=>'Корзина',
        'styles'=>['style.css', 'basket.css']
    ];
    include('modules/header.php');
    // unset($_SESSION['basket']);
    $template = [
        'products'=>[],
        'full_price'=>0
    ];
    if( !empty( $_SESSION['basket'] ) ){
        foreach( $_SESSION['basket'] as $basket_item ){
            $sql_basket_item = "
                SELECT * FROM products WHERE id = {$basket_item['id']}
            ";
            $result_basket_item = mysqli_query($db, $sql_basket_item);
            $data_basket_item = mysqli_fetch_assoc($result_basket_item);
            $data_basket_item['quantity'] =  $basket_item['quantity'];
            $data_basket_item['full_price'] = $basket_item['quantity'] * $data_basket_item['price'];
            $template['products'][] = $data_basket_item;

            $template['full_price'] += $data_basket_item['full_price'];
        }
    }

    d($template);
?>


<main class="main">
            <form action="handlers/form.php" method="POST">
                <div class="basket-wrapper">
                    <div class="basket-wrapper__header flex flex-column-center">
                        <h1 class="basket-wrapper__header__head">Ваша корзина</h1>
                        <p class="basket-wrapper__header__p">Товары резервируются на ограниченное время</p>
                    </div>
                    <div class="basket-wrapper__items">
                        <div class="basket-wrapper__items__row flex flex-row">
                            <div class="items-left flex flex-row">
                                <p class="items-left__head title">Фото</p>
                                <p class="items-left__head title">Наименование</p>
                            </div>
                            <div class="items-right flex flex-row">
                                <p class="items-right__head title">Размер</p>
                                <p class="items-right__head title">Количество</p>
                                <p class="items-right__head title">Стоимость</p>
                                <p class="items-right__head title">Удалить</p>
                            </div>
                        </div>

                        <?php foreach( $template['products'] as $product ): ?>
                        <div class="basket-wrapper__items__row flex flex-row">
                            <div class="items-left flex flex-row">

                           
                                <div class="items-left__pic" style="background-image:url(<?=$product['pic']?>)"></div>
                                <div class="items-left__column flex flex-column-start">
                                    <div class="items-left__column__head"><?=$product['name']?></div>
                                    <div class="items-left__column__sku"><?=$product['sku']?></div>
                                </div>
                            </div>
                            <div class="items-right items-right-result flex flex-row">
                                <div class="item-size">39</div>
                                <div class="item-quantity flex flex-row-center">
                                    <div class="quantity-number"><?=$product['quantity']?></div>
                                    <div class="quantity-button flex flex-column-center">
                                        <div class="quantity-button_btn flex flex-column-center">+</div>
                                        <div class="quantity-button_btn flex flex-column-center">-</div>
                                    </div>
                                </div>
                                <div class="item-price"><?=$product['full_price']?></div>
                                <div class="item-delite">Х</div>
                            

                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>

                </div>

                <div class="zigzag-wrapper flex flex-row-center">
                    <div class="zigzag-wrapper-box flex">

                        <div class="orange-line-item1">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>
                        <div class="orange-line-item2">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>
                        <div class="orange-line-item3">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>


                    </div>
                </div>

                <div class="delivery-wrapper-box">
                    <div class="delivery-wrapper">
                        <div class="delivery-wrapper__header flex flex-column-center">
                            <h2 class="delivery-wrapper__header__head">Адрес доставки</h2>
                            <p class="delivery-wrapper__header__p">Все поля обязательны для заполнения</p>
                        </div>
                        <div class="delivery-wrapper__form">

                            <div class="form_row full-input">
                                <div class="form__col__input title">Выберите вариант доставки</div>
                                <select name="delivery-option" required>
                                    <option value="Курьерская служба">Курьерская служба - 500 руб.</option>
                                    <option value="Самовывоз">Самовывоз - 0 руб.</option>
                                    <option value="Пункты выдачи">Пункты выдачи - 100 руб.</option>
                                </select>
                            </div>
                            <div class="form__row flex flex-row flex-wrap">
                                <div class="form__col flex flex-column">
                                    <div class="form__col__input title">Имя</div>
                                    <div class="half-input"> <input type="text" name="name" required></div>
                                </div>
                                <div class="form__col flex flex-column">
                                    <div class="form__col__input title">Фамилия</div>
                                    <div class="half-input"> <input type="text" name="surname" required></div>
                                </div>
                            </div>

                            <div class="form__row full-input">
                                <div class="form__col__input title full_row">Адрес</div>
                                <div class="full-input"><input type="text" name="adress" required></div>
                            </div>

                            <div class="form__row flex flex-row flex-wrap">
                                <div class="form__col">
                                    <div class="form__col__input title">Город</div>
                                    <div class="half-input"> <input type="text" name="city" required></div>
                                </div>
                                <div class="form__col">
                                    <div class="form__col__input title">Индекс</div>
                                    <div class="half-input"> <input type="text" name="index" required></div>
                                </div>
                            </div>
                            <div class="form__row flex flex-row flex-wrap">
                                <div class="form__col">
                                    <div class="form__col__input title">Телефон</div>
                                    <div class="half-input"> <input type="tel" name="phone" required></div>
                                </div>
                                <div class="form__col">
                                    <div class="form__col__input title">Е-майл</div>
                                    <div class="half-input"> <input type="email" name="email" required></div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="zigzag-wrapper flex flex-row-center">
                    <div class="zigzag-wrapper-box flex">

                        <div class="orange-line-item1">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>
                        <div class="orange-line-item2">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>
                        <div class="orange-line-item3">
                            <div class="orange-line down"></div>
                            <div class="orange-line up"></div>
                        </div>


                    </div>
                </div>

                <div class="payment-wrapper ">
                    <div class="payment-wrapper__header flex flex-column-center">
                        <h2 class="payment-wrapper__header__head">Варианты оплаты</h2>
                        <p class="payment-wrapper__header__p">Все поля обязательны для заполнения</p>
                    </div>
                    <div class="payment-wrapper-items flex flex-column-center">
                        <div class="payment-wrapper_info flex flex-column-center">
                            <div class="payment_info price">Стоимость: <?=$template['full_price']?> <span>руб.</span> </div>
                            <div class="payment_info delivery">Доставка: <span>руб.</span> </div>
                            <div class="payment_info result-price">Итого: <span>руб.</span> </div>
                        </div>

                        <div class="payment-options_wrapper flex flex-column-center">
                            <div class="select_wrapper">
                                <div class="title">Выберите способ оплаты</div>
                                <select name="payment-options" required>
                                    <option value="Банковская карта">Банковская карта</option>
                                    <option value="По счету">По счету</option>
                                    <option value="Наличными при получении">Наличными при получении</option>
                                </select>
                            </div>

                            <button class="btn-submit" type="submit"> Заказать </button>

                        </div>
                    </div>
                </div>

            </form>
        </main>

<?php 
    $footerConfig = [
        'scripts'=>['script.js', 'basket.js']    
    ];
    include('modules/footer.php');
?>