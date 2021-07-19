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

// Booking Confirmation
class Booking extends Widget_Base {

	public function get_name() {
		return 'booking';
	}

	public function get_title() {
		return __( 'Booking Confirmation', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'booking',
			array(
				'label' => __( 'Styling', 'findbiz-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'booking_margin',
			array(
				'label'      => __( 'margin', 'findbiz-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'booking_padding',
			array(
				'label'      => __( 'Padding', 'findbiz-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {    ?>
		<div class="findbiz-directorist_booking_confirmation"><?php echo do_shortcode( '[directorist_booking_confirmation]' ); ?></div>
		<?php
	}
}
