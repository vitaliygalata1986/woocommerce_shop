<?php
/**
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;
global $product;
?>
<div class="col-12">
    <?php
    /**
     * Hook: woocommerce_before_single_product.
     *
     * @hooked woocommerce_output_all_notices - 10
     */
    do_action('woocommerce_before_single_product');

    /*
        if (post_password_required()) {   // зашифровать запись пароля - чтобы получить доступ к записи, т.е. показывается некая формочка
            echo get_the_password_form();     // WPCS: XSS ok.
            return;
        }
    */

    ?>
</div>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('col-12 product-card', $product); ?>>
    <div class="row">
        <div class="col-lg-5 mb-30">
            <?php do_action('woocommerce_before_single_product_summary'); ?>
        </div>
        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30 product-card-content">
                <?php woocommerce_show_product_sale_flash(); ?>
                <?php do_action('woocommerce_single_product_summary'); ?>
            </div>
        </div>
    </div>
    <div class="row product-additional">
        <div class="col">
            <div class="bg-light p-30">
                <?php do_action('woocommerce_after_single_product_summary'); ?>
            </div>
        </div>
    </div>
    <?php woocommerce_upsell_display(); ?>
</div><!--/product-->
<?php do_action('woocommerce_after_single_product'); ?>

