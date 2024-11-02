<?php 
namespace Hiendntheme\Models;
class PostModel {
    public static function get_latest_posts($count = 5) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $count,
            'post_status'   => 'publish',
            'orderby'         => array('rand' => 'DESC')
        );
        return new \WP_Query($args);
    }
}