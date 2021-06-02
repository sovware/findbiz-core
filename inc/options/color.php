<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Colors', 'findbiz-core' ),
		'icon'   => 'fas fa-paint-brush',
		'fields' => array(
			array(
				'type'  => 'heading',
				'title' => esc_html__( 'Sitewide Colors', 'findbiz-core' ),
			),
			array(
				'id'          => 'primary_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Primary Color', 'findbiz-core' ),
				'default'     => '#e53935',
				'required'    => array( 'color_type', '=', 'custom' ),
			),
			array(
				'id'    => 'section-color-menu',
				'type'  => 'heading',
				'title' => esc_html__( 'Main Menu', 'findbiz-core' ),
			),
			array(
				'id'      => 'menu_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Menu Color', 'findbiz-core' ),
				'default' => '#111111',
			),
			array(
				'type'  => 'heading',
				'title' => esc_html__( 'Sub Menu', 'findbiz-core' ),
			),
			array(
				'id'      => 'submenu_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Submenu Color', 'findbiz-core' ),
				'default' => '#111111',
			),
			array(
				'id'      => 'submenu_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Submenu Hover Color', 'findbiz-core' ),
				'default' => '#ffffff',
			),
			array(
				'id'      => 'submenu_hover_bgcolor',
				'type'    => 'color',
				'title'   => esc_html__( 'Submenu Hover Background Color', 'findbiz-core' ),
				'default' => '#111111',
			),
			array(
				'type'  => 'heading',
				'title' => esc_html__( 'Banner Area', 'findbiz-core' ),
			),
			array(
				'id'      => 'banner_title_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Banner Title Color', 'findbiz-core' ),
				'default' => '#000',
			),
			array(
				'type'  => 'heading',
				'title' => esc_html__( 'Footer Area', 'findbiz-core' ),
			),
			array(
				'id'          => 'footer_bgcolor',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Background Color', 'findbiz-core' ),
				'default'     => '#111111',
			),
			array(
				'id'          => 'footer_title_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Title Text Color', 'findbiz-core' ),
				'default'     => '#ffffff',
			),
			array(
				'id'          => 'footer_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Text Color', 'findbiz-core' ),
				'default'     => '#cccccc',
			),
			array(
				'id'          => 'footer_link_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Link Color', 'findbiz-core' ),
				'default'     => '#cccccc',
			),
			array(
				'id'          => 'footer_link_hover_color',
				'type'        => 'color',
				'transparent' => false,
				'title'       => esc_html__( 'Footer Body Link Hover Color', 'findbiz-core' ),
				'default'     => '#ffffff',
			),
		),
	)
);
