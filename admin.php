<?php 
    global $wpdb;
    $quasar_form_woo = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_shop WHERE id='1'", ARRAY_A  );
    foreach($quasar_form_woo as $row){
        $array_option = json_decode( $row['mainparams'], true   ); //remove /
        if ( !$array_option ){ $array_option = json_decode( stripslashes($row['mainparams']) , true );}
    }
    
    $url = plugins_url( '/assets/img/', __FILE__ );
    echo '<div class="img-dir-q">'.esc_url( $url ).'</div>';
?>

<div class='header-form-quasar'>
    <div class='swap-header-q'>
        <div class='swap-logo-header-q'>
            <div class='logo-header-q'>
                <div class='version-q-form'><span class='name-plugin-q'>Quasar Form add-on for WooCommerce</span> <?php esc_html_e('Version','quasar-form-shop');?> <span>1.7</span></div>
            </div> 
        </div>
        <div class='menu-header-q'>
        </div> 
    </div>  
</div>


<div class='swap-top-menu-q'>
    <div class='menu-top-q setting-q activ-tab-q' data-tab='1'><?php esc_html_e('Settings','quasar-form-shop'); ?></div>
    <div class='menu-top-q setting-q' data-tab='2'><?php esc_html_e('Design','quasar-form-shop'); ?></div>
    <div class='menu-top-q setting-q' data-tab='3'><?php esc_html_e('Localization','quasar-form-shop'); ?></div>
    <div class='menu-top-q setting-q' data-tab='4'><?php esc_html_e('Import/export settings','quasar-form-shop'); ?></div>
</div>
    
