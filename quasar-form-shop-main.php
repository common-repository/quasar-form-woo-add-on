<?php
/*
Plugin Name: Quasar Form add-on for WooCommerce
Plugin URI: https://woocommerce.quasar-form.com
Description: Allows you to use forms from the Quasar Form plugin as quick order forms in Woocommerce 
Version: 1.7
Author: nucleus_genius

*/

//v
define( 'quasar_form_shop_free_version', '1.7' );


// add button admin
function quasar_form_shop_free_main_addpanel() {
   add_menu_page('Quasar-form-pro', 'QF for Woo', 'manage_options', 'quasar-form-woo-add-on/admin.php', '', plugins_url( '/assets/img/icon2.png', __FILE__  ));
}
add_action('admin_menu', 'quasar_form_shop_free_main_addpanel' ); 



//creating a database when activating the plugin
function quasar_form_shop_free_addtable (){
	global $wpdb;
    $table_name = $wpdb->base_prefix . 'quasarform_shop';
    $sql = "CREATE TABLE $table_name (
			id int(11) NOT NULL AUTO_INCREMENT,
			mainparams mediumtext NOT NULL,
			UNIQUE KEY id (id)
			);";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	
    //default option
    $quasar_form_option = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_shop", ARRAY_A  );
    if ( count($quasar_form_option) == 0 ) {
        $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->base_prefix}quasarform_shop ( `mainparams` ) VALUES ( %s )",  '{"dataForm":"Select form","dataTextButton":"Buy one click","dataPosition":"variant1","dataPosition2":"variant1","dataIdForm":"","dataCreateOrder":"yes","dataTextPrice":"","dataTextQuantity":"","dataShowStockZero":"yes","dataPositionCurrency":"left","dataFirstName":"0","dataLasttName":"0","dataEmail":"0","dataPhone":"0","dataCompany":"0","dataAddress":"0","dataCity":"0","dataState":"0","dataPostcode":"0","dataCountry":"US","dataComment":"0","dataQuanity":"0","dataShowImg":"yes","dataShowPrice":"yes","dataShowQuanity":"yes","dataShowName":"yes","dataFontName":"16px","dataColorName":"#262626","dataFontHeading":"14px","dataColorHeading":"#262626","dataFontInput":"14px","dataColorSections":"#262626","dataBackgroundSections":"#f1f1f1","dataBorderSections":"#d9d9d9","dataButtonAlign":"center","dataButtonMagrinCategory":"0px;0px;10px;0px","dataButtonMagrinCart":"20px;0px;0px;0px","dataTypeVariable":"select","dataFontVariable":"14px","dataColorVariable":"#000","dataBackgroundVariable":"#f1f1f1","dataVariableBorderWidth":"1px","dataVariableBorderColor":"#d9d9d9","dataVariableMargin":"20px;20px;0px;0px","dataVariableActivColor":"#fff","dataVariableActivBackground":"#7d7b7b","dataVariableActivBorderColor":"#848484","dataVariableBoxSize":"50px","dataAttributeFontSize":"14px","dataAttributeFontWeight":"600","dataAttributeFontColor":"#000","dataShowVariable":"yes"}'));
    }
	

}
register_activation_hook( __FILE__, 'quasar_form_shop_free_addtable' );




