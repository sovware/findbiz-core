<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz_Core;

use WpWax\FindBiz\Helper as FindBizHelper;

class Helper {

	public function __construct() {
		// single listing shortcodes.
		add_shortcode( 'findbiz_listing_gallery', array( $this, 'gallery' ) );

	}

	// single listing gallery section
	public static function gallery() {
		$listing_img                 = array();
		$title                       = get_directorist_option( 'findbiz_details_text', __( 'Gallery', 'findbiz' ) );
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
										<img src="<?php echo ! empty($image) ? esc_url( $image[0] ) : ''; ?>" alt="<?php echo esc_attr( FindBizHelper::image_alt( $ids ) ); ?>">
										<figcaption>
											<a href="<?php echo ! empty($preview) ? esc_url( $preview[0] ) : ''; ?>" class="hoverZoomLink">
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

	// Sanitize video URL of single listing.
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

	//add listing action URL.
	public static function add_listing_action_url() {
		return esc_url( $_SERVER['REQUEST_URI'] );
	}
}

new Helper();
