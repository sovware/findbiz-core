<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class Helper {

	use URI_Trait;

	public static function filter_content( $content ) {
		// wp filters
		$content = wptexturize( $content );
		$content = convert_smilies( $content );
		$content = convert_chars( $content );
		$content = wpautop( $content );
		$content = shortcode_unautop( $content );

		// remove shortcodes
		$pattern = '/\[(.+?)\]/';
		$content = preg_replace( $pattern, '', $content );

		// remove tags
		$content = strip_tags( $content );

		return $content;
	}

	public static function get_current_post_content( $post = false ) {
		if ( ! $post ) {
			$post = get_post();
		}
		$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
		$content = self::filter_content( $content );
		return $content;
	}

	public static function comments_callback( $comment, $args, $depth ) {
		$args2 = get_defined_vars();
		self::get_template_part( 'template-parts/comments-callback', $args2 );
	}

	public static function get_nav_menu_args() {
		$nav_menu_args = array(
			'theme_location' => 'primary',
			'container'      => false,
			'fallback_cb'    => false,
			'menu_class'     => 'navbar-nav mr-auto mb-0',
		);
		return $nav_menu_args;
	}

	public static function get_page_title() {
		if ( is_search() ) {
			$title = esc_html__( 'Search Results for : ', 'drestaurant' ) . get_search_query();
		} elseif ( is_404() ) {
			$title = esc_html__( 'Page not Found', 'drestaurant' );
		} elseif ( is_home() ) {
			if ( get_option( 'page_for_posts' ) ) {
				$title = get_the_title( get_option( 'page_for_posts' ) );
			} else {
				$title = apply_filters( 'aztheme_blog_title', esc_html__( 'All Posts', 'drestaurant' ) );
			}
		} elseif ( class_exists( 'woocommerce' ) && is_shop() || class_exists( 'woocommerce' ) && is_product() ) {
			$title = get_the_title( wc_get_page_id( 'shop' ) );
		} elseif ( is_archive() ) {
			$title = get_the_archive_title();
		} else {
			$title = get_the_title();
		}

		return apply_filters( 'aztheme_page_title', $title );
	}

	public static function get_template_part( $template, $args = array() ) {
		extract( $args );

		$template = '/' . $template . '.php';

		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		} else {
			$file = get_template_directory() . $template;
		}

		require $file;
	}

	/* == Blog functions == */

	public static function categories() {
		$cats = get_the_category_list( esc_html__( ', ', 'findbiz' ) );
		if ( $cats ) {
			printf( '<li>%s %s</li>', __( 'in', 'findbiz' ), $cats );
		}
	}

	public static function tags() {
		if ( get_the_tags() ) {
			the_tags( '<div class="tags"><ul class="list-unstyled"><li>', '</li><li>', '</li></ul></div>' );
		}
	}

	public static function social() {
		global $post;
		$facebook    = get_user_meta( $post->post_author, 'facebook', true );
		$twitter     = get_user_meta( $post->post_author, 'twitter', true );
		$linkedin    = get_user_meta( $post->post_author, 'linkedin', true );
		$google_plus = get_user_meta( $post->post_author, 'google_plus', true );

		if ( ! empty( $facebook || $twitter || $linkedin || $google_plus ) ) { ?>

			<ul class="list-unstyled social-basic">
				<?php

				if ( $facebook ) {
					?>
					<li>
						<a href="<?php echo esc_url( $facebook ); ?>">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
					<?php
				}

				if ( $twitter ) {
					?>
					<li>
						<a href="<?php echo esc_url( $twitter ); ?>">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<?php
				}

				if ( $linkedin ) {
					?>
					<li>
						<a href="<?php echo esc_url( $linkedin ); ?>">
							<i class="fa fa-linkedin-in"></i>
						</a>
					</li>
					<?php
				}

				if ( $google_plus ) {
					?>
					<li>
						<a href="<?php echo esc_url( $google_plus ); ?>">
							<i class="fa fa-google-plus-g"></i>
						</a>
					</li>
					<?php
				}
				?>

			</ul>

			<?php
		}
	}

	public static function setPostViews( $postID ) {
		$countKey = 'post_views_count';
		$count    = get_post_meta( $postID, $countKey, true );
		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $countKey );
			add_post_meta( $postID, $countKey, '0' );
		} else {
			$count++;
			update_post_meta( $postID, $countKey, $count );
		}
	}

	public static function page_id() {
		$id = '';
		if ( class_exists( 'woocommerce' ) && is_shop() || class_exists( 'woocommerce' ) && is_product_taxonomy() ) {
			$id = wc_get_page_id( 'shop' );
		} elseif ( class_exists( 'woocommerce' ) && is_cart() ) {
			$id = wc_get_page_id( 'cart' );
		} elseif ( class_exists( 'woocommerce' ) && is_checkout() ) {
			$id = wc_get_page_id( 'checkout' );
		} elseif ( class_exists( 'woocommerce' ) && is_account_page() ) {
			$id = wc_get_page_id( 'myaccount' );
		} elseif ( is_archive() || is_home() || is_search() ) {
			$id = get_option( 'page_for_posts' );
		} else {
			$id = get_the_ID();
		}
		return $id;
	}

	public static function time() {
		$markup     = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $markup, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date() );
		return sprintf( '<a href="%s" rel="bookmark">%s</a>', esc_url( get_permalink() ), $time_string );
	}

	public static function pagination() {
		wp_link_pages(
			array(
				'before'   => '<div class="m-top-50"><nav class="navigation pagination d-flex justify-content-center" role="navigation"><div class="nav-links">',
				'after'    => '</div></nav></div>',
				'pagelink' => '<span class="page-numbers">%</span>',
			)
		);
	}

	public static function image_alt( $id = null ) {
		if ( is_object( $id ) || is_array( $id ) ) :

			if ( isset( $id['attachment_id'] ) ) :
				$post = get_post( $id['attachment_id'] );
				if ( is_object( $post ) ) :
					if ( $post->post_excerpt ) :
						return $post->post_excerpt;
					else :
						return $post->post_title;
					endif;
				endif;
			else :
				return false;
			endif;

		elseif ( $id > 0 ) :

			$post = get_post( $id );
			if ( is_object( $post ) ) :
				if ( $post->post_excerpt ) :
					return $post->post_excerpt;
				else :
					return $post->post_title;
				endif;
			endif;

		endif;
	}

	public static function using_elementor() {
		global $post;
		if ( in_array( 'elementor/elementor.php', (array) get_option( 'active_plugins' ) ) ) {
			return \Elementor\Plugin::$instance->db->is_built_with_elementor( $post->ID );
		}
	}

	public static function directorist() {
		return class_exists( 'Directorist_Base' ) ? true : false;
	}

	public static function woocommerce() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}


	public static function social_url( $name ) {
		$listingURL   = urlencode( get_permalink() );
		$listingTitle = str_replace( ' ', '%20', get_the_title() );

		$facebookURL = "https://www.facebook.com/share.php?u={$listingURL}&title={$listingTitle}";
		$twitterURL  = "http://twitter.com/share?url={$listingURL}";
		$linkedin    = "http://www.linkedin.com/shareArticle?mini=true&url={$listingURL}&title={$listingTitle}";
		if ( $name == 'facebook' ) {
			return esc_url( $facebookURL );
		}
		if ( $name == 'twitter' ) {
			return esc_url( $twitterURL );
		}
		if ( $name == 'linkedin' ) {
			return esc_url( $linkedin );
		}
	}

	public static function listing_share() {
		?>

		<span class="dropdown-toggle" id="social-links" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
			<span class="la la-share"></span>
			<?php esc_html_e( 'Share', 'findbiz' ); ?>
		</span>

		<div class="atbd_director_social_wrap dropdown-menu" aria-labelledby="social-links">
			<ul class="list-unstyled">
				<li>
					<a href="<?php echo self::social_url( 'facebook' ); ?>" target="_blank">
						<span class="fab fa-facebook color-facebook"></span><?php esc_html_e( 'Facebook', 'findbiz' ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo self::social_url( 'twitter' ); ?>" target="_blank">
						<!-- twitter icon by Icons8 -->
						<span class="fab fa-twitter color-twitter"></span><?php esc_html_e( 'Twitter', 'findbiz' ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo self::social_url( 'linkedin' ); ?>" target="_blank">
						<!-- linkedin icon by Icons8 -->
						<span class="fab fa-linkedin-in color-linkedin"></span><?php esc_html_e( 'LinkedIn', 'findbiz' ); ?>
					</a>
				</li>
			</ul>
			<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		</div>

		<?php
	}

	// dashboard notification info
	public static function dashboard_notification() {
		if ( isset( $_GET['renew'] ) && ( 'token_expired' === $_GET['renew'] ) ) {
			?>
			<div class="alert alert-danger">
				<i class="la la-times-circle"></i>
				<?php _e( 'Link appears to be invalid.', 'findbiz' ); ?>
			</div>
			<?php
		}

		if ( isset( $_GET['renew'] ) && ( 'success' === $_GET['renew'] ) ) {
			?>
			<div class="alert alert-success">
				<i class="la la-check-circle"></i>
				<?php _e( 'Renewed successfully.', 'findbiz' ); ?>
			</div>
			<?php
		}
	}

	public static function header_footer() {
		$checked_id_one = preg_match( '/(listing-listings_with_map)/', get_post_field( 'post_content', get_the_ID() ) );
		$checked_one    = ( 1 === $checked_id_one ) ? true : false;
		if ( is_404() || is_search() ) {
			return false;
		} elseif ( $checked_one ) {
			return true;
		} else {
			return false;
		}
	}

	public static function directory_listing_type() {
		$listing_type = ! empty( $_GET['directory_type'] ) ? $_GET['directory_type'] : directorist_default_directory();
		$term         = get_term_by( is_numeric( $listing_type ) ? 'id' : 'slug', $listing_type, ATBDP_TYPE );
		return $term->term_id;
	}
}
