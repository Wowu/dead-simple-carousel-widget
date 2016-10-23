<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://musur.pl/
 * @since      1.0.0
 *
 * @package    Dead_Simple_Carousel
 * @subpackage Dead_Simple_Carousel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dead_Simple_Carousel
 * @subpackage Dead_Simple_Carousel/includes
 * @author     Karol Musur <kamusur@gmail.com>
 */
class Dead_Simple_Carousel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dead-simple-carousel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
