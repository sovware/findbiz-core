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

// Counter
class Counter extends Widget_Base {

	public function get_name() {
		return 'counter';
	}

	public function get_title() {
		return __( 'Counter', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'count', 'counter', 'count down' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_counter',
			array(
				'label' => __( 'Counter', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'number',
			array(
				'label'   => __( 'Number', 'findbiz-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'suffix',
			array(
				'label'   => __( 'Number Suffix', 'findbiz-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'label',
			array(
				'label'   => __( 'Title', 'findbiz-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->end_controls_section();
	}

	private function wpwax_load_scripts() {
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'counter-up' );
	}

	protected function render() {
		$this->wpwax_load_scripts();
		$settings = $this->get_settings_for_display();
		$number   = $settings['number'];
		$suffix   = $settings['suffix'];
		$title    = $settings['label'];
		?>
		<div class="list-unstyled counter-items">
			<div>
				<p>
					<span class="count_up"><?php echo esc_attr( $number ); ?></span>
					<?php echo esc_attr( $suffix ); ?>
				</p>
				<span><?php echo esc_attr( $title ); ?></span>
			</div>
		</div>
		<?php
	}
}
