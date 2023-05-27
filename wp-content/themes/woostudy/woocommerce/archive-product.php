<?php defined('ABSPATH') || exit; ?>
<?php get_header(); ?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </div>
</div>

<?php do_action('woocommerce_before_main_content'); ?>
<?php do_action('woocommerce_sidebar'); // хук подключает сайдбар ?>
<!-- Shop Product Start -->
<div class="col-lg-9 col-md-8">
    <div class="row pb-3">
        <div class="col-12">
            <header class="woocommerce-products-header">
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                    <h1 class="woocommerce-products-header__title page-title section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3"><?php woocommerce_page_title(); ?></span>
                    </h1>
                <?php endif; ?>
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action('woocommerce_archive_description'); // описание магазина
                ?>
                <div class="mt-1 mb-1"><?php woocommerce_output_all_notices(); ?></div>
            </header>
        </div>
        <?php
        if (woocommerce_product_loop()) { ?>
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <!--/**
                        * Hook: woocommerce_before_shop_loop.
                        *
                        * @hooked woocommerce_output_all_notices - 10
                        * @hooked woocommerce_result_count - 20
                        * @hooked woocommerce_catalog_ordering - 30
                        */
                    -->
                    <?php do_action('woocommerce_before_shop_loop'); ?>
                </div>
            </div>

            <?php woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>
    </div><!--/row pb-3-->
</div><!--/col-lg-9 col-md-8-->

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer(); ?>

