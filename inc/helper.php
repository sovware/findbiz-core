<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz_Core;

use WpWax\FindBiz\Directorist_Support;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Helper {

	protected static $instance;

	public function __construct() {

		add_shortcode( 'findbiz_listing_gallery', array( $this, 'single_listing_gallery' ) );// single listing shortcodes.

	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// Single listing gallery section.
	public static function single_listing_gallery() {
		Directorist_Support::single_listing_gallery();
	}

	//add listing action URL.
	public static function add_listing_action_url() {
		return esc_url( $_SERVER['REQUEST_URI'] );
	}

	// Get user email
	public static function get_findbiz_mail( $email, $subject, $message, $headers ) {
		return wp_mail( $email, $subject, $message, $headers );
	}
}

Helper::instance();