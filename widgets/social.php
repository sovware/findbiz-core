<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Social extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'social',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'findbiz_core' ),
		 );
		 parent::__construct( 'social', esc_html__( '-[Social Icon]', 'findbiz_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		?>
		<div class="widget-wrapper">
			<div class="widget-default">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_attr( $title ); ?></h6>
					</div>
					<?php
				}
				?>
				<div class="widget-content">
					<div class="social social--small social--gray ">
						<ul class="d-flex flex-wrap">
							<?php
							for ( $i = 1; $i <= $instance['social']; $i++ ) {

								$link_text = ! empty( $instance[ "link_text$i" ] ) ? $instance[ "link_text$i" ] : '';
								$link_url  = ! empty( $instance[ "link_url$i" ] ) ? $instance[ "link_url$i" ] : '';
								if ( $link_text ) :
									?>
									<li>
										<a href="<?php echo esc_url( $link_url ); ?>" class="<?php echo esc_attr( $link_text ); ?>">
											<span class="fab fa-<?php echo esc_attr( $link_text ); ?>"></span>
										</a>
									</li>
									<?php
							endif;
							}
							?>

						</ul>
					</div>

				</div>
			</div>
		</div>

		<?php
	}

	public function form( $instance ) {
		 $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$social = ! empty( $instance['social'] ) ? $instance['social'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'findbiz-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>">
				<b><?php esc_html_e( 'How many social field would you want? & hit save.', 'findbiz-core' ); ?></b>
			</label>
		</p>

		<p><input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>" type="text" value="<?php echo esc_attr( $social ); ?>" />
		</p>

		<?php
		if ( ! empty( $social ) ) {
			printf( "<p style='font-size: 12px; color: #9d9d9d; font-style: italic'>%s | <a href='https://fontawesome.com/icons?d=listing&m=free' target='_blank'>%s</a></p>", esc_html__( 'Please Note: Social Icon Names are just Fonts Awesome Icon Name in lower case(eg. facebook-f or twitter etc)', 'findbiz_core' ), esc_html__( 'Font Awesome Icons List', 'findbiz_core' ) );
			for ( $i = 1; $i <= $social; $i++ ) {

				$link_text = ! empty( $instance[ "link_text$i" ] ) ? $instance[ "link_text$i" ] : '';
				$link_url  = ! empty( $instance[ "link_url$i" ] ) ? $instance[ "link_url$i" ] : '';
				?>

				<p style="border: 1px solid #f5548e; padding: 10px; ">
					<label for="<?php echo esc_attr( $this->get_field_id( "link_text$i" ) ); ?>">
						<?php echo "#$i : Social Icon Name"; ?>
						<a href='https://fontawesome.com/icons?d=listing&m=free' target='_blank'>Font Awesome Icons
							List</a>
					</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "link_text$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "link_text$i" ) ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "link_url$i" ) ); ?>"><?php echo "#$i : Social url"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "link_url$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "link_url$i" ) ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
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
