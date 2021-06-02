<?php

/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Blog Settings', 'findbiz-core' ),
		'icon'   => 'fas fa-tags',
		'fields' => array(
			array(
				'id'      => 'blog_style',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Blog Grid', 'findbiz-core' ),
				'default' => false,
			),
			array(
				'id'      => 'blog_date',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Date', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'blog_author_name',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Author Name', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'blog_cats',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Categories', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'comment',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Categories', 'findbiz-core' ),
				'default' => true,
			),
		),
	)
);
