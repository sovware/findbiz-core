<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use WpWax\FindBiz\DirHelper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Featured_Listing extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'sponsor',
			 'description' => esc_html__( 'You can use it to display featured service listings.', 'findbiz_core' ),
		 );
		 parent::__construct( 'sponsor', esc_html__( '-[Featured Listing Carousel]', 'findbiz_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$number_cat = ( ! empty( $instance['posts_per'] ) ) ? $instance['posts_per'] : '';
		add_filter( 'all_listings_wrapper', array( new DirHelper(), 'all_listings_wrapper' ) );
		add_filter(
			'all_listings_column',
			function() {
				return '';
			}
		);
		?>
		<div id="listing-carousel" class="widget-wrapper sponsored-listing-widget">
			<?php if ( $title ) { ?>
				<div class="widget-header">
					<h6 class="widget-title"><?php echo esc_attr( $title ); ?></h6>
				</div>
			<?php } ?>

			<?php echo do_shortcode( '[directorist_all_listing view="grid" listings_per_page="' . esc_attr( $number_cat ) . '" featured_only="yes" header="no" action_before_after_loop="no" display_preview_image="yes" directory_type="general"]' ); ?>

		</div>

		<?php
	}

	public function form( $instance ) {
		$title     = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$posts_per = ( ! empty( $instance['posts_per'] ) ) ? $instance['posts_per'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'findbiz-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts_per' ) ); ?>">
				<b><?php esc_html_e( 'How many listing you want to show ?', 'findbiz-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per' ) ); ?>" type="text" value="<?php echo esc_attr( $posts_per ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['id'] ) ) {
			$new_instance['id'] = sanitize_text_field( $new_instance['id'] );
		}
		return $new_instance;
	}
}
