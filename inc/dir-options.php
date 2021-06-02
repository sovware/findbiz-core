<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class DirOption {

	public function __construct() {
		 add_filter( 'atbdp_gateway_settings_fields', array( $this, 'findbiz_remove_gateway_settings' ) );
		add_filter( 'atbdp_extension_settings_fields', array( $this, 'findbiz_remove_extension_promotion_settings' ) );
		add_filter( 'atbdp_search_result_settings_fields', array( $this, 'findbiz_search_result_settings_fields' ) );
		add_filter( 'atbdp_settings_menus', array( $this, 'findbiz_settings_menus' ) );
		add_filter( 'atbdp_pages_settings_fields', array( $this, 'findbiz_pages_settings_fields' ) );
		add_filter( 'atbdp_create_custom_pages', array( $this, 'findbiz_create_custom_pages' ) );
		add_filter( 'atbdp_pages_settings_fields', array( $this, 'findbiz_remove_custom_pages' ) );
		add_filter( 'atbdp_general_listings_submenus', array( $this, 'findbiz_general_listings_submenus' ) );
		add_filter( 'atbdp_search_settings_fields', array( $this, 'findbiz_search_settings_fields' ) );
		add_filter( 'atbdp_settings_menus', array( $this, 'findbiz_atbdp_settings_menus' ) );
		add_filter( 'atbdp_single_listings_settings_fields', array( $this, 'single_listing_template' ) );
		add_filter( 'atbdp_listings_settings_fields', array( $this, 'findbiz_remove_sort_by_select' ) );
	}

	public static function findbiz_remove_gateway_settings( $args ) {
		unset( $args['gateway_promotion'] );
		return $args;
	}

	public static function findbiz_remove_extension_promotion_settings( $args ) {
		unset( $args['extension_promotion_set'] );
		return $args;
	}

	public static function findbiz_search_result_settings_fields( $args ) {
		 unset( $args['search_view_as'] );
		unset( $args['search_view_as_items'] );
		unset( $args['search_sort_by'] );
		return $args;
	}

	public static function findbiz_settings_menus( $args ) {
		unset( $args['categories_menu'] );
		return $args;
	}

	public static function findbiz_pages_settings_fields( $args ) {
		 unset( $args['single_listing_page'] );
		return $args;
	}

	public static function findbiz_create_custom_pages( $args ) {
		unset( $args['single_listing_page'] );
		return $args;
	}

	public static function findbiz_remove_custom_pages( $args ) {
		unset( $args['single_listing_page'] );
		return $args;
	}

	public static function findbiz_general_listings_submenus( $args ) {
		 unset( $args['style_setting'] );
		return $args;
	}

	public static function findbiz_search_settings_fields( $args ) {
		unset( $args['search_home_background'] );
		return $args;
	}

	public static function findbiz_atbdp_settings_menus( $args ) {
		unset( $args['style_settings_menu'] );
		return $args;
	}

	public static function single_listing_template( $args ) {
		unset( $args['single_listing_template'] );
		unset( $args['enable_single_location_taxonomy'] );
		return $args;
	}

	public static function findbiz_remove_sort_by_select( $args ) {
		 unset( $args['listings_sort_by_items'] );
		unset( $args['display_view_as'] );
		unset( $args['default_listing_view'] );
		unset( $args['all_listing_columns'] );
		unset( $args['order_listing_by'] );
		unset( $args['sort_listing_by'] );
		return $args;
	}
}

new DirOption();
