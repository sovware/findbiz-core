<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Button extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'button',
			 'description' => esc_html__( 'You can use it to button with icon.', 'findbiz-core' ),
		 );
		 parent::__construct( 'button', esc_html__( '-[Button]', 'findbiz-core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		?>
		<div class="wpwax-widget wpwax-widget--buttons">
			<div class="wpwax-widget__body">
				<ul class="list-unstyled store-btns d-flex flex-wrap">
					<?php
					for ( $i = 1; $i <= $instance['social']; $i++ ) {

						$btn_text = ! empty( $instance[ "btn_text$i" ] ) ? $instance[ "btn_text$i" ] : '';
						$btn_url  = ! empty( $instance[ "btn_url$i" ] ) ? $instance[ "btn_url$i" ] : '';
						$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';
						if ( $btn_text ) :
							?>
							<li>
								<a href="<?php echo esc_url( $btn_url ); ?>" class="btn">
									<span class="fab fa-<?php echo esc_html( $icon ); ?>"></span>
									<?php echo esc_html( $btn_text ); ?>
								</a>
							</li>

							<?php
					endif;
					}
					?>
				</ul>
			</div>
		</div>

		<?php
	}

	public function form( $instance ) {
		 $social = ! empty( $instance['social'] ) ? $instance['social'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>">
				<b><?php esc_html_e( 'How many button you want? & hit save.', 'findbiz-core' ); ?></b>
			</label>
		</p>

		<p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>" type="text" value="<?php echo esc_attr( $social ); ?>" />
		</p>

		<?php
		if ( ! empty( $social ) ) {
			printf( "<p style='font-size: 12px; color: #9d9d9d; font-style: italic'>%s | <a href='https://fontawesome.com/icons?d=listing&m=free' target='_blank'>%s</a></p>", esc_html__( 'Please Note: Social Icon Names are just Fonts Awesome Icon Name in lower case(eg. facebook-f or twitter etc)', 'findbiz-core' ), esc_html__( 'Font Awesome Icons List', 'findbiz-core' ) );
			for ( $i = 1; $i <= $social; $i++ ) {

				$btn_text = ! empty( $instance[ "btn_text$i" ] ) ? $instance[ "btn_text$i" ] : '';
				$btn_url  = ! empty( $instance[ "btn_url$i" ] ) ? $instance[ "btn_url$i" ] : '';
				$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';
				?>
				<p style="border: 1px solid #f5548e; padding: 10px; ">
					<label for="<?php echo esc_attr( $this->get_field_id( "btn_text$i" ) ); ?>"><?php echo "#$i : Button Text"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "btn_text$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "btn_text$i" ) ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "btn_url$i" ) ); ?>"><?php echo "#$i : Button url"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "btn_url$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "btn_url$i" ) ); ?>" type="text" value="<?php echo esc_attr( $btn_url ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>"><?php echo "#$i : Social Icon Name"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon$i" ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />

				</p>

				<?php
			}
		}
		?>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['social'] ) ) {
			$new_instance['social'] = sanitize_text_field( $new_instance['social'] );
		}

		return $new_instance;
	}
}
