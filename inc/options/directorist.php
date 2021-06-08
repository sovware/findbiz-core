<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Directorist', 'findbiz-core' ),
		'icon'   => 'fas fa-map-marked-alt',
		'fields' => array(
			array(
				'id'      => 'tabs',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Single Listing Tabs', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'desc',
				'type'    => 'text',
				'title'   => esc_html__( 'Description Tab Label', 'findbiz-core' ),
				'default' => 'Description',
				'dependency' => array( 'tabs', '==', 'true' ),
			),
			array(
				'id'      => 'gallery',
				'type'    => 'text',
				'title'   => esc_html__( 'Gallery Tab Label', 'findbiz-core' ),
				'default' => 'Photos',
				'dependency' => array( 'tabs', '==', 'true' ),
			),
			array(
				'id'      => 'video',
				'type'    => 'text',
				'title'   => esc_html__( 'Video Tab Label', 'findbiz-core' ),
				'default' => 'Videos',
				'dependency' => array( 'tabs', '==', 'true' ),
			),
			array(
				'id'      => 'review',
				'type'    => 'text',
				'title'   => esc_html__( 'Review Tab Label', 'findbiz-core' ),
				'default' => 'Review',
				'dependency' => array( 'tabs', '==', 'true' ),
			),
			array(
				'id'      => 'message',
				'type'    => 'text',
				'title'   => esc_html__( 'Contact Tab Label', 'findbiz-core' ),
				'default' => 'Message',
				'dependency' => array( 'tabs', '==', 'true' ),
			),
		),
	)
);
