<?php
// открепляем функцию от хука - это открывающая и закрывающая обертка всего сайта
//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// это ниначто не влияет
add_action(/**
 * @return void
 */ 'woocommerce_before_main_content', function () {
    // echo '<div class="container test3">';
}, 10); // 10 - можно не ставить, это приоритет по умолчанию

/*
add_action( 'woocommerce_after_main_content', function () {
	echo '</div>';
}, 10 );
*/

// хлебные крошки
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// add_action('woocommerce_before_main_content','woocommerce_breadcrumb',9); // смысл в приоритете - поместим хлебные крошки перед открывающими тегами
// add_action('woocommerce_after_shop_loop','woocommerce_breadcrumb',9); // поместим хлебные крошки перед пагинацией

/**
 * хлебные крошки
 */
add_filter('woocommerce_breadcrumb_defaults', function () {
    return array(
        'delimiter' => '&nbsp;/&nbsp;',
        'wrap_before' => '<nav class="breadcrumb bg-light mb-30">',
        'wrap_after' => '</nav>',
        'before' => '',
        'after' => '',
        'home' => __('Home', 'woostudy'),
    );
});

// отключение дефолтных стилей woocommerce
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action('woocommerce_shop_loop_subcategory_title', function ($category) {
    // debug($category);
    echo '<h6>' . esc_html($category->name) . '</h6>';
    if ($category->count > 0) {
        echo '<small class="text-body">' . esc_html($category->count) . __(' Products', 'woostudy') . ' </small>';
    }
});

// ссылка на товар в карточке товара
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// Удалить распродажа
// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',10);

// открепим title от хука
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', function () {
    // $product - это объект класса WC_Product - абстрактный класс в объектно-ориентированном программировании — базовый класс, который не предполагает создания экземпляров.
    // https://woocommerce.github.io/code-reference/classes/WC-Product.html
    global $product;
    /** @var WC_Product $product */
    echo '<a class="h6 text-decoration-none text-truncate" href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>';
}); // 10 - можно не ставить, это приоритет по умолчанию

// открепим рейтинг от хука
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

/*
add_action('woocommerce_after_shop_loop_item',function (){
    echo '<div class="d-flex align-items-center justify-content-center mb-1">sdvdsvdsvds</div>';
},11);
*/

add_action('woocommerce_after_shop_loop_item', function () {
    global $product;
    /** @var WC_Product $product */
    echo '<div class="d-flex align-items-center justify-content-center mt-2 mb-2">';
    woocommerce_template_loop_rating();


    if ($rating_cnt = $product->get_rating_count()) { // если у товара была хотябы одна оценка
        echo '<small>(' . $rating_cnt . ')</small></span>';
    }
    echo '</div>';
}, 6);


/*
// открепим цену
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);

add_action('woocommerce_after_shop_loop_item_title',function (){
    echo '<div class="d-flex align-items-center justify-content-center mt-2">';
    woocommerce_template_loop_price();
    echo '</div>';
},10);
*/

// обновление мини корзины
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) { // $fragments - это массив

    $fragments['.mini-cart-cnt'] = '<span class="badge text-secondary border border-secondary rounded-circle mini-cart-cnt">' . count(WC()->cart->get_cart()) . '</span>'; // добавляем в массив вот такой ключ: mini-cart-cnt и дальше нам нужно предать верстку, которая потом будет перерисована
    return $fragments;

});

// открепим notice
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

// отключение sidebar

add_action('template_redirect', function () { // хук template_redirect отрабатывет, когда переопределяется шаблон
    // применяем в тот случае, если is_product не отрабатывает
    if (is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
});

// отключим рапродажу
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// отключим related product
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// отключим upsell product
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);


// открепим cross sells из корзины
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);


// https://woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
add_filter('woocommerce_default_address_fields', function ($fields) {
    unset($fields['address_2']); // удалим из массива поле address_2
    // debug($fields, 1);
    // $fields['address_1']['required'] = false; // // сделаем поле address 1 не обязательным для заполнения
    return $fields;
});


// https://wpbeaches.com/filter-woocommerce-place-order-text-button-in-checkout-page/
add_filter('woocommerce_order_button_html', function ($button) {
    return str_replace('button alt', 'button alt btn btn-block btn-primary font-weight-bold py-3', $button);
});
