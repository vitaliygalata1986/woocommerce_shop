<?php

function woostudy_setup()
{
    load_theme_textdomain('woostudy', get_template_directory() . '/languages'); // наши переводы
    add_theme_support('title-tag');
    add_theme_support('post-thumbnail');
    add_theme_support('woocommerce');

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus(
        array(
            'menu-1' => __('Top Menu', 'woostudy'), // функция локализации (нам нужно вернуть перевод строки, исп. __)
            'menu-2' => __('Categories Menu', 'woostudy'),
            'menu-3' => __('Navbar Menu', 'woostudy'),
        )
    );
}

add_action('after_setup_theme', 'woostudy_setup');


add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
}, 5);
function woostudy_scripts()
{
    wp_enqueue_style('woostudy-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap', array(), null);
    wp_enqueue_style('woostudy-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css');
    wp_enqueue_style('woostudy-animate', get_template_directory_uri() . '/assets/lib/animate/animate.min.css');
    wp_enqueue_style('woostudy-owlcarousel', get_template_directory_uri() . '/assets/lib/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('woostudy-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('woostudy-custom', get_template_directory_uri() . '/assets/css/custom.css');

    wp_enqueue_script('jquery'); // подключаем встроенную библиотеку jquery
    wp_enqueue_script('woostudy-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('woostudy-easing', get_template_directory_uri() . '/assets/lib/easing/easing.min.js', array(), false, true);
    wp_enqueue_script('woostudy-owlcarousel', get_template_directory_uri() . '/assets/lib/owlcarousel/owl.carousel.min.js', array(), false, true);
    wp_enqueue_script('woostudy-main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'woostudy_scripts');

require_once get_template_directory() . '/inc/woocommerce-hooks.php';
require_once get_template_directory() . '/inc/class-woostudy-menu-categories.php';
require_once get_template_directory() . '/inc/class-woostudy-menu-navbar.php';
require_once get_template_directory() . '/inc/cpt.php';

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>'; // 1 / true, чтобы перехватить вывод
    if ($die) {
        die();
    }
}

function woostudy_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'woostudy'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'woostudy'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
        )
    );
}

add_action('widgets_init', 'woostudy_widgets_init');