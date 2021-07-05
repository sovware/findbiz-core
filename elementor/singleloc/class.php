<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
*/ 

use WpWax\FindBiz\DirHelper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Single location
class SingleLoc extends Widget_Base
{
    public function get_name()
    {
        return 'single_loc';
    }

    public function get_title()
    {
        return __('Location Archive', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'findbiz-el-custom';
    }

    public function get_keywords()
    {
        return ['single location', 'need location', 'location',];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('Single Location', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                    'map' => esc_html__('Map View', 'findbiz-core'),
                    'listings_with_map' => esc_html__('Listings With Map View', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
                'condition' => [
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'findbiz-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'preview',
            [
                'label' => __('Show Preview Image?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'findbiz-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'findbiz-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes',
                    'layout!' => 'listings_with_map'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'findbiz-core'),
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => __('Columns', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'condition' => [
                    'layout' => 'listings_with_map',
                ]
            ]
        );

        $this->add_control(
            'listings_count',
            [
                'label' => __('Number of Listings to Show:', 'findbiz-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'findbiz-core'),
                    'date' => esc_html__(' Date', 'findbiz-core'),
                    'price' => esc_html__(' Price', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'findbiz-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'findbiz-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types   = $settings['default_types'];
        $types           = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $preview         = $settings['preview'] ? $settings['preview'] : 'no';
        $layout          = $settings['layout'];
        $zoom_level      = $settings['zoom_level'];
        $map_height      = $settings['map_height'];
        $header          = $settings['header'];
        $title           = $settings['title'];
        $filter          = $settings['filter'];
        $user            = $settings['user'];
        $row             = $settings['row'];
        $rows            = $settings['rows'];
        $listings_count  = $settings['listings_count'];
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $show_pagination = $settings['show_pagination'];
        
        echo ( 'listings_with_map' === $layout ) ? '<input type="hidden" id="listing-listings_with_map">' : '';

        echo do_shortcode(' [directorist_location view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($listings_count) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" advanced_filter="'.$filter.'" columns="' . esc_attr($row) . '" listings_with_map_columns="' . esc_attr($rows) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" map_zoom_level="'.$zoom_level.'" display_preview_image="'.$preview.'" logged_in_user_only="' . esc_attr($user) . '" directory_type="' . esc_attr($types) . '" default_directory_type="' . esc_attr($default_types) . '"]');
    }
}