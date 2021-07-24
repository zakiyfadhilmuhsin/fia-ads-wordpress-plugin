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
        'options_page' // Panggil Halaman Options
    );
}
// Hubungkan ke Hook 'admin_menu' dan jalankan function
add_action('admin_menu', 'add_menu_fia_on_wp_admin');

/*
Tambah Options Page
*/
// Buat Field Settings
function fia_ads_settings() {
    // Custom Ads Section
    add_settings_section( 'custom_ads_settings','Ads Code','custom_ads_description_section','fia-custom-ads-options');

    // Add & Register Fields Custom Ads Code 
    add_settings_field('custom_ads_code','Custom Ads Code','display_custom_ads_code_element','fia-custom-ads-options','custom_ads_settings');
    register_setting( 'fia-ads-options', 'custom_ads_code');
}
// Register Field Settings
add_action('admin_init','fia_ads_settings');

// Custom Ads Description
function custom_ads_description_section() {
    echo '<p>Pengaturan custom ads</p>';
}

// HTML Fields Custom Ads Code
function display_custom_ads_code_element(){
    ?>
        <div>
            <input type="text" name="custom_ads_code" id="custom_ads_code" value="<?php echo esc_html( get_option('custom_ads_code') ); ?>" placeholder="Masukkan Kode Ads Disini..." style="width: 250px; border: 1px solid gray; border-radius: 5px; padding: 2px 12px" />
        </div>
    <?php
}

// Call Template Options Page
function options_page() {
    require_once 'settings/options_page.php';
}