<?php
/**
 * Plugin Name: HD - Plugin Custom Code
 * Description: HD learning custom plugin wordpress full coures
 * Version: 1.0
 * Author: Ngoc Hien - HenryDang
 */

// Hook to add an admin menu for the import page
add_action('admin_menu', 'wc_csv_image_importer_menu');

function wc_csv_image_importer_menu() {
    add_submenu_page(
        'wc-admin',
        'CSV Image Importer',
        'CSV Image Importer',
        'manage_options',
        'wc-csv-image-importer',
        'wc_csv_image_importer_page',
        5
    );
}

// Display the CSV Importer page
function wc_csv_image_importer_page() {
    ?>
    <div class="wrap">
        <h1>WooCommerce CSV Image Importer</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" required>
            <?php submit_button('Upload CSV'); ?>
        </form>
    </div>
    <?php

    // Handle the file upload
    if (isset($_FILES['csv_file'])) {
        wc_process_csv_upload($_FILES['csv_file']);
    }
}

// Process the CSV file upload
function wc_process_csv_upload($file) {
    $file_path = $file['tmp_name'];

    // Read the CSV and process each row
    if (($handle = fopen($file_path, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $product_id = $data[0];
            $image_path = $data[1];
            wc_upload_image_to_product($product_id, $image_path);
        }
        fclose($handle);
        echo '<div class="notice notice-success"><p>CSV processed successfully.</p></div>';
    } else {
        echo '<div class="notice notice-error"><p>Failed to open CSV file.</p></div>';
    }
}

// Upload an image to the media library and assign it to the product
function wc_upload_image_to_product($product_id, $image_path) {
    if (!file_exists($image_path)) {
        echo "<p>Image not found: $image_path</p>";
        return;
    }

    // Prepare the file for upload
    $filetype = wp_check_filetype(basename($image_path), null);
    $upload_dir = wp_upload_dir();
    $upload_file = $upload_dir['path'] . '/' . basename($image_path);

    // Copy the file to the uploads directory
    if (!copy($image_path, $upload_file)) {
        echo "<p>Failed to copy: $image_path</p>";
        return;
    }

    // Insert the attachment into the media library
    $attachment = [
        'guid'           => $upload_dir['url'] . '/' . basename($image_path),
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($image_path)),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $upload_file);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload_file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    // Assign the image to the product
    set_post_thumbnail($product_id, $attach_id);
    echo "<p>Image uploaded and assigned to product ID $product_id</p>";
}
