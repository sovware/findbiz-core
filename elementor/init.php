<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Plugin;

class Custom_Widget_Init {

	public $prefix;
	public $category;
	public $widgets;
	
	public function __construct() {
		 // Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widgets_category' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
	}

	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .findbiz-el-custom{content: url(' . $img . ');width: 28px;}' );
	}

	public function init() {

		// Widgets -- dirname=>classname
		$widgets1 = array(
			'heading'        => 'Heading',
			//'blogs'          => 'Blogs',
			'contactitems'   => 'ContactItems',
			'counter'        => 'Counter',
			'cta'            => 'CTA',
			'infobox'     	 => 'infoBox',
			'feature' 		 => 'Feature',
			'featurevideo' 	 => 'FeatureVideo',
			'logos'          => 'Logos',
			'team'           => 'Team',
			'testimonial'    => 'Testimonial',
			'faq'				=> 'FAQ',
			'contactform'  => 'ContactForm',
		);
		$widgets2 = array(
			'categories'   => 'Categories',
			'searchform'   => 'SearchForm',
		);

		( ! class_exists( 'Directorist_Base' ) ) ? $widgets2 = array() : '';

		$widgets = array_merge( $widgets1, $widgets2 );

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			} else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;

			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname() );
		}
	}

	public function widgets_category() {
		$id         = 'findbiz_category'; // Category /@dev
		$properties = array(
			'title' => __( 'Theme Elements', 'findbiz-core' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
	
}

new Custom_Widget_Init();
