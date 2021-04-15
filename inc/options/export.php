<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

\CSF::createSection( 'findbiz', array(
    'title'       => esc_html__( 'Import/Export', 'findbiz-core' ),
    'icon'        => 'fas fa-shield-alt',
    'fields'      => array(
        array(
            'type' => 'backup',
        ),
    )
) );