//lang dirname
function quasar_form_shop_free_lang() {
	load_plugin_textdomain( 'quasar-form-shop', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' ); 
}
add_action( 'plugins_loaded', 'quasar_form_shop_free_lang' );


//frontend style and script
function quasar_form_shop_free_frontend(){
    
    wp_enqueue_style('quasar-woo-frontend-style', plugins_url( '/assets/css/frontend.css', __FILE__ ), array(), quasar_form_shop_free_version );
    
    //add frontend js
    wp_enqueue_script('quasar-woo-frontend-script',plugins_url( '/assets/js/frontend.js', __FILE__ ), array('jquery') , quasar_form_shop_free_version, true);
    
    
    wp_localize_script('quasar-woo-frontend-script', 'params',
        array(
            'ajaxurlq' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('nonce-frontend-q')
        )
    ); 
}
add_action('wp_footer','quasar_form_shop_free_frontend');



//add script admin page 
function quasar_form_shop_free_admin_script( $hook ){
    if( $hook != 'quasar-form-woo-add-on/admin.php' ) return;
    
    //hide notifications
    remove_all_actions('admin_notices');

    //admin
    wp_register_script('quasar-woo-admin-script', plugins_url( '/assets/js/admin.js', __FILE__ ), array(), quasar_form_shop_free_version  );
    wp_enqueue_script('quasar-woo-admin-script');
    
    //admin fa fa
    wp_enqueue_style('Quasar-form-font-awesome', plugins_url( '/assets/font-awesome/css/font-awesome.min.css', __FILE__ ), array(), quasar_form_shop_free_version  ); 
    
    
    //admin ajax
    wp_localize_script('quasar-woo-admin-script', 'params',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('q-ajax-nonce')
        )
    ); 

    //admin css
    wp_enqueue_style('Quasar-form-admin-style', plugins_url( '/assets/css/admin.css', __FILE__ ), array(), quasar_form_shop_free_version );
    
    wp_enqueue_script('jquery-color');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('iris');
    wp_enqueue_media();
    //admin alfa color picker
    wp_enqueue_style( 'Quasar-form-color-picker-alpha' );
    wp_enqueue_script( 'Quasar-form-color-picker-alpha',  plugins_url( '/lib/wp-color-picker-alpha-master/dist/wp-color-picker-alpha.min.js', __FILE__ ) , array( 'wp-color-picker' ) , quasar_form_shop_free_version , true);
    
    //color localization
    wp_localize_script('Quasar-form-color-picker-alpha', 'localizationColor',
        array(
            'color' => esc_html__('Select Color','quasar-form-shop'),
            'clear' => esc_html__('Clear','quasar-form-shop'),
        )
    ); 
  
}
add_action('admin_enqueue_scripts','quasar_form_shop_free_admin_script');



