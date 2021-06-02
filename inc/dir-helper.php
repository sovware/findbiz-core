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
		// disable contact form 7 auto p tag
		add_action( 'wpcf7_autop_or_not', '__return_false' );

		// single listing shortcodes
		add_shortcode( 'findbiz_listing_gallery', array( $this, 'gallery' ) );

		// login actions hook
		add_action( 'init', array( $this, 'login_init' ) );

		// search form
		add_action( 'atbdp_search_form_fields', array( $this, 'search_form' ) );

		// price and review
		add_action( 'atbdp_listings_review_price', array( $this, 'review_price' ) );
		add_action( 'atbdp_listings_list_review_price', array( $this, 'review_price' ) );

		// locations & cats
		add_action( 'atbdp_all_locations_after_location_name', array( $this, 'atbdp_all_listings_meta_count' ), 10, 2 );
		add_action( 'atbdp_all_categories_after_category_name', array( $this, 'atbdp_all_listings_cat_meta_count' ), 10, 2 );

		// locations & cats
		add_action( 'bdmv_after_filter_button_in_listings_header', array( $this, 'listings_with_map_header' ), 10, 2 );

		// Findbiz core script.
		add_action( 'wp_enqueue_scripts', array( $this, 'core_script' ), 10, 2 );

	}

	/* Plugin scripts */
	public function core_script() {
		wp_enqueue_script( 'findbiz-core-main', plugin_dir_url( __DIR__ ) . 'assets/main.js', array( 'jquery' ), null, true );
	}

	// Login functions
	public function login_init() {
		wp_enqueue_script( 'ajax-login-script', get_theme_file_uri( 'theme_assets/js/ajax-login-register-script.js' ), 'jquery', null, true );
		$password = get_directorist_option( 'display_password_reg', 1 );
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
		check_ajax_referer( 'ajax-login-nonce', 'security' );
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

	// search form
	public static function search_form( $input = 'yes', $input_ph = '', $cat = 'yes', $cat_ph = '', $loc = 'yes', $loc_ph = '', $btn = '', $more = '' ) {
		$input_re = get_directorist_option( 'require_search_text' ) ? 'required' : '';
		$cat_re   = get_directorist_option( 'require_search_category' ) ? 'required' : '';
		$loc_re   = get_directorist_option( 'require_search_location' ) ? 'required' : '';
		$address  = get_directorist_option( 'search_location_address', 'address' );
		$fields   = get_directorist_option( 'search_tsc_fields', array( 'search_text', 'search_category', 'search_location' ) );

		$args = array(
			'parent'             => 0,
			'term_id'            => 0,
			'hide_empty'         => 0,
			'orderby'            => 'name',
			'order'              => 'asc',
			'show_count'         => 0,
			'single_only'        => 0,
			'pad_counts'         => true,
			'immediate_category' => 0,
			'active_term_id'     => 0,
			'ancestors'          => array(),
		);

		if ( $input && in_array( 'search_text', $fields ) ) {
			$cat_off = ! $cat ? 'findbiz_' : ''; ?>

			<div class="single_search_field <?php echo $cat_off; ?>search_query">
				<input class="form-control search_fields" type="text" name="q" <?php echo esc_attr( $input_re ); ?> autocomplete="off" placeholder="<?php echo esc_html( $input_ph ); ?>">
			</div>

			<?php
		}

		if ( $cat && in_array( 'search_category', $fields ) ) {
			?>

			<div class="single_search_field search_category" id="search_listing_category">
				<select <?php echo esc_attr( $cat_re ); ?> name="in_cat" class="search_fields form-control" id="at_biz_dir-category">
					<option value=""><?php echo esc_html( $cat_ph ); ?></option>
					<?php echo search_category_location_filter( $args, ATBDP_CATEGORY ); ?>
				</select>
			</div>

			<?php
			do_action( 'atbdp_search_listing_after_category_field' );
		}

		if ( $loc && in_array( 'search_location', $fields ) ) {

			if ( 'listing_location' == $address ) {
				?>

				<div class="single_search_field search_location">
					<select <?php echo esc_attr( $loc_re ); ?> name="in_loc" class="search_fields form-control" id="at_biz_dir-location">
						<option value=""><?php echo esc_html( $loc_ph ); ?></option>
						<?php echo search_category_location_filter( $args, ATBDP_LOCATION ); ?>
					</select>
				</div>

				<?php
			} else {
				wp_enqueue_script( 'atbdp-geolocation' );
				$address = ! empty( $_GET['address'] ) ? $_GET['address'] : '';
				$map     = get_directorist_option( 'map', 'google' );
				?>

				<div class="single_search_field atbdp_map_address_field">
					<div class="atbdp_get_address_field">
						<input type="text" id="address" name="address" autocomplete="off" value="<?php echo esc_attr( $address ); ?>" placeholder="<?php echo esc_html( $loc_ph ); ?>" <?php echo esc_attr( $loc_re ); ?> class="form-control location-name">
						<span class="atbd_get_loc la la-crosshairs"></span>
					</div>

					<?php echo 'google' != $map ? wp_kses_post( '<div class="address_result"></div>' ) : ''; ?>

					<input type="hidden" id="cityLat" name="cityLat" value="" />
					<input type="hidden" id="cityLng" name="cityLng" value="" />
				</div>
				<?php
			}
		}
		?>

		<div class="atbd_submit_btn">

			<button type="submit" class="btn_search">
				<i class="la la-search"></i><?php echo esc_attr( $btn ); ?>
			</button>

			<?php if ( 'yes' == $more ) { ?>
				<button class="more-filter">
					<span class="<?php atbdp_icon_type( true ); ?>-filter"></span>
				</button>
			<?php } ?>
		</div>

		<?php
	}

	public static function search_more() {
		$filters   = get_directorist_option( 'search_filters', array( 'search_reset_filters', 'search_apply_filters' ) );
		$reset_btn = get_directorist_option( 'sresult_reset_text', esc_html__( 'Reset Filters', 'findbiz-core' ) );
		$apply_btn = get_directorist_option( 'sresult_apply_text', esc_html__( 'Apply Filters', 'findbiz-core' ) );
		$fields    = get_directorist_option( 'search_more_filters_fields', array( 'search_price', 'search_price_range', 'search_rating', 'search_tag', 'search_custom_fields', 'radius_search' ) );
		$tag       = get_directorist_option( 'tag_label', esc_html__( 'Tag', 'findbiz-core' ) );
		$address   = get_directorist_option( 'address_label', esc_html__( 'Address', 'findbiz-core' ) );
		$fax       = get_directorist_option( 'fax_label', esc_html__( 'Fax', 'findbiz-core' ) );
		$email     = get_directorist_option( 'email_label', esc_html__( 'Email', 'findbiz-core' ) );
		$website   = get_directorist_option( 'website_label', esc_html__( 'Website', 'findbiz-core' ) );
		$zip       = get_directorist_option( 'zip_label', esc_html__( 'Zip', 'findbiz-core' ) );
		$currency  = get_directorist_option( 'g_currency', 'USD' );
		$c_symbol  = atbdp_currency_symbol( $currency );
		$location  = get_directorist_option( 'search_location_address', 'address' );
		?>

		<div class="ads_float">
			<div class="ads-advanced">

				<form action="<?php echo ATBDP_Permalink::get_search_result_page_link(); ?>" role="form">

					<?php

					if ( in_array( 'search_price', $fields ) || in_array( 'search_price_range', $fields ) ) {
						?>

						<div class="form-group ">
							<label class=""><?php esc_html_e( 'Price Range', 'findbiz-core' ); ?></label>
							<div class="price_ranges">

								<?php

								if ( in_array( 'search_price', $fields ) ) {
									$min = ( isset( $_GET['price'] ) ) ? esc_attr( $_GET['price'][0] ) : '';
									$max = ( isset( $_GET['price'] ) ) ? esc_attr( $_GET['price'][1] ) : '';
									?>

									<div class="range_single">
										<input type="text" name="price[0]" class="form-control" placeholder="<?php _e( 'Min Price', 'findbiz-core' ); ?>" value="<?php echo esc_attr( $min ); ?>">
									</div>
									<div class="range_single">
										<input type="text" name="price[1]" class="form-control" placeholder="<?php _e( 'Max Price', 'findbiz-core' ); ?>" value="<?php echo esc_attr( $max ); ?>">
									</div>

								<?php } ?>

								<?php

								if ( in_array( 'search_price_range', $fields ) ) {
									$bellow   = isset( $_GET['price_range'] ) && ( 'bellow_economy' == isset( $_GET['price_range'] ) ) ? "checked='checked'" : '';
									$economy  = ( isset( $_GET['price_range'] ) && 'economy' == isset( $_GET['price_range'] ) ) ? "checked='checked'" : '';
									$moderate = ( isset( $_GET['price_range'] ) && 'moderate' == isset( $_GET['price_range'] ) ) ? "checked='checked'" : '';
									$skimming = ( isset( $_GET['price_range'] ) && 'skimming' == isset( $_GET['price_range'] ) ) ? "checked='checked'" : '';
									?>

									<div class="price-frequency">

										<label class="pf-btn">
											<input type="radio" name="price_range" value="bellow_economy" <?php echo esc_html( $bellow ); ?>>
											<span><?php echo esc_attr( $c_symbol ); ?></span>
										</label>

										<label class="pf-btn">
											<input type="radio" name="price_range" value="economy" <?php echo esc_html( $economy ); ?>>
											<span><?php echo esc_attr( $c_symbol . $c_symbol ); ?></span>
										</label>

										<label class="pf-btn">
											<input type="radio" name="price_range" value="moderate" <?php echo esc_html( $moderate ); ?>>
											<span><?php echo esc_attr( $c_symbol . $c_symbol . $c_symbol ); ?></span>
										</label>

										<label class="pf-btn">
											<input type="radio" name="price_range" value="skimming" <?php echo esc_html( $skimming ); ?>>
											<span><?php echo esc_attr( $c_symbol . $c_symbol . $c_symbol . $c_symbol ); ?></span>
										</label>

									</div>

								<?php } ?>

							</div>
						</div>
						<?php
					}

					if ( in_array( 'search_rating', $fields ) ) {
						$star5 = ( isset( $_GET['search_by_rating'] ) && '5' == isset( $_GET['search_by_rating'] ) ) ? 'selected' : '';
						$star4 = ( isset( $_GET['search_by_rating'] ) && '4' == isset( $_GET['search_by_rating'] ) ) ? 'selected' : '';
						$star3 = ( isset( $_GET['search_by_rating'] ) && '3' == isset( $_GET['search_by_rating'] ) ) ? 'selected' : '';
						$star2 = ( isset( $_GET['search_by_rating'] ) && '2' == isset( $_GET['search_by_rating'] ) ) ? 'selected' : '';
						$star1 = ( isset( $_GET['search_by_rating'] ) && '1' == isset( $_GET['search_by_rating'] ) ) ? 'selected' : '';
						?>
						<div class="form-group">
							<label for="filter-ratings"><?php _e( 'Filter by Ratings', 'findbiz-core' ); ?></label>

							<select id="filter-ratings" name='search_by_rating' class="select-basic form-control">

								<option value=""><?php _e( 'Select Ratings', 'findbiz-core' ); ?></option>

								<option value="5" <?php echo esc_html( $star5 ); ?>> <?php _e( '5 Star', 'findbiz-core' ); ?> </option>

								<option value="4" <?php echo esc_html( $star4 ); ?>> <?php _e( '4 Star & Up', 'findbiz-core' ); ?> </option>

								<option value="3" <?php echo esc_html( $star3 ); ?>> <?php _e( '3 Star & Up', 'findbiz-core' ); ?> </option>

								<option value="2" <?php echo esc_html( $star2 ); ?>> <?php _e( '2 Star & Up', 'findbiz-core' ); ?> </option>

								<option value="1" <?php echo esc_html( $star1 ); ?>> <?php _e( '1 Star & Up', 'findbiz-core' ); ?> </option>

							</select>
						</div>
						<?php
					}

					if ( in_array( 'search_open_now', $fields ) && in_array( 'directorist-business-hours/bd-business-hour.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
						$open_now = ( isset( $_GET['open_now'] ) && 'open_now' == isset( $_GET['open_now'] ) ) ? "checked='checked'" : '';
						?>
						<div class="form-group">
							<label><?php _e( 'Open Now', 'findbiz-core' ); ?></label>
							<div class="check-btn">
								<div class="btn-checkbox">
									<label>
										<input type="checkbox" name="open_now" value="open_now" <?php echo esc_html( $open_now ); ?>>
										<span><i class="fa fa-clock-o"></i><?php _e( 'Open Now', 'findbiz-core' ); ?> </span>
									</label>
								</div>
							</div>
						</div>
						<?php
					}

					$radius = '';
					if ( 'map_api' == $location && in_array( 'radius_search', $fields ) ) {
						$radius = get_directorist_option( 'search_default_radius_distance', 0 );
						?>
						<div class="form-group">
							<div class="atbdp-range-slider-wrapper">
								<span><?php _e( 'Radius Search', 'findbiz-core' ); ?></span>
								<div>
									<div id="atbdp-range-slider"></div>
								</div>
								<p class="atbd-current-value"></p>
							</div>
							<input type="hidden" class="atbdrs-value" name="miles" value="<?php echo ! empty( $radius ) ? $radius : 0; ?>" />
						</div>
						<?php
					}

					if ( in_array( 'search_tag', $fields ) ) {
						$terms = get_terms( ATBDP_TAGS );
						if ( $terms ) {
							?>
							<div class="form-group ads-filter-tags">

								<label><?php echo $tag ? esc_attr( $tag ) : __( 'Tags', 'findbiz-core' ); ?></label>

								<div class="bads-custom-checks">
									<?php
									$rand = rand();
									foreach ( $terms as $term ) {
										?>
										<div class="custom-control custom-checkbox checkbox-outline checkbox-outline-primary">
											<input type="checkbox" class="custom-control-input" name="in_tag[]" value="<?php echo $term->term_id; ?>" id="<?php echo esc_attr( $rand . $term->term_id ); ?>">
											<span class="check--select"></span>
											<label for="<?php echo esc_attr( $rand . $term->term_id ); ?>" class="custom-control-label">
												<?php echo esc_attr( $term->name ); ?>
											</label>
										</div>
									<?php } ?>
								</div>

								<a href="#" class="more-or-less sml"> <?php esc_html_e( 'Show More', 'findbiz-core' ); ?> </a>

							</div>
							<?php
						}
					}

					if ( in_array( 'search_custom_fields', $fields ) ) {
						?>

						<div id="atbdp-custom-fields-search" class="form-group ads-filter-tags atbdp-custom-fields-search">
							<?php do_action( 'wp_ajax_atbdp_custom_fields_search', isset( $_GET['in_cat'] ) ? $_GET['in_cat'] : 0 ); ?>
						</div>
						<?php
					}

					if ( in_array( 'search_website', $fields ) || in_array( 'search_email', $fields ) || in_array( 'search_phone', $fields ) || in_array( 'search_fax', $fields ) || in_array( 'search_address', $fields ) || in_array( 'search_zip_code', $fields ) ) {
						?>

						<div class="form-group">
							<div class="bottom-inputs">
								<?php
								if ( in_array( 'search_website', $fields ) ) {
									?>
									<div>
										<input type="text" name="website" placeholder="<?php echo $website ? esc_attr( $website ) : esc_html__( 'Website', 'findbiz-core' ); ?>" value="<?php echo isset( $_GET['website'] ) ? $_GET['website'] : ''; ?>" class="form-control">
									</div>
									<?php
								}

								if ( in_array( 'search_email', $fields ) ) {
									?>
									<div>
										<input type="text" name="email" placeholder="<?php echo $email ? esc_attr( $email ) : esc_html__( 'Email', 'findbiz-core' ); ?>" value="<?php echo isset( $_GET['email'] ) ? esc_attr( $_GET['email'] ) : ''; ?>" class="form-control">
									</div>
									<?php
								}

								if ( in_array( 'search_phone', $fields ) ) {
									?>
									<div>
										<input type="text" name="phone" placeholder="<?php esc_html_e( 'Phone Number', 'findbiz-core' ); ?>" value="<?php echo isset( $_GET['phone'] ) ? esc_attr( $_GET['phone'] ) : ''; ?>" class="form-control">
									</div>
									<?php
								}

								if ( in_array( 'search_fax', $fields ) ) {
									?>
									<div>
										<input type="text" name="fax" placeholder="<?php echo $fax ? esc_attr( $fax ) : esc_html__( 'Fax', 'findbiz-core' ); ?>" value="<?php echo isset( $_GET['fax'] ) ? esc_attr( $_GET['fax'] ) : ''; ?>" class="form-control">
									</div>
									<?php
								}

								if ( in_array( 'search_address', $fields ) ) {
									?>
									<div class="atbdp_map_address_field">
										<input type="text" name="address" id="address" value="<?php echo isset( $_GET['address'] ) ? esc_attr( $_GET['address'] ) : ''; ?>" placeholder="<?php echo $address ? esc_attr( $address ) : esc_html__( 'Address', 'findbiz-core' ); ?>" class="form-control location-name">
										<div id="address_result">
											<ul></ul>
										</div>
										<input type="hidden" id="cityLat" name="cityLat" />
										<input type="hidden" id="cityLng" name="cityLng" />
									</div>
									<?php
								}

								if ( in_array( 'search_zip_code', $fields ) ) {
									?>
									<div>
										<input type="text" name="zip_code" placeholder="<?php echo $zip ? esc_attr( $zip ) : esc_html__( 'Zip/Post Code', 'findbiz-core' ); ?>" value="<?php echo isset( $_GET['zip_code'] ) ? esc_attr( $_GET['zip_code'] ) : ''; ?>" class="form-control">
									</div>
									<?php
								}
								?>
							</div>
						</div>

						<?php
					}

					if ( in_array( 'search_reset_filters', $filters ) || in_array( 'search_apply_filters', $filters ) ) {
						?>
						<div class="bdas-filter-actions">
							<?php if ( in_array( 'search_reset_filters', $filters ) ) { ?>
								<button type="reset" class="btn btn-outline btn-outline-primary btn-sm">
									<?php echo $reset_btn ? esc_attr( $reset_btn ) : esc_html__( 'Reset Filters', 'findbiz-core' ); ?>
								</button>
								<?php
							}
							if ( in_array( 'search_apply_filters', $filters ) ) {
								?>
								<button type="submit" class="btn btn-primary btn-sm">
									<?php echo $apply_btn ? esc_attr( $apply_btn ) : esc_html__( 'Apply Filters', 'findbiz-core' ); ?>
								</button>
								<?php
							}
							?>
						</div>
					<?php } ?>

				</form>
			</div>
		</div>
		<?php
	}

	// popular categories
	public static function popular_cat() {
		$args = array(
			'type'          => ATBDP_POST_TYPE,
			'parent'        => 0,
			'orderby'       => 'count',
			'order'         => 'desc',
			'hide_empty'    => 1,
			'number'        => 5,
			'taxonomy'      => ATBDP_CATEGORY,
			'no_found_rows' => true,

		);
		$cats = get_categories( $args );
		if ( ! $cats ) {
			return;
		}
		?>
		<div class="search-categories">
			<ul class="list-unstyled">

				<?php

				foreach ( $cats as $key => $cat ) {
					$icon      = get_cat_icon( $cat->term_id );
					$icon_type = substr( $icon, 0, 2 );
					$icon_name = ( 'la' === $icon_type ) ? $icon_type . ' ' . $icon : 'fa ' . $icon;
					$link      = ATBDP_Permalink::atbdp_get_category_page( $cat );
					echo sprintf( '<li><a href="%s"><span class="bg-danger %s"></span><h5>%s</h5></a> </li>', esc_url( $link ), esc_attr( $icon_name ), esc_attr( $cat->name ) );
				}
				wp_reset_postdata();
				?>
			</ul>
		</div>
		<?php
	}

	// price and review
	public static function review_price() {
		 $id             = get_the_ID();
		$review          = get_directorist_option( 'enable_review', 1 );
		$bdbh            = get_post_meta( $id, '_bdbh', true );
		$enable247       = get_post_meta( $id, '_enable247hour', true );
		$disable_bz_hour = get_post_meta( $id, '_disable_bz_hour_listing', true );
		$b_hours         = $bdbh ? atbdp_sanitize_array( $bdbh ) : array();
		$count           = ATBDP()->review->db->count( array( 'post_id' => $id ) );
		$average         = ATBDP()->review->get_average( get_the_ID() );
		$float           = ! strchr( $average, '.' ) ? $average . '.0' : $average;
		?>

		<div class="atbd_listing_meta">

			<?php

			if ( $review ) {
				?>
				<div class="atbd_rated_stars">
					<ul>
						<?php

						$review_title = '';
						if ( $count ) {
							$review_title = 1 == $count ? $count . esc_html__( ' Review', 'findbiz-core' ) : $count . esc_html__( ' Reviews', 'findbiz-core' );
						}
						$star      = '<i class="la la-star rate_active"></i>';
						$half_star = '<i class="la la-star-half-o"></i>';
						$none_star = '<i class="la la-star-o"></i>';

						if ( ! strchr( $average, '.' ) ) {
							for ( $i = 1; $i <= 5; $i++ ) {
								if ( $i <= $average ) {
									echo wp_kses_post( $star );
								} else {
									echo wp_kses_post( $none_star );
								}
							}
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
						}

						echo sprintf( '<span class="atbd_count"><span>%s</span> %s </span>', esc_attr( $float ), esc_attr( $review_title ) );
						?>

					</ul>
				</div>
				<?php
			}

			$plan_hours = true;
			if ( is_fee_manager_active() ) {
				$plan_hours = is_plan_allowed_business_hours( get_post_meta( $id, '_fm_plans', true ) );
			}

			if ( is_business_hour_active() && $plan_hours && ! $disable_bz_hour ) {
				$open = get_directorist_option( 'open_badge_text', esc_html__( 'Open Now', 'findbiz-core' ) );
				if ( $enable247 ) {
					echo sprintf( '<span class="atbd_upper_badge"><span class="atbd_badge atbd_badge_open">%s</span></span>', esc_attr( $open ) );
				} else {
					echo sprintf( '<span class="atbd_upper_badge">%s</span>', BD_Business_Hour()->show_business_open_close( $b_hours ) );
				}
			}
			?>

		</div>

		<?php
	}

	// Arguments of service offer
	public static function service_offer() {
		return apply_filters(
			'atbdp_service_offer_field_setting',
			array(
				array(
					'type'    => 'toggle',
					'name'    => 'listing_service_offer',
					'label'   => __( 'Enable', 'findbiz-core' ),
					'default' => 1,
				),
				array(
					'type'        => 'textbox',
					'name'        => 'service_offer_label',
					'label'       => __( 'Label', 'findbiz-core' ),
					'default'     => __( 'Services Offer', 'findbiz-core' ),
					'description' => __( 'Leave it empty for hiding the label', 'findbiz-core' ),
				),
				array(
					'type'    => 'toggle',
					'name'    => 'service_offer_only_admin',
					'label'   => __( 'Only For Admin Use', 'findbiz-core' ),
					'default' => 0,
				),
			)
		);
	}

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
						<textarea class="form-control" id="atbdp-contact-message" rows="3" placeholder="<?php esc_html_e( 'Message', 'directorist' ); ?>..." required></textarea>
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

	public static function directorist_listing_types() {
		$all_types = directory_types();
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

	// listing badges and price
	public static function budgets() {
		$price   = get_directorist_option( 'disable_list_price' );
		$budget  = get_post_meta( get_the_ID(), '_price', true );
		$range   = get_post_meta( get_the_ID(), '_price_range', true );
		$pricing = get_post_meta( get_the_ID(), '_atbd_listing_pricing', true );
		$hourly  = get_post_meta( get_the_ID(), '_pyn_is_hourly', true );
		$hourly  = $hourly ? sprintf( '<span class="budget-hr">%s</span>', __( '/hr', 'findbiz-core' ) ) : '';
		?>

		<?php
		$html = '';
		if ( $budget || $range ) {
			$html = '<p class="atbd_service_budget">' . __( 'Budget:', 'findbiz-core' ) . '<span>';
			if ( $range && ( 'range' === $pricing ) ) {
				$html .= atbdp_display_price_range( $range ) . $hourly;
			} else {
				$html .= atbdp_display_price( $budget, $price, $currency = null, $symbol = null, $c_position = null, $echo = false ) . $hourly;
			}
			$html .= '</span> </p>';
		}

		return $html;
	}

	// listing badges
	public static function badges() {
		$featured      = get_post_meta( get_the_ID(), '_featured', true );
		$feature_badge = get_directorist_option( 'feature_badge', 1 );
		$feature_text  = get_directorist_option( 'feature_badge_text', 'Featured' );
		$popular_text  = get_directorist_option( 'popular_badge_text', 'Popular' );
		$id            = atbdp_popular_listings( get_the_ID() );
		?>

		<?php

		if ( $featured && ! empty( $feature_badge ) ) {
			echo sprintf( '<span class="atbd_badge atbd_badge_featured">%s</span>', esc_attr( $feature_text ) );
		}

		if ( $id === get_the_ID() ) {
			echo sprintf( '<span class="atbd_badge atbd_badge_popular">%s</span>', esc_attr( $popular_text ) );
		}

		echo new_badge();
	}

	// gallery section
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
		return ' all-listings-carousel owl-carousel ';
	}

}

new DirHelper();
