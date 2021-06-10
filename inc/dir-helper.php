<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

use ATBDP_Permalink;

class DirHelper {

	public function __construct() {
		// disable contact form 7 auto p tag.
		add_action( 'wpcf7_autop_or_not', '__return_false' );

		// single listing shortcodes.
		add_shortcode( 'findbiz_listing_gallery', array( $this, 'gallery' ) );

		// login actions hook.
		add_action( 'init', array( $this, 'login_init' ) );

		// locations & cats.
		add_action( 'atbdp_all_locations_after_location_name', array( $this, 'atbdp_all_listings_meta_count' ), 10, 2 );
		add_action( 'atbdp_all_categories_after_category_name', array( $this, 'atbdp_all_listings_cat_meta_count' ), 10, 2 );

		// Listings with map header title All Items heading.
		add_action( 'bdmv_after_filter_button_in_listings_header', array( $this, 'listings_with_map_header' ), 10, 2 );

		// Findbiz core script.
		add_action( 'wp_enqueue_scripts', array( $this, 'core_script' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'menu_responsive' ) );
	}

	//Plugin main js scripts.
	public function core_script() {
		wp_enqueue_script( 'findbiz-core-main', plugin_dir_url( __DIR__ ) . 'assets/main.js', array( 'jquery' ), null, true );
	}

	//Theme option responsive localized.
	public function menu_responsive() {
		$width = get_option( 'findbiz' )['resmenu_width'];
		wp_localize_script( 'findbiz-core-main', 'responsiveObj', array(
			'width' => $width,
		) );
	}

	// Login functions
	public function login_init() {
		wp_enqueue_script( 'ajax-login-script', get_theme_file_uri( 'theme_assets/js/ajax-login-register-script.js' ), 'jquery', null, true );
		$password = class_exists( 'Directorist_Base' ) ? get_directorist_option( 'display_password_reg', 1 ) : '';
		$notice   = ! $password ? __( ' Go to your inbox or spam/junk and get your password.', 'findbiz-core' ) : __( ' Congratulations! Registration completed.', 'findbiz-core' );

		wp_localize_script(
			'ajax-login-script',
			'findbiz_ajax_login_object',
			array(
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'redirecturl'               => ( class_exists( 'Directorist_Base' ) ) ? ATBDP_Permalink::get_login_redirection_page_link() : home_url( '/' ),
				'loadingmessage'            => esc_html__( 'Sending user info, please wait...', 'findbiz-core' ),
				'registration_confirmation' => $notice,
				'login_failed'              => esc_html__( 'Sorry! Login failed', 'findbiz-core' ),
			)
		);

		add_action( 'wp_ajax_nopriv_findbiz_ajaxlogin', array( $this, 'login' ) );
		add_action( 'wp_ajax_nopriv_findbiz_recovery_password', array( $this, 'password_recovery' ) );
	}

	public function login() {
		// First check the nonce, if it fails the function will break
		
		// check_ajax_referer( 'ajax-login-nonce', 'findbiz-security' );

		$username       = $_POST['username'];
		$user_password  = $_POST['password'];
		$keep_signed_in = ! empty( $_POST['rememberme'] ) ? true : false;
		$user           = wp_authenticate( $username, $user_password );
		if ( is_wp_error( $user ) ) {
			echo json_encode(
				array(
					'loggedin' => false,
					'message'  => __(
						'Wrong username or password.',
						'findbiz-core'
					),
				)
			);
		} else {
			wp_set_current_user( $user->ID );
			wp_set_auth_cookie( $user->ID, $keep_signed_in );
			echo json_encode(
				array(
					'loggedin' => true,
					'message'  => __(
						'Login successful',
						'findbiz-core'
					),
				)
			);
		}
		exit();
	}