if( !is_admin() ){
	global $wpdb;
    $quasar_form_shop = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_shop WHERE id='1'", ARRAY_A  );
    foreach($quasar_form_shop as $row){
        $quasar_array_option = json_decode( $row['mainparams'] , true ); 
        if ( !$quasar_array_option ){ $quasar_array_option = json_decode( stripslashes($row['mainparams']) , true );}
    }
    //variable deoult
    if ( !isset($quasar_array_option['dataTypeVariable']) ){ $quasar_array_option['dataTypeVariable'] = 'select'; } 
    if ( !isset($quasar_array_option['dataFontVariable']) ){ $quasar_array_option['dataFontVariable'] = '14px'; }
    if ( !isset($quasar_array_option['dataColorVariable']) ){ $quasar_array_option['dataColorVariable'] = '#000'; }
    if ( !isset($quasar_array_option['dataBackgroundVariable']) ){ $quasar_array_option['dataBackgroundVariable'] = '#f1f1f1'; }
    if ( !isset($quasar_array_option['dataVariableBorderWidth']) ){ $quasar_array_option['dataVariableBorderWidth'] = '1px'; }
    if ( !isset($quasar_array_option['dataVariableBorderColor']) ){ $quasar_array_option['dataVariableBorderColor'] = '#d9d9d9'; }
    if ( !isset($quasar_array_option['dataVariableMargin']) ){ $quasar_array_option['dataVariableMargin'] = '0px;0px;0px;0px'; }
    if ( !isset($quasar_array_option['dataVariableActivColor']) ){ $quasar_array_option['dataVariableActivColor'] = '#fff'; }
    if ( !isset($quasar_array_option['dataVariableActivBackground']) ){ $quasar_array_option['dataVariableActivBackground'] = '#7d7b7b'; }
    if ( !isset($quasar_array_option['dataVariableActivBorderColor']) ){ $quasar_array_option['dataVariableActivBorderColor'] = '#848484'; }
    if ( !isset($quasar_array_option['dataVariableBoxSize']) ){ $quasar_array_option['dataVariableBoxSize'] = '50px'; }
    if ( !isset($quasar_array_option['dataVariaSelecttext']) ){ $quasar_array_option['dataVariaSelecttext'] = 'Select option'; }
    if ( !isset($quasar_array_option['dataVariableBorderRadius']) ){ $quasar_array_option['dataVariableBorderRadius'] = '0px'; }
    
    
    if ( !isset($quasar_array_option['dataAttributeFontSize']) ){ $quasar_array_option['dataAttributeFontSize'] = '14px'; }
    if ( !isset($quasar_array_option['dataAttributeFontWeight']) ){ $quasar_array_option['dataAttributeFontWeight'] = '600'; }
    if ( !isset($quasar_array_option['dataAttributeFontColor']) ){ $quasar_array_option['dataAttributeFontColor'] = '#000'; }
    if ( !isset($quasar_array_option['dataShowVariable']) ){ $quasar_array_option['dataShowVariable'] = 'yes'; } 
    
    if ( !isset($quasar_array_option['dataTextRequired']) ){ $quasar_array_option['dataTextRequired'] = ''; } 
    if ( !isset($quasar_array_option['dataTextNotVariation']) ){ $quasar_array_option['dataTextNotVariation'] = ''; }
    if ( !isset($quasar_array_option['dataVariableIMG']) ){ $quasar_array_option['dataVariableIMG'] = 'not'; }
    if ( !isset($quasar_array_option['dataVariableStyleType']) ){ $quasar_array_option['dataVariableStyleType'] = ''; }
    
    if ( !isset($quasar_array_option['dataPrioritetCategory']) ){ $quasar_array_option['dataPrioritetCategory'] = '25'; }
    if ( !isset($quasar_array_option['dataPrioritetCart']) ){ $quasar_array_option['dataPrioritetCart'] = '25'; }
    
    if ( !isset($quasar_array_option['dataFontHeadingPrice']) ){ $quasar_array_option['dataFontHeadingPrice'] = '14px'; }
    if ( !isset($quasar_array_option['dataColorHeadingPrice']) ){ $quasar_array_option['dataColorHeadingPrice'] = '#262626'; }
    if ( !isset($quasar_array_option['dataFontPrice']) ){ $quasar_array_option['dataFontPrice'] = '14px'; }
    
    if ( !isset($quasar_array_option['dataColorPrice']) ){ $quasar_array_option['dataColorPrice'] = '#000'; }
    if ( !isset($quasar_array_option['dataBackgroundPrice']) ){ $quasar_array_option['dataBackgroundPrice'] = '#fff'; }
    if ( !isset($quasar_array_option['dataBorderColorPrice']) ){ $quasar_array_option['dataBorderColorPrice'] = '#fff'; }
    if ( !isset($quasar_array_option['dataAllChoseSelectionText']) ){ $quasar_array_option['dataAllChoseSelectionText'] = esc_html__('Select a value in each option','quasar-form-shop');}
    if ( !isset($quasar_array_option['dataPrioritetCart']) ){ $quasar_array_option['dataPrioritetCart'] = '25'; } 
    if ( !isset($quasar_array_option['dataPrioritetCategory']) ){ $quasar_array_option['dataPrioritetCategory'] = '25'; }
    
    if ( !isset($quasar_array_option['dataConnectionAttributeQuasar']) ){ $quasar_array_option['dataConnectionAttributeQuasar'] = 'not'; }


} 


