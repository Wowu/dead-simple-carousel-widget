<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://musur.pl/
 * @since             1.0.0
 * @package           Dead_Simple_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Dead Simple Carousel
 * Plugin URI:        http://musur.pl/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Karol Musur
 * Author URI:        http://musur.pl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dead-simple-carousel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Require composer dependencies
 */
require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

$timber = new \Timber\Timber();

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dead-simple-carousel-activator.php
 */
function activate_dead_simple_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dead-simple-carousel-activator.php';
	Dead_Simple_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dead-simple-carousel-deactivator.php
 */
function deactivate_dead_simple_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dead-simple-carousel-deactivator.php';
	Dead_Simple_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dead_simple_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_dead_simple_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dead-simple-carousel.php';

require plugin_dir_path( __FILE__ ) . 'widgets/class-dead-simple-carousel-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dead_simple_carousel() {

	$plugin = new Dead_Simple_Carousel();
	$plugin->run();

}
run_dead_simple_carousel();
