<?php
/*
Plugin Name: Top Like
Plugin URI: http://www.zoytex.com
Description: Display top like facebook widget
Version: 1.0
Author: Mr. Hien
Author URI: http://www.nguyenduyhien.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Top_Like' ) ) :

class Top_Like {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		add_action( 'plugins_loaded', array( &$this, 'includes' ), 2 );

		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_style' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 0.1
	 */
	public function constants() {

		define( 'TK_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		define( 'TK_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		define( 'TK_INCLUDES', TK_DIR . trailingslashit( 'includes' ) );

	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 0.1
	 */
	public function includes() {
		require_once( TK_INCLUDES . 'admin.php' );
	}

	/**
	 * Register custom style for the widget settings.
	 *
	 * @since 0.8
	 */
	function admin_style() {
		wp_enqueue_style( 'toplike-admin-style', RPWE_URI . 'includes/admin.css' );
	}

}

new Top_Like;
endif;
?>