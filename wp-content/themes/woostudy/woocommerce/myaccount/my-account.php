<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
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
        <div class="col-md-3">
            <div class="bg-light p-30 mb-2 md-h-100"><?php do_action('woocommerce_account_navigation'); ?></div>
        </div>
        <div class="col-md-9">
            <div class="bg-light p-30 mb-2 md-h-100">
                <div class="woocommerce-MyAccount-content"><?php do_action('woocommerce_account_content'); ?></div>
            </div>
        </div>
    </div>
</div>
