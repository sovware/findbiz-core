<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class DirSupport {

	public function __construct() {
		if ( Helper::options()['tabs'] ) {
			add_filter( 'atbdp_single_listing_content_widgets', array( $this, 'single_listing_content_widgets' ) );
		}
		//add_filter( 'atbdp_single_listing_other_fields_widget', array( $this, 'single_listing_other_fields_widget' ) );
		add_filter( 'atbdp_listing_type_settings_field_list', array( $this, 'directorist_contact_button_of_listing_card' ) );
		add_filter( 'atbdp_listing_type_settings_layout', array( $this, 'directorist_single_listing_header' ) );
		add_filter( 'directorist_disable_shortcode_restriction_on_scripts', '__return_true' );
		add_filter( 'directorist_required_extensions', array( $this, 'theme_required_dir_extensions' ) );
		add_filter( 'directorist_search_setting_sections', array( $this, 'theme_modify_search_settings' ) );
		add_filter( 'directorist_option', array( $this, 'theme_directorist_option' ), 10, 2 );
		add_filter( 'directorist_search_setting_sections', array( $this, 'theme_modify_search_settings' ) );
	}

	// Registered contact button for listing card.
	public static function directorist_contact_button_of_listing_card( $fields ) {
		$hours_widget = array(
			'type'    => 'button',
			'id'      => 'contact_button',
			'label'   => 'Contact Button',
			'icon'    => 'uil uil-phone',
			'hook'    => 'atbdp_open_close_badge',
			'options' => array(
				'title'  => 'Button Label',
				'fields' => array(
					'value' => array(
						'type'  => 'text',
						'label' => 'Contact Label',
						'value' => 'Contact',
					),
				),
			),
		);

		// Placement of contact button for listing card.
		foreach ( $fields as $key => $value ) {

			if ( 'listings_card_grid_view' === $key ) {
				// Register Contact widget.
				$fields[ $key ]['card_templates']['grid_view_with_thumbnail']['widgets']['contact_button'] = $hours_widget;
				// Listing cart layout - preview image.
				array_push( $fields[ $key ]['card_templates']['grid_view_with_thumbnail']['layout']['thumbnail']['bottom_right']['acceptedWidgets'], 'pricing' );
				array_push( $fields[ $key ]['card_templates']['grid_view_with_thumbnail']['layout']['footer']['right']['acceptedWidgets'], 'contact_button' );
			}

			if ( 'listings_card_list_view' === $key ) {
				// Register Contact widget.
				$fields[ $key ]['card_templates']['list_view_with_thumbnail']['widgets']['contact_button'] = $hours_widget;
				// Listing cart layout - body area.
				array_push( $fields[ $key ]['card_templates']['list_view_with_thumbnail']['layout']['footer']['right']['acceptedWidgets'], 'contact_button' );
				array_push( $fields[ $key ]['card_templates']['list_view_with_thumbnail']['layout']['body']['top']['acceptedWidgets'], 'user_avatar' );
				array_push( $fields[ $key ]['card_templates']['list_view_with_thumbnail']['layout']['body']['right']['acceptedWidgets'], 'pricing' );
			}
		}
		return $fields;
	}

	// Remove video widget for single page layout.
	public static function single_listing_content_widgets( $fields ) {
		unset( $fields['video'] );
		return $fields;
	}

	// Remove single listing header layout FROM builder.
	public static function directorist_single_listing_header( $layout ) {

		unset( $layout['single_page_layout']['submenu']['listing_header'] );

		return $layout;
	}

	// Created description widget for single page layout in Other Fields.
	public static function single_listing_other_fields_widget( $other_widgets ) {
		$other_widgets['description'] = array(
			'type'    => 'section',
			'label'   => __( 'Description', 'directorist' ),
			'icon'    => 'las la-paragraph',
			'options' => array(
				'icon'  => array(
					'type'  => 'icon',
					'label' => __( 'Icon', 'directorist' ),
					'value' => 'las la-align-justify',
				),
				'label' => array(
					'type'  => 'text',
					'label' => __( 'Label', 'directorist' ),
					'value' => 'Description',
				),
			),
		);

		// Remove review widget for single page layout from Other Fields.
		if ( Helper::options()['tabs'] ) {
			unset( $other_widgets['review'] );
			unset( $other_widgets['contact_listings_owner'] );
		}
		return $other_widgets;

	}

	// Included Extensions.
	public static function theme_required_dir_extensions( $required_extensions ) {
		$required_extensions[] = array(
			'ref'        => 'findbiz',
			'extensions' => array(
				'directorist-business-hours',
				'directorist-listings-with-map',
				'directorist-social-login',
				'directorist-pricing-plans',
				'directorist-paypal',
				'directorist-stripe',
				'directorist-faqs',
				'directorist-claim-listing',
				'directorist-booking',
				'directorist-live-chat',
				'directorist-post-your-need',
			),
		);

		return $required_extensions;
	}

	// Hide settings.
	public static function theme_modify_search_settings( $value ) {
		$data     = $value['search_form']['fields'];
		$settings = array( 'search_title', 'search_subtitle', 'search_border', 'search_more_filters', 'home_display_filter', 'popular_cat_title', 'search_home_bg' );

		foreach ( $settings as $setting ) {
			$key = array_search( $setting, $data );
			if ( $key !== false ) {
				unset( $data[ $key ] );
			}
		}

		$value['search_form']['fields'] = array_values( $data );

		return $value;
	}

	// Set default value of settings.
	public static function theme_directorist_option( $value, $name ) {

		switch ( $name ) {
			case 'search_title':
			case 'search_subtitle':
			case 'popular_cat_title':
			case 'search_more_filters':
			case 'search_home_bg':
				$value = '';
				break;

			case 'search_border':
				$value = false;
				break;

			case 'home_display_filter':
				$value = 'overlapping';
				break;
		}

		return $value;
	}
}

new DirSupport();
