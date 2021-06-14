<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

use AazzTech\FindBiz\DirHelper;
use AazzTech\FindBiz\Helper;
use AazzTech\FindBiz\Theme_Setup;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// **************************************************************************************
// Popular post
// **************************************************************************************

class findbiz_popular_post_widget extends WP_Widget {

	public function __construct() {
		$widget_details = array(
			'classname'   => 'findbiz_popular_post_widget',
			'description' => esc_html__( 'You can use it to display popular post.', 'findbiz_core' ),
		);
		parent::__construct( 'findbiz_popular_post_widget', esc_html__( '-[Popular Blog]', 'findbiz_core' ), $widget_details );
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
											<span><?php echo Theme_Setup::time(); ?></span>
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


// **************************************************************************************
// Latest post
// **************************************************************************************


class findbiz_latest_post_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'findbiz_latest_post_widget',
			 'description' => esc_html__( 'You can use it to display latest post.', 'findbiz_core' ),
		 );
		 parent::__construct( 'findbiz_latest_post_widget', esc_html__( '-[Latest Blog]', 'findbiz_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';

		// Popular posts
		query_posts(
			array(
				'posts_per_page' => $post_count,
				'post_type'      => 'post',
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
					<?php
				}
				if ( have_posts() ) {
					?>
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
											<span><?php echo Theme_Setup::time(); ?></span>

										</p>
									</div>
								</div><!-- ends: .post-single -->
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
				wp_reset_query();
				?>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		 $title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
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


// **************************************************************************************
// Social
// **************************************************************************************

class findbiz_connect_follow_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'findbiz_connect_follow_widget',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'findbiz_core' ),
		 );
		 parent::__construct( 'findbiz_connect_follow_widget', esc_html__( '-[Social Icon]', 'findbiz_core' ), $widget_details );
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

// **************************************************************************************
// Sponsor
// **************************************************************************************

class findbiz_sponsor_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'findbiz_sponsor_widget',
			 'description' => esc_html__( 'You can use it to display featured service listings.', 'findbiz_core' ),
		 );
		 parent::__construct( 'findbiz_sponsor_widget', esc_html__( '-[Featured Listing Carousel]', 'findbiz_core' ), $widget_details );
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


// **************************************************************************************
// Contact Info
// **************************************************************************************
class findbiz_icon_title_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'findbiz_icon_title_widget',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'findbiz_core' ),
		 );
		 parent::__construct( 'findbiz_icon_title_widget', esc_html__( '-[Icon With Title]', 'findbiz_core' ), $widget_details );
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

// **************************************************************************************
// Button
// **************************************************************************************

class findbiz_widget_button extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'findbiz_widget_button',
			 'description' => esc_html__( 'You can use it to button with icon.', 'findbiz-core' ),
		 );
		 parent::__construct( 'findbiz_widget_button', esc_html__( '-[Button]', 'findbiz-core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		?>
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


function findbiz_widgets_register() {
	register_widget( 'findbiz_popular_post_widget' );
	register_widget( 'findbiz_latest_post_widget' );
	register_widget( 'findbiz_connect_follow_widget' );
	register_widget( 'findbiz_sponsor_widget' );
	register_widget( 'findbiz_icon_title_widget' );
	register_widget( 'findbiz_widget_button' );
}

add_action( 'widgets_init', 'findbiz_widgets_register' );
