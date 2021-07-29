<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use WpWax\FindBiz\Helper;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Feature section
class Feature extends Widget_Base {

	public function get_name() {
		return 'feature_section';
	}

	public function get_title() {
		return __( 'Feature Section', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'section', 'feature section' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'feature_section',
			array(
				'label' => __( 'Feature Section', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => array(
					'style1'   => esc_html__( 'Style 1', 'findbiz-core' ),
					'style2'   => esc_html__( 'Style 2', 'findbiz-core' ),
					'style3'   => esc_html__( 'Style 3', 'findbiz-core' ),
				),
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
				'default'     => 'We help build trusted connections in local businesses',
			)
		);

		$this->add_control(
			'desc',
			array(
				'label'       => __( 'Description', 'findbiz-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Enter your description', 'findbiz-core' ),
				'default'     => 'Lorem Ipsum is simply dummy text of the printing and type setting industry has been the industry stan.',
			)
		);

		$this->add_control(
			'img',
			array(
				'label'   => __( 'Right Side Image', 'findbiz-core' ),
				'type'    => Controls_Manager::MEDIA,
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
					'{{WRAPPER}} h2' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	private function wpwax_load_scripts() {
		wp_enqueue_script( 'magnific-popup' );
	}

	protected function render() {
		$this->wpwax_load_scripts();
		$settings = $this->get_settings_for_display();
		$title    = $settings['title'];
		$desc     = $settings['desc'];
		$img      = $settings['img'];
		$style    = $settings['style'];
		?>
		
		<?php if ( 'style1' === $style ) { ?>
			<section class="intro-img">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<h1><?php echo wp_kses_post( $title ); ?></h1>
							<p><?php echo wp_kses_post( $desc ); ?></p>
						</div>

						<?php if ( $img['url'] ) { ?>
							<div class="col-lg-6">
								<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( Helper::image_alt( $img['id'] ) ); ?>" class="img-full">
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
			<?php 
		}
		elseif( 'style2' === $style ) {
			?>
			<div class="row block-content">
				<?php if ( $img['url'] ) { ?>
					<div class="col-lg-6">
						<div class="block-content__img">
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( Helper::image_alt( $img['id'] ) ); ?>" class="img-full">
						</div>
					</div>
				<?php } ?>
				
				<div class="col-lg-6">
					<div class="block-content__details">
						<h3><?php echo wp_kses_post( $title ); ?></h3>
						<p><?php echo wp_kses_post( $desc ); ?></p>
					</div>
				</div>
			</div>
			<?php
		}
		else {
			?>
			<div class="row block-content">
				<div class="col-lg-6">
					<div class="block-content__details">
						<h3><?php echo wp_kses_post( $title ); ?></h3>
						<p><?php echo wp_kses_post( $desc ); ?></p>
					</div>
				</div>

				<?php if ( $img['url'] ) { ?>
					<div class="col-lg-6">
						<div class="block-content__img">
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( Helper::image_alt( $img['id'] ) ); ?>" class="img-full">
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}
}
