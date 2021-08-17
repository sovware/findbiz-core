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

// Accordion
class FAQ extends Widget_Base {


	public function get_name() {
		return 'faq';
	}

	public function get_title() {
		return __( 'FAQ', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}
	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'accordion', 'tabs', 'faq' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'wpwaxtheme-accordion',
			array(
				'label' => __( 'FAQ', 'findbiz-core' ),
			)
		);
		$this->add_control(
			'section_title',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => __( 'Section Title', 'findbiz-core' ),
				'default'   => "Listing FAQ's",
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs', 'findbiz-core' ),
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
				'fields'      => array(
					array(
						'name'        => 'title',
						'label'   => __( 'Title', 'findbiz-core' ),
						'type'    => Controls_Manager::TEXT,
						'dynamic' => array(
							'active' => true,
						),
					),
					array(
						'name'        => 'content',
						'label'   => __( 'Content', 'findbiz-core' ),
						'type'    => Controls_Manager::TEXTAREA,
						'dynamic' => array(
							'active' => true,
						),
					),
				),
				'default'	=> array(
					'title' => 'How to open an account?',
					'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
				),
			)
		);
		$this->add_control(
			'title_alignment',
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => __( 'Section Title Alignment', 'findbiz-core' ),
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'findbiz-core' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'findbiz-core' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'findbiz-core' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .faq-contents .atbd_area_title h4' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'wpwax_animation_duration',
			array(
				'type'      => Controls_Manager::NUMBER,
				'label'     => __( 'Animation Duration', 'findbiz-core' ),
				'default' => '2000',
			)
		);
		$this->add_control(
			'delay',
			array(
				'type'      => Controls_Manager::NUMBER,
				'label'     => __( 'Delay', 'findbiz-core' ),
				'default' => '10',
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
			's_title_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Section Title Color', 'findbiz-core' ),
				'default'   => '#272b41',
				'selectors' => array( '{{WRAPPER}} .faq-contents .atbd_area_title h4' => 'color: {{VALUE}}' )
			)
		);
		$this->add_control(
			'tab_title_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Tab Title Color', 'findbiz-core' ),
				'default'   => '#272b41',
				'selectors' => array( '{{WRAPPER}} .faq-contents .atbdb_content_module_contents .dacc_single h3 a' => 'color: {{VALUE}}' )
			)
		);
		$this->add_control(
			'tab_content_color',
			array(
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Tab Content Color', 'findbiz-core' ),
				'default'   => '#272b41',
				'selectors' => array( '{{WRAPPER}} .faq-contents .atbdb_content_module_contents .dacc_single p.dac_body' => 'color: {{VALUE}}' )
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
			array(
				'name' => 'section_title_typo',
				'label'     => __( 'Section Title Color', 'findbiz-core' ),
				'selector' => '{{WRAPPER}} .faq-contents .atbd_area_title h4',
			),
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'tab_title_typo',
				'label'     => __( 'Tab Title Color', 'findbiz-core' ),
				'selector' => '{{WRAPPER}} .faq-contents .atbdb_content_module_contents .dacc_single h3 a',
			),
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name' => 'tab_content_typos',
				'label'     => __( 'Tab Content Color', 'findbiz-core' ),
				'selector' => '{{WRAPPER}} .faq-contents .atbdb_content_module_contents .dacc_single p.dac_body',
			),
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings		= $this->get_settings_for_display();
		$tabs			= $settings['tabs'];
		$section_title	= $settings['section_title'];
		?>

		<div class="faq-contents">
			<div class="atbd_content_module atbd_faqs_module">

				<?php if ( $section_title ) { ?>
					<div class="atbd_content_module__tittle_area">
						<div class="atbd_area_title">
							<h4><span class="la la-question-circle"></span><?php echo esc_attr( $section_title ); ?></h4>
						</div>
					</div>
				<?php } ?>

				<?php if ( $tabs ) { ?>
					<div class="atbdb_content_module_contents">
						<div class="atbdp-accordion findbiz_accordion">
							<?php
								foreach ( $tabs as $tab ) {
									$title = $tab['title'];
									$desc  = $tab['content'];
									?>
									<div class="dacc_single">
										<h3 class="faq-title">
											<a href="#"><?php echo esc_attr( $title ); ?></a>
										</h3>
										<p class="dac_body"><?php echo esc_attr( $desc ); ?></p>
									</div>
									<?php
								}
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
