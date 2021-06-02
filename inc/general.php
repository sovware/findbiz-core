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
		add_action( 'widgets_init', array( $this, 'register_sidebars' ), 5 );
		add_filter( 'elementor/widgets/wordpress/widget_args', array( $this, 'elementor_widget_args' ) );
		add_filter( 'user_contactmethods', array( $this, 'author_social' ) );

		// disable auto page creation
		add_filter( 'atbdp_create_required_pages', '__return_false' );

		// disable setup widget
		add_filter( 'atbdp_setup_wizard', '__return_false' );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function register_sidebars() {
		$widgets = array(
			'1' => esc_html__( 'Footer 1', 'drestaurant' ),
			'2' => esc_html__( 'Footer 2', 'drestaurant' ),
			'3' => esc_html__( 'Footer 3', 'drestaurant' ),
			'4' => esc_html__( 'Footer 4', 'drestaurant' ),
		);

		foreach ( $widgets as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => 'footer-' . $id,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				)
			);
		}

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'drestaurant' ),
				'id'            => 'sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Blog Sidebar', 'drestaurant' ),
				'id'            => 'blog-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		if ( class_exists( 'woocommerce' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Shop Sidebar', 'drestaurant' ),
					'id'            => 'shop-sidebar',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				)
			);
		}
	}

	public function elementor_widget_args( $args ) {
		$args['before_widget'] = '<div class="widget %2$s">';
		$args['after_widget']  = '</div>';
		$args['before_title']  = '<h4>';
		$args['after_title']   = '</h4>';
		return $args;
	}

	public function author_social( $social ) {
		$social['twitter']     = esc_html__( 'Twitter Username', 'findbiz' );
		$social['google_plus'] = esc_html__( 'Google plus profile', 'findbiz' );
		$social['facebook']    = esc_html__( 'Facebook Profile', 'findbiz' );
		$social['linkedin']    = esc_html__( 'Linkedin Profile', 'findbiz' );

		return $social;
	}
}

General_Setup::instance();
