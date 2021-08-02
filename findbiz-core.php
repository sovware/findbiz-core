<?php
/*
Plugin Name: Findbiz Core
Plugin URI: https://directorist.com/
Description: Core plugin of FindBiz Theme.
Author: WpWax
Author URI: https://wpwax.com
Domain Path: /languages
Text Domain: findbiz-core
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FindBiz_Core {

	protected static $instance;
	public static $base_dir;
	public static $base_url;
	public $plugin = 'findbiz-core';
	public $action = 'findbiz_theme_init';

	public function __construct() {
		self::$base_dir = plugin_dir_path( __FILE__ );
		self::$base_url = plugin_dir_url( __FILE__ );

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 20 );
		add_action( 'plugins_loaded', array( $this, 'demo_importer' ), 17 );
		add_action( $this->action, array( $this, 'after_theme_loaded' ) );
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function after_theme_loaded() {

		require_once self::$base_dir . 'widgets/init.php'; // Widgets
		require_once self::$base_dir . 'inc/demo-importer.php';
		require_once self::$base_dir . 'inc/helper.php';

		if ( ! class_exists( 'CSF' ) ) {
			require_once self::$base_dir . 'lib/cdf/codestar-framework.php';
		}

		/*
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once self::$base_dir . 'inc/post-meta.php'; // Post Meta
			require_once self::$base_dir . 'widgets/init.php'; // Widgets
		}
		*/

		if ( did_action( 'elementor/loaded' ) ) {
			require_once self::$base_dir . 'elementor/init.php'; // Elementor
		}
	}

	public function demo_importer() {
		require_once self::$base_dir . 'inc/demo-importer.php';
		require_once self::$base_dir . 'inc/demo-importer-ocdi.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public static function get_findbiz_mail( $email, $subject, $message, $headers ) {
		return wp_mail( $email, $subject, $message, $headers );
	}
}

FindBiz_Core::instance();