//add button
function quasar_form_shop_free_add_button($q){
    global  $quasar_array_option,$product,$post;
    $setting = $quasar_array_option['dataShowImg'].';'.$quasar_array_option['dataShowPrice'].';'.$quasar_array_option['dataShowQuanity'].';'.$quasar_array_option['dataShowName'].';'.$quasar_array_option['dataFontName'].';'.$quasar_array_option['dataColorName'].';'.$quasar_array_option['dataFontHeading'].';'.$quasar_array_option['dataColorHeading'].';'.$quasar_array_option['dataFontInput'].';'.$quasar_array_option['dataColorSections'].';'.$quasar_array_option['dataBackgroundSections'].';'.$quasar_array_option['dataBorderSections'].';'.$quasar_array_option['dataPositionCurrency'].';'.$quasar_array_option['dataFontHeadingPrice'].';'.$quasar_array_option['dataColorHeadingPrice']   .';'.$quasar_array_option['dataFontPrice'].';'.$quasar_array_option['dataColorPrice'].';'.$quasar_array_option['dataBackgroundPrice'].';'.$quasar_array_option['dataBorderColorPrice'];
    
    //if stock 0 not show
    if ( $quasar_array_option['dataShowStockZero'] == 'not' ) {
        if ( !$product->is_in_stock() ){ return; }
    }


    //simple product
    if ( $product->is_type( 'simple' ) ) {
        $currency = get_woocommerce_currency();
        $currency = get_woocommerce_currency_symbol( $currency = $currency );
        
        //class button cart
        if ( $q == 1){
            $margin = explode(';', $quasar_array_option['dataButtonMagrinCart']);
            $class = 'cart-button-q';
            $style = 'margin-left:'.$margin['0'].'; margin-right:'.$margin['1'].'; margin-top:'.$margin['2'].'; margin-bottom:'.$margin['3'];
        }
        //category
        else {
            $margin = explode(';', $quasar_array_option['dataButtonMagrinCategory']);
            $class = 'category-button-q';
            $style = 'margin-left:'.$margin['0'].'; margin-right:'.$margin['1'].'; margin-top:'.$margin['2'].'; margin-bottom:'.$margin['3'];
            
            if ( $quasar_array_option['dataButtonAlign'] =='left' ){ $class.=' left-align-c-b-q';}
            else if ( $quasar_array_option['dataButtonAlign'] =='right' ){ $class.=' right-align-c-b-q';}
            else if ( $quasar_array_option['dataButtonAlign'] =='center' ){ $class.=' center-align-c-b-q';}
        }
        
        return '<div class="wrap-button-quasar-woo '.esc_attr( $class ).'" style="'.esc_attr( $style ).'" data-id="'.esc_attr( $product->get_id() ).'" data-name="'.esc_attr( $product->get_name() ).'" data-price="'.esc_attr( $product->get_price() ).'" data-price-2="" data-price-3="'.esc_attr( $product->get_regular_price() ).'" data-img="'.esc_url( get_the_post_thumbnail_url($post->ID) ).'" data-currency="'.esc_attr( $currency ).'" data-setting="'.esc_attr( $setting ).'" data-h-1="'.esc_html( $quasar_array_option['dataTextPrice'] ).'" data-h-2="'.esc_html( $quasar_array_option['dataTextQuantity'] ).'"  data-qua="'.esc_attr( $quasar_array_option['dataQuanity'] ).'">'.do_shortcode( '[formaQ id="'.esc_attr($quasar_array_option['dataIdForm']).'" type="popup" align="center" text="'.esc_html($quasar_array_option['dataTextButton']).'" ]' )."</div>";
    }
    
}

 
if( !is_admin() ){
    //add button position 1
    add_action( 'woocommerce_after_add_to_cart_button', 'quasar_form_shop_free_add_button_1', $quasar_array_option['dataPrioritetCart'] );
    function quasar_form_shop_free_add_button_1(){
        global  $quasar_array_option;
        if ( $quasar_array_option['dataPosition']== 'variant1' ){
            echo quasar_form_shop_free_add_button(1);
        }
    }
    
    
    //add button position 2
    add_action( 'woocommerce_before_quantity_input_field', 'quasar_form_shop_free_add_button_2', $quasar_array_option['dataPrioritetCart']);
    function quasar_form_shop_free_add_button_2(){
        global  $quasar_array_option;
        if ( $quasar_array_option['dataPosition']== 'variant2' ){
            echo quasar_form_shop_free_add_button(1);
        }
    }
    
    //add button position 3 or if stock 0
    add_action( 'woocommerce_single_product_summary', 'quasar_form_shop_free_add_button_3', $quasar_array_option['dataPrioritetCart'] );
    function quasar_form_shop_free_add_button_3(){
       	global  $quasar_array_option, $product;
        if ( $quasar_array_option['dataPosition']== 'variant3' || ( $quasar_array_option['dataShowStockZero'] == 'yes' &&  $quasar_array_option['dataPosition']!= 'variant4' &&  !$product->is_in_stock()  && $product->is_type( 'simple' ) ) ){
            echo quasar_form_shop_free_add_button(1);
        }
    }
    
    //add button position 4
    add_action( 'woocommerce_product_meta_end', 'quasar_form_shop_free_add_button_4', $quasar_array_option['dataPrioritetCart']);
    function quasar_form_shop_free_add_button_4(){
        global  $quasar_array_option;
        if ( $quasar_array_option['dataPosition']== 'variant4' ){
            echo quasar_form_shop_free_add_button(1); 
        }
    }
    
    
    //archive & category position 1
    add_action( 'woocommerce_after_shop_loop_item', 'quasar_form_shop_free_archive_button_1', $quasar_array_option['dataPrioritetCategory'] );
    function quasar_form_shop_free_archive_button_1(){
        global  $quasar_array_option,$product;
        if ( $quasar_array_option['dataPosition2']== 'variant1' ){
            if ( $quasar_array_option['dataShowStockZero'] == 'yes' ){
                echo quasar_form_shop_free_add_button(2);
            }
            else { 
                //stock != 0
                if ( $product->is_in_stock() ) {
                    echo quasar_form_shop_free_add_button(2) ;
                }
            }
        }
    }
    
    //archive & category position 2
    add_action( 'woocommerce_before_shop_loop_item', 'quasar_form_shop_free_archive_button_2', $quasar_array_option['dataPrioritetCategory'] );
    function quasar_form_shop_free_archive_button_2(){
        global  $quasar_array_option,$product;
        if ( $quasar_array_option['dataPosition2']== 'variant2' ){
            if ( $quasar_array_option['dataShowStockZero'] == 'yes' ){
                echo quasar_form_shop_free_add_button(2);
            }
            else { 
                //stock != 0
                if ( $product->is_in_stock() ) {
                    echo quasar_form_shop_free_add_button(2) ;
                }
            }
        }
    }
}



