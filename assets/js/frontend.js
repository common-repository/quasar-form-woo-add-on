(function ($) {
$(document).ready(function () {
    
    
$('.wrap-button-quasar-woo').find('.button-qform').attr('data-woo', 'yes');


function fullFillingvariable(form){
    //option
    if ( form.find('.wrap-select-variable-q select').length > 0 ){
        let filling = 0;
        form.find('.wrap-select-variable-q select').each(function(){
            if ( $(this).find('option:selected').attr('data-prise') == 'none' ){filling++;}
        });
        if ( filling === 0 ) { $('.active-q-b').parent().attr('data-fill', 'yes'); }
        else { $('.active-q-b').parent().attr('data-fill', 'not'); }
    }
    //checkbox
    else {
        if ( form.find('.wrap-select-variable-q label').length > 0 ){
            let filling = 0;
            form.find('.wrap-select-variable-q .wrap-checkbox-section-q').each(function(){
                let number = 0;
                $(this).find('input').each(function(){
                    if ( $(this).prop('checked') ) { number++; }
                });
                if ( number === 0 ) { filling++; }
            });
            
            if ( filling === 0 ) { $('.active-q-b').parent().attr('data-fill', 'yes'); }
            else { $('.active-q-b').parent().attr('data-fill', 'not'); }
        }
    }
}

$('.wrap-button-quasar-woo').on('click', function(){
    let idform = $(this).find('.button-qform').attr('data-form');
    let setting = $(this).attr('data-setting').split(';');
    let idProduct = $(this).attr('data-id');
    let classForm = '.unique-class-'+idform;
    $('.type-product-element').remove();
    let style = $(this).attr('data-style');
    let prise ='';
    
    //show form
    $(classForm).find('.swap-tabs-element, .percent-send-q, .form-main-element').css('display' , 'flex');
    $(classForm).find('.text-prorgress-send, .text-after-send-q').css('display' , 'none');
    //if tab form
    if ( $(classForm).find('.tab-box-q').length > 0 ) {
        let text =  $(classForm).find('.element-send-q').attr('data-text');
         $(classForm).find('.element-send-q').html( text );
        //remove admin class
        $(classForm).find('.tab-box-q').removeClass('first').removeClass('last').removeClass('activ-tab-q');
        $(classForm).find('.form-element-q[data-tabs!="0"]').not('.type-submit-element').addClass('tab-none-q');
        $(classForm).find('.construction-block[data-tabs!="0"]').not('.second-level-q').addClass('tab-none-q');
        //click first tab
        $(classForm).find('.tab-box-q').not('.hide-tab-q').filter(':first').trigger('click');
    }
    
    let createdEleent = "<div class='type-product-element'>";
    if ( setting[0] == 'yes' ){ createdEleent = createdEleent + "<div class='type-img-product'><img src='"+$(this).attr('data-img')+"' data-i='"+$(this).attr('data-img')+"'></div>"; }
    if ( setting[3] == 'yes' ){ createdEleent = createdEleent + "<div class='type-name-product' style='font-size: "+setting[4]+"; color: "+setting[5]+"'>"+$(this).attr('data-name')+"</div>"; }
    //price
    createdEleent = createdEleent + "<div class='wrap-prise'>";
    if ( setting[1] == 'yes' && $(this).attr('data-price') !=='' ){ createdEleent = createdEleent + "<div class='wrap-price-qf-woo'><span class='heading-qf-woo' style='font-size: "+setting[13]+"; line-height: "+setting[13]+"; color: "+setting[14]+"'>"+$(this).attr('data-h-1')+"</span><div class='product-prise-q' style='background-color: "+setting[17]+"; color: "+setting[16]+"; border-color: "+setting[18]+"; font-size: "+setting[15]+";line-height: "+setting[15]+";'>"; }
    //variable prise
    if ( $(this).attr('data-price-2') !=='' ){ 
        prise ="<span class='prise-q'>"+$(this).attr('data-price-2')+"</span></div></div>";
    }
    //standart prise
    else {
        if ( $(this).attr('data-price-3') == $(this).attr('data-price') ){
            if ( setting[1] == 'yes' && setting[12] == 'right' && $(this).attr('data-price') !=='' ) {  
                prise = "<span class='prise-q'>"+$(this).attr('data-price')+"<span class='currency-q'>"+$(this).attr('data-currency')+"</span></span></div></div>";  
            }
            
            if ( setting[1] == 'yes' && setting[12] == 'left' && $(this).attr('data-price') !=='' ) {  
                prise =  "<span class='prise-q'><span class='currency-q'>"+$(this).attr('data-currency')+"</span>"+$(this).attr('data-price')+"</span></div></div>";
            }
        }
        else {
            //sale
            let sale = '';
            if ( $(this).attr('data-price-3') != $(this).attr('data-price') ){
                if ( setting[1] == 'yes' && setting[12] == 'right' && $(this).attr('data-price') !=='' ) { 
                    sale = '<span class="sale-prise-q">'+$(this).attr('data-price-3')+'<span class="currency-q">'+$(this).attr('data-currency')+'</span></span>'; 
                    prise = "<span class='prise-q'>"+sale+$(this).attr('data-price')+"<span class='currency-q'>"+$(this).attr('data-currency')+"</span></span></div></div>"; 
                }
                if ( setting[1] == 'yes' && setting[12] == 'left' && $(this).attr('data-price') !=='' ) { 
                    sale = '<span class="sale-prise-q"><span class="currency-q">'+$(this).attr('data-currency')+'</span>'+$(this).attr('data-price-3')+'</span>'; 
                    prise = "<span class='prise-q'><span class='currency-q'>"+sale+$(this).attr('data-currency')+"</span>"+$(this).attr('data-price')+"</span></div></div>";
                }
            }
        }
        
    }
    createdEleent = createdEleent + prise;
    //number
    if ( setting[2] == 'yes' ){ createdEleent = createdEleent + "<div class='number-product-in-q'><span class='heading-qf-woo' style='font-size: "+setting[6]+"; line-height: "+setting[6]+"; color: "+setting[7]+"'>"+$(this).attr('data-h-2')+"</span><input style='background-color: "+setting[10]+"; color: "+setting[9]+"; border-color: "+setting[11]+"; font-size: "+setting[8]+"; line-height: "+setting[8]+";' type='number' min='1' value='1'></div>"; }
   
    createdEleent = createdEleent + "</div></div>";
    $(classForm).find('.form-main-element').prepend(createdEleent);
    
    //fix heaight
    if ( setting[1] == 'yes' && setting[2] =='yes' ) {
        let val = $(classForm).find('.product-prise-q').css('height');
        $(classForm).find('.number-product-in-q input').css('height', val);
    }

});


    
    
$('.quasar-form .submit-quasar-form-event').on('click', function(){

    if (typeof arraySubmit === 'object'){
        if ( $('.active-q-b').parent().hasClass('wrap-button-quasar-woo') ){
            //simple
            let dataIdProduct = $('.active-q-b').parent().attr('data-id');
            let dataVal = '';
            //variable
            if ( $('.active-q-b').parent().hasClass('variable-item-q') ){
                dataIdProduct = $('.active-q-b').parent().attr('data-id-v');
                dataVal = $('.active-q-b').parent().attr('data-val');
            }
    
            let dataQuantity = 1;
            if ( $('.number-product-in-q').find('input').length > 0 ){
                dataQuantity = $('.number-product-in-q').find('input').val();
            }
            
            //ajax
            $.ajax({
                type: "POST",
                url: params.ajaxurlq,
                data: {
                    action: 'send_woo_form',
                    nonce_code : params.nonce,
                    dataSend: arraySubmit.toString(),
                    dataIdProduct: dataIdProduct,
                    dataQuantity: dataQuantity,
                    dataVal : dataVal
                },
                success: function(otvet) {
                    //console.log(otvet);
                }
            });
        }
    }

});  


function quantityProduct(x){
    let val = x.val();
    let form = x.closest('.form-main-element');
    fullFillingvariable(form);
    let filling = 0;
    let id_v ='';
    let active_button = $('.active-q-b');
    let imgSetting = active_button.parent().attr('data-img-v');
    let img_v ='';
    let all_variable = active_button.next().attr('data-all-variable');
    let valString = "";
    let stop = 0;
    let setting = active_button.parent().attr('data-setting').split(';');
    let currency = active_button.parent().attr('data-currency');
    let align_currency  = setting[12];
    let prise = 'none';
    let prise_regular = '';
    let numberFixed = 0;

    //simple
    if ( form.find('.product-prise-q').length > 0 ){
        let button = $('.active-q-b').closest('.wrap-button-quasar-woo');
        let prise = button.attr('data-price');
        let prise_regular = button.attr('data-price-3');
        
        prise = Number(prise) * Number(val);
        prise_regular = Number(prise_regular) * Number(val);
        if ( align_currency =='left'){ prise = currency+prise; prise_regular = currency+prise_regular; }
        else { prise = prise+currency; prise_regular = prise_regular+currency; }
        
        //not sale
        if ( prise == prise_regular ){
            form.find('.prise-q').html(prise);
        }
        //sale
        else {
            form.find('.prise-q').html("<span class='sale-prise-q'>"+prise_regular+"</span>" + prise);
        }
        
    }
}

//standart quantity
$('.form-main-element').on('keyup change', '.number-product-in-q input' , function(){
    quantityProduct( $(this) );
});

//custom quantity
$('.form-main-element').on('keyup', '.swap-quantity-q input' , function(){
    let form = $(this).closest('.form-main-element');
    let id = $('.active-q-b').closest('.wrap-button-quasar-woo').attr('data-qua'); 
    if ( id !== '0') {
        let idField = $(this).closest('.type-quantity-element').attr('id');
        if ( id == idField ){
            quantityProduct( $(this) );
        }
    }
});
$('.form-main-element').on('click', '.quantity-minus-q, .quantity-plus-q' , function(){
    let id = $('.active-q-b').closest('.wrap-button-quasar-woo').attr('data-qua'); 
    if ( id !== '0') {
        let field = $(this).closest('.type-quantity-element');
        let idField = field.attr('id');
        if ( id == idField ){
            quantityProduct( field.find('input') );
        }
    }

});
    
 
    
});
})(jQuery);
