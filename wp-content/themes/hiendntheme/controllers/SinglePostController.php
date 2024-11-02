<?php 
namespace Hiendntheme\Controllers;

class SinglePostController {
    public function show($post_id) {
        $post = get_post($post_id);
        require get_template_directory() . '/views/single-post.php';
    }
}