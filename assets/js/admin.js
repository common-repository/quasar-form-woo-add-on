(function ($) {
$(document).ready(function () {
    
//country selected
let selected = $('#country-redefinition').parent().attr('data-select');
$('#country-redefinition').find('option').each(function(){
    if ( $(this).attr('value') == selected ) { $(this).prop('selected', true) ; }
});


//status create new order
$('#activation-created-order').on('change', function(){ 
    statusOrderCreate();
});

function statusOrderCreate(){
    let val = $('#activation-created-order').find('option:selected').attr('data-val');
    if ( val =='yes' ){ 
        $('.section-satus-order-q').find('span').html( $('.section-satus-order-q ').attr('data-yes') ).removeClass('status-not-q').addClass('status-yes-q');
        $('.section-redefinition-q').removeClass('status-not-block');
    }
    else { 
        $('.section-satus-order-q').find('span').html( $('.section-satus-order-q ').attr('data-not') ).removeClass('status-yes-q').addClass('status-not-q');
        $('.section-redefinition-q').addClass('status-not-block');
    }
}
statusOrderCreate();

//setting
$('.wrap-setting-two-col-q').on('change', function(){ 
    settingDemonstrate();
});

function settingDemonstrate(){
    let dataShowImg = $('#show-product-image').prop('checked');

    if ( dataShowImg === true ){ $('.type-img-product').css('display' ,'flex'); }
    else { $('.type-img-product').css('display' ,'none'); }
    
    let dataShowPrice = $('#show-product-price').prop('checked');
    if ( dataShowPrice === true ){ 
        $('.wrap-price-qf-woo').css('display' ,'flex'); 
        $('.prise-design-q').removeClass('not-active-d'); 
        $('.disabled-prise').css('display' ,'none'); 
    }
    else { 
        $('.wrap-price-qf-woo').css('display' ,'none'); 
        $('.prise-design-q').addClass('not-active-d'); 
        $('.disabled-prise').css('display' ,'inline'); 
    }
    
    let dataShowQuanity = $('#show-product-quanity').prop('checked');
    if ( dataShowQuanity === true ){ 
        $('.number-product-in-q').css('display' ,'flex');
        $('.prise-quantity-q').removeClass('not-active-d');
        $('.disabled-quantity').css('display' ,'none');
    }
    else { 
        $('.number-product-in-q').css('display' ,'none'); 
        $('.prise-quantity-q').addClass('not-active-d');
        $('.disabled-quantity').css('display' ,'inline'); 
    }
    
    let dataShowName = $('#show-product-name').prop('checked');
    if ( dataShowName === true ){  
        $('.type-name-product').css('display' ,'flex'); 
        $('.name-design-q').removeClass('not-active-d');
        $('.disabled-name').css('display' ,'none');
    }
    else { 
        $('.type-name-product').css('display' ,'none');
        $('.name-design-q').addClass('not-active-d');
        $('.disabled-name').css('display' ,'inline');
    }
    
    let dataShowVariable = $('#show-product-variable').prop('checked');
    if ( dataShowVariable === true ){ 
        $('.wrap-select-variable-q').css('display' ,'block');
        $('.variable-design-q').removeClass('not-active-d');
        $('.disabled-variable').css('display' ,'none');
    }
    else {  
        $('.wrap-select-variable-q').css('display' ,'none'); 
        $('.variable-design-q').addClass('not-active-d');
        $('.disabled-variable').css('display' ,'inline');
    }
   
    
    
}
settingDemonstrate();

$('.wrap-setting-two-col-q, .section-5-q').on('keyup', '.style-input-q' , function(){
    let val = $(this).val();
    settingDesign( val, $(this) );
});

$('.wrap-setting-two-col-q, .section-5-q').on('change', 'select' , function(){
    let val = $(this).val();
    settingDesign( val, $(this) );
});

function settingDesign(val,input){
    //heading text
    if ( input.attr('id') == 'text-above-price-q' ){ $('.wrap-price-qf-woo').find('.heading-qf-woo').html( val ); }
    if ( input.attr('id') == 'text-above-quantity-q' ){ $('.number-product-in-q').find('.heading-qf-woo').html( val ); }
    //design
    if ( input.attr('id') == 'text-font-name-q' ){ $('.type-name-product').css('font-size', val); }
    
    if ( input.attr('id') == 'text-font-heading-q' ){
        $('.number-product-in-q .heading-qf-woo').css({'font-size' :  val, 'line-height':  val });
    }
    if ( input.attr('id') == 'text-font-input-q' ){
        $('.number-product-in-q input').css({'font-size':  val, 'line-height':  val });
    }
    
    if ( input.attr('id') == 'text-price-font-q' ){
        $('.product-prise-q span').css({'font-size':  val, 'line-height':  val });
    }
    
    if ( input.attr('id') == 'text-font-price-heading-q' ){
        $('.wrap-price-qf-woo .heading-qf-woo').css({'font-size' :  val, 'line-height':  val });
    }
    
}


$('.section-5-q input').each(function(){
    let val = $(this).val();
    settingDesign( val, $(this) );
});




//confirmation remove
$('.save-setting-woo').on('click', function(){ 
    
    //setting 
    let dataShowImg = $('#show-product-image').prop('checked');
    if ( dataShowImg === true ){dataShowImg = 'yes';}
    else { dataShowImg = 'not'; }
    
    let dataShowPrice = $('#show-product-price').prop('checked');
    if ( dataShowPrice === true ){dataShowPrice = 'yes';}
    else { dataShowPrice = 'not'; }
    
    let dataShowQuanity = $('#show-product-quanity').prop('checked');
    if ( dataShowQuanity === true ){dataShowQuanity = 'yes';}
    else { dataShowQuanity = 'not'; }
    
    let dataShowName = $('#show-product-name').prop('checked');
    if ( dataShowName === true ){dataShowName = 'yes';}
    else { dataShowName = 'not'; }

    let dataShowVariable = 'yes';

    
    let arraySave = {
        'dataForm' : $('#list-form-q').val(),
        'dataTextButton' : $('#text-button-q').val(),
        'dataIdForm' : $('#list-form-q').find('option:selected').attr('data-id'),
        'dataPosition' : $('#list-position').find('option:selected').attr('data-val'),
        'dataPosition2' : $('#list-position-archive').find('option:selected').attr('data-val'),
        'dataCreateOrder' : $('#activation-created-order').find('option:selected').attr('data-val'),
        'dataTextPrice' : $('#text-above-price-q').val(),
        'dataTextQuantity' : $('#text-above-quantity-q').val(),
        'dataShowStockZero' : $('#list-show-stock-zero').find('option:selected').attr('data-val'),
        'dataPositionCurrency' : $('#position-currency-q').find('option:selected').attr('data-val'),
        'dataPrioritetCart' : $('#position-prioritet-cart').find('option:selected').attr('data-val'),
        'dataPrioritetCategory' : $('#position-prioritet-category').find('option:selected').attr('data-val'),
        //redefinition
        'dataFirstName' : $('#first-name-redefinition').find('option:selected').attr('data-id'),
        'dataLasttName' : $('#last-name-redefinition').find('option:selected').attr('data-id'),
        'dataEmail' : $('#email-redefinition').find('option:selected').attr('data-id'),
        'dataPhone' : $('#phone-redefinition').find('option:selected').attr('data-id'),
        'dataCompany' : $('#company-redefinition').find('option:selected').attr('data-id'),
        'dataAddress' : $('#address-redefinition').find('option:selected').attr('data-id'),
        'dataCity' : $('#city-redefinition').find('option:selected').attr('data-id'),
        'dataState' : $('#state-redefinition').find('option:selected').attr('data-id'),
        'dataPostcode' : $('#postcode-redefinition').find('option:selected').attr('data-id'),
        'dataCountry' : $('#country-redefinition').find('option:selected').attr('value'),
        'dataComment' : $('#comment-redefinition').find('option:selected').attr('data-id'),
        'dataQuanity' : $('#quanity-redefinition').find('option:selected').attr('data-id'),
        //design
        'dataFontName' : $('#text-font-name-q').val(),
        'dataColorName' : $('#text-color-name-q').val(),
        'dataFontHeading' : $('#text-font-heading-q').val(),
        'dataColorHeading' : $('#text-color-price-quantity-heading-q').val(),
        'dataFontInput' : $('#text-font-input-q').val(),
        'dataColorSections' : $('#text-color-price-quantity-q').val(),
        'dataBackgroundSections' : $('#text-background-price-quantity-q').val(),
        'dataBorderSections' : $('#text-border-color-price-quantity-q').val(),
        'dataButtonAlign' : $('.swap-align-buttons').attr('data-val'),
        'dataButtonMagrinCategory' : $('.margin-category').attr('data-val'),
        'dataButtonMagrinCart' : $('.margin-cart').attr('data-val'),
        //new design
        'dataFontHeadingPrice' : $('#text-font-price-heading-q').val(),
        'dataColorHeadingPrice' : $('#text-color-price-heading-q').val(),
        'dataFontPrice' : $('#text-price-font-q').val(),
        'dataColorPrice' : $('#text-variable-price-color-q').val(),
        'dataBackgroundPrice' : $('#text-price-backgroun-color-q').val(),
        'dataBorderColorPrice' : $('#text-border-color-price-q').val(),
        //setting
        'dataShowImg' : dataShowImg,
        'dataShowPrice' : dataShowPrice,
        'dataShowQuanity' : dataShowQuanity,
        'dataShowName' : dataShowName,
        'dataShowVariable' : dataShowVariable,
        //loc
        'dataTextRequired' : $('#text-required-q').val(),
        
    };


    arraySave = JSON.stringify(arraySave);//conver array to json string
    


    

    //ajax remove form
    $.ajax({
        type: "POST",
        url: params.ajaxurl,
        data: {
            action: 'save_woo_setting',
            nonce_code : params.nonce,
            arraySave: arraySave,
            
        },
        success: function( response ) {
            
            $('.saved-lib-q').css({'opacity' : '1', 'z-index' : '1'});
            setTimeout(function(){
                $(".saved-lib-q").css({'opacity' : '0', 'z-index' : '-1'});
            },2000);
            
        },
        error: function (error) {
            
            $('.error-saved-lib-q').css({'opacity' : '1', 'z-index' : '1'});
            setTimeout(function(){
                $(".error-saved-lib-q").css({'opacity' : '0', 'z-index' : '-1'});
            },2000);
            
        }
    });


});

//color editor
var colorOptions = {
    change: function(event, ui){
        //color name product
        if( $(this).attr('id') == 'text-color-name-q' ) {
            $('.type-name-product').css('color', ui.color.toString() );
        }
        //color heading prise
        if( $(this).attr('id') == 'text-color-price-heading-q' ) {
            $('.wrap-price-qf-woo .heading-qf-woo').css('color', ui.color.toString() );
        }
        //color heading quantity
        if( $(this).attr('id') == 'text-color-price-quantity-heading-q' ) {
            $('.number-product-in-q .heading-qf-woo').css('color', ui.color.toString() );
        }
        //color quantity
        if( $(this).attr('id') == 'text-color-price-quantity-q' ) {
            $('.number-product-in-q input').css('color', ui.color.toString() );
        }
        //color prise
        if( $(this).attr('id') == 'text-variable-price-color-q' ) {
            $('.product-prise-q span').css('color', ui.color.toString() );
        }
        //background color quantity
        if( $(this).attr('id') == 'text-background-price-quantity-q' ) {
            $('.number-product-in-q input').css('background-color', ui.color.toString() );
        }
        //background color prise
        if( $(this).attr('id') == 'text-price-backgroun-color-q' ) {
            $('.product-prise-q').css('background-color', ui.color.toString() );
        }
        //border color quantity
        if( $(this).attr('id') == 'text-border-color-price-quantity-q' ) {
            $('.number-product-in-q input').css('border-color', ui.color.toString() );
        }
        //border color prise
        if( $(this).attr('id') == 'text-border-color-price-q' ) {
            $('.product-prise-q').css('border-color', ui.color.toString() );
        }
        
        //select variable 
        if ( $('.wrap-select-variable-q').find('select').length > 0 ) {
            $('.wrap-select-variable-q').find('select').css({
                'color' : $('#text-variable-color-q').val(),
                'background-color' : $('#text-backgroun-color-q').val(),
                'border-color' : $('#text-border-color-q').val(),

            });
            $('.wrap-select-variable-q').find('option').css({
                'color' : $('#text-variable-color-q').val(),
            });
        }
        else {
            $('.wrap-select-variable-q').find('label').css({
                'color' : $('#text-variable-color-q').val(),
                'background-color' : $('#text-backgroun-color-q').val(),
                'border-color' : $('#text-border-color-q').val(),
            }).attr({
                'data-a-c' : $('#variable-activ-color-q').val(), 
                'data-a-b' : $('#variable-activ-background-q').val(), 
                'data-color' : $('#text-variable-color-q').val(), 
                'data-background' : $('#text-backgroun-color-q').val(), 
                'data-active-border-color' : $('#variable-activ-border-color-q').val(),
            });
            $('.wrap-select-variable-q input').trigger('change');
        }
        //name attribute
        if ( $(this).attr('id') == 'attribute-color-q' ) {
            $('.wrap-select-variable-q').find('.name-attribute-q').css({
                'color' : ui.color.toString() ,
            });
        }
        
    }
};

//inout color
$('#text-color-name-q, #text-color-price-quantity-heading-q, #text-color-price-quantity-q, #text-background-price-quantity-q, #text-border-color-price-quantity-q, #text-variable-color-q, #text-backgroun-color-q, #text-border-color-q, #variable-activ-color-q, #variable-activ-background-q, #variable-activ-border-color, #attribute-color-q, #variable-activ-border-color-q, #text-color-price-heading-q, #text-variable-price-color-q, #text-price-backgroun-color-q, #text-border-color-price-q').wpColorPicker(colorOptions);



//validation text
$(document).on('keyup', '#text-button-q, #text-above-price-q, #text-above-quantity-q, #text-font-name-q, #text-font-input-q' , function(){
    //forbidden symbols
    if ( $(this).val().match(/[\/\\\"<>]/g) ){ 
        let edit = $(this).val().replace(/[\/\\\"<>]/g,'');
        $(this).val( edit );
    }
});



//switch form
$('#list-form-q').on('change', function(){
    let valId = $(this).find('option:selected').attr('data-id');
    let contentArray = $('.none-coontent-form[data-id="'+valId+'"]').html();
    let createdElement = '';
    let text = '';
    if (typeof contentArray !="undefined"){
        contentArray = contentArray.split('/');
        $('.section-redefinition-q').find('select').each(function(){
            let thisSelect = $(this);
            text = '';
            if ( $(this).attr('id') !='country-redefinition' ) { 
                thisSelect.find('option[data-id!="0"]').remove();
            }
                
            if ( thisSelect.attr('id') =='quanity-redefinition' ){
                $.each(contentArray,function(index,value){
                    value = value.split(';');
                    if (value[0]=='quantity' ) {
                        if ( value[3] !='' ){ text = text + value[3]; }
                        text = value[5]+' - '+text;
                        createdElement = '<option selected data-id="'+value['5']+'">'+text+'</option>';
                        thisSelect.append(createdElement);
                    }
                });
            }
                
           
            if ( thisSelect.attr('id') =='first-name-redefinition' || thisSelect.attr('id') =='last-name-redefinition' || thisSelect.attr('id') =='address-redefinition' || thisSelect.attr('id') =='city-redefinition' || thisSelect.attr('id') =='state-redefinition' || thisSelect.attr('id') =='company-redefinition' || thisSelect.attr('id') =='postcode-redefinition' ){
                $.each(contentArray,function(index,value){
                    value = value.split(';');
                    if ( value[0]=='input' ) {
                        if ( value[4] !='' ){ text = text + value[4]; }
                        else { text = text + value[1]; }
                        text = value[6]+' - '+text;
                        createdElement = '<option data-id="'+value['6']+'">'+text+'</option>';
                        thisSelect.append(createdElement);
                    }
                });
            }
            
            if ( thisSelect.attr('id') =='email-redefinition' ){
                $.each(contentArray,function(index,value){
                    value = value.split(';');
                    text = '';
                    if ( value[0]=='input' || value[0]=='type-email-element') {
                        if ( value[4] !='' ){ text = text + value[4]; }
                        else { text = text + value[1]; }
                        text = value[6]+' - '+text;
                        createdElement = '<option data-id="'+value['6']+'">'+text+'</option>';
                        thisSelect.append(createdElement);
                    }
                });
            }
            
            if ( thisSelect.attr('id') =='phone-redefinition' ){
                $.each(contentArray,function(index,value){
                    value = value.split(';');
                    text = '';
                    if ( value[0]=='input' || value[0]=='type-phone-element' ) {
                        if ( value[4] !='' ){ text = text + value[4]; }
                        else { text = text + value[1]; }
                        text = value[6]+' - '+text;
                        createdElement = '<option data-id="'+value['6']+'">'+text+'</option>';
                        thisSelect.append(createdElement);
                    }
                });
            }
            
            if ( thisSelect.attr('id') =='comment-redefinition' ){
                $.each(contentArray,function(index,value){
                    value = value.split(';');
                    if ( value[0]=='type-textarea-element' ) {
                        if ( value[4] !='' ){ text = text + value[4]; }
                        else { text = text + value[1]; }
                        text = value[7]+' - '+text;
                        createdElement = '<option data-id="'+value['7']+'">'+text+'</option>';
                        thisSelect.append(createdElement);
                    }
                });
            }
            
        });
    }

});


function positionCurrency(){
    let val = $('#position-currency-q').find('option:selected').attr('data-val');
    if (val == 'left'){ $('.currency-q').css('order', '1'); }
    else { $('.currency-q').css('order', '3'); }
}
positionCurrency();

$('#position-currency-q').on('change', function(){
    positionCurrency();
    
});


//disable defoult quantity
function disableDefoultQuntity(){
    let val = $('#quanity-redefinition').find('option:selected').attr('data-id');
    let block = $('#show-product-quanity').parent();
    let block2 = $('#text-above-quantity-q').closest('.input-section-q');
    
    if ( val !='0' ){
        block.addClass('status-not-block').find('.disable-quantity-d').css('display', 'inline');
        block2.addClass('status-not-block').find('.disable-quantity-d').css('display', 'inline');
        if ( $('#show-product-quanity').prop('checked') ) { 
            $('#show-product-quanity').prop('checked', false); 
            $('.number-product-in-q').css('display', 'none');
        }
    }
    else {
        block.removeClass('status-not-block').find('.disable-quantity-d').css('display', 'none');
        block2.removeClass('status-not-block').find('.disable-quantity-d').css('display', 'none');
    }
}
disableDefoultQuntity();

$('#quanity-redefinition, #show-product-quanity').on('change', function(){
    disableDefoultQuntity();
});

//align button
let valAlign = $('.swap-align-buttons').attr('data-val');
if ( valAlign == 'left' ) { 
    $('#left-button').addClass('element-align-active-q');
}
if ( valAlign == 'right' ) { 
    $('#right-button').addClass('element-align-active-q');
}
if ( valAlign == 'center' ) { 
    $('#center-button').addClass('element-align-active-q');
}

$('#left-button, #right-button, #center-button').on('click', function(){ 
    $('#left-button, #right-button, #center-button').removeClass('element-align-active-q');
    $(this).addClass('element-align-active-q');
    if ( $(this).attr('id') == 'left-button'){ $('.swap-align-buttons').attr('data-val', 'left'); }
    if ( $(this).attr('id') == 'right-button'){ $('.swap-align-buttons').attr('data-val', 'right'); }
    if ( $(this).attr('id') == 'center-button'){ $('.swap-align-buttons').attr('data-val', 'center'); }
});


//margin category
let marginCategory = $('.margin-category').attr('data-val').split(';');
$('#admpaddingleft').val(marginCategory[0]) ;
$('#admpaddingright').val(marginCategory[1]) ;
$('#admpaddingtop').val(marginCategory[2]) ;
$('#admpaddingbottom').val(marginCategory[3]) ;
$('.margin-category').on('keyup', 'input', function(){ 
    let val = $('#admpaddingleft').val() + ';' + $('#admpaddingright').val() + ';' + $('#admpaddingtop').val() + ';' + $('#admpaddingbottom').val() ;
    $('.margin-category').attr('data-val', val);
});   

//margin cart
let marginCart = $('.margin-cart').attr('data-val').split(';');
$('#admpaddingleft-k').val(marginCart[0]) ;
$('#admpaddingright-k').val(marginCart[1]) ;
$('#admpaddingtop-k').val(marginCart[2]) ;
$('#admpaddingbottom-k').val(marginCart[3]) ;
$('.margin-cart').on('keyup', 'input', function(){ 
    let val = $('#admpaddingleft-k').val() + ';' + $('#admpaddingright-k').val() + ';' + $('#admpaddingtop-k').val() + ';' + $('#admpaddingbottom-k').val() ;
    $('.margin-cart').attr('data-val', val);
});   




$(window).scroll(function(){
    if ( $('.activ-tab-q').attr('data-tab') == '2' ){
        
    
    	let wt = $(window).scrollTop();

    	if ( wt < 150 ){ $('.column-2 .wrap-demo-product-section').css('top', 'auto'); }
    	if ( wt > 200 && wt < 460){ $('.column-2 .wrap-demo-product-section').addClass('fixed-position-q').removeClass('remove-fixed-q').css('top', '50px');}
    	if ( wt > 460 ){  
    	    wt = 460;
    	    
    	    $('.column-2 .wrap-demo-product-section').css({
    	        'top' : wt+'px', 
    	    }).addClass('fixed-position-q').addClass('remove-fixed-q'); 
    	}
    }

});



$('.wrap-demo-product-section').on('click', '.close-fixed', function(){
    $('.wrap-demo-product-section').addClass('remove-fixed-q');
    $('.wrap-demo-product-section').find('.close-fixed').remove();
});



//type variable
$('#type-variable-q').on('change', function(){
    typeVariable( $(this) );
});

typeVariable( $('#type-variable-q') );

function typeVariable(x) {
    let val = x.find('option:selected').attr('data-val');
    //select
    if ( val == 'select' ){
        
        //clear
        $('.wrap-select-variable-q').html('');
        
        //create select
        let padding = $('.margin-variavble').attr('data-val');
        padding = padding.split(';');
        let variableStyle = {
            'font' : $('#text-variable-font-q').val(), 
            'color' : $('#text-variable-color-q').val(),
            'background-color' : $('#text-backgroun-color-q').val(),
            'border-width' : $('#text-border-width-q').val(),  
            'border-color' : $('#text-border-color-q').val(),
            'border-radius' : $('#text-border-radius-q').val(),
            'padding' : 'padding-left:'+padding['0']+'; padding-right:'+padding['1']+'; padding-top:'+padding['2']+'; padding-bottom:'+padding['3'],
        };
        let string = '<div class="wrap-variation-o-q select-block-d"><div class="name-attribute-q" style="font-size: '+$('#attribute-fontr-q').val()+'; font-weight: '+$('#attribute-weight-q').val()+'; color: '+$('#attribute-color-q').val()+'">Attribute name</div> <select style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+'; background-color:'+variableStyle['background-color']+'; border-width: '+variableStyle['border-width']+'; border-color: '+variableStyle['border-color']+'; '+variableStyle['padding']+';border-radius:'+variableStyle['border-radius']+';"> <option style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+';">'+$('#text-select-variable').val()+'</option> <option style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+';">Variation 1</option><option style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+';">Variation 2</option> </select>';
        $('.wrap-select-variable-q').append(string);
  
    }

    
    //checkbox
    if ( val == 'checkbox' ){
        $('.type-checkbox-variable').css('display', 'block');
        
        //clear
        $('.wrap-select-variable-q').html('');
        
        //create checckbox
        let padding = $('.margin-variavble').attr('data-val');
        padding = padding.split(';');
        let number = 0;
        //style
        let variableStyle = {
            'font' : $('#text-variable-font-q').val(), 
            'color' : $('#text-variable-color-q').val(),
            'background-color' : $('#text-backgroun-color-q').val(),
            'border-width' : $('#text-border-width-q').val(),  
            'border-color' : $('#text-border-color-q').val(),
            'border-radius' : $('#text-border-radius-q').val(),
            'padding' : 'padding-left: 15px; padding-right: 15px; padding-top: 6px; padding-bottom: 6px;',
            'activ-color' : $('#variable-activ-color-q').val(),
            'activ-background' : $('#variable-activ-background-q').val(),
            'active-border-color' : $('#variable-activ-border-color-q').val(),
        };

        //fix padding for checkbox
        $('#admpaddingleft-v').val('15px');
        $('#admpaddingright-v').val('15px');
        $('#admpaddingtop-v').val('6px');
        $('#admpaddingbottom-v').val('6px').trigger('click');
        $('#admpaddingbottom-v').trigger('keyup');//for update padding
        //1
        let string = '<div class="swap-checkbox-variabble-q"> ';
        string = string + '<div class="wrap-variation-o-q"><div class="name-attribute-q" style="font-size: '+$('#attribute-fontr-q').val()+'; font-weight: '+$('#attribute-weight-q').val()+'; color: '+$('#attribute-color-q').val()+'">Attribute name</div>';
        string = string + '<div class="wrap-checkbox-design-q">';
        string = string + '<input type="radio" id="variable'+number+'" name="variable-q">';
        string = string + '<label class="variable-checkbox-q" style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+'; background-color:'+variableStyle['background-color']+'; border-width: '+variableStyle['border-width']+'; border-color: '+variableStyle['border-color']+'; border-radius:'+variableStyle['border-radius']+'; '+variableStyle['padding']+';" for="variable'+number+'" data-color="'+variableStyle['color']+'" data-background="'+variableStyle['background-color']+'" data-active-border-color="'+variableStyle['active-border-color']+'" data-border-color="'+variableStyle['border-color']+'" data-a-c="'+variableStyle['activ-color']+'" data-a-b="'+variableStyle['activ-background']+'">Variation 1</label>';
        number++;
        //2
        string = string + '<input type="radio" id="variable'+number+'" name="variable-q">';
        string = string + '<label class="variable-checkbox-q" style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+'; background-color:'+variableStyle['background-color']+'; border-width: '+variableStyle['border-width']+'; border-color: '+variableStyle['border-color']+'; border-radius:'+variableStyle['border-radius']+'; '+variableStyle['padding']+';" for="variable'+number+'" data-color="'+variableStyle['color']+'" data-background="'+variableStyle['background-color']+'" data-active-border-color="'+variableStyle['active-border-color']+'" data-border-color="'+variableStyle['border-color']+'" data-a-c="'+variableStyle['activ-color']+'" data-a-b="'+variableStyle['activ-background']+'">Variation 2</label>';
            number++;
        //3
        string = string + '<input type="radio" id="variable'+number+'" name="variable-q">';
        string = string + '<label class="variable-checkbox-q" style="font-size: '+variableStyle['font']+'; color: '+variableStyle['color']+'; background-color:'+variableStyle['background-color']+'; border-width: '+variableStyle['border-width']+'; border-color: '+variableStyle['border-color']+'; border-radius:'+variableStyle['border-radius']+'; '+variableStyle['padding']+';" for="variable'+number+'" data-color="'+variableStyle['color']+'" data-background="'+variableStyle['background-color']+'" data-active-border-color="'+variableStyle['active-border-color']+'" data-border-color="'+variableStyle['border-color']+'" data-a-c="'+variableStyle['activ-color']+'" data-a-b="'+variableStyle['activ-background']+'">Variation 2</label>';
            number++;

        string = string + '</div></div></div>';
        $('.wrap-select-variable-q').append(string);
        
        //fix id for calumn2
        $('.column-2 .swap-checkbox-variabble-q').find('input').each(function(){
            let id = $(this).attr('id')+'2';
            $(this).attr('id', id  ).next('label').attr('for', id  );
        });
    }
    else {
        $('.type-checkbox-variable').css('display', 'none');
        
    }
    //style
    if ( $('#variable-style-type').find('option:selected').attr('data-val') =='style-2' ){
        $('.wrap-variation-o-q').addClass('style-2');
    }
    else {
        $('.wrap-variation-o-q').removeClass('style-2');
    }
 
}


//variable checkbox checked
$('.wrap-demo-product-section').on('change', '.wrap-select-variable-q input', function(){
    $(this).parent().find('label').each(function(){
        $(this).removeClass('aktive-variable-check-q'); 
        $(this).css({'color' :  $(this).attr('data-color'), 'background-color' :  $(this).attr('data-background'), 'border-color' : $(this).attr('data-border-color'), });
    });
    let id = $(this).attr('id');
    let object =  $(this).parent().find('label[for="'+id+'"]');
    object.addClass('aktive-variable-check-q').css({'color' :  object.attr('data-a-c'), 'background-color' :  object.attr('data-a-b'), 'border-color' : object.attr('data-active-border-color') });

});


//auto width field setting
function updateWidthField(){
    $('.input-section-2-q').each(function(){ 
        if ( $(this).find('label').length === 0 ){
            if ( $(this).find('.wp-picker-container').length === 0 ){  
                $(this).find('input').css('width' , $(this).find('.text-setting-3-q').css('width') );
                $(this).find('select').css('width' , $(this).find('.wrap-heading-margin').css('width') );
            }
        }
    });
}

//tab menu
$(document).on('click', '.menu-top-q' , function(e){
    $('.menu-top-q').removeClass('activ-tab-q');
    $(this).addClass('activ-tab-q');
    let tab_id = $(this).attr('data-tab');
    //for text help
    if( tab_id == 1 ){
        $('.text-help-heading').css('display','block');
    }
    else {
        $('.text-help-heading').css('display','none');
    }
    //shoe hide tab
    $('.wrap-setting-qf-woo').each(function(){
        $('.wrap-setting-qf-woo').css('display', 'none');
        $('.tab-class-'+tab_id).css('display', 'block');
    });
    
    updateWidthField();
});
$('.activ-tab-q').trigger('click');


//create window
$('.wrap-setting-qf-woo').on('click', '.help-q' , function(e){
    if( $(e.target).hasClass('help-q') ){
        $('.swap-modal-help-q').remove();
        $(this).append('<div class="swap-modal-help-q"> <div class="modal-help-q"></div> <div class="close-help-q"><i class="fa fa-timesq"></i></div> </div>');
        if ( $(this).hasClass('q1') ){ 
            $('.modal-help-q').html( $('#text-help-1').html() );
            $('.swap-modal-help-q').css({'top' : '-80px'});
        }
        
        $('.not-active-field').removeClass('not-active-field');
    }
});

//close window
$('.wrap-setting-qf-woo').on('click', '.close-help-q' , function(){
    $(this).closest('.swap-modal-help-q').remove();
}); 

//close window 2
$('#wpbody-content').on('click' , function(e){
    if ( $(this).find('.swap-modal-help-q').length > 0 ){
        if ( $(e.target).attr('class')!='swap-modal-help-q' && $(e.target).attr('class')!='modal-help-q' && $(e.target).parent().attr('class')!='modal-help-q' && !$(e.target).hasClass('help-q') && !$(e.target).hasClass('img-help-q')  ){ 
            $('.wrap-setting-qf-woo').find('.swap-modal-help-q').remove();
        }
    }
});



//import export
$('.active-export-button').on('click', function(){
    let val =  $('#import-form-code').val();
    val = val.replace(/\\"/g,'"');
    try {
        val = JSON.parse(val);
        if ( typeof val == 'object'){
            let number = 0;
            

            if ( typeof val['dataTextButton'] =='undefined' ) {number++;}
            if ( typeof val['dataShowStockZero'] =='undefined' ) {number++;}
            if ( typeof val['dataFirstName'] =='undefined' ) {number++;}
            if ( typeof val['dataQuanity'] =='undefined' ) {number++;}
            if ( typeof val['dataShowImg'] =='undefined' ) {number++;}
            if ( typeof val['dataShowPrice'] =='undefined' ) {number++;}
            if ( typeof val['dataShowQuanity'] =='undefined' ) {number++;}
            if ( typeof val['dataShowName'] =='undefined' ) {number++;}
            if ( typeof val['dataEmail'] =='undefined' ) {number++;}  
            if ( typeof val['dataPhone'] =='undefined' ) {number++;} 
            if ( typeof val['dataCompany'] =='undefined' ) {number++;} 
            if ( typeof val['dataAddress'] =='undefined' ) {number++;} 
            if ( typeof val['dataCity'] =='undefined' ) {number++;}
            if ( typeof val['dataState'] =='undefined' ) {number++;}
            if ( typeof val['dataPostcode'] =='undefined' ) {number++;}
            if ( typeof val['dataCountry'] =='undefined' ) {number++;}
            if ( typeof val['dataComment'] =='undefined' ) {number++;}
            if ( typeof val['dataQuanity'] =='undefined' ) {number++;}
            if ( typeof val['dataButtonMagrinCategory'] =='undefined' ) {number++;}
            if ( number == 0 ){
                let arraySettingSave = $('#import-form-code').val().replace(/\\"/g,'"') ;
                //ajax remove form
                $.ajax({
                    type: "POST",
                    url: params.ajaxurl,
                    data: {
                        action: 'save_shop_import_setting_q',
                        nonce_code : params.nonce,
                        arraySettingSave: arraySettingSave,
                    },
                    success: function( response ) {
                        $('.error-export-button').css({'display' : 'none'});
                        $('.save-export-button').css({'opacity' : '1', 'z-index' : '1'});
                        setTimeout(function(){
                            $(".save-export-button").css({'opacity' : '0', 'z-index' : '-1'});
                            $('.error-export-button').css({'display' : 'inline-block'});
                        },2000);
                        location.reload();
   
                    },
                    error: function (error) {
                        $('.error-export-button').css({'opacity' : '1', 'z-index' : '1'});
                        setTimeout(function(){
                            $(".error-export-button").css({'opacity' : '0', 'z-index' : '-1'});
                        },2000);
                        
                    }
                });
            }
            else {
                $('.export-form-swap').children().addClass('error-esport-q');
                $('.error-export-button').css({'opacity' : '1', 'z-index' : '1'});
                setTimeout(function(){
                    $(".error-export-button").css({'opacity' : '0', 'z-index' : '-1'});
                },2000);
            }

        }
    } 
    catch (e) {
        $('.export-form-swap').children().addClass('error-esport-q');
        $('.export-form-swap').children().addClass('error-esport-q');
        $('.error-export-button').css({'opacity' : '1', 'z-index' : '1'});
        setTimeout(function(){
            $(".error-export-button").css({'opacity' : '0', 'z-index' : '-1'});
        },2000);
    }
  
});

$('#import-form-code').on('click', function(){
    $('.export-form-swap').children().removeClass('error-esport-q');
});

//select export text
$('.copy-export-button').on('click' , function(){
    $('#export-setting-code').select();
});

    
  
});
})(jQuery);