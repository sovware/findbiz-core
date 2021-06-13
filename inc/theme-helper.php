<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class Helper {

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
			<?php esc_html_e( 'Share', 'findbiz-core' ); ?>
		</span>

		<div class="atbd_director_social_wrap dropdown-menu" aria-labelledby="social-links">
			<ul class="list-unstyled">
				<li>
					<a href="<?php echo self::social_url( 'facebook' ); ?>" target="_blank">
						<span class="fab fa-facebook color-facebook"></span><?php esc_html_e( 'Facebook', 'findbiz-core' ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo self::social_url( 'twitter' ); ?>" target="_blank">
						<!-- twitter icon by Icons8 -->
						<span class="fab fa-twitter color-twitter"></span><?php esc_html_e( 'Twitter', 'findbiz-core' ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo self::social_url( 'linkedin' ); ?>" target="_blank">
						<!-- linkedin icon by Icons8 -->
						<span class="fab fa-linkedin-in color-linkedin"></span><?php esc_html_e( 'LinkedIn', 'findbiz-core' ); ?>
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
				<?php _e( 'Link appears to be invalid.', 'findbiz-core' ); ?>
			</div>
			<?php
		}

		if ( isset( $_GET['renew'] ) && ( 'success' === $_GET['renew'] ) ) {
			?>
			<div class="alert alert-success">
				<i class="la la-check-circle"></i>
				<?php _e( 'Renewed successfully.', 'findbiz-core' ); ?>
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

	public static function options() {
		return get_option('findbiz');
	}

}
