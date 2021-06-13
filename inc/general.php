<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class General_Setup {

	protected static $instance = null;

	public function __construct() {
		add_filter( 'elementor/widgets/wordpress/widget_args', array( $this, 'elementor_widget_args' ) );
		add_filter( 'user_contactmethods', array( $this, 'author_social' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function elementor_widget_args( $args ) {
		$args['before_widget'] = '<div class="widget %2$s">';
		$args['after_widget']  = '</div>';
		$args['before_title']  = '<h4>';
		$args['after_title']   = '</h4>';
		return $args;
	}

	public function author_social( $social ) {
		$social['twitter']     = esc_html__( 'Twitter Username', 'findbiz-core' );
		$social['google_plus'] = esc_html__( 'Google plus profile', 'findbiz-core' );
		$social['facebook']    = esc_html__( 'Facebook Profile', 'findbiz-core' );
		$social['linkedin']    = esc_html__( 'Linkedin Profile', 'findbiz-core' );

		return $social;
	}

}

General_Setup::instance();
