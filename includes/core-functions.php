<?php

/*
Tambah Menu Baru di Dashboard Admin Wordpress
*/
// Function untuk menampilkan menu di WP Admin
function add_menu_fia_on_wp_admin() {
    add_menu_page(
        'Facebook Instant Articles (Custom Ads)', // Page Title
        'FIA (Custom Ads)', // Menu Title
        'manage_options', // Hooks
        'fia-ads', // Slug
        'options_template' // Panggil Halaman Options
    );
}
// Hubungkan ke Hook 'admin_menu' dan jalankan function
add_action('admin_menu', 'add_menu_fia_on_wp_admin');

// Call Template Options Page
function options_template() {
    require_once 'settings/options_template.php';
}

// Panggil Options Page Settings
require_once 'settings/options_page.php';