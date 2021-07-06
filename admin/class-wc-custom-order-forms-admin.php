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
		add_shortcode('ondemand_form', array($this, 'wc_order_form_ondemad'));
	}

	public static function generateSuiteNumber($id, $countrycode)
	{
		// $countryCodeRef = ['EG'=> '020', 'AE'=> '971', 'LK' => '000'];
		$countryCodeRef = ['AF' => '093', 'AL' => '0355', 'DZ' => '0213', 'AS' => '01-684', 'AD' => '0376', 'AO' => '0244', 
		'AI' => '01-264', 'AQ' => '0672', 'AG' => '01-268', 'AR' => '054', 'AM' => '0374', 'AW' => '0297', 'AU' => '061', 
		'AT' => '043', 'AZ' => '0994', 'BS' => '01-242', 'BH' => '0973', 'BD' => '0880', 'BB' => '01-246', 'BY' => '0375', 
		'BE' => '032', 'BZ' => '0501', 'BJ' => '0229', 'BM' => '01-441', 'BT' => '0975', 'BO' => '0591', 'BA' => '0387', 
		'BW' => '0267', 'BR' => '055', 'BN' => '0673', 'BG' => '0359', 'BF' => '0226', 'BI' => '0257', 'KH' => '0855', 
		'CM' => '0237', 'CA' => '01', 'CV' => '0238', 'KY' => '01-345', 'CF' => '0236', 'TD' => '0235', 'CL' => '056', 
		'CN' => '086', 'CX' => '053', 'CC' => '061', 'CO' => '057', 'KM' => '0269', 'CD' => '0243', 'CG' => '0242', 'CK' => '0682', 
		'CR' => '0506', 'CI' => '0225', 'HR' => '0385', 'CU' => '053', 'CY' => '0357', 'CZ' => '0420', 'DK' => '045', 'DJ' => '0253', 
		'DM' => '01-767', 'DO' => '01-809', 'TP' => '0670', 'EC' => '0593', 'EG' => '020', 'SV' => '0503', 'GQ' => '0240', 'ER' => '0291', 
		'EE' => '0372', 'ET' => '0251', 'FK' => '0500', 'FO' => '0298', 'FJ' => '0679', 'FI' => '0358', 'FR' => '033', 'GF' => '0594', 
		'PF' => '0689', 'GA' => '0241', 'GM' => '0220', 'GE' => '0995', 'DE' => '049', 'GH' => '0233', 'GI' => '0350', 'GR' => '030', 
		'GL' => '0299', 'GD' => '01-473', 'GP' => '0590', 'GU' => '01-671', 'GT' => '0502', 'GN' => '0224', 'GW' => '0245', 'GY' => '0592', 
		'HT' => '0509', 'HN' => '0504', 'HK' => '0852', 'HU' => '036', 'IS' => '0354', 'IN' => '091', 'ID' => '062', 'IR' => '098', 
		'IQ' => '0964', 'IE' => '0353', 'IL' => '0972', 'IT' => '039', 'JM' => '01-876', 'JP' => '081', 'JO' => '0962', 'KZ' => '07', 
		'KE' => '0254', 'KI' => '0686', 'KP' => '0850', 'KR' => '082', 'KW' => '0965', 'KG' => '0996', 'LA' => '0856', 'LV' => '0371', 
		'LB' => '0961', 'LS' => '0266', 'LR' => '0231', 'LY' => '0218', 'LI' => '0423', 'LT' => '0370', 'LU' => '0352', 'MO' => '0853', 
		'MK' => '0389', 'MG' => '0261', 'MW' => '0265', 'MY' => '060', 'MV' => '0960', 'ML' => '0223', 'MT' => '0356', 'MH' => '0692', 
		'MQ' => '0596', 'MR' => '0222', 'MU' => '0230', 'YT' => '0269', 'MX' => '052', 'FM' => '0691', 'MD' => '0373', 'MC' => '0377', 
		'MN' => '0976', 'MS' => '01-664', 'MA' => '0212', 'MZ' => '0258', 'MM' => '095', 'NA' => '0264', 'NR' => '0674', 'NP' => '0977', 
		'NL' => '031', 'AN' => '0599', 'NC' => '0687', 'NZ' => '064', 'NI' => '0505', 'NE' => '0227', 'NG' => '0234', 'NU' => '0683', 
		'NF' => '0672', 'MP' => '01-670', 'NO' => '047', 'OM' => '0968', 'PK' => '092', 'PW' => '0680', 'PS' => '0970', 'PA' => '0507', 
		'PG' => '0675', 'PY' => '0595', 'PE' => '051', 'PH' => '063', 'PL' => '048', 'PT' => '0351', 'PR' => '01-787', 'QA' => '0974', 
		'RE' => '0262', 'RO' => '040', 'RU' => '07', 'RW' => '0250', 'SH' => '0290', 'KN' => '01-869', 'LC' => '01-758', 'PM' => '0508', 
		'VC' => '01-784', 'WS' => '0685', 'SM' => '0378', 'ST' => '0239', 'SA' => '0966', 'SN' => '0221', 'SC' => '0248', 'SL' => '0232', 
		'SG' => '065', 'SK' => '0421', 'SI' => '0386', 'SB' => '0677', 'SO' => '0252', 'ZA' => '027', 'ES' => '034', 'LK' => '094', 'SD' => 
		'0249', 'SR' => '0597', 'SZ' => '0268', 'SE' => '046', 'CH' => '041', 'SY' => '0963', 'TW' => '0886', 'TJ' => '0992', 'TZ' => '0255', 
		'TH' => '066', 'TK' => '0690', 'TO' => '0676', 'TT' => '01-868', 'TN' => '0216', 'TR' => '090', 'TM' => '0993', 'TC' => '01-649', 
		'TV' => '0688', 'UG' => '0256', 'UA' => '0380', 'AE' => '0971', 'GB' => '044', 'US' => '01', 'UY' => '0598', 'UZ' => '0998', 
		'VU' => '0678', 'VA' => '0418', 'VE' => '058', 'VN' => '084', 'VI' => '01-284', 'VQ' => '01-340', 'WF' => '0681', 'YE' => '0967', 
		'ZM' => '0260', 'ZW' => '0263'];
		$length = 4;
		if(strlen($id) <= '4'){
			$suite = substr(str_repeat(0, $length).$id, - $length);
		}else{
			$suite = $id;
		}

		$suitenumber 	= (get_user_meta($id, 'suite_number', true))? get_user_meta($id, 'suite_number', true) : $countryCodeRef[$countrycode].'-'.$suite;
		return $suitenumber;
	}


	public function wc_order_form_buy()
	{

		$email = ''; $name = ''; $address_1 = ''; $address_2 = ''; $city = ''; $state = ''; $postcode = ''; $userCountry = ''; $phone = ''; $suitenumber = '';
		// $countryCodeRef = ['EG'=> '020', 'AE'=> '971', 'LK' => '000'];
		if(is_user_logged_in()){
			$id = get_current_user_id();
			$customer      = new WC_Customer( $id );
			
			$email			= $customer->get_email();
			$name			= $customer->get_first_name().' '.$customer->get_last_name();
			$username		= $customer->get_username();
			$address_1  	= $customer->get_billing_address_1();
			$address_2  	= $customer->get_billing_address_2();
			$city       	= $customer->get_billing_city();
			$state      	= $customer->get_billing_state();
			$postcode   	= $customer->get_billing_postcode();
			$countrycode	= (get_user_meta($id, 'xoo_aff_country_rohad', true))? get_user_meta($id, 'xoo_aff_country_rohad', true) : $customer->get_billing_country();
			$phone      	= $customer->get_billing_phone();
			$userCountry	= WC()->countries->countries[$countrycode]; 
			
			$suitenumber = $this->generateSuiteNumber($id, $countrycode);
		}

		$form_buy = '<div class="container">';
		if(isset($_GET['success']) && $_GET['success'] == 'true'){
			$orderid = (isset($_GET['order_id'])) ? $_GET['order_id'] : '';
			$form_buy .= '<div class="alert alert-success" role="alert">You request sent successfully, Your order Id#'.$orderid.'</div>';
		}
		if(isset($_GET['success']) && $_GET['success'] == 'false'){
			$form_buy .= '<div class="alert alert-danger" role="alert">You request unsuccessfull</div>';
		}
		$form_buy .= '<form id="buy_for_me" class="multiStepForm" action="'.admin_url( 'admin-post.php' ).'" method="POST" enctype="multipart/form-data">';
		$form_buy .= '<h2>Customer details</h2>';

		$form_buy .= '<div class="form-row">';
		$form_buy .= '<div class="col col-md-6">';		
		$form_buy .= '<label label-for="name">Name:</label>';
		$form_buy .= '<input class="form-control" type="text" name="name" value="'.$name.'" readonly/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="col col-md-6">';
		$form_buy .= '<label label-for="contact_number">Contact Number: </label>';
		$form_buy .= '<input class="form-control" type="text" name="contact_number" value="'.$phone.'" readonly/>';
		$form_buy .= '</div>';
		$form_buy .= '</div>';

		$form_buy .= '<div class="form-row">';
		$form_buy .= '<div class="col col-md-6">';
		$form_buy .= '<label label-for="email_address">Email Address: </label>';
		$form_buy .= '<input class="form-control" type="text" name="email_address" value="'.$email.'"  readonly/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="col col-md-6">';
		$form_buy .= '<label label-for="suite_number">Suite No: </label>';
		$form_buy .= '<input class="form-control" type="text" name="suite_number" value="'.$suitenumber.'"  readonly/>';
		$form_buy .= '</div>';
		$form_buy .= '</div>';

		$form_buy .= '<h2 style="display:inline-block;">Product details</h2>';

		$form_buy .= '<div class="input-div">';
		$form_buy .= '<div class="form-row">';		
		$form_buy .= '<div class="col col-md-12">';	
		$form_buy .= '<label label-for="item_photo">Item Photo (upload photo): </label>';
		$form_buy .= '<input type="file" class="form-control-file" name="item_photo[]" required>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="col col-md-12">';	
		$form_buy .= '<label label-for="item_url">Item URL: </label>';
		$form_buy .= '<input class="form-control" type="text" name="item_url[]" required/>';
		$form_buy .= '</div>';
		$form_buy .= '<div class="col col-md-12">';	
		$form_buy .= '<label label-for="item_price">Item price: </label>';
		$form_buy .= '<input class="form-control" type="text" name="item_price[]" required/>';	
		$form_buy .= '</div>';		
		$form_buy .= '<div class="date-field-actions" style="padding-left:15px;">';
		$form_buy .= '<button type="button" class="btn btn-primary add_button" id="addBtnbuy" name="addfield">Add more products</button>';
		$form_buy .= '</div>';
		$form_buy .= '</div>';
		$form_buy .= '</div>';


		$form_buy .= '<div class="form-row">';
		$form_buy .= '<div class="col col-md-12">';			
		$form_buy .= '<label label-for="special_instruction">Special Instructions: </label>';
		$form_buy .= '<textarea class="form-control" name="special_instruction"></textarea>';
		$form_buy .= '</div>';		
		$form_buy .= '<input type="hidden" name="action" value="add_buy_for_me_order_order">';		
		$form_buy .= wp_nonce_field( 'buy_for_me_order','_wpnonce' ,true ,false );
		$form_buy .= '</div>';
		$form_buy .= '<div class="col col-md-12">';
		$form_buy .= '<input class="btn btn-primary" type="submit" name="Submit request">';
		$form_buy .= '</div>';
		$form_buy .= '</div>';
		$form_buy .= '</form>';

		
		return $form_buy;
	}

	public function wc_order_form_ship()
	{
		$email = ''; $name = ''; $address_1 = ''; $address_2 = ''; $city = ''; $state = ''; $postcode = ''; $userCountry = ''; $phone = ''; $suitenumber = '';
		
		if(is_user_logged_in()){
			$id = get_current_user_id();
			$customer      = new WC_Customer( $id );
			
			$email			= $customer->get_email();
			$name			= $customer->get_first_name().' '.$customer->get_last_name();
			$username		= $customer->get_username();
			$address_1  	= $customer->get_billing_address_1();
			$address_2  	= $customer->get_billing_address_2();
			$city       	= $customer->get_billing_city();
			$state      	= $customer->get_billing_state();
			$postcode   	= $customer->get_billing_postcode();
			$countrycode	= (get_user_meta($id, 'xoo_aff_country_rohad', true))? get_user_meta($id, 'xoo_aff_country_rohad', true) : $customer->get_billing_country();
			$phone      	= $customer->get_billing_phone();
			$userCountry	= WC()->countries->countries[$countrycode];
			$suitenumber = $this->generateSuiteNumber($id, $countrycode);
		}

		$form_ship = '<div class="container">';
		if(isset($_GET['success']) && $_GET['success'] == 'true'){
			$orderid = (isset($_GET['order_id'])) ? $_GET['order_id'] : '';
			$form_ship .= '<div class="alert alert-success" role="alert">You request sent successfully, Your order Id#'.$orderid.'</div>';
		}
		if(isset($_GET['success']) && $_GET['success'] == 'false'){
			$form_ship .= '<div class="alert alert-danger" role="alert">You request unsuccessfull</div>';
		}
		$form_ship .= '<form id="pack_and_ship" class="multiStepForm" action="'.admin_url( 'admin-post.php' ).'" method="POST" enctype="multipart/form-data">';
		$form_ship .= '<h2>Customer details</h2>';
		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-6">';		
		$form_ship .= '<label label-for="name">Name: </label>';
		$form_ship .= '<input class="form-control" type="text" name="name" value="'.$name.'"  readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-6">';	
		$form_ship .= '<label label-for="contact_number">Contact Number: </label>';
		$form_ship .= '<input class="form-control" type="text" name="contact_number" value="'.$phone.'"   readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-6">';			
		$form_ship .= '<label label-for="email_address">Email Address: </label>';
		$form_ship .= '<input class="form-control" type="text" name="email_address" value="'.$email.'"  readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-6">';	
		$form_ship .= '<label label-for="suite_number">Suite No: </label>';
		$form_ship .= '<input class="form-control" type="text" name="suite_number" value="'.$suitenumber.'"  readonly/>';
		$form_ship .= '</div>';		
		$form_ship .= '</div>';

		$form_ship .= '<h2 style="display:inline-block;">Product details</h2>';	

		$form_ship .= '<div class="input-div">';
		$form_ship .= '<div class="form-row">';		
		$form_ship .= '<div class="col col-md-12">';			
		$form_ship .= '<label label-for="item_photo">Item Photo (upload photo): </label>';
		$form_ship .= '<input type="file" class="form-control-file" name="item_photo[]" required>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-12">';		
		$form_ship .= '<label label-for="item_url">Item URL: </label>';
		$form_ship .= '<input class="form-control" type="text" name="item_url[]" required/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<label label-for="item_price">Item price: </label>';
		$form_ship .= '<input class="form-control" type="text" name="item_price[]" required/>';	
		$form_ship .= '</div>';		
		$form_ship .= '<div class="date-field-actions"  style="padding-left:15px;">';
		$form_ship .= '<button type="button" class="btn btn-primary add_button" id="addBtnbuy" name="addfield">Add more products</button>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';

		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-12">';		
		$form_ship .= '<label label-for="special_instruction">Special Instructions: </label>';
		$form_ship .= '<textarea class="form-control" name="special_instruction"></textarea>';
		$form_ship .= '</div>';		
		$form_ship .= '</div>';		
		$form_ship .= '<input type="hidden" name="action" value="add_pack_and_ship_order">';
		$form_ship .= wp_nonce_field( 'pack_and_ship_order' );
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<input class="btn btn-primary" type="submit" name="Submit request">';
		$form_ship .= '</div>';	
		$form_ship .= '</div>';	

		$form_ship .= '</form>';	
		return $form_ship;
	}

	public function wc_order_form_ondemad()
	{
		$email = ''; $name = ''; $address_1 = ''; $address_2 = ''; $city = ''; $state = ''; $postcode = ''; $userCountry = ''; $phone = ''; $suitenumber = '';
		
		if(is_user_logged_in()){
			$id = get_current_user_id();
			$customer      = new WC_Customer( $id );
			
			$email			= $customer->get_email();
			$name			= $customer->get_first_name().' '.$customer->get_last_name();
			$username		= $customer->get_username();
			$address_1  	= $customer->get_billing_address_1();
			$address_2  	= $customer->get_billing_address_2();
			$city       	= $customer->get_billing_city();
			$state      	= $customer->get_billing_state();
			$postcode   	= $customer->get_billing_postcode();
			$countrycode	= (get_user_meta($id, 'xoo_aff_country_rohad', true))? get_user_meta($id, 'xoo_aff_country_rohad', true) : $customer->get_billing_country();
			$phone      	= $customer->get_billing_phone();
			$userCountry	= WC()->countries->countries[$countrycode];
			$suitenumber = $this->generateSuiteNumber($id, $countrycode);
		}

		$form_ship = '<div class="container">';
		if(isset($_GET['success']) && $_GET['success'] == 'true'){
			$orderid = (isset($_GET['order_id'])) ? $_GET['order_id'] : '';
			$form_ship .= '<div class="alert alert-success" role="alert">You request sent successfully, Your order Id#'.$orderid.'</div>';
		}
		if(isset($_GET['success']) && $_GET['success'] == 'false'){
			$form_ship .= '<div class="alert alert-danger" role="alert">You request unsuccessfull</div>';
		}
		$form_ship .= '<form id="ondemand" class="multiStepForm" action="'.admin_url( 'admin-post.php' ).'" method="POST" enctype="multipart/form-data">';
		$form_ship .= '<h2>Customer details</h2>';
		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-6">';
		$form_ship .= '<label label-for="name">Name: </label>';
		$form_ship .= '<input class="form-control" type="text" name="name" value="'.$name.'"  readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-6">';
		$form_ship .= '<label label-for="contact_number">Contact Number: </label>';
		$form_ship .= '<input class="form-control" type="text" name="contact_number" value="'.$phone.'"   readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-6">';	
		$form_ship .= '<label label-for="email_address">Email Address: </label>';
		$form_ship .= '<input class="form-control" type="text" name="email_address" value="'.$email.'"  readonly/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-6">';	
		$form_ship .= '<label label-for="suite_number">Suite No: </label>';
		$form_ship .= '<input class="form-control" type="text" name="suite_number" value="'.$suitenumber.'"  readonly/>';
		$form_ship .= '</div>';		
		$form_ship .= '</div>';
		
		$form_ship .= '<h2 style="display:inline-block;">Product details</h2>';

		$form_ship .= '<div class="input-div">';
		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<label label-for="item_photo">Item Photo (upload photo): </label>';
		$form_ship .= '<input type="file" class="form-control-file" name="item_photo[]" required>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<label label-for="item_description">Item Description: </label>';
		$form_ship .= '<input class="form-control" type="text" name="item_description[]" required/>';
		$form_ship .= '</div>';
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<label label-for="item_price">Item price: </label>';
		$form_ship .= '<input class="form-control" type="text" name="item_price[]" required/>';	
		$form_ship .= '</div>';		
		$form_ship .= '<div class="date-field-actions" style="padding-left:15px;">';
		$form_ship .= '<button type="button" class="btn btn-primary add_button" id="addBtnbuy" name="addfield">Add more products</button>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';
		$form_ship .= '</div>';

		$form_ship .= '<div class="form-row">';
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<label label-for="special_instruction">Special Instructions: </label>';
		$form_ship .= '<textarea class="form-control" name="special_instruction"></textarea>';
		$form_ship .= '</div>';		
		$form_ship .= '</div>';		
		$form_ship .= '<input type="hidden" name="action" value="add_ondemand_order">';
		$form_ship .= wp_nonce_field( 'ondemand_order' );
		$form_ship .= '<div class="col col-md-12">';	
		$form_ship .= '<input class="btn btn-primary" type="submit" name="Submit request">';
		$form_ship .= '</div>';			
		$form_ship .= '</div>';			
		$form_ship .= '</form>';
		return $form_ship;
	}

	//Custom Setting Page in WordPress
	//https://themes.artbees.net/blog/custom-setting-page-in-wordpress/

	public function custom_order_admin_menu() {
		add_menu_page(
			'WC customs order forms',
			'WC customs order forms',
			'manage_options',
			$this->plugin_name,
			array($this, 'custom_order_form_settings'),
			'dashicons-hammer',100);
	}

	public function custom_order_form_settings() {
		require_once( plugin_dir_path( __FILE__ ) . 'partials/wc-custom-order-forms-admin-display.php' );
	}
	
	function custom_order_settings_init() {
	
		add_settings_section(
			'wc_order_setting_section',
			'',
			'',
			'wc-custom-order-page'
		);
	
		add_settings_field(
			'wc_order_custom_form_setting_field',
			'Buy for me form page',
			array($this, 'wc_order_custom_form_setting_markup'),
			'wc-custom-order-page',
			'wc_order_setting_section'
		);

		add_settings_field(
			'wc_order_custom_form_setting_field_2',
			'Pack and ship form page',
			array($this, 'wc_order_custom_form_setting_markup_2'),
			'wc-custom-order-page',
			'wc_order_setting_section'
		);

		register_setting( 'wc-custom-order-page', 'wc_order_custom_form_setting_field' );
		register_setting( 'wc-custom-order-page', 'wc_order_custom_form_setting_field_2' );
	}
	
	
	function wc_order_custom_form_setting_markup() {
		//$pages = get_pages();
		//var_dump($pages);
		$buyforme = get_option( 'wc_order_custom_form_setting_field' );
		?>
		<select id="wc_order_custom_form_setting_field" name="wc_order_custom_form_setting_field">
			<option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
			<?php 
			$pages = get_pages(); 
			foreach ( $pages as $page ) {
				$option = '<option value="' . $page->ID . '" '.selected( $buyforme, $page->ID ).'>';
				$option .= $page->post_title;
				$option .= '</option>';
				echo $option;
			}
			?>
		</select>
		<?php
	}
	function wc_order_custom_form_setting_markup_2() {
		$packandship = get_option( 'wc_order_custom_form_setting_field_2' );
		?>
		<select id="wc_order_custom_form_setting_field_2" name="wc_order_custom_form_setting_field_2">
			<option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
			<?php 
			$pages = get_pages(); 
			foreach ( $pages as $page ) {
				$option = '<option value="' . $page->ID . '" '.selected( $packandship, $page->ID ).'>';
				$option .= $page->post_title;
				$option .= '</option>';
				echo $option;
			}
			?>
		</select>
		<?php
	}

	function custom_order_my_account_link( $menu_links ){

		$new = array( 'buy4me' => 'Buy for me ','packAndship' => 'PackNShip' );

		// array_slice() is good when you want to add an element between the other ones
		$menu_links = array_slice( $menu_links, 0, 1, true ) + $new + array_slice( $menu_links, 1, NULL, true );
		return $menu_links;
	}

	function custom_order_hook_endpoint( $url, $endpoint, $value, $permalink ){
	
		if( $endpoint === 'buy4me' ) {
			$buyforme = get_option( 'wc_order_custom_form_setting_field' );
			//get_permalink();
			// ok, here is the place for your custom URL, it could be external
			$url = get_permalink($buyforme);
		}
		if( $endpoint === 'packAndship' ) {
			$packandship = get_option( 'wc_order_custom_form_setting_field_2' );
			// ok, here is the place for your custom URL, it could be external
			$url = get_permalink($packandship);
			//$url = site_url();
		}
		return $url;
	
	}

}
