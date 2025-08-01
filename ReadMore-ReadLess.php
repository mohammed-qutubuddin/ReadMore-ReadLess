<?php
/*
Plugin Name: Read More Shortcode
Description: Add [readmore]...[/readmore] for collapsible content with custom button, text, and easy settings.
Version: 1.0
Author: Abdul Nasir
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) {
    exit;
}

// Include files
require_once __DIR__ . '/includes/readmore-shortcode.php';
require_once __DIR__ . '/includes/admin-settings.php';

add_filter('plugin_action_links_' . plugin_basename(__FILE__), function($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=readmore-settings') . '">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
});
