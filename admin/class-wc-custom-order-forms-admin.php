<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Custom_Order_Forms
 * @subpackage Wc_Custom_Order_Forms/admin
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Wc_Custom_Order_Forms_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-custom-order-forms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-custom-order-forms-admin.js', array( 'jquery' ), $this->version, false );
		

	}

	public function register_custom_order_plug_shortcodes()
	{
		add_shortcode('buy_4_me_form', array($this, 'wc_order_form_buy'));
		add_shortcode('pack_N_ship_form', array($this, 'wc_order_form_ship'));
	}

	public function wc_order_form_buy()
	{
		$form_buy = '<div class="container">';
		if(isset($_GET['success']) && $_GET['success'] == 'true'){
			$orderid = (isset($_GET['order_id'])) ? $_GET['order_id'] : '';
			$form_buy .= '<div class="alert alert-success" role="alert">You request sent successfully, Your order Id#'.$orderid.'</div>';
		}
		if(isset($_GET['success']) && $_GET['success'] == 'false'){
			$form_buy .= '<div class="alert alert-danger" role="alert">You request unsuccessfull</div>';
		}
		$form_buy .= '<form id="buy_for_me" action="'.admin_url( 'admin-post.php' ).'" method="POST" enctype="multipart/form-data">';
		$form_buy .= '<div class="form-group">';
		$form_buy .= '<label label-for="name">Name:</label>';
		$form_buy .= '<input class="form-control" type="input" name="name" required/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';
		$form_buy .= '<label label-for="contact_number">Contact Number: </label>';
		$form_buy .= '<input class="form-control" type="input" name="contact_number" required/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';
		$form_buy .= '<label label-for="email_address">Email Address: </label>';
		$form_buy .= '<input class="form-control" type="input" name="email_address" required/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="shipping_address">Street address: </label>';
		$form_buy .= '<input class="form-control" type="input" name="shipping_address_01" placeholder="House number and street name" required/>';
		$form_buy .= '<input class="form-control" type="input" name="shipping_address_02" placeholder="Apartment, suite, unit, etc. (optional)"/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="shipping_address">Town / City : </label>';
		$form_buy .= '<input class="form-control" type="input" name="shipping_address_city" placeholder="Town / city" />';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="shipping_address">Postcode / ZIP : </label>';
		$form_buy .= '<input class="form-control" type="input" name="shipping_address_postcode" placeholder="Postcode / ZIP"/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';

		$countries_obj   = new WC_Countries();
		$countries   = $countries_obj->__get('countries');
		$form_buy .= '<label label-for="shipping_address">Country / Region : </label>';
		$form_buy .= '<select class="form-control" name="shipping_address_country">';
		foreach ($countries as $key => $country) {
			$form_buy .= '<option>'.$country.'</option>';
		}
		$form_buy .= '</select>';
		$form_buy .= '</div>';
		
		$form_buy .= '<div class="input-div">';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="item_photo">Item Photo (upload photo): </label>';
		$form_buy .= '<input type="file" class="form-control-file" name="item_photo[]" required>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="item_url">Item URL: </label>';
		$form_buy .= '<input class="form-control" type="input" name="item_url[]" required/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';		
		$form_buy .= '<label label-for="item_price">Item price: </label>';
		$form_buy .= '<input class="form-control" type="input" name="item_price[]" required/>';	
		$form_buy .= '</div>';		
		$form_buy .= '<div class="date-field-actions">';
		$form_buy .= '<button type="button" class="btn btn-primary add_button" id="addBtnbuy" name="addfield">Add more products</button>';
		$form_buy .= '</div>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';
		$form_buy .= '<label label-for="special_instruction">Special Instructions: </label>';
		$form_buy .= '<textarea class="form-control" name="special_instruction"></textarea>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="form-group">';			
		$form_buy .= '<input class="btn btn-primary" type="submit" name="Submit request">';
		$form_buy .= '</div>';
		$form_buy .= '<input type="hidden" name="action" value="add_buy_for_me_order_order">';		
		$form_buy .= wp_nonce_field( 'buy_for_me_order' );
		$form_buy .= '</form>';
		return $form_buy;
	}

	public function wc_order_form_ship()
	{
		$form_ship = '<div class="container">';
		if(isset($_GET['success']) && $_GET['success'] == 'true'){
			$orderid = (isset($_GET['order_id'])) ? $_GET['order_id'] : '';
			$form_ship .= '<div class="alert alert-success" role="alert">You request sent successfully, Your order Id#'.$orderid.'</div>';
		}
		if(isset($_GET['success']) && $_GET['success'] == 'false'){
			$form_ship .= '<div class="alert alert-danger" role="alert">You request unsuccessfull</div>';
		}
		$form_ship .= '<form id="pack_and_ship" action="'.admin_url( 'admin-post.php' ).'" method="POST" enctype="multipart/form-data">';
		$form_ship .= '<div class="form-group">';
		$form_ship .= '<label label-for="name">Name: </label>';
		$form_ship .= '<input class="form-control" type="input" name="name" required/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';
		$form_ship .= '<label label-for="contact_number">Contact Number: </label>';
		$form_ship .= '<input class="form-control" type="input" name="contact_number" required/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';		
		$form_ship .= '<label label-for="email_address">Email Address: </label>';
		$form_ship .= '<input class="form-control" type="input" name="email_address" required/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';		
		$form_ship .= '<label label-for="shipping_address">Street address: </label>';
		$form_ship .= '<input class="form-control" type="input" name="shipping_address_01" placeholder="House number and street name" required/>';
		$form_ship .= '<input class="form-control" type="input" name="shipping_address_02" placeholder="Apartment, suite, unit, etc. (optional)"/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';		
		$form_ship .= '<label label-for="shipping_address">Town / City : </label>';
		$form_ship .= '<input class="form-control" type="input" name="shipping_address_city" placeholder="Town / city"/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';		
		$form_ship .= '<label label-for="shipping_address">Postcode / ZIP : </label>';
		$form_ship .= '<input class="form-control" type="input" name="shipping_address_postcode" placeholder="Postcode / ZIP"/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-group">';

		$countries_obj   = new WC_Countries();
		$countries   = $countries_obj->__get('countries');
		$form_ship .= '<label label-for="shipping_address">Country / Region : </label>';
		$form_ship .= '<select class="form-control" name="shipping_address_country">';
		foreach ($countries as $key => $country) {
			$form_ship .= '<option>'.$country.'</option>';
		}
		$form_ship .= '</select>';
		$form_ship .= '</div>';
		
		$form_ship .= '<div class="input-div">';
		$form_ship .= '<div class="form-group">';
		$form_ship .= '<label label-for="item_photo">Item Photo (upload photo): </label>';
		$form_ship .= '<input type="file" class="form-control-file" name="item_photo[]" required>';
		$form_ship .= '<div class="date-field-actions"><button type="button" class="btn btn-primary add_button" id="addBtnship" name="addfield">Add more products</button></div>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';

		$form_ship .= '<div class="form-group">';
		$form_ship .= '<label label-for="special_instruction">Special Instructions: </label>';
		$form_ship .= '<textarea class="form-control" name="special_instruction"></textarea>';
		$form_ship .= '<input class="btn btn-primary" type="submit" name="Submit request">';
		$form_ship .= '</div>';
		$form_ship .= '<input type="hidden" name="action" value="add_pack_and_ship_order">';
		$form_ship .= wp_nonce_field( 'pack_and_ship_order' );
		$form_ship .= '</form>';
		$form_ship .= '</div>';
		return $form_ship;
	}

}
