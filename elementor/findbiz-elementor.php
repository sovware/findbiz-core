<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Plugin as Plugin;

if ( ! class_exists( 'FindBizWidgets' ) ) {

	final class FindBizWidgets {

		const VERSION                   = '1.0.0';
		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
		const MINIMUM_PHP_VERSION       = '5.6';

		private static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'init' ) );
		}

		public function init() {
			// Add Plugin actions
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
			add_action( 'elementor/elements/categories_registered', array( $this, 'findbiz_widget_category' ) );
		}

		public function init_widgets() {
			require_once __DIR__ . '/widgets.php';

			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Heading() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Accordion() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_findbiz_Form() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Profile() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Blogs() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Categories() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Checkout() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_ContactForm() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_ContactItems() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Counter() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_CTA() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Dashboard() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_FeatureBox() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_FeatureSection() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Listings() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Locations() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Login() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Transaction() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Registration() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Logos() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Payment() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_PricingPlan() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_SearchForm() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_SearchResult() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_SingleCat() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_SingleLoc() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_SingleTag() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Team() );
			Plugin::instance()->widgets_manager->register_widget_type( new FindBiz_Testimonial() );
			Plugin::instance()->widgets_manager->register_widget_type( new Findbiz_Booking() );
		}

		public function findbiz_widget_category( $manager ) {
			$manager->add_category(
				'findbiz_category',
				array(
					'title' => __( 'findbiz-core', 'findbiz-core' ),
				)
			);
		}
	}

	FindBizWidgets::instance();
}
