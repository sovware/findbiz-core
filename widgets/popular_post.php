<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use WpWax\FindBiz\DirHelper;

if ( ! defined( 'ABSPATH' ) ) exit;

class Popular_Post extends WP_Widget {

	public function __construct() {
		$widget_details = array(
			'classname'   => 'popular_post',
			'description' => esc_html__( 'You can use it to display popular post.', 'findbiz_core' ),
		);
		parent::__construct( 'popular_post', esc_html__( '-[Popular Blog]', 'findbiz_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';

		// Popular posts.
		query_posts(
			array(
				'posts_per_page' => $post_count,
				'post_type'      => 'post',
				'meta_key'       => 'post_views_count',
				'orderby'        => 'meta_value_num',
				'post__not_in'   => get_option( 'sticky_posts' ),
				'order'          => 'DESC',
			)
		);
		?>

		<div class="widget-wrapper">
			<div class="widget-default">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_html( $title ); ?></h6>
					</div>
				<?php } ?>

				<?php if ( have_posts() ) { ?>
					<div class="widget-content">
						<div class="sidebar-post">
							<?php
							while ( have_posts() ) {
								the_post();
								?>
								<div class="post-single">
									<div class="d-flex align-items-center">
										<?php the_post_thumbnail( array( 60, 60 ), array( 'class' => 'rounded' ) ); ?>
										<p>
											<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
											<span><?php echo DirHelper::time(); ?></span>
										</p>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="widget-content">
						<div class="sidebar-post">
							<h4> <?php esc_html_e( 'No Post Found.', 'findbiz_core' ); ?> </h4>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'findbiz-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>">
				<b><?php esc_html_e( 'How many posts you want to show ?', 'findbiz-core' ); ?></b>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_count' ) ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?> " />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['post_count'] ) ) {
			$new_instance['post_count'] = sanitize_text_field( $new_instance['post_count'] );
		}
		return $new_instance;
	}
}