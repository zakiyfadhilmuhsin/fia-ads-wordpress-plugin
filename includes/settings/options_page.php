<?php
/*
 * Options Page
 * Desc: Options Page Settings
 */

/*
 * Field Custom Ads Middle Position 
 */

// Buat Field Settings
function fia_ads_settings() {
    /* Sections */

    // Custom Ads Section
    add_settings_section(
        'custom_ads_settings', // Section Name
        'Ads Code', // Section Title
        'custom_ads_description_section', // Section Description
        'fia-custom-ads-options' // Section Group
    );

    // Custom Script Section
    add_settings_section(
        'custom_script_settings', // Section Name
        'Custom Script', // Section Title
        'custom_script_description_section', // Section Description
        'fia-custom-ads-options' // Section Group
    );

    // Facebook Section
    add_settings_section(
        'facebook_settings', // Section Name
        'Facebook Settings', // Section Title
        'facebook_settings_description_section', // Section Description
        'fia-custom-ads-options' // Section Group
    );

    /* End Sections */

    /* Fields */

    // Add & Register Fields Custom Ads Code Middle Position 
    add_settings_field(
        'custom_ads_code_middle', // Field Name
        'Kode Iklan (Tengah Konten)', // Description
        'display_custom_ads_code_middle', // Display HTML
        'fia-custom-ads-options', // Section Group
        'custom_ads_settings' // Section
    );
    register_setting( 'fia-ads-options', 'custom_ads_code_middle');

    // Add & Register Fields Custom Ads Code Bottom Position 
    add_settings_field(
        'custom_ads_code_bottom', // Field Name
        'Kode Iklan (Bawah Konten)', // Description
        'display_custom_ads_code_bottom', // Display HTML
        'fia-custom-ads-options', // Section Group
        'custom_ads_settings' // Section
    );
    register_setting( 'fia-ads-options', 'custom_ads_code_bottom');


    // Add & Register Fields Custom Script
    add_settings_field(
        'custom_script', // Field Name
        'Kode Script', // Description
        'display_custom_script', // Display HTML
        'fia-custom-ads-options', // Section Group
        'custom_script_settings' // Section
    );
    register_setting( 'fia-ads-options', 'custom_script');


    // Add & Register Fields Facebook Page ID
    add_settings_field(
        'facebook_page_id', // Field Name
        'Facebook Page ID', // Description
        'display_facebook_page_id', // Display HTML
        'fia-custom-ads-options', // Section Group
        'facebook_settings' // Section
    );
    register_setting( 'fia-ads-options', 'facebook_page_id');

    // Add & Register Fields Facebook Audience Network 
    add_settings_field(
        'facebook_audience_network', // Field Name
        'Facebook Audience Network', // Description
        'display_facebook_audience_network', // Display HTML
        'fia-custom-ads-options', // Section Group
        'facebook_settings' // Section
    );
    register_setting( 'fia-ads-options', 'facebook_audience_network');
    
    /* End Fields */
}
// Register Field Settings
add_action('admin_init','fia_ads_settings');

/* ----- End Field Custom Ads Middle Position ---- */

/*
 * Section Description Functions 
 */

// Custom Ads Description
function custom_ads_description_section() {
    echo '<p>Pengaturan custom ads</p>';
}

// Custom Script Description
function custom_script_description_section() {
    echo '<p>Pengaturan custom script</p>';
}

// Facebook Settings Description
function facebook_settings_description_section() {
    echo '<p>Pengaturan facebook</p>';
}

/* ----- End Description Functions ---- */


/*
 * Display HTML Input Functions 
 */

// HTML Fields Custom Ads Code Middle
function display_custom_ads_code_middle(){
    ?>
        <div>
            <textarea id="custom_ads_code_middle" name="custom_ads_code_middle" rows="5" cols="35" type="textarea"><?php echo esc_html( get_option('custom_ads_code_middle') ); ?></textarea>
        </div>
    <?php
}

// HTML Fields Custom Ads Code Bottom
function display_custom_ads_code_bottom(){
    ?>
        <div>
            <textarea id="custom_ads_code_bottom" name="custom_ads_code_bottom" rows="5" cols="35" type="textarea"><?php echo esc_html( get_option('custom_ads_code_bottom') ); ?></textarea>
        </div>
    <?php
}

// HTML Fields Custom Script
function display_custom_script(){
    ?>
        <div>
            <textarea id="custom_script" name="custom_script" rows="5" cols="35" type="textarea"><?php echo esc_html( get_option('custom_script') ); ?></textarea>
        </div>
    <?php
}

// HTML Fields Facebook Page ID
function display_facebook_page_id(){
    ?>
        <div>
            <input type="text" name="facebook_page_id" id="facebook_page_id" value="<?php echo esc_html( get_option('facebook_page_id') ); ?>" placeholder="Masukkan Facebook Page ID Disini..." style="width: 250px; border: 1px solid gray; border-radius: 5px; padding: 2px 12px" />
        </div>
    <?php
}

// HTML Fields Facebook Audience Network
function display_facebook_audience_network(){
    ?>
        <div>
            <input type="text" name="facebook_audience_network" id="facebook_audience_network" value="<?php echo esc_html( get_option('facebook_audience_network') ); ?>" placeholder="Masukkan Facebook Audience Network Disini..." style="width: 250px; border: 1px solid gray; border-radius: 5px; padding: 2px 12px" />
        </div>
    <?php
}

/* ----- End Display HTML Input Functions  ---- */