<div class='swap-panel-form-q'>
    <div class='text-help-heading'><?php echo esc_html__('This addon works according to the following algorithm. In the main settings. You select the form created in the Quasar Form plugin. Then you connect the fields of this form with the woccomerce order fields so that the form data appears in the order.','quasar-form-shop') ?></div>
    
    <?php 
    if ( !is_plugin_active('quasar-form-pro/quasar-form-main.php') && !is_plugin_active('quasar-form/quasar-form-main.php')) {
    
	    echo '<div class="error-not-plugin">'.esc_html__('Error: Quasar Form plugin not installed','quasar-form-shop').'</div>';
    }
    ?>

    <div class='wrap-setting-qf-woo tab-class-1'>
        
        <div class='section-heading-q heading-q'><?php echo esc_html__('Main settings','quasar-form-shop') ?></div>
        
        <div class='section-setting-q'>
            <div class='block-field-q drop-menu-select' class='menu-top-q'>
                <select id='list-form-q'>
                    <option data-id=''><?php esc_html_e('Select form','quasar-form-shop'); ?></option>
                    <?php //add list all form
                    global $wpdb  ;
                    $id_selected_form ='';
                    $quasar_form_array_form = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_main" , ARRAY_A  ); 
                    foreach($quasar_form_array_form as $quasar_form_row){
                        //name
                        if ( json_decode($quasar_form_row['name']) != null ){ 
                            $quasar_form_row['name'] = str_replace( 'RTQasB',  '\\',  $quasar_form_row['name'] );
                            $quasar_form_row['name'] = json_decode($quasar_form_row['name']);
                        }
                        if ( $array_option['dataForm'] == $quasar_form_row['name'] ) { 
                            echo '<option selected data-id="'.esc_attr($quasar_form_row['id']).'">' .esc_html( $quasar_form_row['name'] ). '</option>'; 
                            $id_selected_form = $quasar_form_row['id']; }
                        else { echo '<option data-id="'.esc_attr($quasar_form_row['id']).'">' .esc_html( $quasar_form_row['name'] ). '</option>'; }
                    }
                    ?> 
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Select the form that will be displayed in the product and used for quick ordering.','quasar-form-shop');?></div>
        </div>
            
        <div class='section-setting-q'>
            <div class='block-field-q'><input id='text-button-q' class='style-input-q' value="<?php echo esc_html($array_option['dataTextButton']) ?>"></div>
            <div class='text-setting-q'><?php esc_html_e('Button text','quasar-form-shop');?></div>
        </div>   
        
        <div class='section-setting-q'>
            <div class='block-field-q drop-menu-select' class='menu-top-q'>
                <select id='activation-created-order'>
                <?php 
                if ( $array_option['dataCreateOrder'] == 'yes' ){ echo '<option selected data-val="yes">'.esc_html__('Yes','quasar-form-shop').'</option>'; }
                else { echo '<option data-val="yes">'.esc_html__('Yes','quasar-form-shop').'</option>'; }
                
                if ( $array_option['dataCreateOrder'] == 'not' ){ echo '<option selected data-val="not">'.esc_html__('No','quasar-form-shop').'</option>'; }
                else { echo '<option data-val="not">'.esc_html__('No','quasar-form-shop').'</option>'; }
                ?>
                </select>
            </div> 
            <div class='text-setting-q'><?php esc_html_e('Create a new order in woocommerce when submitting a quick order form.','quasar-form-shop');?></div>
        </div>

    </div>
    
    
    <div class='wrap-setting-qf-woo tab-class-1'>
        
        <div class='section-heading-q heading-q'><?php echo esc_html__('Button location','quasar-form-shop') ?></div>
        
        <div class='section-setting-q location-setting-q'>
            <div class='block-field-q drop-menu-select prioritet-block'>
                <span><?php echo esc_html__('Product card','quasar-form-shop') ?></span>
                <select id='list-position'>
                    <?php 
                    if ( $array_option['dataPosition'] == 'variant1' ){ echo '<option selected data-val="variant1">'.esc_html__('After add to cart button','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant1">'.esc_html__('After add to cart button','quasar-form-shop').'</option>'; }
                    
                    if ( $array_option['dataPosition'] == 'variant2' ){ echo '<option selected data-val="variant2">'.esc_html__('Before quantity input field','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant2">'.esc_html__('Before quantity input field','quasar-form-shop').'</option>'; }
                    
                    if ( $array_option['dataPosition'] == 'variant3' ){ echo '<option selected data-val="variant3">'.esc_html__('After a short description (this option will work with a product without a price)','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant3">'.esc_html__('After a short description (this option will work with a product without a price)','quasar-form-shop').'</option>'; }
                    
                    if ( $array_option['dataPosition'] == 'variant4' ){ echo '<option selected data-val="variant4">'.esc_html__('Product meta end','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant4">'.esc_html__('Product meta end','quasar-form-shop').'</option>'; }
                    ?>
                </select>
            </div> 
            <div class='block-field-q drop-menu-select prioritet-block'>
                <span><?php echo esc_html__('Priority','quasar-form-shop') ?><span class='help-q q1'>?</span></span>
                <select id='position-prioritet-cart'>
                    <?php 
                    if ( !isset($array_option['dataPrioritetCart']) ){ $array_option['dataPrioritetCart'] = '25'; } 
                    
                    if ( $array_option['dataPrioritetCart'] == '0' ){ echo '<option selected data-val="0">0</option>'; }
                    else { echo '<option data-val="0">0</option>'; }
                    
                    if ( $array_option['dataPrioritetCart'] == '10' ){ echo '<option selected data-val="10">10</option>'; }
                    else { echo '<option data-val="10">10</option>'; }
                    
                    if ( $array_option['dataPrioritetCart'] == '25' ){ echo '<option selected data-val="25">25</option>'; }
                    else { echo '<option data-val="25">25</option>'; }
                    
                    if ( $array_option['dataPrioritetCart'] == '50' ){ echo '<option selected data-val="50">50</option>'; }
                    else { echo '<option data-val="50">50</option>'; }
                    
                    if ( $array_option['dataPrioritetCart'] == '100' ){ echo '<option selected data-val="100">100</option>'; }
                    else { echo '<option data-val="100">100</option>'; }
                    ?>
                </select>
            </div> 
            <div class='text-setting-q'><?php esc_html_e('Select the position of the button in the product card.','quasar-form-shop');?></div>
        </div>
        
        <div class='section-setting-q location-setting-q'>
            <div class='block-field-q drop-menu-select prioritet-block'>
                <span><?php echo esc_html__('Category','quasar-form-shop') ?></span>
                <select id='list-position-archive'>
                    <option data-val=""><?php esc_html_e('None','quasar-form-shop') ?></option>
                    <?php 
                    if ( $array_option['dataPosition2'] == 'variant1' ){ echo '<option selected data-val="variant1">'.esc_html__('After add to cart button','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant1">'.esc_html__('After add to cart button','quasar-form-shop').'</option>'; }
                    
                    if ( $array_option['dataPosition2'] == 'variant2' ){ echo '<option selected data-val="variant2">'.esc_html__('Before shop loop item','quasar-form-shop').'</option>'; }
                    else { echo '<option data-val="variant2">'.esc_html__('Before shop loop item','quasar-form-shop').'</option>'; }
                    ?>
                </select>
            </div> 
            <div class='block-field-q drop-menu-select prioritet-block'>
                <span><?php echo esc_html__('Priority','quasar-form-shop') ?><span class='help-q q1'>?</span></span>
                <select id='position-prioritet-category'>
                    <?php 
                    if ( !isset($array_option['dataPrioritetCategory']) ){ $array_option['dataPrioritetCategory'] = '25'; }
                    
                    if ( $array_option['dataPrioritetCategory'] == '0' ){ echo '<option selected data-val="0">0</option>'; }
                    else { echo '<option data-val="0">0</option>'; }
                    
                    if ( $array_option['dataPrioritetCategory'] == '10' ){ echo '<option selected data-val="10">10</option>'; }
                    else { echo '<option data-val="10">10</option>'; }
                    
                    if ( $array_option['dataPrioritetCategory'] == '25' ){ echo '<option selected data-val="25">25</option>'; }
                    else { echo '<option data-val="25">25</option>'; }
                    
                    if ( $array_option['dataPrioritetCategory'] == '50' ){ echo '<option selected data-val="50">50</option>'; }
                    else { echo '<option data-val="50">50</option>'; }
                    
                    if ( $array_option['dataPrioritetCategory'] == '100' ){ echo '<option selected data-val="100">100</option>'; }
                    else { echo '<option data-val="100">100</option>'; }
                    ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Select the position of the button in the archive and category pages.','quasar-form-shop');?></div>
        </div>
        
        <div class='section-setting-q'>
            <div class='block-field-q drop-menu-select'>
                <select id='list-show-stock-zero'>
                <?php 
                if ( $array_option['dataShowStockZero'] == 'yes' ){ echo '<option selected data-val="yes">'.esc_html__('Yes','quasar-form-shop').'</option>'; }
                else { echo '<option data-val="yes">'.esc_html__('Yes','quasar-form-shop').'</option>'; }
                
                if ( $array_option['dataShowStockZero'] == 'not' ){ echo '<option selected data-val="not">'.esc_html__('No','quasar-form-shop').'</option>'; }
                else { echo '<option data-val="not">'.esc_html__('No','quasar-form-shop').'</option>'; }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Show the button in products with zero stock.','quasar-form-shop');?></div>
        </div>
  
    </div>
    
    <div class='wrap-setting-qf-woo section-redefinition-q tab-class-1'>
            
        <?php 
        //all field in form
        global $wpdb;
        //all form
        $quasar_form_content = [];
        $quasar_form_array_admin = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}quasarform_main" , ARRAY_A  );
        foreach( $quasar_form_array_admin as $quasar_form_row ){ 
            //content
            $content = json_decode( $quasar_form_row['content'] );
            $content = implode('/', $content );
            echo "<div class='none-coontent-form' data-id='".esc_attr($quasar_form_row['id'])."'>".esc_html( $content )."</div>";
            if ( $id_selected_form == $quasar_form_row['id']) {  $quasar_form_content = json_decode($quasar_form_row['content']); }
        }
            
        ?>
        
        <div class='section-satus-order-q section-heading-q heading-q' data-not='<?php echo esc_html__('Disable','quasar-form-shop') ?>' data-yes='<?php echo esc_html__('Enable','quasar-form-shop') ?>'><?php echo esc_html__('Creating orders:','quasar-form-shop') ?><span></span></div>
        
        <div class='section-heading-q'><?php echo esc_html__('You can connect the form fields from Quasar Form with the Woocommerce order fields. This way, the data from your form fields will be transferred to the created woocommerce order.','quasar-form-shop') ?></div>
  
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='quanity-redefinition'>
                <option data-id="0"><?php echo esc_html__('Default','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ($value['0']=='quantity' ) { 
                        if ( $value['3'] !='' ){ $text.= $value['3']; }
                        else { $text.= esc_html__('Quantity','quasar-form-shop'); }
                        $text = $value['5'].' - '.$text;
                        if ( $array_option['dataQuanity'] == $value['5'] ){echo '<option selected data-id="'.esc_attr($value['5']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['5']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Quantity (available in Quasar Form pro)','quasar-form-shop');?></div>
        </div>    
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='first-name-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ($value['0']=='input') { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataFirstName'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('First name','quasar-form-shop');?></div>
        </div> 
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='last-name-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ($value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataLasttName'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Last name','quasar-form-shop');?></div>
        </div>
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='email-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' || $value['0']=='type-email-element' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataEmail'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Email','quasar-form-shop');?></div>
        </div>
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='phone-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' || $value['0']=='type-phone-element' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataPhone'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Phone','quasar-form-shop');?></div>
        </div>
        
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='comment-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='type-textarea-element' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['7'].' - '.$text;
                        if ( $array_option['dataComment'] == $value['7'] ){echo '<option selected data-id="'.esc_attr($value['7']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['7']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Order notes','quasar-form-shop');?></div>
        </div>
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='address-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataAddress'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Address 1','quasar-form-shop');?></div>
        </div>
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='city-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataCity'] == $value['6'] ){ echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('City','quasar-form-shop');?></div>
        </div>
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='state-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataState'] == $value['6'] ){ echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('State / Region','quasar-form-shop');?></div>
        </div>
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='company-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataCompany'] == $value['6'] ){echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Company','quasar-form-shop');?></div>
        </div>
        
        
        <div class='section-setting-q'>
            <div class='block-field-q'>
                <select id='postcode-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <?php 
                foreach( $quasar_form_content as $value ){ 
                    $text = '';
                    $value = explode(';', $value );
                    if ( $value['0']=='input' ) { 
                        if ( $value['4'] !='' ){ $text.= $value['4']; }
                        else { $text.= $value['1']; }
                        $text = $value['6'].' - '.$text;
                        if ( $array_option['dataPostcode'] == $value['6'] ){ echo '<option selected data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                        else { echo '<option data-id="'.esc_attr($value['6']).'">'.esc_html($text).'</option>'; }
                    }
                }
                ?>
                </select>
            </div>
            <div class='text-setting-q'><?php esc_html_e('Postcode','quasar-form-shop');?></div>
        </div>
        
        
        
        <div class='section-setting-q'>
            <div class='block-field-q' data-select='<?php echo $array_option['dataCountry'] ?>'>
                <select id='country-redefinition'>
                <option data-id="0"><?php echo esc_html__('Empty','quasar-form-shop') ?></option>
                <option value="AF" >Afghanistan</option>
                <option value="AX" >Åland Islands</option>
                <option value="AL" >Albania</option>
                <option value="DZ" >Algeria</option>
                <option value="AS" >American Samoa</option>
                <option value="AD" >Andorra</option>
                <option value="AO" >Angola</option>
                <option value="AI" >Anguilla</option>
                <option value="AQ" >Antarctica</option>
                <option value="AG" >Antigua and Barbuda</option>
                <option value="AR" >Argentina</option>
                <option value="AM" >Armenia</option>
                <option value="AW" >Aruba</option>
                <option value="AU" >Australia</option>
                <option value="AT" >Austria</option>
                <option value="AZ" >Azerbaijan</option>
                <option value="BS" >Bahamas</option>
                <option value="BH" >Bahrain</option>
                <option value="BD" >Bangladesh</option>
                <option value="BB" >Barbados</option>
                <option value="BY" >Belarus</option>
                <option value="PW" >Belau</option>
                <option value="BE" >Belgium</option>
                <option value="BZ" >Belize</option>
                <option value="BJ" >Benin</option>
                <option value="BM" >Bermuda</option>
                <option value="BT" >Bhutan</option>
                <option value="BO" >Bolivia</option>
                <option value="BQ" >Bonaire, Saint Eustatius and Saba</option>
                <option value="BA" >Bosnia and Herzegovina</option>
                <option value="BW" >Botswana</option>
                <option value="BV" >Bouvet Island</option>
                <option value="BR" >Brazil</option>
                <option value="IO" >British Indian Ocean Territory</option>
                <option value="BN" >Brunei</option>
                <option value="BG" >Bulgaria</option>
                <option value="BF" >Burkina Faso</option>
                <option value="BI" >Burundi</option>
                <option value="KH" >Cambodia</option>
                <option value="CM" >Cameroon</option>
                <option value="CA" >Canada</option>
                <option value="CV" >Cape Verde</option>
                <option value="KY" >Cayman Islands</option>
                <option value="CF" >Central African Republic</option>
                <option value="TD" >Chad</option>
                <option value="CL" >Chile</option>
                <option value="CN" >China</option>
                <option value="CX" >Christmas Island</option>
                <option value="CC" >Cocos (Keeling) Islands</option>
                <option value="CO" >Colombia</option>
                <option value="KM" >Comoros</option>
                <option value="CG" >Congo (Brazzaville)</option>
                <option value="CD" >Congo (Kinshasa)</option>
                <option value="CK" >Cook Islands</option>
                <option value="CR" >Costa Rica</option>
                <option value="HR" >Croatia</option>
                <option value="CU" >Cuba</option>
                <option value="CW" >Cura&ccedil;ao</option>
                <option value="CY" >Cyprus</option>
                <option value="CZ" >Czech Republic</option>
                <option value="DK" >Denmark</option>
                <option value="DJ" >Djibouti</option>
                <option value="DM" >Dominica</option>
                <option value="DO" >Dominican Republic</option>
                <option value="EC" >Ecuador</option>
                <option value="EG" >Egypt</option>
                <option value="SV" >El Salvador</option>
                <option value="GQ" >Equatorial Guinea</option>
                <option value="ER" >Eritrea</option>
                <option value="EE" >Estonia</option>
                <option value="ET" >Ethiopia</option>
                <option value="FK" >Falkland Islands</option>
                <option value="FO" >Faroe Islands</option>
                <option value="FJ" >Fiji</option>
                <option value="FI" >Finland</option>
                <option value="FR" >France</option>
                <option value="GF" >French Guiana</option>
                <option value="PF" >French Polynesia</option>
                <option value="TF" >French Southern Territories</option>
                <option value="GA" >Gabon</option>
                <option value="GM" >Gambia</option>
                <option value="GE" >Georgia</option>
                <option value="DE" >Germany</option>
                <option value="GH" >Ghana</option>
                <option value="GI" >Gibraltar</option>
                <option value="GR" >Greece</option>
                <option value="GL" >Greenland</option>
                <option value="GD" >Grenada</option>
                <option value="GP" >Guadeloupe</option>
                <option value="GU" >Guam</option>
                <option value="GT" >Guatemala</option>
                <option value="GG" >Guernsey</option>
                <option value="GN" >Guinea</option>
                <option value="GW" >Guinea-Bissau</option>
                <option value="GY" >Guyana</option>
                <option value="HT" >Haiti</option>
                <option value="HM" >Heard Island and McDonald Islands</option>
                <option value="HN" >Honduras</option>
                <option value="HK" >Hong Kong</option>
                <option value="HU" >Hungary</option>
                <option value="IS" >Iceland</option>
                <option value="IN" >India</option>
                <option value="ID" >Indonesia</option>
                <option value="IR" >Iran</option>
                <option value="IQ" >Iraq</option>
                <option value="IE" >Ireland</option>
                <option value="IM" >Isle of Man</option>
                <option value="IL" >Israel</option>
                <option value="IT" >Italy</option>
                <option value="CI" >Ivory Coast</option>
                <option value="JM" >Jamaica</option>
                <option value="JP" >Japan</option>
                <option value="JE" >Jersey</option>
                <option value="JO" >Jordan</option>
                <option value="KZ" >Kazakhstan</option>
                <option value="KE" >Kenya</option>
                <option value="KI" >Kiribati</option>
                <option value="KW" >Kuwait</option>
                <option value="KG" >Kyrgyzstan</option>
                <option value="LA" >Laos</option>
                <option value="LV" >Latvia</option>
                <option value="LB" >Lebanon</option>
                <option value="LS" >Lesotho</option>
                <option value="LR" >Liberia</option>
                <option value="LY" >Libya</option>
                <option value="LI" >Liechtenstein</option>
                <option value="LT" >Lithuania</option>
                <option value="LU" >Luxembourg</option>
                <option value="MO" >Macao</option>
                <option value="MG" >Madagascar</option>
                <option value="MW" >Malawi</option>
                <option value="MY" >Malaysia</option>
                <option value="MV" >Maldives</option>
                <option value="ML" >Mali</option>
                <option value="MT" >Malta</option>
                <option value="MH" >Marshall Islands</option>
                <option value="MQ" >Martinique</option>
                <option value="MR" >Mauritania</option>
                <option value="MU" >Mauritius</option>
                <option value="YT" >Mayotte</option>
                <option value="MX" >Mexico</option>
                <option value="FM" >Micronesia</option>
                <option value="MD" >Moldova</option>
                <option value="MC" >Monaco</option>
                <option value="MN" >Mongolia</option>
                <option value="ME" >Montenegro</option>
                <option value="MS" >Montserrat</option>
                <option value="MA" >Morocco</option>
                <option value="MZ" >Mozambique</option>
                <option value="MM" >Myanmar</option>
                <option value="NA" >Namibia</option>
                <option value="NR" >Nauru</option>
                <option value="NP" >Nepal</option>
                <option value="NL" >Netherlands</option>
                <option value="NC" >New Caledonia</option>
                <option value="NZ" >New Zealand</option>
                <option value="NI" >Nicaragua</option>
                <option value="NE" >Niger</option>
                <option value="NG" >Nigeria</option>
                <option value="NU" >Niue</option>
                <option value="NF" >Norfolk Island</option>
                <option value="KP" >North Korea</option>
                <option value="MK" >North Macedonia</option>
                <option value="MP" >Northern Mariana Islands</option>
                <option value="NO" >Norway</option>
                <option value="OM" >Oman</option>
                <option value="PK" >Pakistan</option>
                <option value="PS" >Palestinian Territory</option>
                <option value="PA" >Panama</option>
                <option value="PG" >Papua New Guinea</option>
                <option value="PY" >Paraguay</option>
                <option value="PE" >Peru</option>
                <option value="PH" >Philippines</option>
                <option value="PN" >Pitcairn</option>
                <option value="PL" >Poland</option>
                <option value="PT" >Portugal</option>
                <option value="PR" >Puerto Rico</option>
                <option value="QA" >Qatar</option>
                <option value="RE" >Reunion</option>
                <option value="RO" >Romania</option>
                <option value="RU" >Russia</option>
                <option value="RW" >Rwanda</option>
                <option value="ST" >S&atilde;o Tom&eacute; and Pr&iacute;ncipe</option>
                <option value="BL" >Saint Barth&eacute;lemy</option>
                <option value="SH" >Saint Helena</option>
                <option value="KN" >Saint Kitts and Nevis</option>
                <option value="LC" >Saint Lucia</option>
                <option value="SX" >Saint Martin (Dutch part)</option>
                <option value="MF" >Saint Martin (French part)</option>
                <option value="PM" >Saint Pierre and Miquelon</option>
                <option value="VC" >Saint Vincent and the Grenadines</option>
                <option value="WS" >Samoa</option>
                <option value="SM" >San Marino</option>
                <option value="SA" >Saudi Arabia</option>
                <option value="SN" >Senegal</option>
                <option value="RS" >Serbia</option>
                <option value="SC" >Seychelles</option>
                <option value="SL" >Sierra Leone</option>
                <option value="SG" >Singapore</option>
                <option value="SK" >Slovakia</option>
                <option value="SI" >Slovenia</option>
                <option value="SB" >Solomon Islands</option>
                <option value="SO" >Somalia</option>
                <option value="ZA" >South Africa</option>
                <option value="GS" >South Georgia/Sandwich Islands</option>
                <option value="KR" >South Korea</option>
                <option value="SS" >South Sudan</option>
                <option value="ES" >Spain</option>
                <option value="LK" >Sri Lanka</option>
                <option value="SD" >Sudan</option>
                <option value="SR" >Suriname</option>
                <option value="SJ" >Svalbard and Jan Mayen</option>
                <option value="SZ" >Swaziland</option>
                <option value="SE" >Sweden</option>
                <option value="CH" >Switzerland</option>
                <option value="SY" >Syria</option>
                <option value="TW" >Taiwan</option>
                <option value="TJ" >Tajikistan</option>
                <option value="TZ" >Tanzania</option>
                <option value="TH" >Thailand</option>
                <option value="TL" >Timor-Leste</option>
                <option value="TG" >Togo</option>
                <option value="TK" >Tokelau</option>
                <option value="TO" >Tonga</option>
                <option value="TT" >Trinidad and Tobago</option>
                <option value="TN" >Tunisia</option>
                <option value="TR" >Turkey</option>
                <option value="TM" >Turkmenistan</option>
                <option value="TC" >Turks and Caicos Islands</option>
                <option value="TV" >Tuvalu</option>
                <option value="UG" >Uganda</option>
                <option value="UA" >Ukraine</option>
                <option value="AE" >United Arab Emirates</option>
                <option value="GB" >United Kingdom (UK)</option>
                <option value="US" >United States (US)</option>
                <option value="UM" >United States (US) Minor Outlying Islands</option>
                <option value="UY" >Uruguay</option>
                <option value="UZ" >Uzbekistan</option>
                <option value="VU" >Vanuatu</option>
                <option value="VA" >Vatican</option>
                <option value="VE" >Venezuela</option>
                <option value="VN" >Vietnam</option>
                <option value="VG" >Virgin Islands (British)</option>
                <option value="VI" >Virgin Islands (US)</option>
                <option value="WF" >Wallis and Futuna</option>
                <option value="EH" >Western Sahara</option>
                <option value="YE" >Yemen</option>
                <option value="ZM" >Zambia</option>
                <option value="ZW" >Zimbabwe</option>
                </select>

            </div>
            <div class='text-setting-q'><?php esc_html_e('Country','quasar-form-shop');?></div>
        </div>
        
     </div>
    
    
    <div class='wrap-setting-qf-woo section-4-q tab-class-1'>
        
        <div class='section-heading-q heading-q'><?php echo esc_html__('Product information','quasar-form-shop') ?></div>   
        <div class='section-heading-q'><?php echo esc_html__('This is how the block with product information will look like in the quick order form:','quasar-form-shop') ?></div>  
                
        <div class='section-setting-q'>
            <div class='wrap-demo-product-section'>
                <div class='type-product-element'>
                    <div class='type-img-product'>
                        <img src='<?php echo esc_attr( $url."img-demo.png");?>'>
                    </div>
                    <div class='type-name-product'><?php esc_html_e('Product name','quasar-form-shop');?></div>
                    <div class='wrap-prise'>
                        <div class='wrap-price-qf-woo'>
                            <span class='heading-qf-woo' style="color:<?php echo esc_html($array_option['dataColorHeading']) ?>"><?php echo esc_html($array_option['dataTextPrice']) ?></span>
                            <div class='product-prise-q' style="background-color:<?php echo esc_attr($array_option['dataBackgroundSections']);?>; border-color: <?php echo esc_attr($array_option['dataBorderSections']) ?>;"><span class='wrap-price-q' style="color:<?php echo esc_html($array_option['dataColorSections']) ?>"><span class='price-pq'>1000</span><span class='currency-q'>$</span></span></div>
                        </div>
                        <div class='number-product-in-q' style="color:<?php echo esc_attr($array_option['dataColorHeading']) ?>">
                            <span class='heading-qf-woo'><?php echo esc_attr($array_option['dataTextQuantity']) ?></span>
                            <input style="background-color:<?php echo esc_attr($array_option['dataBackgroundSections']) ?>; color:<?php echo esc_attr($array_option['dataColorSections']) ?>; border-color: <?php echo esc_attr($array_option['dataBorderSections']) ?>;" type='number' min='1' value='1'>
                        </div>
                    </div>
                    <div class='wrap-select-variable-q'>
                        <select>
                            <option><?php echo esc_html__('Select option','quasar-form-shop') ?></option>
                            <option><?php echo esc_html__('Variation 1','quasar-form-shop') ?></option>
                            <option><?php echo esc_html__('Variation 2','quasar-form-shop') ?></option>
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        <div class='section-setting-q setting-design-section-q'>
            
            <div class="separator-q"></div>
            
            <div class='heading-q'><?php echo esc_html__('Setting:','quasar-form-shop') ?></div>   

            <div class='wrap-setting-two-col-q'>
            
                <div class='li-top-menu-q admin-check-style-1'>  
                    <?php 
                    if ( $array_option['dataShowImg'] =='yes' ){ echo "<input id='show-product-image' type='checkbox' checked>"; }
                    else { echo "<input id='show-product-image' type='checkbox' >"; } 
                    ?>
                    <label for='show-product-image'></label>
                    <span><?php esc_html_e('Show product image','quasar-form-shop');?></span>
                </div> 
            
            
                <div class='li-top-menu-q admin-check-style-1'>  
                    <?php 
                    if ( $array_option['dataShowPrice'] =='yes' ){ echo "<input id='show-product-price' type='checkbox' checked>"; }
                    else { echo "<input id='show-product-price' type='checkbox' >"; } 
                    ?>
                    <label for='show-product-price'></label>
                    <span><?php esc_html_e('Show product price','quasar-form-shop');?></span>
                </div> 
            
                <div class='li-top-menu-q admin-check-style-1'>  
                    <?php 
                    if ( $array_option['dataShowName'] =='yes' ){ echo "<input id='show-product-name' type='checkbox' checked>"; }
                    else { echo "<input id='show-product-name' type='checkbox' >"; } 
                    ?>
                    <label for='show-product-name'></label>
                    <span><?php esc_html_e('Show product name','quasar-form-shop');?></span>
                </div> 
            
                <div class='li-top-menu-q admin-check-style-1'>  
                    <?php 
                    if ( $array_option['dataShowQuanity'] =='yes' ){ echo "<input id='show-product-quanity' type='checkbox' checked>"; }
                    else { echo "<input id='show-product-quanity' type='checkbox' >"; } 
                    ?>
                    <label for='show-product-quanity'></label>
                    <span><?php esc_html_e('Show the choice of product quantity in the order','quasar-form-shop');?><span class='disable-quantity-d'><?php esc_html_e('Disabled','quasar-form-shop');?></span></span>
                </div> 
                
                
                <div class='input-section-q'>
                    <div class='inp-setting-q'><input id='text-above-price-q' class='style-input-q' value="<?php echo esc_html($array_option['dataTextPrice']) ?>"></div>
                    <div class='text-setting-2-q'><?php esc_html_e('Text above the price','quasar-form-shop');?></div>
                </div> 
                
                <div class='input-section-q'>
                    <div class='inp-setting-q'><input id='text-above-quantity-q' class='style-input-q' value="<?php echo esc_html($array_option['dataTextQuantity']) ?>"></div>
                    <div class='text-setting-2-q'><?php esc_html_e('Text above the quantity','quasar-form-shop');?><span class='disable-quantity-d'><?php esc_html_e('Disabled','quasar-form-shop');?></span></div>
                </div>   
                
                <div class='section-setting-q'>
                    <div class='wrap-select-2' class='menu-top-q'>
                        <select id='position-currency-q'>
                        <?php 
                        if ( $array_option['dataPositionCurrency'] == 'left' ){ echo '<option selected data-val="left">'.esc_html__('To the left of the price','quasar-form-shop').'</option>'; }
                        else { echo '<option data-val="left">'.esc_html__('To the left of the price','quasar-form-shop').'</option>'; }
                
                        if ( $array_option['dataPositionCurrency'] == 'right' ){ echo '<option selected data-val="right">'.esc_html__('To the right of the price','quasar-form-shop').'</option>'; }
                        else { echo '<option data-val="right">'.esc_html__('To the right of the price','quasar-form-shop').'</option>'; }
                        ?>
                        </select>
                    </div> 
                    <div class='text-setting-2-q'><?php esc_html_e('Сurrency icon position','quasar-form-shop');?></div>
                </div>
                
                
              
            </div> 
            
        </div> 
        
    </div>
        
    <div class='wrap-setting-qf-woo section-5-q tab-class-2'>
        
        <div class='section-setting-q setting-design-section-q'>
            
            <div class='heading-q'><?php echo esc_html__('Design:','quasar-form-shop') ?></div> 
            <div class='section-heading-q'><?php echo esc_html__('Sections are boxes of price and quantity.','quasar-form-shop') ?></div>
            
            <div class='wrap-setting-two-col-q'>
                <div class='column-1'>
                    
                    <div class='wrap-text-section-q'>
                        <p><?php esc_html_e('Product name','quasar-form-shop');?><span class='disabled-d disabled-name'><?php esc_html_e('disabled','quasar-form-shop');?></span></p>
                    </div>
                    
                    <div class='input-section-2-q scroll-element-q name-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Font size','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-font-name-q' class='style-input-q' value="<?php echo esc_html($array_option['dataFontName']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q name-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Color','quasar-form-shop');?></div>
                        <div class='inp-setting-q'> <input  id='text-color-name-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataColorName']) ?>"></div>
                    </div>   
                    
                    <div class='wrap-text-section-q'>
                        <p><?php esc_html_e('Blocks with quantity','quasar-form-shop');?><span class='disabled-d disabled-quantity'><?php esc_html_e('disabled','quasar-form-shop');?></span></p>
                    </div>
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Font size of headings','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-font-heading-q' class='style-input-q' value="<?php echo esc_html($array_option['dataFontHeading']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Color of headings','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-color-price-quantity-heading-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataColorHeading']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Font size','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-font-input-q' class='style-input-q' value="<?php echo esc_html($array_option['dataFontInput']) ?>"></div>
                    </div>
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Color','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-color-price-quantity-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataColorSections']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Background color','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-background-price-quantity-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataBackgroundSections']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q prise-quantity-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Border color','quasar-form-shop');?></div>
                        <div class='inp-setting-q'><input id='text-border-color-price-quantity-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataBorderSections']) ?>"></div>
                    </div> 
                    
                    
                    
                    <div class='wrap-text-section-q'>                         
                        <p><?php esc_html_e('Block with price','quasar-form-shop');?><span class='disabled-d disabled-prise'><?php esc_html_e('disabled','quasar-form-shop');?></span></p>                    
                    </div>
                    
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Font size of headings','quasar-form-shop');?></div>
                        <?php if ( !isset($array_option['dataFontHeadingPrice']) ){ $array_option['dataFontHeadingPrice'] = '14px'; } ?>
                        <div class='inp-setting-q'><input id='text-font-price-heading-q' class='style-input-q' value="<?php echo esc_html($array_option['dataFontHeadingPrice']) ?>"></div>
                    </div> 
                    
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Color of headings','quasar-form-shop');?></div>
                        <?php if ( !isset($array_option['dataColorHeadingPrice']) ){ $array_option['dataColorHeadingPrice'] = '#262626'; } ?>
                        <div class='inp-setting-q'><input id='text-color-price-heading-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataColorHeadingPrice']) ?>"></div>
                    </div> 
                        
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Font size','quasar-form-shop');?></div>
                        <?php  if ( !isset($array_option['dataFontPrice']) ){ $array_option['dataFontPrice'] = '14px'; } ?>
                        <div class='inp-setting-q'><input id='text-price-font-q' class='style-input-q' value="<?php echo esc_html($array_option['dataFontPrice']) ?>"></div>
                    </div> 
                        
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Color','quasar-form-shop');?></div>
                        <?php  if ( !isset($array_option['dataColorPrice']) ){ $array_option['dataColorPrice'] = '#000'; } ?>
                        <div class='inp-setting-q'> <input id='text-variable-price-color-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataColorPrice']) ?>"></div>
                    </div> 
                        
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Background color','quasar-form-shop');?></div>
                        <?php  if ( !isset($array_option['dataBackgroundPrice']) ){ $array_option['dataBackgroundPrice'] = '#ffffff'; } ?>
                        <div class='inp-setting-q'> <input id='text-price-backgroun-color-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataBackgroundPrice']) ?>"></div>
                    </div>  
                    
                    <div class='input-section-2-q prise-design-q'>
                        <div class='text-setting-3-q'><?php esc_html_e('Border color','quasar-form-shop');?></div>
                        <?php if ( !isset($array_option['dataBorderColorPrice']) ){ $array_option['dataBorderColorPrice'] = '#fff'; } ?>
                        <div class='inp-setting-q'><input id='text-border-color-price-q' data-alpha='true' class='style-input-q' value="<?php echo esc_html($array_option['dataBorderColorPrice']) ?>"></div>
                    </div> 
                    
                    
                    
                    
                    <div class='wrap-text-section-q'>
                        <p><?php esc_html_e('Button','quasar-form-shop');?></p>
                    </div>
                    
                    <div class='warning-design'>
                        <?php esc_html_e('Note. The design of the button itself is configured in the Quasar Form -> Design -> Design of popup button','quasar-form-shop');?>
                    </div>
                    
                    <div class='input-section-2-q'>
                        <span class='heading-align'><?php esc_html_e('Align (for categories)','quasar-form-shop');?></span>
                        <div class='swap-align-buttons' data-val='<?php echo esc_html($array_option['dataButtonAlign']) ?>'>
                            <div class='element-align-q' id='left-button'><i class='fa fa-align-leftq'></i></div> 
                            <div class='element-align-q' id='center-button'><i class='fa fa-align-centerq'></i></div>  
                            <div class='element-align-q' id='right-button'><i class='fa fa-align-rightq'></i></div>   
                        </div>
                    </div>
                    
                    <div class='input-section-2-q'>
                        <div class='wrap-margin-block margin-category' data-val='<?php echo esc_html($array_option['dataButtonMagrinCategory']) ?>'>
                            <div class='wrap-heading-margin'>
                                <span><?php esc_html_e('Margin button: left, right, top, bottom (for categories)','quasar-form-shop');?></span>
                             </div>
                            <input id='admpaddingleft' class='style-input-q'> 
                            <input id='admpaddingright' class='style-input-q'> 
                            <input id='admpaddingtop' class='style-input-q'>
                            <input id='admpaddingbottom' class='style-input-q'>
                        </div>
                    </div>
                    
                    <div class='input-section-2-q'>
                        <div class='wrap-margin-block margin-cart' data-val='<?php echo esc_html($array_option['dataButtonMagrinCart']) ?>' >
                            <div class='wrap-heading-margin'>
                                <span><?php esc_html_e('Margin button: left right top bottom (for card)','quasar-form-shop');?></span>
                             </div>
                            <input id='admpaddingleft-k' class='style-input-q'> 
                            <input id='admpaddingright-k' class='style-input-q'> 
                            <input id='admpaddingtop-k' class='style-input-q'>
                            <input id='admpaddingbottom-k' class='style-input-q'>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
                <div class='column-2'>
                    <div class='wrap-demo-product-section'>
                        <div class='type-product-element'>
                            <div class='type-img-product'>
                                <img src='<?php echo esc_attr( $url."img-demo.png");?>'>
                            </div>
                            <div class='type-name-product'><?php esc_html_e('Product name','quasar-form-shop');?></div>
                            <div class='wrap-prise'>
                                <div class='wrap-price-qf-woo'>
                                    <span class='heading-qf-woo' style="color:<?php echo esc_html($array_option['dataColorHeading']) ?>"><?php echo esc_html($array_option['dataTextPrice']) ?></span>
                                    <div class='product-prise-q' style="background-color:<?php echo esc_attr($array_option['dataBackgroundSections']);?>; border-color: <?php echo esc_attr($array_option['dataBorderSections']) ?>;"><span class='wrap-price-q' style="color:<?php echo esc_html($array_option['dataColorSections']) ?>"><span class='price-pq'>1000</span><span class='currency-q'>$</span></span>
                                    </div>
                                </div>
                                <div class='number-product-in-q' style="color:<?php echo esc_attr($array_option['dataColorHeading']) ?>">
                                    <span class='heading-qf-woo'><?php echo esc_attr($array_option['dataTextQuantity']) ?></span>
                                    <input style="background-color:<?php echo esc_attr($array_option['dataBackgroundSections']) ?>; color:<?php echo esc_attr($array_option['dataColorSections']) ?>; border-color: <?php echo esc_attr($array_option['dataBorderSections']) ?>;" type='number' min='1' value='1'>
                                </div>
                            </div>
                            <div class='wrap-select-variable-q'>
                                <select>
                                    <option><?php echo esc_html__('Select option','quasar-form-shop') ?></option>
                                    <option><?php echo esc_html__('Variation 1','quasar-form-shop') ?></option>
                                    <option><?php echo esc_html__('Variation 2','quasar-form-shop') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
    
    <div class='wrap-setting-qf-woo section-5-q tab-class-3'>
        <div class='heading-q otstup-variable-b full-width-q'><span class='disable-quantity-d'></span><?php echo esc_html__('Localization:','quasar-form-shop') ?></div>
        <div class='wrap-localization-q'>  
        
            <div class='input-section-2-q'>
                <div class='text-setting-3-q'><?php esc_html_e('Required to fill','quasar-form-shop');?></div>
                <?php 
                if ( !isset($array_option['dataTextRequired']) ){ $array_option['dataTextRequired'] = esc_html__('Required','quasar-form-shop'); }
                if ( $array_option['dataTextRequired'] !='' ){
                ?>
                    <div class='inp-setting-q'><input id='text-required-q' class='style-input-q' value="<?php echo esc_html($array_option['dataTextRequired']) ?>"></div>
                <?php } else { ?>
                    <div class='inp-setting-q'><input id='text-required-q' class='style-input-q' value="<?php echo esc_html__('Required','quasar-form-shop') ?>"></div>
                <?php } ?>  
            </div>
                            
        </div>
        <div class='warning-design'>
            <?php esc_html_e('Note. The text from messages you receive by email is configurable in the Quasar form plugin -> Setting -> Frontend text/localization','quasar-form-shop');?>
        </div>
    </div>
    
    <!-- tab 5-->
    <div class='wrap-setting-qf-woo tab-class-4'>
        <p><span class='heading-q'><?php esc_html_e('Import/export','quasar-form-shop'); ?></span><span class='font-size-14'><?php esc_html_e(' (you can import settings and design sections)','quasar-form-shop'); ?></span></p>
       
        <?php
            $export_text = json_encode($array_option);
        ?>
        
        <div class='copy-export-button'><?php esc_html_e('Select text to export','quasar-form-shop');?> </div>
        <div class='export-form-swap'> 
            <div class='element-css-q type-input-element style-qform-1 color-p-10 color-class-1 adm-setting-element'>
                <span class='heading-field-q heading-setting-field'><?php esc_attr_e('Export form','quasar-form-shop');?></span>
                <textarea id ="export-setting-code" class='style-element' placeholder='<?php esc_attr_e('Export text','quasar-form-shop'); ?>' autocomplete='off'> <?php echo wp_specialchars_decode($export_text )?></textarea>
            </div>
        </div>
        <div class='export-form-swap'>
            <div class='element-css-q type-input-element style-qform-1 color-p-10 color-class-1 adm-setting-element'>
                <span class='heading-field-q heading-setting-field'><?php esc_attr_e('Import form','quasar-form-shop');?></span>
                <div class='error-export-form'><?php esc_attr_e('Incorrect text of export!','quasar-form-shop');?></div>
                <textarea id ="import-form-code" class='style-element' placeholder='<?php esc_attr_e('Import text','quasar-form-shop'); ?>' autocomplete='off'></textarea>
            </div>
            <div class='active-export-button'><?php esc_html_e('Apply import','quasar-form-shop');?> </div>
            <div class='error-export-button'><?php esc_html_e('Error while saving','quasar-form-shop');?> </div>
            <div class="save-export-button"> <span><i class='fa fa-checkq'></i></span> <?php esc_html_e('Saved','quasar-form-shop'); ?> </div>
        </div>
        <div class='message-quick-2'><?php esc_html_e("If you don't copy all the text when importing or exporting, this can lead to errors in the plugin! To import the current version of the settings, restart the page.",'quasar-form-shop'); ?></div>

    </div>

    <div class='wrap-save-button-q'>
        <div class='save-setting-woo'><?php esc_html_e('Save settings','quasar-form-shop');?></div>
        
        <div class='swap-save-informer-q'>
            <div class="error-saved-lib-q"> <span><i class='fa fa-exclamation-triangleq'></i></span> <?php esc_html_e('Error while saving','quasar-form-shop'); ?> </div>
            <div class="saved-lib-q"> <span><i class='fa fa-checkq'></i></span> <?php esc_html_e('Saved','quasar-form-shop'); ?> </div>
        </div>
        
    </div>
    
    

</div>

<div class='none-text-q'>
    <div id='text-help-1'><?php esc_html_e('If the button in your theme does not display correctly, try different priority values. Priority affects where the button will be displayed. This is different for different themes.','quasar-form-shop');?></div>
    
</div>
