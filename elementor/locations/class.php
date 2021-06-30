<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

use WpWax\FindBiz\DirHelper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Locations
class Locations extends Widget_Base
{
    public function get_name()
    {
        return 'locations';
    }

    public function get_title()
    {
        return __('All Locations', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'findbiz-el-custom';
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    public function get_keywords()
    {
        return ['locations', 'all location', 'listing locations'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'locations',
            [
                'label' => __('Listing Locations', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'logged_in',
            [
                'label'   => __('Show Only For Logged In User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'findbiz-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => DirHelper::directorist_listing_types(),
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
            'view',
            [
                'label'   => __('View', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'    => esc_html__('Grid View', 'findbiz-core'),
                    'list' => esc_html__('List View', 'findbiz-core'),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => esc_html__('Categories Per Row', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__('4 Items / Row', 'findbiz-core'),
                    '3' => esc_html__('3 Items / Row', 'findbiz-core'),
                    '2' => esc_html__('2 Items / Row', 'findbiz-core'),
                ],
                'default' => '2',
            ]
        );

        $this->add_control(
            'number_loc',
            [
                'label'   => __('Number of locations to Show:', 'findbiz-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
                'default' => 4,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__('Order by', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id'    => esc_html__('Location ID', 'findbiz-core'),
                    'count' => esc_html__('Listing Count', 'findbiz-core'),
                    'name'  => esc_html__('Location name (A-Z)', 'findbiz-core'),
                    'slug'  => esc_html__('Select Location', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label'     => esc_html__('Select Locations', 'findbiz-core'),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => DirHelper::locations(),
                'condition' => [
                    'order_by' => 'slug'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => esc_html__('Locations Order', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'asc'  => esc_html__(' ASC', 'findbiz-core'),
                    'desc' => esc_html__(' DESC', 'findbiz-core'),
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'listings_cats',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #directorist.atbd_wrapper .atbd_location_grid_wrap .atbd_location_grid:not(.atbd_location_grid-default) figure figcaption h3, {{WRAPPER}} .atbdp-text-list .atbd_category_wrapper a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .atbd_location_grid .listing-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types         = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $slug          = $settings['slug'] ? implode( ',', $settings['slug'] ) : '';
        $views         = $settings['view'];
        $order_by      = $settings['order_by'];
        $order         = $settings['order_list'];
        $columns       = $settings['row'];
        $number_loc    = $settings['number_loc'];
        $logged_in     = $settings['logged_in'];
        
        echo do_shortcode( '[directorist_all_locations view="'.$views.'" orderby="'.$order_by.'" order="'.$order.'" loc_per_page="'.$number_loc.'" columns="'.$columns.'" slug="'.$slug.'" logged_in_user_only="'.$logged_in.'" directory_type="'.$types.'" default_directory_type="'.$default_types.'"]' );
    }
}