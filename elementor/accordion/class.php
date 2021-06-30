<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

use Elementor\Core\Schemes;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Accordion
class Accordion extends Widget_Base
{

    public function get_name()
    {
        return 'accordion';
    }

    public function get_title()
    {
        return __('Faq', 'findbiz-core');
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
        return ['accordion', 'tabs', 'faq'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Faq', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'element_title',
            [
                'label'   => __('Element title', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter element title', 'findbiz-core'),
                'default'     => __("Listing FAQ's", 'findbiz-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'   => __('Title & Content', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'findbiz-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'      => __('Content', 'findbiz-core'),
                'type'       => Controls_Manager::TEXTAREA,
                'default'    => __('Accordion Content', 'findbiz-core'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'   => __('Accordion Items', 'findbiz-core'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title'   => __('How to open an account?', 'findbiz-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'findbiz-core'),
                    ],
                    [
                        'tab_title'   => __('How to add listing?', 'findbiz-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'findbiz-core'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __('Title', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label'     => __('Active Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a.active' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __('Content', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'findbiz-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single .dac_body' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $accordions    = $settings['tabs'];
        $section_title = $settings['element_title']; ?>
        <div class="faq-contents">
            <div class="atbd_content_module atbd_faqs_module">
                <?php if ($section_title) { ?>
                    <div class="atbd_content_module__tittle_area">
                        <div class="atbd_area_title">
                            <h4>
                                <span class="la la-question-circle"></span>
                                <?php echo esc_attr($section_title); ?>
                            </h4>
                        </div>
                    </div>
                <?php
                } ?>
                <div class="atbdb_content_module_contents">
                    <div class="atbdp-accordion findbiz_accordion">
                        <?php
                        if ($accordions) {
                            foreach ($accordions as $accordion) {
                                $title = $accordion['tab_title'];
                                $desc  = $accordion['tab_content']; ?>
                                <div class="dacc_single">
                                    <h3 class="faq-title">
                                        <a href="#"><?php echo esc_attr($title); ?></a>
                                    </h3>
                                    <p class="dac_body"><?php echo esc_attr($desc); ?></p>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}