add_action('wp_ajax_save_woo_setting', 'quasar_form_shop_free_save');

add_action('wp_ajax_send_woo_form', 'quasar_form_shop_free_send_woo_form');
add_action('wp_ajax_nopriv_send_woo_form', 'quasar_form_shop_free_send_woo_form'); 



// save/update form
function quasar_form_shop_free_save(){

    check_ajax_referer( 'q-ajax-nonce', 'nonce_code' );
    
    // Stop if the current user is not an admin or do not have administrative access
	if( ! current_user_can( 'manage_options' ) ) {
		die();
	}


    $quasar_woo_save_array = array(
        'dataForm' => sanitize_text_field( $_POST['dataForm'] ),
        'dataTextButton' => sanitize_text_field( $_POST['dataTextButton'] ),
    );
    

    $quasar_woo_save_array = sanitize_text_field( $_POST['arraySave'] );
    //decode
    $quasar_woo_save_array = json_decode( stripslashes($quasar_woo_save_array) , true ); //remove 
    //povtornoe codirovabie for kirilici
    $quasar_woo_save_array = json_encode($quasar_woo_save_array);

    

    global $wpdb;
    $update_check = $wpdb->get_results("SELECT * FROM {$wpdb->base_prefix}quasarform_shop ", ARRAY_A  );

    //updating the current form
    $wpdb->update( "{$wpdb->prefix}quasarform_shop",
        [ 'mainparams' => $quasar_woo_save_array ],
	    [ 'id' => '1' ],
	    [ '%s' ],
	    [ '%s' ]
	 );
}




