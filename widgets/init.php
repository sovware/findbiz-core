<?php
/**
 * @author  WpWax\FindBiz
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

class Custom_Widgets_Init {

	public $widgets;
	protected static $instance = null;

	public function __construct() {

		// Widgets -- filename=>classname /@dev
		$widgets1 = array(
			'popular_post'     => 'Popular_Post',
			'latest_post'      => 'Latest_Post',
			'social'           => 'Social',
			'featured-fisting' => 'Featured_Listing',
			'icon_title'       => 'Icon_Title',
			'button'           => 'Button',
		);

		$this->widgets = $widgets1;

		add_action( 'widgets_init', array( $this, 'custom_widgets' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function custom_widgets() {
		foreach ( $this->widgets as $filename => $classname ) {
			$file = dirname( __FILE__ ) . '/' . $filename . '.php';

			require_once $file;

			register_widget( $classname );
		}
	}
}

Custom_Widgets_Init::instance();
