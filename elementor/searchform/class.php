<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WpWax\FindBiz_Core\Helper as FindBiz_CoreHelper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Hero area
class SearchForm extends Widget_Base {


	public function get_name() {
		return 'search_form section-padding';
	}

	public function get_title() {
		return __( 'Search Form', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_keywords() {
		return array( 'search-form', 'form', 'hero area' );
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'sec_general',
			array(
				'label' => __( 'General', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'show_subtitle',
			array(
			'type'      => Controls_Manager::SWITCHER,
			'label'     => __( 'Add Element Title & Subtitle?', 'directorist' ),
			'default'   => 'yes',
			)
		);
		$this->add_control(
			'title_subtitle_alignment',
			array(
			'type'      => Controls_Manager::CHOOSE,
			'label'     => __( 'Title/Subtitle Alignment', 'directorist' ),
			'options'   => array(
				'left'   => array(
					'title' => __( 'Left', 'directorist' ),
					'icon'  => 'fa fa-align-left',
				),
				'center' => array(
					'title' => __( 'Center', 'directorist' ),
					'icon'  => 'fa fa-align-center',
				),
				'right'  => array(
					'title' => __( 'Right', 'directorist' ),
					'icon'  => 'fa fa-align-right',
				),
			),
			'toggle'    => true,
			'selectors' => array(
				'{{WRAPPER}} .directorist-search-top__title' => 'text-align: {{VALUE}}',
				'{{WRAPPER}} .directorist-search-top__subtitle' => 'text-align: {{VALUE}}',
			),
			'condition' => array( 'show_subtitle' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'title',
			array(
			'type'      => Controls_Manager::TEXTAREA,
			'label'     => __( 'Search Form Title', 'directorist' ),
			'default'   => __( 'Search here', 'directorist' ),
			'condition' => array( 'show_subtitle' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'subtitle',
			array(
			'type'      => Controls_Manager::TEXTAREA,
			'label'     => __( 'Search Form Subtitle', 'directorist' ),
			'default'   => __( 'Find the best match of your interest', 'directorist' ),
			'condition' => array( 'show_subtitle' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'type',
			array(
			'type'     => Controls_Manager::SELECT2,
			'label'    => __( 'Directory Types', 'directorist' ),
			'multiple' => true,
			'options'  => FindBiz_CoreHelper::az_listing_types(),
			'condition' => FindBiz_CoreHelper::multi_directory_enabled() ? '' : ['nocondition' => true],
			)
		);
		$this->add_control(
			'default_type',
			array(
			'type'     => Controls_Manager::SELECT2,
			'label'    => __( 'Default Directory Types', 'directorist' ),
			'options'  => FindBiz_CoreHelper::az_listing_types(),
			'condition' => FindBiz_CoreHelper::multi_directory_enabled() ? '' : ['nocondition' => true],
			)
		);
		$this->add_control(
			'search_btn_text',
			array(
			'type'      => Controls_Manager::TEXT,
			'label'     => __( 'Search Button Label', 'directorist' ),
			'default'   => __( 'Search Listing', 'directorist' ),
			)
		);
		$this->add_control(
			'show_more_filter_btn',
			array(
			'type'      => Controls_Manager::SWITCHER,
			'label'     => __( 'Show More Search Field?', 'directorist' ),
			'default'   => 'yes',
			)
		);
		$this->add_control(
			'more_filter_btn_text',
			array(
			'type'      => Controls_Manager::TEXT,
			'label'     => __( 'More Search Field Button Label', 'directorist' ),
			'default'   => __( 'More Filters', 'directorist' ),
			'condition' => array( 'show_more_filter_btn' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'more_filter_reset_btn',
			array(
			'type'      => Controls_Manager::SWITCHER,
			'label'     => __( 'Show More Field Reset Button?', 'directorist' ),
			'default'   => 'yes',
			'condition' => array( 'show_more_filter_btn' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'more_filter_reset_btn_text',
			array(
			'type'      => Controls_Manager::TEXT,
			'label'     => __( 'More Field Reset Button Label', 'directorist' ),
			'default'   => __( 'Reset Filters', 'directorist' ),
			'condition' => array( 'more_filter_reset_btn' => 'yes', 'show_more_filter_btn' => 'yes' ),
			)
		);
		$this->add_control(
			'more_filter_search_btn',
			array(
			'type'      => Controls_Manager::SWITCHER,
			'label'     => __( 'Show More Field Search Button?', 'directorist' ),
			'default'   => 'yes',
			'condition' => array( 'show_more_filter_btn' => array( 'yes' ) ),
			)
		);
		$this->add_control(
			'more_filter_search_btn_text',
			array(
			'type'      => Controls_Manager::TEXT,
			'label'     => __( 'More Field Search Button Label', 'directorist' ),
			'default'   => __( 'Apply Filters', 'directorist' ),
			'condition' => array( 'more_filter_search_btn' => 'yes', 'show_more_filter_btn' => 'yes' ),
			)
		);
		$this->add_control(
			'more_filter',
			array(
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'More Filter By', 'directorist' ),
			'options' => array(
				'overlapping' => __('Overlapping', 'directorist'),
				'sliding'     => __('Sliding', 'directorist'),
				'always_open' => __('Always Open', 'directorist')
			),
			'default' => 'overlapping',
			)
		);
		$this->add_control(
			'user',
			array(
			'type'      => Controls_Manager::SWITCHER,
			'label'     => __( 'Show only for logged in user?', 'directorist' ),
			'default'   => 'no',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_style',
			array(
				'label' => __( 'Color', 'findbiz-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => array( 'show_subtitle' => array( 'yes' ) ),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Title', 'directorist' ),
				'default'   => '#51526e',
				'selectors' => array( '{{WRAPPER}} .directorist-search-top__title' => 'color: {{VALUE}}' )
			)
		);
		$this->add_control(
			'subtitle_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Subtitle', 'directorist' ),
				'default'   => '#51526e',
				'selectors' => array( '{{WRAPPER}} .directorist-search-top__subtitle' => 'color: {{VALUE}}' ),
			)
		);

		$this->add_control(
			'tab_text_color',
			array(
				'label'     => __( 'Tab Text Color', 'findbiz-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tab_bg_color',
			array(
				'label'     => __( 'Tab BG Color', 'findbiz-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current:before' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .directorist-listing-type-selection .directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'search_box',
			array(
				'label'     => __( 'Search Box Border Color', 'findbiz-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .directorist-search-form-box' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_style_type',
			array(
				'tab'   => Controls_Manager::TAB_STYLE,
				'label' => __( 'Typography', 'directorist' ),
				'condition' => array( 'show_subtitle' => array( 'yes' ) ),
			)
		);

		/* $this->add_control(
			'title_typo',
			array(
				'label'    => __( 'Title', 'directorist' ),
				'type'     => Group_Control_Typography::get_type(),
				'selector' => '{{WRAPPER}} .directorist-search-top__title',
			)
		);
		$this->add_control(
			'subtitle_typo',
			array(
				'label'    => __( 'Subtitle', 'directorist' ),
				'type'     => Group_Control_Typography::get_type(),
				'selector' => '{{WRAPPER}} .directorist-search-top__subtitle',
			)
		); */

		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$atts = array(
			'show_title_subtitle'   => $settings['show_subtitle'],
			'search_bar_title'      => $settings['title'],
			'search_bar_sub_title'  => $settings['subtitle'],
			'search_button_text'    => $settings['search_btn_text'],
			'more_filters_button'   => $settings['show_more_filter_btn'],
			'more_filters_text'     => $settings['more_filter_btn_text'],
			'reset_filters_button'  => $settings['more_filter_reset_btn'],
			'apply_filters_button'  => $settings['more_filter_search_btn'],
			'reset_filters_text'    => $settings['more_filter_reset_btn_text'],
			'apply_filters_text'    => $settings['more_filter_search_btn_text'],
			'more_filters_display'  => $settings['more_filter'],
			'logged_in_user_only'   => $settings['user'] ? $settings['user'] : 'no',
		);

		if ( FindBiz_CoreHelper::multi_directory_enabled() ) {
			if ( $settings['type'] ) {
				$atts['directory_type'] = implode( ',', $settings['type'] );
			}
			if ( $settings['default_type'] ) {
				$atts['default_directory_type'] = $settings['default_type'];
			}
		}
		
		FindBiz_CoreHelper::az_run_shortcode( 'directorist_search_listing', $atts );
	}
}
