<?php
/*
Plugin Name: Facebook Instant Articles (Custom Ads)
Description: Plugin untuk mengenerate xml yang bisa menaruh custom ads untuk kebutuhan facebook instant articles
Author: Zakiy Fadhil Muhsin
Author URI: https://fb.me/zakilah24
Version: 0.0.1
*/

// Tambah Core Functions Plugin
require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';

// Tambah Function XML Generator
require_once plugin_dir_path(__FILE__) . 'includes/xml-generator/xml-generator.php';

// Updater Plugin
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/zakiyfadhilmuhsin/fia-ads-wordpress-plugin/',
	__FILE__,
	'fia-ads-wordpress-plugin'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');