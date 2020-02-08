<?php

/*
Plugin Name: Responsive Menu Pro
Plugin URI: https://responsive.menu
Description: Highly Customisable Responsive Menu Plugin for WordPress
Version: 3.1.24
Author: Peter Featherstone
Text Domain: responsive-menu-pro
Author URI: https://responsive.menu
License: GPL2
Tags: responsive, menu, responsive menu
*/

/* Check correct PHP version first */
add_action('admin_init', 'check_responsive_menu_pro_php_version');
function check_responsive_menu_pro_php_version() {
    if(version_compare(PHP_VERSION, '5.4', '<')):
        add_action('admin_notices', 'responsive_menu_pro_deactivation_text');
        deactivate_plugins(plugin_basename(__FILE__));
    endif;
}

function responsive_menu_pro_deactivation_text() {
    echo '<div class="error"><p>' . sprintf(
            'Responsive Menu Pro requires PHP 5.4 or higher to function and has therefore been automatically disabled.
            You are still on %s.%sPlease speak to your web host about upgrading your PHP version.',
            PHP_VERSION,
            '<br /><br />'
        ) . '</p></div>';
}

if(version_compare(PHP_VERSION, '5.4', '<'))
    return;

include dirname(__FILE__) . '/vendor/autoload.php';
include dirname(__FILE__) . '/config/default_options.php';
include dirname(__FILE__) . '/config/services.php';
include dirname(__FILE__) . '/config/wp/scripts.php';
include dirname(__FILE__) . '/config/routing.php';
include dirname(__FILE__) . '/migration.php';
include dirname(__FILE__) . '/config/polylang.php';

if(is_admin()):
    $license_type = get_option('responsive_menu_pro_license_type');
    $item_id = 58802; // Our default Generic License
    if($license_type = 'Multi License')
        $item_id = 1143;
    elseif($license_type == 'Single License')
        $item_id = 1175;

    $updater = new ResponsiveMenuPro\Licensing\Check('https://responsive.menu', __FILE__, array(
        'version' => get_option('responsive_menu_pro_version'),
        'license' => trim(get_option('responsive_menu_pro_license_key')),
        'item_id' => $item_id,
        'author' => 'Responsive Menu',
        'url' => home_url()
    ));
endif;