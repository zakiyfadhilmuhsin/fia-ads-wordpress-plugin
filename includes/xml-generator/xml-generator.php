<?php
/* 
 * Generate Page Custom XML 
 */

// Register RSS Feed
function init_rss_feed_fia_ads() {
    add_feed('fia_ads_xml', 'add_feed_template');
}
add_action('init', 'init_rss_feed_fia_ads');

// Call Feed Template
function add_feed_template() {
    require_once 'feed-template.php';
}