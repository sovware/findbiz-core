<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Add listing form
class Form extends Widget_Base
{
    public function get_name()
    {
        return 'add_listing_form';
    }

    public function get_title()
    {
        return __('Add Listing Form', 'findbiz-core');
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
        return ['Listing form', 'form', 'add listing'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'add_listing_form',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_margin',
            [
                'label'      => __('margin', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label'      => __('Padding', 'findbiz-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        echo do_shortcode('[directorist_add_listing]');
    }
}