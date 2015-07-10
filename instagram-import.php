<?php

/**
 * WP Instagram Importer
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wpinstagram.hatemzidi.com
 * @since             1.0.0
 * @package           instg_imprtr
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Instagram Importer
 * Plugin URI:        http://wpinstagram.hatemzidi.com
 * Description:       Imports Instagram photos as posts to your WordPress site.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       instg-imprtr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-instg-imprtr-activator.php
 */
function activate_instg_imprtr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instg-imprtr-activator.php';
	instg_imprtr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-instg-imprtr-deactivator.php
 */
function deactivate_instg_imprtr() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instg-imprtr-deactivator.php';
	instg_imprtr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_instg_imprtr' );
register_deactivation_hook( __FILE__, 'deactivate_instg_imprtr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-instg-imprtr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_instg_imprtr() {

	$plugin = new instg_imprtr();
	$plugin->run();

}
run_instg_imprtr();
