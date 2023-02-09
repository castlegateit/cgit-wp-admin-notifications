<?php

/*
 * Plugin Name: Castlegate IT WP Admin Notifications
 * Plugin URI: https://github.com/castlegateit/cgit-wp-admin-notifications
 * GitHub Plugin URI: https://github.com/castlegateit/cgit-wp-admin-notifications
 * Description: Prevents admin notifications from being displayed to non-admin users.
 * Author: Castlegate
 * Author URI: https://www.castlegateit.co.uk
 * Version: 1.0.4
 * Network: True
 * License: MIT
 * Requires PHP: 7.0
 */

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_ADMIN_NOTIFICATIONS_PLUGIN', __FILE__);

require_once __DIR__ . '/classes/autoload.php';

$plugin = new Castlegate\AdminNotifications\Plugin;
