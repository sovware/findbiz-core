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
class FeatureVideo extends Widget_Base {

	public function get_name() {
		return 'Feature_video';
	}

	public function get_title() {
		return __( 'Feature Video', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'video', 'feature video' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'feature_video',
			array(
				'label' => __( 'Feature Video', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => array(
					'style-one'   => esc_html__( 'Style 1', 'findbiz-core' ),
					'style-two'   => esc_html__( 'Style 2', 'findbiz-core' ),
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
				'default'     => 'See how it works',
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
				'default'     => 'The best place for people and businesses to outsource tasks.',
			)
		);

		$this->add_control(
			'btn',
			array(
				'label'     => __( 'Video Button Label', 'findbiz-core' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'style' => 'style-one',
				),
			)
		);

		$this->add_control(
			'url',
			array(
				'label'         => __( 'Link', 'findbiz-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'findbiz-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'style' => array( 'style-one', 'style-two' ),
				),
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
		$btn      = $settings['btn'];
		$url      = $settings['url'] ? $settings['url']['url'] : '';
		$img      = $settings['img'];
		$style    = $settings['style'];
		?>
		
		<?php if ( 'style-one' == $style ) { ?>
			<div class="service-process">
				<div class="process-desc">

					<h2><?php echo wp_kses_post( $title ); ?></h2>
					<p><?php echo wp_kses_post( $desc ); ?></p>

					<?php if ( $url ) { ?>
						<p class="play--btn">
							<span class=""><i class="fas fa-play"></i></span>
							<a href="<?php echo esc_url( $url ); ?>" class="stretched-link video-iframe"><?php echo esc_attr( $btn ); ?></a>
						</p>
					<?php } ?>
				</div>

				<?php if ( $img['url'] ) { ?>
					<div class="process-img">
						<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo Helper::image_alt( $img['id'] ); ?>">
					</div>
				<?php } ?>
			</div>
			<?php
		} 
		else { ?>
			<div class="intro-video">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-6">
							<h1><?php echo wp_kses_post( $title ); ?></h1>
							<p class="col-md-10"><?php echo wp_kses_post( $desc ); ?></p>
						</div>
						<?php if ( $url || $img['url'] ) { ?>
							<div class="col-lg-5 col-md-6">
								<div class="card-video">
									<figure>
										<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo Helper::image_alt( $img['id'] ); ?>">
										<?php if ( $url ) { ?>
											<figcaption>
												<a href="<?php echo esc_url( $url ); ?>" class="play--btn video-iframe">
													<span class=""><i class="fa fa-play"></i></span>
												</a>
											</figcaption>
										<?php } ?>
									</figure>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
