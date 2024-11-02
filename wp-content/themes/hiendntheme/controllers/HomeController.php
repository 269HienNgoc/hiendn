<?php
namespace Hiendntheme\Controllers;

use Hiendntheme\Models\PostModel;

class HomeController {
    public function index() {
        $posts_controller = PostModel::get_latest_posts(50);
        require get_template_directory() . '/views/home.php';
    }
}