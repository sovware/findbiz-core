<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use WpWax\FindBiz\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Testimonial
class Testimonial extends Widget_Base {

	public function get_name() {
		return 'testimonials';
	}

	public function get_title() {
		return __( 'Testimonials', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'testimonial', 'client', 'testi' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'Testimonials',
			array(
				'label' => __( 'Testimonials', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'label'       => __( 'Testimonials', 'findbiz-core' ),
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
				'fields'      => array(
					array(
						'name'        => 'name',
						'label'       => __( 'Name', 'findbiz-core' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'default'     => 'Mark Tony',
					),
					array(
						'name'        => 'designation',
						'label'       => __( 'Designation', 'findbiz-core' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'default'     => 'Software Developer',
					),
					array(
						'name'  => 'desc',
						'label' => __( 'Testimonial Text', 'findbiz-core' ),
						'type'  => Controls_Manager::TEXTAREA,
					),
					array(
						'name'  => 'image',
						'label' => __( 'Author Image', 'findbiz-core' ),
						'type'  => Controls_Manager::MEDIA,
					),
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
					'{{WRAPPER}} .testimonial-author h4' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	private function wpwax_load_scripts() {
		wp_enqueue_script( 'owl-carousel' );
	}

	protected function render() {
		$this->wpwax_load_scripts();
		$settings     = $this->get_settings_for_display();
		$testimonials = $settings['testimonials'];
		?>

		<div class="testimonial-carousel owl-carousel">
			<?php foreach ( $testimonials as $test ) { ?>
				<div class="testimonial-single">
					<div class="testimonial-author">
						<img src="<?php echo esc_url( $test['image']['url'] ); ?>" alt="<?php echo Helper::image_alt( $test['image']['id'] ); ?>">
						<div>
							<h4><?php echo esc_attr( $test['name'] ); ?></h4>
							<span><?php echo esc_attr( $test['designation'] ); ?></span>
						</div>
					</div>
					<p class="testimonial-text"><?php echo esc_attr( $test['desc'] ); ?></p>
					<img src="<?php echo plugins_url( 'quotes.svg', __FILE__ ); ?>" alt="<?php echo esc_html( 'testimonial quote' ); ?>" class="svg">
				</div>
			<?php } ?>
		</div>

		<?php
	}
}