	function password_recovery() {
		global $wpdb;
		$error   = '';
		$success = '';
		$email   = trim( $_POST['user_login'] );
		if ( empty( $email ) ) {
			$error = esc_html__( 'Enter a username or e-mail address..', 'findbiz-core' );
		} elseif ( ! is_email( $email ) ) {
			$error = esc_html__( 'Invalid username or e-mail address.', 'findbiz-core' );
		} elseif ( ! email_exists( $email ) ) {
			$error = esc_html__( 'There is no user registered with that email address.', 'findbiz-core' );
		} else {
			$random_password = wp_generate_password( 12, false );
			$user            = get_user_by( 'email', $email );
			$update_user     = update_user_meta( $user->ID, '_atbdp_recovery_key', $random_password );

			// if  update user return true then lets send user an email containing the new password
			if ( $update_user ) {
				$subject = esc_html__( '	Password Reset Request', 'findbiz-core' );
				// $message = esc_html__('Your new password is: ', 'findbiz-core') . $random_password;

				$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
				$message   = __( 'Someone has requested a password reset for the following account:', 'findbiz-core' ) . '<br>';
				/* translators: %s: site name */
				$message .= sprintf( __( 'Site Name: %s', 'findbiz-core' ), $site_name ) . '<br>';
				/* translators: %s: user login */
				$message .= sprintf( __( 'User: %s', 'findbiz-core' ), $user->user_login ) . '<br>';
				$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'findbiz-core' ) . '<br>';
				$message .= __( 'To reset your password, visit the following address:', 'findbiz-core' ) . '<br>';
				$link     = array(
					'key'  => $random_password,
					'user' => $email,
				);
				$message .= '<a href="' . esc_url( add_query_arg( $link, ATBDP_Permalink::get_login_page_url() ) ) . '">' . esc_url( add_query_arg( $link, ATBDP_Permalink::get_login_page_url() ) ) . '</a>';

				$message = atbdp_email_html( $subject, $message );

				$headers[] = 'Content-Type: text/html; charset=UTF-8';
				$mail      = wp_mail( $email, $subject, $message, $headers );
				if ( $mail ) {
					$success = __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox.', 'findbiz-core' );
				} else {
					$error = __( 'Password updated! But something went wrong sending email.', 'findbiz-core' );
				}
			} else {
				$error = esc_html__( 'Oops something went wrong updaing your account.', 'findbiz-core' );
			}
		}

		if ( ! empty( $error ) ) {
			echo json_encode(
				array(
					'loggedin' => false,
					'message'  => $error,
				)
			);
		}

		if ( ! empty( $success ) ) {
			echo json_encode(
				array(
					'loggedin' => true,
					'message'  => $success,
				)
			);
		}

