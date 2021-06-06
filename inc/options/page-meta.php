<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

// Page Meta
$prefix = 'findbiz_layout';
CSF::createMetabox(
	$prefix,
	array(
		'title'     => 'Page Options',
		'post_type' => array( 'page', 'post', 'at_biz_dir' ),
		'context'   => 'side',
		'data_type' => 'unserialize',

	)
);

CSF::createSection(
	$prefix,
	array(
		'fields' => array(
			array(
				'id'      => 'search',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Top Search', 'directorist' ),
				'default' => true,
			),

			array(
				'id'      => 'banner',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Banner', 'directorist' ),
				'default' => true,
			),

			array(
				'id'      => 'sidebar',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Sidebar', 'directorist' ),
				'default' => false,
			),

			array(
				'id'      => 'footer',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Footer Widget Area', 'directorist' ),
				'default' => true,
			),

			array(
				'id'      => 'footer_bg',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Footer Dark BG', 'directorist' ),
				'default' => false,
			),

		),
	)
);
