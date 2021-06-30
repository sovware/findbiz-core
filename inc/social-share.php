<?php
/**
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace WpWax\FindBiz;

add_filter( 'user_contactmethods', 'author_social' );

function author_social( $social ) {
	$social['twitter']     = __( 'Twitter Username', 'findbiz-core' );
	$social['google_plus'] = __( 'Google plus profile', 'findbiz-core' );
	$social['facebook']    = __( 'Facebook Profile', 'findbiz-core' );
	$social['linkedin']    = __( 'Linkedin Profile', 'findbiz-core' );

	return $social;
}