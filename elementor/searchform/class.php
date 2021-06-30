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

//Hero area
class SearchForm extends Widget_Base
{

    public function get_name()
    {
        return 'search_form section-padding';
    }

    public function get_title()
    {
        return __('Search Form', 'findbiz-core');
    }

    public function get_icon()
    {
        return 'findbiz-el-custom';
    }

    public function get_keywords()
    {
        return ['search-form', 'form', 'hero area'];
    }

    public function get_categories()
    {
        return ['findbiz_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'hero_area',
            [
                'label' => __('Search Form', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'logged_in',
            [
                'label'   => __('Show Only For Logging User?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title_subtitle',
            [
                'label'   => __('Show Title & Subtitle?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'findbiz-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your title', 'findbiz-core'),
                'default'     => __('Explore Trusted Business', 'findbiz-core'),
                'condition'   => [
                    'title_subtitle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => __('Subtitle', 'findbiz-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your subtitle', 'findbiz-core'),
                'default'     => __('Get notified about services that match your requirement', 'findbiz-core'),
                'condition'   => [
                    'title_subtitle' => 'yes',
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
            'search',
            [
                'label'       => __('Search Button Label', 'findbiz-core'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter search button label', 'findbiz-core'),
                'default'     => __('Search', 'findbiz-core'),
            ]
        );

        $this->add_control(
            'more_btn',
            [
                'label'   => __('Advance Search Field?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'reset',
            [
                'label'   => __('Reset Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Reset',
                'condition'   => [
                    'more_btn' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'apply',
            [
                'label'   => __('Apply Button Label', 'findbiz-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Apply',
                'condition'   => [
                    'more_btn' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'popular_cat',
            [
                'label'   => __('Show Popular Category?', 'findbiz-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
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
                    '{{WRAPPER}} .directorist-search-top__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'  => __('Subtitle Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-top__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label'  => __('Tab Text Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_bg_color',
            [
                'label'  => __('Tab BG Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current:before' => 'border-left-color: {{VALUE}};',
                    '{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_box',
            [
                'label'  => __('Search Box Border Color', 'findbiz-core'),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-form-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings       = $this->get_settings_for_display();
        $title_subtitle = $settings['title_subtitle'];
        $title          = $settings['title'];
        $subtitle       = $settings['subtitle'];
        $search         = $settings['search'];
        $more_btn       = $settings['more_btn'];
        $reset	        = $settings['reset'];
        $apply	        = $settings['apply'];
        $popular_cat    = $settings['popular_cat'];
        $logged_in	    = $settings['logged_in'];
        $default_types	= $settings['default_types'];
        $types          = $settings['types'] ? implode( ',', $settings['types'] ) : ''; ?>

        <div class="search-form-wrapper search-form-wrapper--one">
            <?php echo do_shortcode( '[directorist_search_listing show_title_subtitle="'.$title_subtitle.'" search_bar_title="'.$title.'" search_bar_sub_title="'.$subtitle.'" search_button="yes" search_button_text="'.$search.'" more_filters_button="'.$more_btn.'" more_filters_text="" reset_filters_button="yes" apply_filters_button="yes" reset_filters_text="'.$reset.'" apply_filters_text="'.$apply.'" more_filters_display="overlapping" logged_in_user_only="'.$logged_in.'" directory_type="'.$types.'" default_directory_type="'.$default_types.'" show_popular_category="'.$popular_cat.'"]' ); ?>
        </div>
        <?php
    }
}