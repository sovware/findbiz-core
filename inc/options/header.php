<?php

/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Header', 'findbiz-core' ),
		'icon'   => 'fas fa-flag',
		'fields' => array(
			array(
				'id'       => 'resmenu_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Responsive Header Screen Width', 'findbiz-core' ),
				'subtitle' => esc_html__( 'Screen width in which mobile menu activated. Recommended value is: 991', 'findbiz-core' ),
				'default'  => 991,
				'min'      => 0,
				'step'     => 1,
				'max'      => 2000,
				'unit'     => 'px',
			),
			array(
				'id'      => 'sign_in',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Sign In Button', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'         => 'sign_in_text',
				'type'       => 'text',
				'title'      => esc_html__( 'Sign In Button Text', 'findbiz-core' ),
				'default'    => esc_html__( 'Sign in', 'findbiz-core' ),
				'dependency' => array( 'sign_in', '==', 'true' ),
			),
			array(
				'id'      => 'add_listing_button',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Add Listing Button', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'         => 'add_listing_button_text',
				'type'       => 'text',
				'title'      => esc_html__( 'Add Listing Button Text', 'findbiz-core' ),
				'default'    => esc_html__( 'Add New', 'findbiz-core' ),
				'dependency' => array( 'add_listing_button', '==', 'true' ),
			),
			array(
				'id'      => 'woo_cart',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Woocommerce Cart Icon', 'findbiz-core' ),
				'default' => true,
			),

		),
	)
);