function quasar_form_shop_free_send_woo_form(){
    
    check_ajax_referer( 'nonce-frontend-q', 'nonce_code' );
    
    
    //data from bd
    global $wpdb,$product,$quasar_array_option;
    $quasar_form_shop = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_shop WHERE id='1'", ARRAY_A  );
    foreach($quasar_form_shop as $row){
        $quasar_array_option = json_decode( $row['mainparams'] , true ); 
        if ( !$quasar_array_option ){ $quasar_array_option = json_decode( stripslashes($row['mainparams']) , true ); }
    }
    //data from form
    $id_product = sanitize_text_field( $_POST['dataIdProduct'] );
    $quanity_defoult = sanitize_text_field( $_POST['dataQuantity'] );
    $data_val = sanitize_text_field( $_POST['dataVal'] );

    $object = sanitize_text_field( $_POST['dataSend'] );
    $object = explode( ',', $object);
    
    $arrayDataOrder = array(
        'FirstName' => '',
        'LastName' => '',
        'Company' => '',
        'Email' => '',
        'Phone' => '',
        'Address' => '',
        'City' => '',
        'State' => '',
        'Postcode' => '',
        'Country' => '',
        'Comment' => '',
        'Quanity' => '1',
        
    );
    $quanity = 0;

    foreach($object as $value){
        $value = explode(';', $value);
        if ( $quasar_array_option['dataFirstName'] == $value['0'] ){ $arrayDataOrder['FirstName'] = $value['2']; }
        if ( $quasar_array_option['dataLasttName'] == $value['0'] ){ $arrayDataOrder['LastName'] = $value['2']; }
        if ( $quasar_array_option['dataCompany'] == $value['0'] ){ $arrayDataOrder['Company'] = $value['2']; }
        if ( $quasar_array_option['dataEmail'] == $value['0'] ){ $arrayDataOrder['Email'] = $value['2']; }
        if ( $quasar_array_option['dataPhone'] == $value['0'] ){ $arrayDataOrder['Phone'] = $value['2']; }
        if ( $quasar_array_option['dataAddress'] == $value['0'] ){ $arrayDataOrder['Address'] = $value['2']; }
        if ( $quasar_array_option['dataCity'] == $value['0'] ){ $arrayDataOrder['City'] = $value['2']; }
        if ( $quasar_array_option['dataState'] == $value['0'] ){ $arrayDataOrder['State'] = $value['2']; }
        if ( $quasar_array_option['dataPostcode'] == $value['0'] ){ $arrayDataOrder['Postcode'] = $value['2']; }
        if ( $quasar_array_option['dataComment'] == $value['0'] ){ $arrayDataOrder['Comment'] = $value['2']; }
        //quanity
        if ( $quasar_array_option['dataQuanity'] == $value['0'] ){ $arrayDataOrder['Quanity'] = $value['2'];  $quanity++; }
  
    }
    
    //quanity defoult
    if ( $quanity == 0 ){
        $arrayDataOrder['Quanity'] = $quanity_defoult; 
    }
    //country
    $arrayDataOrder['Country'] = $quasar_array_option['dataCountry'];
    

	//create order
	if ( $quasar_array_option['dataCreateOrder'] !='not') {
	     $address = array(
            'first_name' => $arrayDataOrder['FirstName'],
            'last_name'  => $arrayDataOrder['LastName'],
            'company'    => $arrayDataOrder['Company'],
            'email'      => $arrayDataOrder['Email'],
            'phone'      => $arrayDataOrder['Phone'],
            'address_1'  => $arrayDataOrder['Address'],
            'address_2'  => '', 
            'city'       => $arrayDataOrder['City'],
            'state'      => $arrayDataOrder['State'],
            'postcode'   => $arrayDataOrder['Postcode'],
            'country'    => $arrayDataOrder['Country']
        );
        
        //for option all - add variable value in order
        $variations_array_for_all = [];
        if ( $data_val !='' ){
            $data_val = explode('|', $data_val);
            foreach ( $data_val as $key => $value ){
                if ( $value !='' ){
                    $value = explode(':', $value);
                    if ( taxonomy_exists('pa_'.$value['0']) ) { $variations_array_for_all['variation']['attribute_pa_'.$value['0']] = $value['1']; }
                    else { $variations_array_for_all['variation'][$value['0']] = $value['1'];   }
                }
            }
            
        }
        
        $order = wc_create_order();
        $order->add_product( wc_get_product( $id_product ), (int)$arrayDataOrder['Quanity'], $variations_array_for_all ); //(get_product with id and next is for quantity)
        $order->set_address( $address, 'billing' );
        $order->set_address( $address, 'shipping' );
        $order->set_customer_note( $arrayDataOrder['Comment']  ); //comment
        $order->calculate_totals();
	}

}



add_action('wp_ajax_save_shop_import_setting_q', 'quasar_form_shop_free_pro_export');
// save import export
function quasar_form_shop_free_pro_export(){

    check_ajax_referer( 'q-ajax-nonce', 'nonce_code' );
    
    // Stop if the current user is not an admin or do not have administrative access
	if( ! current_user_can( 'manage_options' ) ) {
		die();
	}

    $array_save_setting = sanitize_text_field( $_POST['arraySettingSave'] );
	
    global $wpdb;

    //updating the current form
    $wpdb->update( "{$wpdb->prefix}quasarform_shop",
        [ 'mainparams' => $array_save_setting ],
	    [ 'id' => '1' ],
	    [ '%s' ],
	    [ '%s' ]
	 );
}
