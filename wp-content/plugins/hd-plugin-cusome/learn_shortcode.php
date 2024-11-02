<?php 

// Basic Shortcode
function    hd_basic_shortcode(){
    return '<p> This is basic shortcode </p>';
}
add_shortcode('basic_shotcode', 'hd_basic_shortcode');

// Shortcode use $attributes
function hd_shortcode_attributes($attributes){
    $attributes = shortcode_atts( [
        'name' => '',
        'age'  => ''
    ], $attributes, 'shortcode_attributes');
    return '<h3>Data: Name - '.$attributes['name'].' | Age - '.$attributes['age'].'</h3>';
}
add_shortcode('shortcode_attributes', 'hd_shortcode_attributes');

// Shortcode with DB Operation.
function hd_shortcode_db() {

    // Get Information Name DB
    global $wpdb;
    $table_prefix   =   $wpdb->prefix;

    $table_name     =   $table_prefix . 'post';

    $post_type      =   'post';


    // SQL Get Post Whose post_type == post && status == publish.
   $data = $wpdb->get_results( "SELECT post_title FROM {$table_name} WHERE post_type == '{$post_type}' AND post_status == 'publish' " );

   if( count($data) > 0 ){
    foreach ($data as $val){
        return $val->post_title;
    }
   } 

}
add_shortcode('shortcode_db', 'hd_shortcode_db');

// Short Code With Query DB Wordpress
function hd_shortcode_query (){
    $att    = [
        'post_type'     =>  'post',
        'post_status'   =>  'publish',
        'order'         =>  'DESC'
    ];
    $query = new WP_Query($att);

    
}
add_shortcode('shortcode_jquery', 'hd_shortcode_query');