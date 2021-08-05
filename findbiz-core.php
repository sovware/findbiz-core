<?php
/*
Plugin Name: Findbiz Core
Plugin URI: https://directorist.com/
Description: Core plugin of FindBiz Theme.
Author: WpWax
Author URI: https://wpwax.com
Domain Path: /languages
Text Domain: findbiz-core
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FindBiz_Core {

	protected static $instance;
	public static $base_dir;
	public static $base_url;
	
	public $plugin = 'findbiz-core';
	public $prefix = 'findbiz';

	public function __construct() {
		self::$base_dir = plugin_dir_path( __FILE__ );
		self::$base_url = plugin_dir_url( __FILE__ );

		add_action( 'plugins_loaded', 				array( $this, 'load_textdomain' ), 20 );
		add_action( 'findbiz_theme_init_before',	array( $this, 'theme_init_before' ) );
		add_action( 'findbiz_theme_init_after',		array( $this, 'theme_init_after' ) );
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function theme_init_before() {
		if ( ! class_exists( 'CSF' ) ) {
			require_once self::$base_dir . 'lib/cdf/codestar-framework.php'; // Codestar Framework
		}
	}

	public function theme_init_after() {
		require_once self::$base_dir . 'inc/helper.php';
		require_once self::$base_dir . 'widgets/init.php'; // Widgets
		require_once self::$base_dir . 'inc/demo-importer.php'; // Configuration of demo importing system

		if ( did_action( 'elementor/loaded' ) ) {
			require_once self::$base_dir . 'elementor/init.php'; // Elementor widgets
		}
	}
}

FindBiz_Core::instance();