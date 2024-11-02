<?php
spl_autoload_register(function($class) {
    // Define the theme's base directory
    $base_dir = get_template_directory() . '/';

    // Convert namespace to file path
    $file = $base_dir . str_replace(
        ['\\', 'Hiendntheme'], // Replace backslashes and theme's base namespace
        ['/', ''],            // Convert to directory separators and remove base namespace prefix
        $class
    ) . '.php';

    // Require the file if it exists
    if (file_exists($file)) {
        require $file;
    }
});