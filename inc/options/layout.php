<?php

/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

$prefix = 'findbiz';
$opt_name = 'findbiz';

function findbiz_post_type_fields($prefix)
{
    return array(
        'layout' => array(
            'id'       => $prefix . '_layout',
            'type'     => 'button_set',
            'title'    => esc_html__('Layout', 'findbiz-core'),
            'options'  => array(
                'left'  => esc_html__('Left Sidebar', 'findbiz-core'),
                'right' => esc_html__('Right Sidebar', 'findbiz-core'),
            ),
            'default'  => 'right'
        ),
        'breadcrumb' => array(
            'id'       => $prefix . '_breadcrumb',
            'type'     => 'select',
            'title'    => esc_html__('Breadcrumb', 'findbiz-core'),
            'options'  => array(
                'on'      => esc_html__('Enabled', 'findbiz-core'),
                'off'     => esc_html__('Disabled', 'findbiz-core'),
            ),
            'default'  => 'on',
        ),
        'bgtype' => array(
            'id'       => $prefix . '_bgtype',
            'type'     => 'select',
            'title'    => esc_html__('Banner Background Type', 'findbiz-core'),
            'options'  => array(
                'default' => esc_html__('Default',  'findbiz-core'),
                'bgcolor'  => esc_html__('Background Color', 'findbiz-core'),
                'bgimg'    => esc_html__('Background Image', 'findbiz-core'),
            ),
            'default'  => 'default',
        ),
        'bgimg' => array(
            'id'       => $prefix . '_bgimg',
            'type'     => 'media',
            'title'    => esc_html__('Banner Background Image', 'findbiz-core'),
            'library' => 'image',
            'url'      => false,
            'dependency' => array($prefix . '_bgtype', '==', 'bgimg'),
        ),
        'opacity' => array(
            'id'       => $prefix . '_opacity',
            'type'     => 'slider',
            'title'    => esc_html__('Image Opacity', 'findbiz-core'),
            'default'  => 6,
            'min'      => 0,
            'step'     => 1,
            'max'      => 9,
            'dependency' => array($prefix . '_bgtype', '==', 'bgimg'),
        ),
        'bgcolor' => array(
            'id'       => $prefix . '_bgcolor',
            'type'     => 'color',
            'title'    => esc_html__('Banner Background Color', 'findbiz-core'),
            'validate' => 'color',
            'transparent' => false,
            'default'  => '',
            'dependency' => array($prefix . '_bgtype', '==', 'bgcolor'),
        ),
    );
}

\CSF::createSection(
    $opt_name,
    array(
        'title' => esc_html__('Layout Settings', 'findbiz-core'),
        'id'    => 'layout_defaults',
        'icon'  => 'fas fa-th-large',
    )
);

// Page
$aztheme_page_fields = findbiz_post_type_fields('page');
$aztheme_page_fields['layout']['default'] = 'right';
\CSF::createSection(
    $opt_name,
    array(
        'title'      => esc_html__('Page', 'findbiz-core'),
        'parent'     => 'layout_defaults',
        'fields'     => $aztheme_page_fields
    )
);

//Post Archive
$aztheme_post_archive_fields = findbiz_post_type_fields('blog');
\CSF::createSection(
    $opt_name,
    array(
        'title'      => esc_html__('Blog / Archive', 'findbiz-core'),
        'parent'     => 'layout_defaults',
        'fields'     => $aztheme_post_archive_fields
    )
);

// Single Post
$aztheme_single_post_fields = findbiz_post_type_fields('single_post');
\CSF::createSection(
    $opt_name,
    array(
        'title'      => esc_html__('Post Single', 'findbiz-core'),
        'parent'     => 'layout_defaults',
        'fields'     => $aztheme_single_post_fields
    )
);

// Search
$aztheme_search_fields = findbiz_post_type_fields('search');
\CSF::createSection(
    $opt_name,
    array(
        'title'      => esc_html__('Search Layout', 'findbiz-core'),
        'parent'     => 'layout_defaults',
        'fields'     => $aztheme_search_fields
    )
);

// Error 404 Layout
$aztheme_error_fields = findbiz_post_type_fields('error');
unset($aztheme_error_fields['layout']);
\CSF::createSection(
    $opt_name,
    array(
        'title'      => esc_html__('Error 404 Layout', 'findbiz-core'),
        'parent'     => 'layout_defaults',
        'fields'     => $aztheme_error_fields
    )
);
