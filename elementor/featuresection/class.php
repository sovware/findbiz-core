<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 * 
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

use WpWax\FindBiz\Helper;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

//Feature section
class FeatureSection extends Widget_Base
{
    public function get_name()
    {
        return 'feature_section';
    }

    public function get_title()
    {
        return __('Feature Section', 'findbiz-core');
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
        return ['section', 'feature section'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'feature_section',
            [
                'label' => __('Feature Section', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'findbiz-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one'   => esc_html__('Style 1', 'findbiz-core'),
                    'style-two'   => esc_html__('Style 2', 'findbiz-core'),
                    'style-three' => esc_html__('Style 3', 'findbiz-core'),
                ],
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
                'default'     => 'See how it works'
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'   => __('Description', 'findbiz-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your description', 'findbiz-core'),
                'default'     => 'The best place for people and businesses to outsource tasks.'
            ]
        );

        $this->add_control(
            'btn',
            [
                'label'   => __('Video Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'style' => 'style-one'
                ]
            ]
        );

        $this->add_control(
            'url',
            [
                'label'         => __('Link', 'findbiz-core'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __('https://your-link.com', 'findbiz-core'),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
                'condition' => [
                    'style' => ['style-one', 'style-two'],
                ]
            ]
        );

        $this->add_control(
            'img',
            [
                'label'   => __('Right Side Image', 'findbiz-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
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
            'title_color',
            [
                'label'  => __('Title Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
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
        $btn      = $settings['btn'];
        $url      = $settings['url'] ? $settings['url']['url'] : '';
        $img      = $settings['img'];
        $style    = $settings['style'];
        ?>
        
        <?php if ('style-one' == $style) { ?>
            <div class="service-process">
                <div class="process-desc">
                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($desc); ?></p>
                    <p class="play--btn">
                    <span class="">
                        <i class="fas fa-play"></i>
                    </span>
                        <a href="<?php echo esc_url($url); ?>" class="stretched-link video-iframe"><?php echo esc_attr($btn); ?></a>
                    </p>
                </div>
                <div class="process-img"><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo Helper::image_alt($img['id']); ?>"></div>
            </div>
        <?php } elseif ('style-two' == $style) { ?>
            <div class="intro-video">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h1><?php echo wp_kses_post($title); ?></h1>
                            <p class="col-md-10"><?php echo wp_kses_post($desc); ?></p>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="card-video">
                                <figure>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo Helper::image_alt($img['id']); ?>">
                                    <figcaption>
                                        <a href="<?php echo esc_url($url); ?>" class="play--btn video-iframe">
                                            <span class=""><i class="fa fa-play"></i></span>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <section class="intro-img">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1><?php echo wp_kses_post($title) ?></h1>
                            <p><?php echo wp_kses_post($desc) ?></p>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr(Helper::image_alt($img['id'])); ?>" class="img-full">
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}