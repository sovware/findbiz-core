<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

class DirHooks {

	public static $shorting;
	public static $sign_in;
	public static $need;
	public static $copyright;

	public function __construct() {
		self::$shorting  = class_exists( 'Directorist_Base' ) ? get_directorist_option( 'display_sort_by', 1 ) : '';
		self::$sign_in   = get_option( 'findbiz' )['sign_in'];
		self::$copyright = get_option( 'findbiz' )['copyright_area'];

		// login in failed
		add_action( 'wp_login_failed', array( $this, 'login_fail' ) );

		// copyright
		if ( self::$copyright ) {
			add_action( 'bdmv-after-listing', array( $this, 'copyright' ) );
		}

		if ( self::$sign_in ) {
			// sign modal
			add_action( 'atbdp_listing_form_login_link', array( $this, 'sign_modal' ) );
			add_action( 'atbdp_user_dashboard_login_link', array( $this, 'sign_modal' ) );
			add_action( 'atbdp_review_login_link', array( $this, 'sign_modal' ) );
			add_action( 'atbdp_claim_now_login_link', array( $this, 'sign_modal' ) );
			add_action( 'atbdp_login_page_link', array( $this, 'sign_modal' ) );
			add_action( 'dashboard_sign', array( $this, 'sign_modal' ) );
			// sign up modal
			add_filter( 'atbdp_listing_form_signup_link', array( $this, 'sign_up_modal' ) );
			add_filter( 'atbdp_user_dashboard_signup_link', array( $this, 'sign_up_modal' ) );
			add_filter( 'atbdp_review_signup_link', array( $this, 'sign_up_modal' ) );
			add_filter( 'atbdp_claim_now_registration_link', array( $this, 'sign_up_modal' ) );
			add_filter( 'atbdp_signup_page_link', array( $this, 'sign_up_modal' ) );
		}

		if ( self::$shorting ) {
			// listing shorting
			add_action( 'bdmv_view_as', array( $this, 'shorting' ), 10, 3 );
		}

		add_action( 'atbdp_listings_with_map_header_sort_by_button', array( $this, 'listing_map_view' ), 10, 3 );

		// email notification
		add_filter( 'wp_new_user_notification_email', array( $this, 'mail_notification' ), 10, 3 );
		add_filter( 'wp_mail_from_name', array( $this, 'from_name' ) );

		// ajax_callback_send_contact_email
		add_action( 'wp_ajax_findbiz_public_send_contact_email', array( $this, 'ajax_callback_send_contact_email' ) );
		add_action( 'wp_ajax_nopriv_findbiz_public_send_contact_email', array( $this, 'ajax_callback_send_contact_email' ) );

		add_action( 'directorist_dashboard_listing_td_2', array( $this, 'directorist_dashboard_listing_td_2' ) );
		add_action( 'directorist_dashboard_listing_th_2', array( $this, 'directorist_dashboard_listing_th_2' ) );
	}

	public static function listing_map_view() {
		$listing_map_view = get_directorist_option( 'listing_map_view', 'grid' );
		$view_as          = isset( $_POST['view_as'] ) ? $_POST['view_as'] : $listing_map_view; ?>
		<div class="view-mode-2 view-as">
			<a data-view="grid" class="action-btn-2 ab-grid map-view-grid <?php echo 'grid' == $view_as ? esc_html( 'active' ) : ''; ?>">
				<span class="la la-th-large"></span>
			</a>
			<a data-view="list" class="action-btn-2 ab-list map-view-list <?php echo 'list' == $view_as ? esc_html( 'active' ) : ''; ?>">
				<span class="la la-list"></span>
			</a>
		</div>
		<?php
	}

