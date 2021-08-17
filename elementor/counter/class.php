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
			'counters',
			array(
				'label'       => __( 'Counters', 'findbiz-core' ),
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
				'fields'      => array(
					array(
						'name'        => 'number',
						'label'   => __( 'Number', 'findbiz-core' ),
						'type'    => Controls_Manager::NUMBER,
						'default' => 0,
						'dynamic' => array(
							'active' => true,
						),
					),
					array(
						'name'        => 'suffix',
						'label'   => __( 'Number Suffix', 'findbiz-core' ),
						'type'    => Controls_Manager::TEXT,
						'dynamic' => array(
							'active' => true,
						),
					),
					array(
						'name'        => 'label',
						'label'   => __( 'Title', 'findbiz-core' ),
						'type'    => Controls_Manager::TEXT,
						'dynamic' => array(
							'active' => true,
						),
					),
				),
				'default'	=> array(
					'number' => '2.8',
					'suffix' => 'M+',
					'label' => 'Verified users',
				),
			)
		);
		$this->end_controls_section();

		// color tab
		$this->start_controls_section(
			'style',
			array(
				'label' => __( 'Style', 'findbiz-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'number_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Numbers Color', 'findbiz-core' ),
				'default'   => '#272b41',
				'selectors' => array( '{{WRAPPER}} .counters .counter-items p span.count_up' => 'color: {{VALUE}}' )
			)
		);
		$this->add_control(
			'suffix_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Suffix Color', 'findbiz-core' ),
				'default'   => '#272b41',
				'selectors' => array( '{{WRAPPER}} .counters .counter-items p' => 'color: {{VALUE}}' )
			)
		);
		$this->add_control(
			'label_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Title Color', 'findbiz-core' ),
				'default'   => '#9299b8',
				'selectors' => array( '{{WRAPPER}} .counters .counter-items span.items-title' => 'color: {{VALUE}}' )
			)
		);
		$this->end_controls_section();

		// typography
		$this->start_controls_section(
			'sec_typography',
			array(
				'label' => __( 'Typography', 'findbiz-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typo',
				'label' => __( 'Number', 'findbiz-core' ),
				'selector' => '{{WRAPPER}} .counters .counter-items p',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __( 'Title', 'findbiz-core' ),
				'selector' => '{{WRAPPER}} .counters .counter-items span.items-title',
			]
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
		$counters   = $settings['counters'];
		?>
		<div class="counters row">
			<?php foreach ( $counters as $counter ) { ?>
				<div class="list-unstyled counter-items col-md-3">
					<div class="counter-items">
						<p>
							<span class="count_up"><?php echo esc_attr( $counter['number'] ); ?></span>
							<?php echo esc_attr( $counter['suffix'] ); ?>
						</p>
						<span class="items-title"><?php echo esc_attr( $counter['label'] ); ?></span>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}
