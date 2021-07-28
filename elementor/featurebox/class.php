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

// Feature Box
class FeatureBox extends Widget_Base {

	public function get_name() {
		return 'feature_boxes';
	}

	public function get_title() {
		return __( 'Feature Box', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'feature', 'feature box', 'all features' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'feature_box',
			array(
				'label' => __( 'Feature Box', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => array(
					'style-one' => esc_html__( 'Style 1', 'findbiz-core' ),
					'style-two' => esc_html__( 'Style 2', 'findbiz-core' ),
				),
			)
		);

		$this->add_control(
			'features',
			array(
				'label'       => __( 'Features', 'findbiz-core' ),
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
				'fields'      => array(
					array(
						'name'        => 'type',
						'type'        => Controls_Manager::SELECT,
						'label'       => __( 'Type', 'findbiz-core' ),
						'options' => array(
							'icon'  => esc_html__( 'Icon Type', 'findbiz-core' ),
							'image' => esc_html__( 'Image Type', 'findbiz-core' ),
						),
						'default'     => 'icon',
					),
					array(
						'name'        => 'icon',
						'label'     => __( 'Font-Awesome', 'findbiz-core' ),
						'type'      => Controls_Manager::ICON,
						'condition' => array(
							'type'  => 'icon',
						),
					),
					array(
						'name'        => 'image',
						'label'     => __( 'Choose Image', 'findbiz-core' ),
						'type'      => Controls_Manager::MEDIA,
						'default'   => array(
							'url' => Utils::get_placeholder_image_src(),
						),
						'condition' => array(
							'type' => 'image',
						),
					),
					array(
						'name'  => 'title',
						'label'       => __( 'Title', 'findbiz-core' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => array(
							'active' => true,
						),
						'placeholder' => __( 'Enter your title', 'findbiz-core' ),
					),
					array(
						'name'  => 'desc',
						'label'       => __( 'Title', 'findbiz-core' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => array(
							'active' => true,
						),
						'placeholder' => __( 'Enter your description', 'findbiz-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'feature_box_style',
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
					'{{WRAPPER}} h4' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'image_icon_align',
			array(
				'label'     => __( 'Icon & Image Alignment', 'findbiz-core' ),
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
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .card-single-content .service-icon i' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_desc_align',
			array(
				'label'     => __( 'Title & Description Alignment', 'findbiz-core' ),
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
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .card-single-content h4, {{WRAPPER}} .card-single-content p' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$style    = $settings['style'];
		$features = $settings['features'];
		?>
		<div class="feature_boxes">
			<div class="row">
				<?php 
				$i = 1; 
				foreach ( $features as $feature ) { ?>
					<div class="col-md-4">
						<div class="service-cards" id="<?php echo esc_attr( $style ); ?>">
							<div class="card-single">
								<div class="card-single-content">
									<?php if ( 'icon' == $feature['type'] ) { ?>
										<div class="service-icon">
											<i class="<?php echo esc_attr( $feature['icon'] ); ?>"></i>
										</div>
									<?php } else { ?>
										<div class="service-icon">
											<img src="<?php echo esc_url( $feature['image']['url'] ); ?>" alt="<?php echo Helper::image_alt( $feature['image']['id'] ); ?>">
										</div>
									<?php } ?>
									<h4><?php echo esc_attr( $feature['title'] ); ?></h4>
									<p><?php echo esc_attr( $feature['desc'] ); ?></p>
									<?php if ( 'style-one' === $style ) { ?>
										<span class="service-count"><?php echo ( 10 <= $i ) ? esc_attr( $i ) : esc_attr( '0' . $i ); ?></span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
					$i++;
				}
				?>
			</div>
		</div>
		<?php
	}
}
