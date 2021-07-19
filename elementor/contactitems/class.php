<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/accordion/class.php
 *
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Contact items
class ContactItems extends Widget_Base {

	public function get_name() {
		return 'contact_items';
	}

	public function get_title() {
		return __( 'Contact Items', 'findbiz-core' );
	}

	public function get_icon() {
		return 'findbiz-el-custom';
	}

	public function get_categories() {
		return array( 'findbiz_category' );
	}

	public function get_keywords() {
		return array( 'address', 'list', 'item', 'contact items' );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'contact_items',
			array(
				'label' => __( 'Contact Items', 'findbiz-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'fontawesome',
			array(
				'label' => __( 'Font-Awesome', 'findbiz-core' ),
				'type'  => Controls_Manager::ICON,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'      => __( 'Content', 'findbiz-core' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => __( 'Enter your address', 'findbiz-core' ),
				'show_label' => false,
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Add New Items', 'findbiz-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'fontawesome' => 'fa fa-map',
						'title'       => __( 'Enter your address', 'findbiz-core' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$addresses = $settings['tabs'];
		?>
		<div class="contact_info_list_wrapper">
			<?php if ( $addresses ) { ?>
				<div class="contact_info_list">
					<ul>
						<?php
						foreach ( $addresses as $address ) {
							$title = $address['title'];
							$icon  = $address['fontawesome'];
							if ( $title ) {
								?>
								<li>
									<p><span class="<?php echo esc_attr( $icon ); ?>"></span></p>
									<p class="contact-details">
										<span class="contact-details__title"><?php echo esc_attr( $title ); ?></span>
									</p>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
