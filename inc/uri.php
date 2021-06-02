<?php
/**
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

namespace AazzTech\FindBiz;

trait URI_Trait {

	public static function get_img( $filename ) {
		$path = '/img/' . $filename;
		return self::get_file_uri( $path );
	}

	public static function get_css( $filename ) {
		$path = '/theme_assets/css/' . $filename . '.css';
		return self::get_file_uri( $path );
	}

	public static function get_js( $filename ) {
		$path = '/theme_assets/js/' . $filename . '.js';
		return self::get_file_uri( $path );
	}

	public static function get_vendor_css( $file ) {
		$path = '/vendor_assets/css/' . $file . '.css';
		return self::get_file_uri( $path );
	}

	public static function get_vendor_js( $file ) {
		$path = '/vendor_assets/js/' . $file . '.js';
		return self::get_file_uri( $path );
	}

	private static function get_file_uri( $path ) {
		$filepath = get_stylesheet_directory() . $path;
		$file     = get_stylesheet_directory_uri() . $path;
		if ( ! file_exists( $filepath ) ) {
			$file = get_theme_file_uri() . $path;
		}
		return $file;
	}
}
