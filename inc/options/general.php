<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'General', 'findbiz-core' ),
		'icon'   => 'fas fa-globe-asia',
		'fields' => array(
			array(
				'id'      => 'logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Logo', 'findbiz-core' ),
				'library' => 'image',
				'url'     => false,
			),
			array(
				'id'      => 'preloader',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Preloader', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'         => 'preloader_image',
				'type'       => 'media',
				'title'      => esc_html__( 'Preloader Image', 'findbiz-core' ),
				'subtitle'   => esc_html__( 'Please upload your choice of preloader image. Transparent GIF format is recommended', 'findbiz-core' ),
				'library'    => 'image',
				'url'        => false,
				'dependency' => array( 'preloader', '==', 'true' ),
			),
			array(
				'id'      => 'back_to_top',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Back to Top Arrow', 'findbiz-core' ),
				'default' => true,
			),
		),
	)
);
