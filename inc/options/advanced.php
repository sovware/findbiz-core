<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection(
	'findbiz',
	array(
		'title'  => esc_html__( 'Advanced', 'findbiz-core' ),
		'icon'   => 'fas fa-code',
		'fields' => array(
			array(
				'id'       => 'custom_css',
				'type'     => 'code_editor',
				'title'    => esc_html__( 'Custom CSS', 'findbiz-core' ),
				'settings' => array(
					'mode' => 'css',
				),
			),
		),
	)
);
