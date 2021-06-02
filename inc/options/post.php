<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Post Settings', 'findbiz-core' ),
		'icon'   => 'fas fa-edit',
		'fields' => array(
			array(
				'id'      => 'post_date',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Post Date', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_author_name',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Author Name', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_comment_num',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Comment Number', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_cats',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Categories', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_tags',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Tags', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_social',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Social Sharing', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'         => 'post_share',
				'type'       => 'checkbox',
				'class'      => 'redux-custom-inline',
				'title'      => esc_html__( 'Social Sharing Icons', 'findbiz-core' ),
				'options'    => array(
					'facebook'  => 'Facebook',
					'twitter'   => 'Twitter',
					'linkedin'  => 'Linkedin',
					'pinterest' => 'Pinterest',
					'tumblr'    => 'Tumblr',
					'reddit'    => 'Reddit',
					'vk'        => 'Vk',
				),
				'default'    => array(
					'facebook'  => '1',
					'twitter'   => '1',
					'linkedin'  => '1',
					'pinterest' => '1',
					'tumblr'    => '0',
					'reddit'    => '0',
					'vk'        => '0',
				),
				'dependency' => array( 'post_social', '==', true ),
			),
			array(
				'id'      => 'post_about_author',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display About Author', 'findbiz-core' ),
				'default' => true,
			),
			array(
				'id'      => 'post_pagination',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Previous/Next Post Link', 'drestaurant' ),
				'default' => true,
			),
			array(
				'id'      => 'post_related',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Related Posts', 'findbiz-core' ),
				'default' => true,
			),
		),
	)
);
