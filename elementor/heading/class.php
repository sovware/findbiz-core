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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Heading Pro
class Heading extends Widget_Base {


	public function get_name() {
		return 'heading_pro section-title';
	}

	public function get_title() {
		return __( 'Heading Pro', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'heading', 'pro', 'Heading Pro' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'heading_pro',
			array(
				'label' => __( 'Title & Subtitle', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'findbiz-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Enter your title', 'findbiz-core' ),
				'default'     => __( 'Add Your Heading Text Here', 'findbiz-core' ),
				'description' => esc_html( 'Use tag "<span>" for highlighting the text. eg. Explore <span>Popular</span> Category' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'     => __( 'Link', 'findbiz-core' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => '',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'header_size',
			array(
				'label'   => __( 'HTML Tag', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default' => 'h3',
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => __( 'Subtitle', 'findbiz-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Enter your subtitle', 'findbiz-core' ),
				'default'     => __( 'Add Your subtitle Text Here', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'findbiz-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'findbiz-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'findbiz-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'findbiz-core' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'findbiz-core' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Styling', 'findbiz-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'findbiz-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'findbiz-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$title      = $settings['title'];
		$subtitle   = $settings['subtitle'] ? '<p>' . $settings['subtitle'] . '</p>' : '';
		$header     = $settings['header_size'];
		$link       = $settings['link']['url'];
		$target     = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow   = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
		$title_attr = $settings['link']['custom_attributes'];

		if ( $link ) {
			$title = sprintf( '<a href="%s" %s %s title="%s" >%s</a>', $link, $target, $nofollow, $title_attr, $title );
		}

		echo sprintf( '<%1$s> %2$s </%1$s> %3$s', $header, $title, $subtitle );
	}
}