	// listing shorting
	public static function shorting() {
		global $bdmv_listings;
		$sort_by           = isset( $_POST['sort_by'] ) ? $_POST['sort_by'] : '';
		$title_asc_active  = ( 'title-asc' == $sort_by ) ? 'active' : '';
		$title_desc_active = ( 'title-desc' == $sort_by ) ? 'active' : '';
		$date_desc_active  = ( 'date-desc' == $sort_by ) ? 'active' : '';
		$date_asc_active   = ( 'date-asc' == $sort_by ) ? 'active' : '';
		$price_asc_active  = ( 'price-asc' == $sort_by ) ? 'active' : '';
		$price_desc_active = ( 'price-desc' == $sort_by ) ? 'active' : '';
		$rand_active       = ( 'rand' == $sort_by ) ? 'active' : '';
		?>

		<div class="directorist-dropdown directorist-dropdown-js directorist-dropdown-right">
			<p><?php echo __( 'Sort by:', 'findbiz-core' ); ?></p>
			<a class="directorist-dropdown__toggle directorist-dropdown__toggle-js directorist-btn directorist-btn-sm directorist-btn-px-15 directorist-btn-outline-primary directorist-toggle-has-icon" href="#" role="button" id="sortByDropdownMenuLink">
				<?php echo esc_attr( $bdmv_listings->options['sort_by_text'] ); ?>
				<span class="atbd_drop-caret"></span>
			</a>
			<div class="directorist-dropdown__links directorist-dropdown__links-js sort-by"
				aria-labelledby="sortByDropdownMenuLink">
				<a class="directorist-dropdown__links--single sort-title-asc <?php echo esc_attr( $title_asc_active ); ?>" data-sort="title-asc"><?php echo __( 'A to Z ( title )', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-title-desc <?php echo esc_attr( $title_desc_active ); ?>" data-sort="title-desc"><?php echo __( 'Z to A ( title )', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-date-desc <?php echo esc_attr( $date_desc_active ); ?>" data-sort="date-desc"><?php echo __( 'Latest listings', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-date-asc <?php echo esc_attr( $date_asc_active ); ?>" data-sort="date-asc"><?php echo __( 'Oldest listings', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-price-asc <?php echo esc_attr( $price_asc_active ); ?>" data-sort="price-asc"><?php echo __( 'Price ( low to high )', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-price-desc <?php echo esc_attr( $price_desc_active ); ?>" data-sort="price-desc"><?php echo __( 'Price ( high to low )', 'findbiz-core' ); ?> </a>
				<a class="directorist-dropdown__links--single sort-rand <?php echo esc_attr( $rand_active ); ?>" data-sort="rand"><?php echo __( 'Random listings', 'findbiz-core' ); ?> </a>
			</div>
		</div>
		<?php
	}

	// copyright
	public static function copyright() {
		$footer = get_post_meta( get_the_ID(), 'footer', true );
		$text   = get_option( 'findbiz' )['copyright_text'];
		?>
		<div class="listing_map_footer bg-<?php echo esc_attr( $footer ); ?>"><?php echo apply_filters( 'get_the_content', $text ); ?></div>
		<?php
	}

	// sign modal
	public static function sign_modal() {
		$sign_in_text = get_option( 'findbiz' )['sign_in_text'];
		return sprintf( '<a href="#" class="access-link" data-toggle="modal" data-target="#login_modal">%s</a>', esc_attr( $sign_in_text ) );
	}

	// sign up modal
	public static function sign_up_modal() {
		return sprintf( '<a href="#" class="access-link" data-toggle="modal"  data-target="#signup_modal">%s</a>', __( 'Sign Up', 'findbiz-core' ) );
	}

	// login failed
	public static function login_fail() {
		$referrer = $_SERVER['HTTP_REFERER'];
		if ( $referrer && ! strstr( $referrer, 'wp-login' ) && ! strstr( $referrer, 'wp-admin' ) ) {
			wp_redirect( $referrer . '?login=failed' );
			exit;
		}
	}

	// mail body
	public static function content_replace( $content, $order_id = 0, $listing_id = 0, $user = null ) {
		if ( ! $listing_id ) {
			$listing_id = (int) get_post_meta( $order_id, '_listing_id', true );
		}
		if ( ! $user ) {
			$post_author_id = get_post_field( 'post_author', $listing_id );
			$user           = get_userdata( $post_author_id );
		} else {
			if ( ! $user instanceof \WP_User ) {
				$user = get_userdata( (int) $user );
			}
		}

		$site_name    = get_option( 'blogname' );
		$site_url     = site_url();
		$date_format  = get_option( 'date_format' );
		$time_format  = get_option( 'time_format' );
		$current_time = current_time( 'timestamp' );
		$find_replace = array(
			'==NAME=='      => ! empty( $user->display_name ) ? $user->display_name : '',
			'==USERNAME=='  => ! empty( $user->user_login ) ? $user->user_login : '',
			'==SITE_NAME==' => $site_name,
			'==SITE_LINK==' => sprintf( '<a href="%s">%s</a>', $site_url, $site_name ),
			'==SITE_URL=='  => sprintf( '<a href="%s">%s</a>', $site_url, $site_url ),
			'==TODAY=='     => date_i18n( $date_format, $current_time ),
			'==NOW=='       => date_i18n( $date_format . ' ' . $time_format, $current_time ),
		);
		$c            = nl2br( strtr( $content, $find_replace ) );

		return $c;
	}

	// mail notification
	public static function mail_notification( $wp_new_user_notification_email, $user, $blogname ) {
		$user_password = get_user_meta( $user->ID, '_atbdp_generated_password', true );

		$sub                                       = get_directorist_option( 'email_sub_registration_confirmation', __( 'Registration Confirmation!', 'findbiz-core' ) );
		$body                                      = get_directorist_option(
			'email_tmpl_registration_confirmation',
			__(
				'
Dear User,

Congratulations! Your registration is completed!

This email is sent automatically for information purpose only. Please do not respond to this.
You can login now using the below credentials: 

',
				'findbiz-core'
			)
		);
		$body                                      = self::content_replace( $body, null, null, $user );
		$wp_new_user_notification_email['subject'] = sprintf( '%s', $sub );
		$wp_new_user_notification_email['message'] = preg_replace( '/<br \/>/', '', $body ) . '
                
' . __( 'Username:', 'findbiz-core' ) . " $user->user_login
" . __( 'Password:', 'findbiz-core' ) . " $user_password";
		return $wp_new_user_notification_email;
	}

	public static function from_name() {
		$site_name = get_option( 'blogname' );
		return $site_name;
	}


	// contact listing owner form
	public static function email_listing_owner_listing_contact() {
		/**
		 * If fires sending processing the submitted contact information
		 *
		 * @since 1.0.0
		 */
		do_action( 'atbdp_before_processing_contact_to_owner' );

		if ( ! in_array( 'listing_contact_form', get_directorist_option( 'notify_user', array() ) ) ) {
			return false;
		}
		// sanitize form values
		$post_id       = (int) $_POST['post_id'];
		$name          = sanitize_text_field( $_POST['name'] );
		$email         = sanitize_email( $_POST['email'] );
		$listing_email = sanitize_email( $_POST['listing_email'] );
		$message       = stripslashes( esc_textarea( $_POST['message'] ) );

		// vars
		$post_author_id        = get_post_field( 'post_author', $post_id );
		$user                  = get_userdata( $post_author_id );
		$site_name             = get_bloginfo( 'name' );
		$site_url              = get_bloginfo( 'url' );
		$site_email            = get_bloginfo( 'admin_email' );
		$listing_title         = get_the_title( $post_id );
		$listing_url           = get_permalink( $post_id );
		$date_format           = get_option( 'date_format' );
		$time_format           = get_option( 'time_format' );
		$current_time          = current_time( 'timestamp' );
		$contact_email_subject = get_directorist_option( 'email_sub_listing_contact_email' );
		$contact_email_body    = get_directorist_option( 'email_tmpl_listing_contact_email' );
		$user_email            = get_directorist_option( 'user_email', 'author' );

		$placeholders = array(
			'==NAME=='          => $user->display_name,
			'==USERNAME=='      => $user->user_login,
			'==SITE_NAME=='     => $site_name,
			'==SITE_LINK=='     => sprintf( '<a href="%s">%s</a>', $site_url, $site_name ),
			'==SITE_URL=='      => sprintf( '<a href="%s">%s</a>', $site_url, $site_url ),
			'==LISTING_TITLE==' => $listing_title,
			'==LISTING_LINK=='  => sprintf( '<a href="%s">%s</a>', $listing_url, $listing_title ),
			'==LISTING_URL=='   => sprintf( '<a href="%s">%s</a>', $listing_url, $listing_url ),
			'==SENDER_NAME=='   => $name,
			'==SENDER_EMAIL=='  => $email,
			'==MESSAGE=='       => $message,
			'==TODAY=='         => date_i18n( $date_format, $current_time ),
			'==NOW=='           => date_i18n( $date_format . ' ' . $time_format, $current_time ),
		);
		if ( 'listing_email' == $user_email ) {
			$to = $listing_email;
		} else {
			$to = $user->user_email;
		}

		$subject = strtr( $contact_email_subject, $placeholders );

		$message = strtr( $contact_email_body, $placeholders );
		$message = nl2br( $message );

		$headers  = "From: {$name} <{$site_email}>\r\n";
		$headers .= "Reply-To: {$email}\r\n";

		// return true or false, based on the result
		return ATBDP()->email->send_mail( $to, $subject, $message, $headers ) ? true : false;
	}

	/**
	 * Send contact message to the admin.
	 *
	 * @since    1.0
	 */
	public static function email_admin_listing_contact() {
		if ( get_directorist_option( 'disable_email_notification' ) ) {
			return false;
		}

		if ( ! in_array( 'listing_contact_form', get_directorist_option( 'notify_admin', array() ) ) ) {
			return false; // vail if order created notification to admin off
		}

		// sanitize form values
		$post_id = (int) $_POST['post_id'];
		$name    = sanitize_text_field( $_POST['name'] );
		$email   = sanitize_email( $_POST['email'] );
		$message = esc_textarea( $_POST['message'] );

		// vars
		$site_name     = get_bloginfo( 'name' );
		$site_url      = get_bloginfo( 'url' );
		$listing_title = get_the_title( $post_id );
		$listing_url   = get_permalink( $post_id );
		$date_format   = get_option( 'date_format' );
		$time_format   = get_option( 'time_format' );
		$current_time  = current_time( 'timestamp' );

		$placeholders = array(
			'{site_name}'     => $site_name,
			'{site_link}'     => sprintf( '<a href="%s">%s</a>', $site_url, $site_name ),
			'{site_url}'      => sprintf( '<a href="%s">%s</a>', $site_url, $site_url ),
			'{listing_title}' => $listing_title,
			'{listing_link}'  => sprintf( '<a href="%s">%s</a>', $listing_url, $listing_title ),
			'{listing_url}'   => sprintf( '<a href="%s">%s</a>', $listing_url, $listing_url ),
			'{sender_name}'   => $name,
			'{sender_email}'  => $email,
			'{message}'       => $message,
			'{today}'         => date_i18n( $date_format, $current_time ),
			'{now}'           => date_i18n( $date_format . ' ' . $time_format, $current_time ),
		);
		$send_emails  = ATBDP()->email->get_admin_email_list();
		$to           = ! empty( $send_emails ) ? $send_emails : get_bloginfo( 'admin_email' );

		$subject = __( '[{site_name}] Contact via "{listing_title}"', 'directorist' );
		$subject = strtr( $subject, $placeholders );

		$message = __( "Dear Administrator,<br /><br />A listing on your website {site_name} received a message.<br /><br />Listing URL: {listing_url}<br /><br />Name: {sender_name}<br />Email: {sender_email}<br />Message: {message}<br />Time: {now}<br /><br />This is just a copy of the original email and was already sent to the listing owner. You don't have to reply this unless necessary.", 'directorist' );
		$message = strtr( $message, $placeholders );

		$headers  = "From: {$name} <{$email}>\r\n";
		$headers .= "Reply-To: {$email}\r\n";

		return ATBDP()->email->send_mail( $to, $subject, $message, $headers ) ? true : false;
	}

	/**
	 * Send contact email.
	 *
	 * @since    1.0
	 */
	public static function ajax_callback_send_contact_email() {
		$data = array( 'error' => 0 );

		if ( self::email_listing_owner_listing_contact() ) {

			// Send a copy to admin( only if applicable ).
			self::email_admin_listing_contact();

			$data['message'] = __( 'Your message sent successfully.', 'findbiz-core' );
		} else {

			$data['error']   = 1;
			$data['message'] = __( 'Sorry! Please try again.', 'findbiz-core' );
		}
		echo wp_json_encode( $data );
		wp_die();
	}

	// Add review & category in dashboard table.
	public static function directorist_dashboard_listing_th_2() {
		echo '<th class="directorist-table-review">' . __( 'Review', 'findbiz-core' ) . '</th>';
		echo '<th class="directorist-table-review">' . __( 'Category', 'findbiz-core' ) . '</th>';
	}

	public static function directorist_dashboard_listing_td_2() {
		$review = get_directorist_option( 'enable_review', 1 );
		if ( ! $review ) {
			return;
		}
		$reviews_count = ATBDP()->review->db->count( array( 'post_id' => get_the_ID() ) );
		$cats          = get_the_terms( get_the_ID(), ATBDP_CATEGORY );
		$cats          = $cats ? $cats : array();
		?>
		<td class="directorist_dashboard_rating">
			<ul class="rating">
				<?php
				$average   = ATBDP()->review->get_average( get_the_ID() );
				$star      = '<li><span class="la la-star rate_active"></span></li>';
				$half_star = '<li><span class="la la-star-half-o rate_active"></span></li>';
				$none_star = '<li><span class="la la-star-o"></span></li>';

				if ( is_int( $average ) ) {
					for ( $i = 1; $i <= 5; $i++ ) {

						if ( $i <= $average ) {
							echo wp_kses_post( $star );
						} else {
							echo wp_kses_post( $none_star );
						}
					}
				} elseif ( ! is_int( $average ) ) {
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

				$review_title = '';
				if ( $reviews_count ) {
					if ( 1 < $reviews_count ) {
						$review_title = $reviews_count . esc_html__( ' Reviews', 'findbiz-core' );
					} else {
						$review_title = $reviews_count . esc_html__( ' Review', 'findbiz-core' );
					}
				}
				?>

				<li class="reviews">
					<span class="atbd_count">
						<?php echo sprintf( '(<b>%s</b> %s )', esc_attr( $average . '/5' ), esc_attr( $review_title ) ); ?>
					</span>
				</li>
			</ul>
		</td>

		<td class="directorist_dashboard_category">
			<ul>
				<li>
					<?php
					if ( $cats ) {
						foreach ( $cats as $cat ) {
							$link          = \ATBDP_Permalink::atbdp_get_category_page( $cat );
							$space         = str_repeat( ' ', 1 );
							$category_icon = $cats ? get_cat_icon( $cat->term_id ) : atbdp_icon_type() . '-tags';
							$icon_type     = substr( $category_icon, 0, 2 );
							$icon          = 'la' === $icon_type ? $icon_type . ' ' . $category_icon : 'fa ' . $category_icon;
							echo sprintf( '%s<span><i class="%s"></i><a href="%s">%s</a></span>', esc_attr( $space ), esc_attr( $icon ), esc_url( $link ), esc_attr( $cat->name ) );
						}
					}
					?>
				</li>
			</ul>
		</td>
		<?php
	}
}

new DirHooks();
