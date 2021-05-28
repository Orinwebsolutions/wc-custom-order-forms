<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/includes
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Wc_Custom_Order_Forms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// $posts_arr = [];
		// // Create post object
		// $order_form_01 = array(
		// 	'post_title'    => 'Buy For Me',
		// 	'post_content'  => '[buy_4_me_form]',
		// 	'post_status'   => 'publish',
		// 	'post_type'		=> 'page',
		// 	'post_author'   => 1,
		// );

		// // Insert the post into the database
		// $form01 = wp_insert_post( $order_form_01 );

		// // Create post object
		// $order_form_02 = array(
		// 	'post_title'    => 'Pack and Ship',
		// 	'post_content'  => '[pack_N_ship_form]',
		// 	'post_status'   => 'publish',
		// 	'post_type'		=> 'page',
		// 	'post_author'   => 1,
		// );

		// // Insert the post into the database
		// $form02 = wp_insert_post( $order_form_02 );
		// array_push($posts_arr, $form01, $form02);
		// update_option('wc_custom_order_forms', $postArray);

	}

}
