<?php
/*
Plugin Name: Findbiz Core
Plugin URI: https://wpwax.com/product/category/themes/wordpress/findbiz/
Description: Core plugin of FindBiz.
Author: WpWax
Author URI: https://aazzztech.com
Domain Path: /languages
Text Domain: findbiz-core
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'FINDBIZ_CORE' ) ) {
	$plugin_data = get_file_data( __FILE__, array( 'version' => 'Version' ) );
	define( 'FINDBIZ_CORE',               $plugin_data['version'] );
	define( 'FINDBIZ_CORE_SCRIPT_VER',    ( WP_DEBUG ) ? time() : FINDBIZ_CORE );
	define( 'FINDBIZ_CORE_THEME_PREFIX',  'findbiz' );
	define( 'FINDBIZ_CORE_BASE_DIR',      plugin_dir_path( __FILE__ ) );
}

class FindBiz_Core {

	public $plugin  = 'findbiz-core';
	public $action  = 'findbiz_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded',       array( $this, 'load_textdomain' ), 20 );
		add_action( 'plugins_loaded',       array( $this, 'demo_importer' ), 17 );
		add_action( $this->action,          array( $this, 'after_theme_loaded' ) );
		add_action( 'user_contactmethods',  array( $this, 'author_social' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function after_theme_loaded() {

		require_once FINDBIZ_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		require_once FINDBIZ_CORE_BASE_DIR . 'inc/demo-importer.php';

		if ( ! class_exists( 'CSF' ) ) {
			require_once FINDBIZ_CORE_BASE_DIR . 'lib/cdf/codestar-framework.php';
		}

		/* if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once FINDBIZ_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once FINDBIZ_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		} */

		if ( did_action( 'elementor/loaded' ) ) {
			require_once FINDBIZ_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}

	public static function author_social( $social ) {
		$social['twitter']     = __( 'Twitter Username', 'findbiz-core' );
		$social['google_plus'] = __( 'Google plus profile', 'findbiz-core' );
		$social['facebook']    = __( 'Facebook Profile', 'findbiz-core' );
		$social['linkedin']    = __( 'Linkedin Profile', 'findbiz-core' );
	
		return $social;
	}

	public function demo_importer() {
		require_once FINDBIZ_CORE_BASE_DIR . 'inc/demo-importer.php';
		require_once FINDBIZ_CORE_BASE_DIR . 'inc/demo-importer-ocdi.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}

FindBiz_Core::instance();
