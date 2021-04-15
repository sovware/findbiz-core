<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection( 'findbiz',
    array(
        'title'   => esc_html__( 'Error Page Settings', 'findbiz-core' ),
        'icon'    => 'fas fa-exclamation-circle',
        'fields'  => array(
            array(
                'id'       => 'error_404img',
                'type'     => 'media',
                'title'    => esc_html__( '404 Image', 'findbiz-core' ),
                'library' => 'image',
                'url'      => false,
            ), 
            array(
                'id'       => 'error_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'findbiz-core' ),
                'default'  => esc_html__( "Oops! That page can’t be found. Perhaps searching can help.", 'findbiz-core' ),
            ),
        )
    )
);