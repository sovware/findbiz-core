<?php

/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

$theme_author_uri = wp_get_theme( get_template() )->get( 'AuthorURI' );

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Footer', 'findbiz-core' ),
		'icon'   => 'fas fa-angle-double-down',
		'fields' => array(
			array(
				'id'      => 'footer_area',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Footer Widget Area', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'copyright_area',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Copyright Area', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'         => 'copyright_text',
				'type'       => 'textarea',
				'title'      => esc_html__( 'Copyright Text', 'findbiz-core' ),
				'default'    => sprintf( '&copy; FindBiz %s. All rights reserved. Created by <a target="_blank" href="%s" rel="nofollow">AazzTech</a>', date( 'Y' ), esc_url( $theme_author_uri ) ),
				'dependency' => array( 'copyright_area', '==', 'true' ),
			),
			array(
				'id'           => 'socials',
				'type'         => 'repeater',
				'title'        => esc_html__( 'Footer Socials', 'findbiz-core' ),
				'button_title' => esc_html__( 'Add new', 'findbiz-core' ),
				'dependency'   => array( 'copyright_area', '==', 'true' ),
				'fields'       => array(

					array(
						'id'    => 'icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'findbiz-core' ),
					),

					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__( 'Url', 'findbiz-core' ),
					),
				),
			),
		),
	)
);
