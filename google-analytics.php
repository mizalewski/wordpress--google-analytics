<?php
/**
 * @package GoogleAnalytics
 * @version 1.0.0
 */
/*
Plugin Name: Google Analytics
Plugin URI: github.com/mizalewski/wordpress--google-analytics
Author: Michał Zalewski
Version: 1.0.0
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function google_analytics_settings_api_init()
{
    // Add the section to reading settings so we can add our
    // fields to it
    add_settings_section(
        'eg_setting_section',
        'Google Analytics',
        'google_analytics_setting_section_callback_function',
        'general'
    );

    add_settings_field(
        'google_analytics_setting_google_analytics_id',
        'Google Analytics ID',
        'google_analytics_setting_google_analytics_id_callback_function',
        'general',
        'eg_setting_section'
    );

    register_setting('general', 'google_analytics_setting_google_analytics_id');
}

function google_analytics_wp_footer()
{
    $googleAnalyticsId = get_option('google_analytics_setting_google_analytics_id');

    echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $googleAnalyticsId . '"></script>' . "<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '" . $googleAnalyticsId . "');</script>";
}

function google_analytics_setting_section_callback_function()
{
}

function google_analytics_setting_google_analytics_id_callback_function()
{
    echo '<input name="google_analytics_setting_google_analytics_id" id="google_analytics_setting_google_analytics_id" type="text" value="' . get_option('google_analytics_setting_google_analytics_id') . '" />';
}

add_action('wp_footer', 'google_analytics_wp_footer');
add_action('admin_init', 'google_analytics_settings_api_init');
