<?php
/**
 * Plugin Name: Session Planner for WordCamps
 * Plugin URI: https://github.com/akirk/session-planner-for-wordcamps
 * Description: Plan the WordCamp you are attending: save sessions from the schedule, follow a live timeline through your day, and export your notes.
 * Version: 1.0.0+0f1191cf025c
 * Requires at least: 6.0
 * Tested up to: 7.1
 * Requires PHP: 7.4
 * Author: Alex Kirk
 * Author URI: https://alex.kirk.at/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: session-planner-for-wordcamps
 */

namespace SessionPlannerForWordCamps;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SESSION_PLANNER_FOR_WORDCAMPS_VERSION', '1.0.0' );

require_once __DIR__ . '/vendor/autoload.php';

// Autoloader for plugin classes.
spl_autoload_register( function( $class ) {
    $prefix = 'SessionPlannerForWordCamps\\';
    $len = strlen( $prefix );
    if ( strncmp( $prefix, $class, $len ) !== 0 ) {
        return;
    }
    $file = __DIR__ . '/src/' . str_replace( '\\', '/', substr( $class, $len ) ) . '.php';
    if ( file_exists( $file ) ) {
        require $file;
    }
} );

add_action( 'plugins_loaded', function() {
    $app = new App();
    $app->init();
} );

register_activation_hook( __FILE__, function() {
    $app = new App();
    $app->activate();
} );

register_deactivation_hook( __FILE__, function() {
    $app = new App();
    $app->deactivate();
} );
