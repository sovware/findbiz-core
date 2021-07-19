<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use WpWax\FindBiz\DirHelper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Contact form 7
class ContactForm extends Widget_Base {

	public function get_name() {
		return 'contact_form';
	}

	public function get_title() {
		return __( 'Contact Form', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'contact', 'form', 'contact form' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'contact_form',
			array(
				'label' => __( 'Contact Form', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Form Title', 'findbiz-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'Enter form title', 'findbiz-core' ),
			)
		);

		$this->add_control(
			'contact_form_id',
			array(
				'label'   => __( 'Select Contact Form', 'findbiz-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => DirHelper::cf7_names(),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$title           = $settings['title'];
		$contact_form_id = $settings['contact_form_id'];

		if ( $contact_form_id ) { ?>
			<div class="contact-wrapper">
				<?php if ( $title ) { ?>
					<div class="contact-wrapper__title">
						<h4><?php echo esc_attr( $title ); ?></h4>
					</div>
					<?php
				}
				?>
				<div class="contact-wrapper__fields">
					<?php echo do_shortcode( '[contact-form-7 id="' . intval( esc_attr( $contact_form_id ) ) . '" ]' ); ?>
				</div>
			</div>
			<?php
		}
	}
}
