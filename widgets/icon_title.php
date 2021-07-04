<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Icon_Title extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'icon_title',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'findbiz_core' ),
		 );
		 parent::__construct( 'icon_title', esc_html__( '-[Icon With Title]', 'findbiz_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		?>

		<div class="widget atbd_widget widget_social">
			<ul class="list-unstyled social-list">
				<?php
				for ( $i = 1; $i <= $instance['social']; $i++ ) {

					$s_title  = ! empty( $instance[ "s_title$i" ] ) ? $instance[ "s_title$i" ] : '';
					$sb_title = ! empty( $instance[ "sb_title$i" ] ) ? $instance[ "sb_title$i" ] : '';
					$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';

					if ( $icon || $s_title || $sb_title ) {
						?>
						<li>
							<i class="la la-<?php echo esc_attr( $icon ); ?>"></i>
							<h6 class="title"><?php echo esc_html( $s_title ); ?></h6>
							<p class="sub-title"><?php echo esc_html( $sb_title ); ?></p>
						</li>
						<?php
					}
				}
				?>

			</ul>
		</div>

		<?php

	}

	public function form( $instance ) {
		 $social = ! empty( $instance['social'] ) ? $instance['social'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>">
				<b><?php esc_html_e( 'How many social field would you want? & hit save.', 'findbiz-core' ); ?></b>
			</label>
		</p>

		<p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>" type="text" value="<?php echo esc_attr( $social ); ?>" />
		</p>

		<?php
		if ( ! empty( $social ) ) {
			printf( "<p style='font-size: 12px; color: #9d9d9d; font-style: italic'>%s | <a href='https://icons8.com/line-awesome' target='_blank'>%s</a></p>", esc_html__( 'Please Note: Social Icon Names are just Line Awesome Icon Name in lower case(eg. facebook-f or twitter etc)', 'findbiz_core' ), esc_html__( 'Line Awesome Icons List', 'findbiz_core' ) );
			for ( $i = 1; $i <= $social; $i++ ) {

				$s_title  = ! empty( $instance[ "s_title$i" ] ) ? $instance[ "s_title$i" ] : '';
				$sb_title = ! empty( $instance[ "sb_title$i" ] ) ? $instance[ "sb_title$i" ] : '';
				$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';
				?>

				<p style="border: 1px solid #f5548e; padding: 10px; ">

					<label for="<?php echo esc_attr( $this->get_field_id( "s_title$i" ) ); ?>"><?php echo "#$i : Title"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "s_title$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "s_title$i" ) ); ?>" type="text" value="<?php echo esc_attr( $s_title ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "sb_title$i" ) ); ?>"><?php echo "#$i : Subtitle"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "sb_title$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "sb_title$i" ) ); ?>" type="text" value="<?php echo esc_attr( $sb_title ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>">
						<?php echo "#$i : Icon Name"; ?>
						<a href='https://icons8.com/line-awesome' target='_blank'>Line Awesome Icons
							List</a>
					</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon$i" ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
				</p>

				<?php
			}
		}
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['social'] ) ) {
			$new_instance['social'] = sanitize_text_field( $new_instance['social'] );
		}

		return $new_instance;
	}
}