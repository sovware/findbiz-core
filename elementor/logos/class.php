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


// Logos
class Logos extends Widget_Base {

	public function get_name() {
		return 'logos';
	}

	public function get_title() {
		return __( 'Logos Carousel', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'logo', 'logos', 'carousel' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'logos',
			array(
				'label' => __( 'Logos', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'findbiz-core' ),
					'carousel' => esc_html__( 'Carousel', 'findbiz-core' ),
				),
			)
		);

		$this->add_control(
			'clients_logo',
			array(
				'label'   => __( 'Add Logos', 'findbiz-core' ),
				'type'    => Controls_Manager::GALLERY,
				'default' => array(),
			)
		);

		$this->end_controls_section();
	}

	private function wpwax_load_scripts() {
		wp_enqueue_script( 'owl-carousel' );
	}

	protected function render() {
		$this->wpwax_load_scripts();
		$settings = $this->get_settings_for_display();
		$style    = $settings['style'];
		$logos    = $settings['clients_logo'];

		if ( 'grid' == $style ) { ?>
			<div class="clients-logo">
				<div class="clients-logo-grid">
					<?php
					if ( $logos ) {
						foreach ( $logos as $logo ) {
							?>
							<div><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo Helper::image_alt( $logo['id'] ); ?>"></div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="logo-carousel owl-carousel">
				<?php
				if ( $logos ) {
					foreach ( $logos as $logo ) {
						?>
						<div class="carousel-single">
							<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo Helper::image_alt( $logo['id'] ); ?>">
						</div>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
	}
}
