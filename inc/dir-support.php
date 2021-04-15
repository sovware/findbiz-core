<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class DirSupport {

	public function __construct() {
		add_filter( 'atbdp_listing_type_settings_field_list', array( $this, 'directorist_items_of_listing' ) );
		add_filter( 'atbdp_listing_type_settings_layout', array( $this, 'directorist_single_listing_header' ) );
		add_filter( 'atbdp_single_listing_other_fields_widget', array( $this, 'directorist_single_listing_widget' ) );
		add_filter( 'atbdp_single_listing_other_fields_widget', array( $this, 'directorist_single_listing_desc_widget' ) );
		add_filter( 'directorist_disable_shortcode_restriction_on_scripts', '__return_true' );
		add_filter( 'directorist_required_extensions', array( $this, 'theme_required_dir_extensions' ) );
		add_filter( 'directorist_search_setting_sections', array( $this, 'theme_modify_search_settings' ) );
		add_filter( 'atbdp_legacy_sections', array( $this, 'theme_modify_legacy_settings' ) );
		add_filter( 'directorist_option', array( $this, 'theme_directorist_option' ), 10, 2 );
		add_filter( 'directorist_search_setting_sections', array( $this, 'theme_modify_search_settings' ) );
	}

	public static function directorist_items_of_listing( $fields ) {
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

	public static function directorist_single_listing_header( $layout ) {

		unset( $layout['single_page_layout']['submenu']['listing_header'] );

		return $layout;
	}

	public static function directorist_single_listing_widget( $other_widgets ) {
		$other_widgets['gallery'] = array(
			'type'    => 'section',
			'label'   => 'Gallery',
			'icon'    => 'la la-image',
			'options' => array(
				'icon'  => array(
					'type'  => 'icon',
					'label' => 'Icon',
					'value' => 'la la-image',
				),
				'label' => array(
					'type'  => 'text',
					'label' => 'Label',
					'value' => 'Gallery',
				),
			),
		);

		return $other_widgets;

	}

	public static function directorist_single_listing_desc_widget( $other_widgets ) {
		$other_widgets['description'] = array(
			'type'    => 'section',
			'label'   => 'Description',
			'icon'    => 'las la-paragraph',
			'options' => array(
				'icon'  => array(
					'type'  => 'icon',
					'label' => 'Icon',
					'value' => 'las la-align-justify',
				),
				'label' => array(
					'type'  => 'text',
					'label' => 'Label',
					'value' => 'Description',
				),
			),
		);

		return $other_widgets;

	}

	public static function findbiz_get_form_field( $listing, $key ) {
		$submission_form_fields = get_term_meta( $listing->type, 'submission_form_fields', true );
		if ( ! empty( $submission_form_fields['fields'][ $key ] ) ) {
			return $submission_form_fields['fields'][ $key ];
		} else {
			return false;
		}
	}

	public static function findbiz_single_has_slider( $listing ) {
		$image_upload = self::findbiz_get_form_field( $listing, 'image_upload' );
		if ( ! $image_upload ) {
			return false;
		}

		$plan_id    = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_photo = true;
		if ( is_fee_manager_active() ) {
			$plan_photo = is_plan_allowed_slider( $plan_id );
		}
		if ( ! $plan_photo ) {
			return false;
		}

		$listing_img = get_post_meta( get_the_ID(), '_listing_img', true );
		if ( ! $listing_img ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_video( $listing ) {
		$video = self::findbiz_get_form_field( $listing, 'video' );
		if ( ! $video ) {
			return false;
		}

		$plan_video = true;
		$fm_plan    = get_post_meta( get_the_ID(), '_fm_plans', true );
		if ( is_fee_manager_active() ) {
			$plan_video = is_plan_allowed_listing_video( $fm_plan );
		}

		if ( ! $plan_video ) {
			return false;
		}

		$value = ! empty( $video['field_key'] ) ? get_post_meta( $listing->id, '_' . $video['field_key'], true ) : '';

		if ( ! $value ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_review( $listing ) {
		$plan_id     = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_review = true;
		if ( is_fee_manager_active() ) {
			$plan_review = is_plan_allowed_listing_review( $plan_id );
		}
		if ( ! $plan_review ) {
			return false;
		}

		$enable_review = get_directorist_option( 'enable_review', 'yes' );
		if ( ! $enable_review ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_owner_contact( $listing ) {
		$plan_id      = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_contact = true;
		if ( is_fee_manager_active() ) {
			$plan_contact = is_plan_allowed_owner_contact_widget( $plan_id );
		}
		if ( ! $plan_contact ) {
			return false;
		}

		return true;
	}

	// Extensions
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

	// Hide settings
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

	public static function theme_modify_legacy_settings( $value ) {
		$key = array_search( 'atbdp_legacy_template', $value['legacy']['fields'] );

		if ( $key !== false ) {
			unset( $value['legacy']['fields'][ $key ] );
		}
		return $value;
	}

	// Override settings value
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
