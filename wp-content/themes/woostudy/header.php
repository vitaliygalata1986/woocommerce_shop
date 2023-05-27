<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'menu_class' => 'd-inline-flex align-items-center h-100 menu-1',
                )
            ) ?>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                        Account
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php if (is_user_logged_in()) { ?>
                            <a class="dropdown-item"
                               href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                               title="<?php _e('My Account', 'woostudy'); ?>"><?php _e('My Account', 'woostudy'); ?></a>
                        <?php } else { ?>
                            <a class="dropdown-item"
                               href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                               title="<?php _e('Sign in', 'woostudy'); ?>"><?php _e('Sign in', 'woostudy'); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                          style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                          style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="<?php echo home_url('/') ?>" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <?php aws_get_search_form(true); ?>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
               href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                 id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'menu-2',
                            'container' => false,
                            'items_wrap' => '%3$s', // избавляемся от ul
                            'walker' => new Woostudy_Menu_Categories(),
                        )
                    ) ?>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'menu-3',
                                'container' => false,
                                'items_wrap' => '%3$s', // избавляемся от ul
                                'walker' => new Woostudy_Menu_Navbar(),
                            )
                        ) ?>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <?php // woocommerce_mini_cart();?>
                        <a href="" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                  style="padding-bottom: 2px;">0</span>
                        </a>
                        <?php $data_attrs = !is_cart() ? ' data-toggle="modal" data-target="#cartModal" ' : ''; ?>
                        <a <?php echo $data_attrs; ?> href="<?php echo wc_get_cart_url() ?>" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle mini-cart-cnt"
                                  style="padding-bottom: 2px;">
                                <?php // echo WC()->cart->get_cart_contents_count()?>
                                <?php echo count(WC()->cart->get_cart()); // возвращает массив элементов в корзине - и так как это массив, то мы можем посчитать кол. этих элементов?>
                            </span>
                        </a>
                    </div>

                    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php woocommerce_mini_cart(); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->
