<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Demo_Importer {

	protected static $instance;

	public function __construct() {

		add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', array( $this, 'add_action_links' ) ); // Link from plugins page 
		add_filter( 'wpwax_demo_importer_warning', array( $this, 'data_loss_warning' ) );
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'demo_config' ) );
		add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', array( $this, 'after_demo_install' ) );
		//add_filter( 'fw:ext:backups:add-restore-task:image-sizes-restore', '__return_false' ); // Enable it to skip image restore step
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">' . __( 'Install Demo Contents', 'findbiz-core' ) . '</a>',
		);
		return array_merge( $links, $mylinks );
	}

	// Confirmation Text
	public function data_loss_warning( $links ) {
		$html  = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
		$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'findbiz-core');
		$html .= '</div>';
		return $html;
	}

	public function demo_config( $demos ) {
		$demos_array = array(
			'demo1' => array(
				'title'        => __( 'Home Light', 'findbiz-core' ),
				'screenshot'   => 'https://demo.directorist.com/theme/demo-content/findbiz/findbiz-light.png',
				'preview_link' => 'https://demo.directorist.com/theme/findbiz/',
			),
			'demo2' => array(
				'title'        => __( 'Home Static', 'findbiz-core' ),
				'screenshot'   => 'https://demo.directorist.com/theme/demo-content/findbiz/findbiz-static.png',
				'preview_link' => 'https://demo.directorist.com/theme/findbiz/home-two/',
			),
			'demo3' => array(
				'title'        => __( 'Home Video', 'findbiz-core' ),
				'screenshot'   => 'https://demo.directorist.com/theme/demo-content/findbiz/findbiz-video.png',
				'preview_link' => 'https://demo.directorist.com/theme/findbiz/home-three/',
			),
		);

		$remote_server_url = 'https://demo.directorist.com/theme/demo-content/findbiz';

		foreach ( $demos_array as $id => $data ) {
			$demo = new FW_Ext_Backups_Demo(
				$id,
				'piecemeal',
				array(
					'url'     => $remote_server_url,
					'file_id' => $id,
				)
			);
			$demo->set_title( $data['title'] );
			$demo->set_screenshot( $data['screenshot'] );
			$demo->set_preview_link( $data['preview_link'] );

			$demos[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos;
	}

	public function after_demo_install( $collection ) {
		// Update front page id
		$demos = array(
			'demo1' => 3414,
			'demo2' => 3739,
			'demo3' => 3740,
		);

		$data = $collection->to_array();

		foreach ( $data['tasks'] as $task ) {
			if ( $task['id'] == 'demo:demo-download' ) {
				$demo_id = $task['args']['demo_id'];
				$page_id = $demos[ $demo_id ];
				update_option( 'page_on_front', $page_id );
				flush_rewrite_rules();
				break;
			}
		}

		// Update contact form 7 email
		$cf7ids = array( 593, 1141, 1208, 1238 );
		foreach ( $cf7ids as $cf7id ) {
			$mail = get_post_meta( $cf7id, '_mail', true );
			$mail['recipient'] = get_option( 'admin_email' );

			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			
			update_post_meta( $cf7id, '_mail', $mail );		
		}

		// Update post author id
		global $wpdb;
		$id    = get_current_user_id();
		$query = "UPDATE $wpdb->posts SET post_author = $id";
		$wpdb->query( $query );
	}
}

Demo_Importer::instance();
