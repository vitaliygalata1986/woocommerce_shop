<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined('ABSPATH') || exit;
?>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <?php do_action('woocommerce_before_cart'); // уведомления - удаление товара из корзины и т.д. ?>
        </div>
        <div class="col-lg-8 table-responsive mb-5">
            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                <?php do_action('woocommerce_before_cart_table'); ?>
                <table class="table table-light table-borderless table-hover mb-0 shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                    <thead class="thead-dark">
                    <tr>
                        <th><?php esc_html_e('Product', 'woocommerce'); ?></th>
                        <th><?php esc_html_e('Price', 'woocommerce'); ?></th>
                        <th><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
                        <th><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
                        <th><?php esc_html_e('Remove item', 'woocommerce'); ?></th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php do_action('woocommerce_before_cart_contents'); ?>
                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                <td class="align-middle product-name cart-product-thumb"
                                    data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$product_permalink) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                    }
                                    ?>
                                    <?php
                                    if (!$product_permalink) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    } else {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }
                                    ?>
                                </td>
                                <td class="align-middle product-price"
                                    data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </td>
                                <td class="align-middle product-quantity"
                                    data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        } else {
                                            $min_quantity = 0;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        }

                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $max_quantity,
                                                'min_value' => $min_quantity,
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                </td>
                                <td class="align-middle product-subtotal"
                                    data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </td>
                                <td class="align-middle product-remove">
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove btn btn-sm btn-danger" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <?php do_action('woocommerce_cart_contents'); ?>
                    <?php do_action('woocommerce_after_cart_contents'); ?>
                    </tbody>
                </table>

                <?php if (wc_coupons_enabled()) : ?>
                    <div class="bg-light p-30 mt-3 coupon">
                        <div class="input-group mb-3">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                                   placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" name="apply_coupon"
                                        value="<?php esc_attr_e('Apply coupon', 'woostyde'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
                            </div>
                        </div>
                        <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                <?php endif; ?>

                <button type="submit"
                        class="button btn btn-block btn-primary font-weight-bold my-3 py-3<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                        name="update_cart"
                        value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

                <?php do_action('woocommerce_cart_actions'); ?>

                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

                <?php do_action('woocommerce_after_cart_table'); ?>
            </form>

        </div><!--/col-lg-8-->


        <div class="col-lg-4">
            <?php do_action('woocommerce_before_cart_collaterals'); ?>
            <?php do_action('woocommerce_cart_collaterals'); ?>
        </div><!--/col-lg-4-->
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?>


