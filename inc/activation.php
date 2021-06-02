<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class Activation {


	protected static $instance = null;

	public function __construct() {
		add_action( 'after_switch_theme', array( $this, 'init' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init() {
		if ( ! get_option( 'findbiz_activated_before' ) ) {
			update_option( 'findbiz_activated_before', 'yes' );
			$this->set_elementor_default_options();
		}
	}


	public function set_elementor_default_options() {
		$data = array(
			'elementor_disable_typography_schemes' => 'yes',
			'elementor_disable_color_schemes'      => 'yes',
			'elementor_css_print_method'           => 'internal',
			'elementor_cpt_support'                => array( 'page' ),
			'elementor_container_width'            => '1140',
			'elementor_viewport_lg'                => '992',

			'_elementor_general_settings'          => array(
				'default_generic_fonts' => 'Sans-serif',
				'global_image_lightbox' => 'yes',
				'container_width'       => '1130',
			),
			'_elementor_global_css'                => array(
				'time'   => '1534145031',
				'fonts'  => array(),
				'status' => 'inline',
				'0'      => false,
				'css'    => '.elementor-section.elementor-section-boxed > .elementor-container{max-width:1130px;}',
			),
		);

		foreach ( $data as $key => $value ) {
			update_option( $key, $value );
		}
	}
}

Activation::instance();