		die();
	}

	//Contact button of listings card
	public static function contact_form( $listing_id ) {
		?>
		<div class="atbdp-widget-listing-contact contact-form">
			<div class="atbd_contfindbiz_public_send_contact_emailent_module atbd_contact_information_module">
				<form id="findbiz-contact-owner-form" class="form-vertical contact_listing_owner" role="form">
					<div class="form-group">
						<input type="text" class="form-control" id="atbdp-contact-name" placeholder="<?php esc_html_e( 'Name', 'directorist' ); ?>" required />
					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="atbdp-contact-email" placeholder="<?php esc_html_e( 'Email', 'directorist' ); ?>" required />
					</div>

					<div class="form-group">
						<textarea class="form-control" id="atbdp-contact-message" rows="3" placeholder="<?php esc_html_e( 'Messagess', 'directorist' ); ?>..." required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							<?php esc_html_e( 'Submit', 'directorist' ); ?>
						</button>
					</div>

					<p id="atbdp-contact-message-display"></p>
				</form>
			</div>
			<input type="hidden" id="atbdp-post-id" value="<?php echo esc_attr( $listing_id ); ?>" />
			<input type="hidden" id="atbdp-listing-email" value="<?php echo ! empty( $email ) ? sanitize_email( $email ) : ''; ?>" />
		</div>
		<?php
	}

	//Directory type
	public static function directorist_listing_types() {
		$all_types = class_exists( 'Directorist_Base' ) ? directory_types() : [];
		$types     = array();
		foreach ( $all_types as $type ) {
			$types[ $type->slug ] = $type->name;
		}
		return $types;
	}

	public static function atbdp_all_listings_meta_count( $html, $term ) {
		$total = $term->count;
		$str   = ( 1 == $total ) ? __( ' Listing', 'findbiz-core' ) : __( ' Listings', 'findbiz-core' );
		return '<span class="listing-count"> ' . $total . '<span class="listing-label">' . $str . '</span>' . '</span>';
	}

	public static function atbdp_all_listings_cat_meta_count( $html, $term ) {
		return $term->count;
	}

	public static function listings_with_map_header() {
		echo '<h4>' . __( 'All Items', 'findbiz-core' ) . '</h4>';
	}

	// Elementor functions
	public static function categories() {
		$categories = get_terms( 'at_biz_dir-category' );
		$cat        = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$cat[ $category->slug ] = $category->name;
			}
			wp_reset_postdata();
		}
		return $cat;
	}

	public static function tags() {
		$tags   = get_terms( 'at_biz_dir-tags' );
		$all_tag = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$all_tag[ $tag->slug ] = $tag->name;
			}
		}
		return $all_tag;
	}

	public static function locations() {
		$locations = get_terms( 'at_biz_dir-location' );
		$loc       = array();
		if ( $locations ) {
			foreach ( $locations as $location ) {
				$loc[ $location->slug ] = $location->name;
			}
		}
		return $loc;
	}

	public static function cf7_names() {
		global $wpdb;
		$cf7_list = $wpdb->get_results(
			"SELECT ID, post_title
                    FROM $wpdb->posts
                    WHERE post_type = 'wpcf7_contact_form'"
		);
		$cf7_val  = array();
		if ( $cf7_list ) {
			$cf7_val[0] = __( 'Select a Contact Form', 'findbiz' );
			foreach ( $cf7_list as $value ) {
				$cf7_val[ $value->ID ] = $value->post_title;
			}
		} else {
			$cf7_val[0] = esc_html__( 'No contact forms found', 'findbiz' );
		}
		return $cf7_val;
	}

	// listing badges
	public static function badges() {
		$featured      = get_post_meta( get_the_ID(), '_featured', true );
		$feature_badge = get_directorist_option( 'feature_badge', 1 );
		$feature_text  = get_directorist_option( 'feature_badge_text', 'Featured' );
		$popular_text  = get_directorist_option( 'popular_badge_text', 'Popular' );
		$id            = atbdp_popular_listings( get_the_ID() );
		?>
		<ul class="list-unstyled listing-info--badges">
			<?php

			if ( $featured && ! empty( $feature_badge ) ) {
				echo sprintf( '<li><span class="atbd_badge atbd_badge_featured">%s</span></li>', esc_attr( $feature_text ) );
			}

			if ( $id === get_the_ID() ) {
				echo sprintf( '<li><span class="atbd_badge atbd_badge_popular">%s</span></li>', esc_attr( $popular_text ) );
			}

			if ( new_badge() ) {
				echo sprintf( '<li>%s</li>', new_badge() );
			}
			?>
		</ul>
		<?php
	}

	public static function reviews() {
		$enable_review = get_directorist_option( 'enable_review', 'yes' );
		if( ! $enable_review ) return;

		$average = ATBDP()->review->get_average( get_the_ID() );
		$average_int_float = ! strchr( $average, '.' ) ? $average . '.0' : $average;
		?>
		<div class="atbd_rated_stars">
			<ul>
				<?php
				$star      = '<i class="la la-star rate_active"></i>';
				$half_star = '<i class="la la-star-half-o rate_active"></i>';
				$none_star = '<i class="la la-star-o rate_disable"></i>';

				if ( ! strchr( $average, '.' ) ) {
					for ( $i = 1; $i <= 5; $i++ ) {
						if ( $i <= $average ) {
							echo wp_kses_post( $star );
						} else {
							echo wp_kses_post( $none_star );
						}
					}
					wp_reset_postdata();
				} elseif ( strchr( $average, '.' ) ) {
					$exp       = explode( '.', $average );
					$float_num = $exp[0];

					for ( $i = 1; $i <= 5; $i++ ) {
						if ( $i <= $average ) {
							echo wp_kses_post( $star );
						} elseif ( ! empty( $average ) && $i > $average && $i <= $float_num + 1 ) {
							echo wp_kses_post( $half_star );
						} else {
							echo wp_kses_post( $none_star );
						}
					}
					wp_reset_postdata();
				}

				echo sprintf( '<span class="atbd_count"><span>%s </span>%s %s </span>', esc_attr( $average_int_float ), esc_attr( $reviews_count ), esc_attr( $review_text ) );
				?>

			</ul>
		</div>
		<?php
	}

	//single listing gallery section
	public static function gallery() {
		$listing_img                 = array();
		$title                       = get_directorist_option( 'findbiz_details_text', __( 'Gallery', 'findbiz-core' ) );
		$listing_info['listing_img'] = get_post_meta( get_the_ID(), '_listing_img', true );
		extract( $listing_info );
		?>

		<div class="atbd_content_module atbd_listing_details">

			<?php if ( $title ) { ?>
				<div class="atbd_content_module__tittle_area">
					<div class="atbd_area_title">
						<h4>
							<span class="la la-image atbd_area_icon"></span>
							<?php echo esc_attr( $title ); ?>
						</h4>
					</div>
				</div>
				<?php
			}

			if ( $listing_img ) {
				?>
				<div class="atbdb_content_module_contents">
					<div class="atbd_directry_gallery_wrapper">
						<ul class="single-listing-gallery popup-gallery">
							<?php
							foreach ( $listing_img as $ids ) {
								$image   = wp_get_attachment_image_src( $ids, 'listing-gallery', false );
								$preview = wp_get_attachment_image_src( $ids, 'full', false );
								?>
								<li>
									<figure>
										<img src="<?php echo $image ? esc_url( $image[0] ) : ''; ?>" alt="<?php echo esc_attr( Helper::image_alt( $ids ) ); ?>">
										<figcaption>
											<a href="<?php echo $preview ? esc_url( $preview[0] ) : ''; ?>" class="hoverZoomLink">
												<span class="la la-search-plus"></span>
											</a>
										</figcaption>
									</figure>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
				<?php
			}
			?>

		</div>
		<?php
	}

	public static function findbiz_get_form_field( $listing, $key ) {
		$submission_form_fields = get_term_meta( $listing->type, 'submission_form_fields', true );
		if ( ! empty( $submission_form_fields['fields'][ $key ] ) ) {
			return $submission_form_fields['fields'][ $key ];
		} else {
			return false;
		}
	}

	public static function findbiz_single_has_slider( $listing ) {
		$image_upload = self::findbiz_get_form_field( $listing, 'image_upload' );
		if ( ! $image_upload ) {
			return false;
		}

		$plan_id    = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_photo = true;
		if ( is_fee_manager_active() ) {
			$plan_photo = is_plan_allowed_slider( $plan_id );
		}
		if ( ! $plan_photo ) {
			return false;
		}

		$listing_img = get_post_meta( get_the_ID(), '_listing_img', true );
		if ( ! $listing_img ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_video( $listing ) {
		$video = self::findbiz_get_form_field( $listing, 'video' );
		if ( ! $video ) {
			return false;
		}

		$plan_video = true;
		$fm_plan    = get_post_meta( get_the_ID(), '_fm_plans', true );
		if ( is_fee_manager_active() ) {
			$plan_video = is_plan_allowed_listing_video( $fm_plan );
		}

		if ( ! $plan_video ) {
			return false;
		}

		$value = ! empty( $video['field_key'] ) ? get_post_meta( $listing->id, '_' . $video['field_key'], true ) : '';

		if ( ! $value ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_review( $listing ) {
		$plan_id     = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_review = true;
		if ( is_fee_manager_active() ) {
			$plan_review = is_plan_allowed_listing_review( $plan_id );
		}
		if ( ! $plan_review ) {
			return false;
		}

		$enable_review = get_directorist_option( 'enable_review', 'yes' );
		if ( ! $enable_review ) {
			return false;
		}

		return true;
	}

	public static function findbiz_single_has_owner_contact( $listing ) {
		$plan_id      = get_post_meta( get_the_ID(), '_fm_plans', true );
		$plan_contact = true;
		if ( is_fee_manager_active() ) {
			$plan_contact = is_plan_allowed_owner_contact_widget( $plan_id );
		}
		if ( ! $plan_contact ) {
			return false;
		}

		return true;
	}

	public static function findbiz_file_get_video_contents( $url ) {
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

		$data = curl_exec( $ch );
		curl_close( $ch );

		return $data;
	}

	public static function all_listings_wrapper() {
		return esc_attr( ' all-listings-carousel owl-carousel ' );
	}

}

new DirHelper();
