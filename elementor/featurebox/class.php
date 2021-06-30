<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
*/ 

use WpWax\FindBiz\Helper;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Feature Box
class FeatureBox extends Widget_Base
{
    public function get_name()
    {
        return 'feature_boxes';
    }

    public function get_title()
    {
        return __('Feature Box', 'findbiz-core');
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
        return ['feature', 'feature box', 'all features'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'feature_box',
            [
                'label' => __('Feature Box', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one' => esc_html__('Style 1', 'findbiz-core'),
                    'style-two' => esc_html__('Style 2', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label'     => __('Feature Number', 'findbiz-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 10,
                'step'      => 1,
                'condition' => [
                    'style' => 'style-one'
                ]
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => __('Type', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon'  => esc_html__('Icon Type', 'findbiz-core'),
                    'image' => esc_html__('Image Type', 'findbiz-core'),
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     => __('Font-Awesome', 'findbiz-core'),
                'type'      => Controls_Manager::ICON,
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __('Choose Image', 'findbiz-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'   => __('Title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your description', 'findbiz-core'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'feature_box_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_icon_align',
            [
                'label'   => __('Icon & Image Alignment', 'findbiz-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .card-single-content .service-icon i' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_desc_align',
            [
                'label'   => __('Title & Description Alignment', 'findbiz-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'findbiz-core'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .card-single-content h4, {{WRAPPER}} .card-single-content p' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title    = $settings['title'];
        $desc     = $settings['desc'];
        $type     = $settings['type'];
        $image    = $settings['image'];
        $icon     = $settings['icon'];
        $number   = $settings['number'];
        $style    = $settings['style'];
        ?>

        <div class="service-cards" id="<?php echo esc_attr($style); ?>">
            <div class="card-single">
                <div class="card-single-content">
                    <?php if ('icon' == $type) { ?>
                        <div class="service-icon">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                    <?php } else { ?>
                        <div class="service-icon">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo Helper::image_alt($image['id']) ?>">
                        </div>
                    <?php } ?>
                    <h4><?php echo esc_attr($title) ?></h4>
                    <p><?php echo esc_attr($desc) ?></p>
                    <?php if ('style-one' == $style) { ?>
                        <span class="service-count"><?php echo esc_attr('0' . $number); ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}