<?php
/**
 * @author  aazztech
 * @since   1.0
 * @version 1.0
 */

if ( ! class_exists( 'CSF' ) ) {
	return;
}

// Add missing google fonts to csf
add_filter(
	'csf_field_typography_googlewebfonts',
	function ( $fonts ) {
		$fonts['Inter'] = array( array( '100', '200', '300', 'normal', '500', '600', '700', '800', '900' ), array( 'latin-ext', 'latin' ) );
		return $fonts;
	}
);

$prefix       = 'findbiz';
$theme_prefix = 'findbiz';
$theme        = wp_get_theme();

\CSF::createOptions(
	$prefix,
	array(
		'framework_title' => $theme->get( 'Name' ),
		'menu_title'      => esc_html__( 'Theme Options', 'findbiz-core' ),
		'menu_slug'       => $theme_prefix . '-options',
		'menu_type'       => 'submenu',
		'menu_parent'     => 'themes.php',
		'theme'           => 'dark',
		'footer_credit'   => sprintf( '<a href="%s" target="_blank">Theme Documentation</a>', '#' ),
	)
);


$path = plugin_dir_path( __FILE__ );

require_once $path . 'general.php';
require_once $path . 'header.php';
require_once $path . 'footer.php';
require_once $path . 'color.php';
require_once $path . 'typography.php';
require_once $path . 'layout.php';
require_once $path . 'blog.php';
require_once $path . 'post.php';
require_once $path . 'directorist.php';
require_once $path . 'error.php';
require_once $path . 'advanced.php';
require_once $path . 'export.php';
require_once $path . 'page-meta.php';
