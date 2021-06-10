<?php
/*
Plugin Name: Findbiz Core
Plugin URI: https://aazztech.com/product/category/themes/wordpress/findbiz/
Description: Core plugin of FindBiz.
Author: AazzTech
Author URI: https://aazzztech.com
Domain Path: /languages
Text Domain: findbiz-core
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function findbiz_textdomain() {
	$plugin_rel_path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
	load_plugin_textdomain( 'findbiz-core', false, $plugin_rel_path );
}

add_action( 'plugins_loaded', 'findbiz_textdomain' );

require_once plugin_dir_path( __FILE__ ) . 'inc/general.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/theme-helper.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/custom-style.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/dir-helper.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/dir-hooks.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/dir-support.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/dir-options.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/activation.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/custom-widgets.php';
require_once plugin_dir_path( __FILE__ ) . 'elementor/findbiz-elementor.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/demo-importer.php';

if ( ! class_exists( 'CSF' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'lib/cdf/codestar-framework.php';
}
