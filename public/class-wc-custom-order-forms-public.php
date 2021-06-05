<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/public
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Wc_Custom_Order_Forms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Custom_Order_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Custom_Order_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-custom-order-forms-public.css', array(), $this->version, 'all' );
		//wp_enqueue_style( $this->plugin_name.'boostrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css', array(), $this->version, 'all' );
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Custom_Order_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Custom_Order_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-custom-order-forms-public.js', array( 'jquery' ), $this->version, false );
		
	}

	public function add_buy_for_me_order_order()
	{
		$nonce = $_POST['_wpnonce'];
		if ( ! wp_verify_nonce( $nonce, 'buy_for_me_order' ) ) {
			exit; // Get out of here, the nonce is rotten!
		}
		// print_r($_POST);
		// print_r($_FILES['item_photo']);
		// wp_die();

		$return = $this->createWCOrder($_POST, $_FILES, 'buy_for_me_order');
		if($return){
			$return_url = add_query_arg( array('success' => 'true', 'order_id' => $return), $_SERVER["HTTP_REFERER"] );
		}else{
			$return_url = add_query_arg( array('success' => 'false'), $_SERVER["HTTP_REFERER"] );
		}
		wp_safe_redirect( $return_url );

	}

	private function createWCOrder($post, $files, $type){
		global $woocommerce;

		$items_photo = $files['item_photo'];
		$special_instruction = sanitize_textarea_field($post['special_instruction']);

		$product['customer'] = array(
			'first_name'		=> sanitize_text_field($post['name']),
			'email'			    => sanitize_text_field($post['email_address']),
			'phone'   			=> sanitize_text_field($post['contact_number']),
			'address_1'  		=> sanitize_text_field($post['shipping_address_01']),
			'address_2'  		=> sanitize_text_field($post['shipping_address_02']), 
			'city'       		=> sanitize_text_field($post['shipping_address_city']),
			'postcode'   		=> sanitize_text_field($post['shipping_address_postcode']),
			'country'    		=> sanitize_text_field($post['shipping_address_country']),
		);
		$product['billing'] = array(
			'first_name'		=> sanitize_text_field($post['name']),
			'email'			    => sanitize_text_field($post['email_address']),
			'phone'   			=> sanitize_text_field($post['contact_number']),
			'address_1'  		=> sanitize_text_field($post['shipping_address_01']),
			'address_2'  		=> sanitize_text_field($post['shipping_address_02']), 
			'city'       		=> sanitize_text_field($post['shipping_address_city']),
			'postcode'   		=> sanitize_text_field($post['shipping_address_postcode']),
			'country'    		=> sanitize_text_field($post['shipping_address_country']),
		);
		$product['shipping'] = array(
			'first_name'		=> sanitize_text_field($post['name']),
			'address_1'  		=> sanitize_text_field($post['shipping_address_01']),
			'address_2'  		=> sanitize_text_field($post['shipping_address_02']), 
			'city'       		=> sanitize_text_field($post['shipping_address_city']),
			'postcode'   		=> sanitize_text_field($post['shipping_address_postcode']),
			'country'    		=> sanitize_text_field($post['shipping_address_country']),		
		);

		$product['status'] = 'wc-pending';

		if($type == 'buy_for_me_order'){
			$item_url = $post['item_url'];
			$item_price = $post['item_price'];

			foreach ($item_price as $value) {
				if (!is_numeric($value)) return false;
			}
		}
		$array_count = count($items_photo['name']);

		$default_password = wp_generate_password();

		$user = get_user_by('email', $post['email_address']);
	
		if (!$user){
			$user_id = wp_create_user( $post['email_address'], $default_password, $post['email_address'] );
		}
		if(!$user_id){
			$user_id = $user->id;
		}
			
        // Now we create the order
        //$order = wc_create_order();
		$order = wc_create_order(array('customer_id' => $user_id));
        
        //Set addresses
        $order->set_address( $product['billing'], 'billing' );
        $order->set_address( $product['shipping'], 'shipping' );

		## ------------- ADD FEE PROCESS ---------------- ##

		// Get the customer country code
		$country_code = $order->get_shipping_country();

		// Set the array for tax calculations
		$calculate_tax_for = array(
			'country' => $country_code, 
			'state' => '', 
			'postcode' =>  '', 
			'city' =>  '',
		);

		if($type == 'buy_for_me_order'){
			for ($i=0; $i < $array_count; $i++) {
				// Get a new instance of the WC_Order_Item_Fee Object
				$item_fee = new WC_Order_Item_Fee();

				// Add Fee item to the order
				$item_fee->set_name( "Product ".($i+1)." fee" ); // Generic fee name
				$item_fee->set_amount( sanitize_text_field($item_price[$i]) ); // Fee amount
				$item_fee->set_tax_class( '' ); // default for ''
				$item_fee->set_tax_status( 'taxable' ); // or 'none'
				$item_fee->set_total( sanitize_text_field($item_price[$i]) ); // Fee amount
				
				// Calculating Fee taxes
				$item_fee->calculate_taxes( $calculate_tax_for );
				$order->add_item( $item_fee );

				update_post_meta($order->get_id(), 'product_'.($i+1).'_url', sanitize_text_field($item_url[$i]));

			}
			update_post_meta($order->get_id(), 'buy_for_me_order', 'yes');
		}else{
			update_post_meta($order->get_id(), 'pack_and_ship_order', 'yes');
		}
		$this->upload_images($order->get_id(), $items_photo);
		//$this->upload_images('3280', $items_photo);
        // // Calculate totals
		$order->add_order_note( $special_instruction );
        $order->calculate_totals();
        // // $order_status = $this->get_woo_order_status_from_pay_status($orders['paystatus']);
        $order->update_status( $product['status'], 'External order created manually', TRUE);

		$order->save();

        /**
         * Need save in reference to this order some thing like below
         * $order_instance->validate_moreflo_order_response('booking', 'add', $response);
        */
        return $order->get_id();

	}

	public function add_pack_and_ship_order()
	{
		$nonce = $_POST['_wpnonce'];
		if ( ! wp_verify_nonce( $nonce, 'pack_and_ship_order' ) ) {
			exit; // Get out of here, the nonce is rotten!
		}

		$return = $this->createWCOrder($_POST, $_FILES, 'pack_and_ship_order');
		if($return){
			$return_url = add_query_arg( array('success' => 'true', 'order_id' => $return), $_SERVER["HTTP_REFERER"] );
		}else{
			$return_url = add_query_arg( array('success' => 'false'), $_SERVER["HTTP_REFERER"] );
		}
		wp_safe_redirect( $return_url );
	}

	function upload_images($order_id, $image)
	{
		for ($i=0; $i < count($image['name']) ; $i++) { 
			
			$image_name		= $image['name'][$i];
			$tmp			= $image['tmp_name'][$i];
		
		
			$compatiableTypes = ['image/jpeg', 'image/png', 'image/gif'];
		
			require_once(ABSPATH . 'wp-admin/includes/media.php');
			require_once(ABSPATH . 'wp-admin/includes/file.php');
			require_once(ABSPATH . 'wp-admin/includes/image.php');
		
			$file_array['name'] = $image_name;
			$file_array['tmp_name'] = $tmp;	
		
			$attachment_post_id;
			$attachment_args = array(
					'posts_per_page' => 1,
					'post_type'      => 'attachment',
					'name'           => $image_name
				);
			
			$imageid = media_handle_sideload( $file_array, $order_id, $image_name );
		
			update_post_meta( $order_id, 'order_product_'.($i+1).'_image', wp_get_attachment_url($imageid));
		}
	}

}
