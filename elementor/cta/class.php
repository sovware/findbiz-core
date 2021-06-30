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

//Call To Action
class CTA extends Widget_Base
{

    public function get_name()
    {
        return 'call_to_action';
    }

    public function get_title()
    {
        return __('Call To Action', 'findbiz-core');
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
        return ['cta', 'call to action', 'action'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'call_to_action',
            [
                'label' => __('Call To Action', 'findbiz-core'),
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
                'default' => 'Are you a Business Providers or Service Seekers?'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'   => __('Subtitle', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Post your business or needs today.'
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label'   => __('Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Add Your Listing'
            ]
        );

        $this->add_control(
            'link',
            [
                'label'   => __('Button Link', 'findbiz-core'),
                'type'    => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'findbiz-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_color',
            [
                'label'  => __('Section BG Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper.cta--dark' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper .cta-content h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-wrapper .cta-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title    = $settings['title'];
        $subtitle = $settings['subtitle'];
        $btn_text = $settings['btn_text'];

        $link       = $settings['link']['url'];
        $target     = $settings['link']['is_external'];
        $nofollow   = $settings['link']['nofollow'];
        $title_attr = $settings['link']['custom_attributes']; ?>

        <div class="cta-wrapper cta--dark">
            <div class="cta-content">
                <h3><?php echo wp_kses_post($title); ?></h3>
                <p><?php echo esc_attr($subtitle); ?></p>
            </div>
            <?php if ($btn_text) { ?>
                <div class="cta-btn">
                    <a class="btn btn-primary" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($nofollow); ?>" title="<?php echo esc_attr($title_attr); ?>">
                        <?php echo esc_attr($btn_text); ?>
                    </a>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}