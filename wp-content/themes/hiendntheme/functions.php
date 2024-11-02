<?php

use Hiendntheme\Controllers\HomeController;
use Hiendntheme\Controllers\SinglePostController;

require_once get_template_directory() . '/includes/autoload.php';

// Khởi tạo theme
function my_mvc_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_mvc_theme_setup');

// Kết nối controller với WordPress để xử lý các trang.
function my_mvc_theme_route() {
    $controller = new HomeController;
    if (is_home() || is_front_page()) {
        $controller->index();
        exit;
    }
}
add_action('template_redirect', 'my_mvc_theme_route');

function my_mvc_theme_single_route() {
    if (is_single()) {
        $post_id = get_the_ID();
        $controller = new SinglePostController;
        $controller->show($post_id);
        exit;
    }
}
// add_action('template_redirect', 'my_mvc_theme_single_route');