jQuery(document).ready(function( $ ) {  

    //check if string starts with a #
    function check_hashtag(value){
        return /^#/.test(value);
    }

    //check if string is a hex color value
    function check_hex(value){
        return /^([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$|^([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])$/.test(value);
    }

    function add_hash_if_hex(colorvalue){
        if (check_hex(colorvalue)) {
            if (!check_hashtag(colorvalue)) {
               colorvalue = '#' + colorvalue;
            }
        }
        return colorvalue
    }

    $('.color-pick-color').each( function() {
        //check if hex, than add hashtag if needed.
        var colorvalue = $(this).data('value');
        if (check_hex(colorvalue)) {
            if (!check_hashtag(colorvalue)) {
               colorvalue = '#' + colorvalue;
            }
        }
        $(this).css("background", colorvalue);
    })


    /*buttons live color change*/
    /*add hashtag if needed than change color*/
    function anpsbuttons(anps_button, cssproperty, hex) {
        if (check_hashtag(hex) === true){
            $(anps_button).css(cssproperty , hex);
        } else {
            if (check_hex(hex) === true){
                $(anps_button).css(cssproperty , '#' + hex);
            } else {
                $(anps_button).css(cssproperty , hex);
            }   
        }
    }

$('.color-pick').on('change', function(){
    var anps_button = $(this).parents('.button-wrap').find('.btn');

    if ($(anps_button).length) {

        var parentdiv = $(this).parent().parent();
        var cssproperty = "";
        var hex = $(this).val();

        if ( $(parentdiv).hasClass('btn-bg')) {
           cssproperty = 'background-color';
        } else if ($(parentdiv).hasClass('btn-c')) { 
             cssproperty = 'color';
        } else if ($(parentdiv).hasClass('btn-b')) { 
            cssproperty = 'border';
        }      

          
        if ($(anps_button).length && cssproperty.length && hex.length) {
            anpsbuttons(anps_button, cssproperty, hex);
        }                       
        
    }
})

    /*buttons hover*/
    $('.button-wrap .btn').mouseover(function(){
        var $bghex, $bhex, $chex = "";
        $bghex = $(this).parent().parent().find('.btn-bg-h input.color-pick').val();
        $bhex = $(this).parent().parent().find('.btn-b-h input.color-pick').val();      
        $chex = $(this).parent().parent().find('.btn-c-h input.color-pick').val();
 
        //background
        if ($bghex != undefined) {
            $(this).css('background', add_hash_if_hex($bghex) );
        } 
        if ($bhex != undefined) {
            $(this).css('border', add_hash_if_hex($bhex) );
        }
        if ($chex != undefined) {
            $(this).css('color', add_hash_if_hex($chex) );
        }
    })

    $('.button-wrap .btn').each(function() {
        var $bghex, $bhex, $chex = "";
        $bghex = $(this).parent().parent().find('.btn-bg input.color-pick').val();
        $bhex = $(this).parent().parent().find('.btn-b input.color-pick').val();      
        $chex = $(this).parent().parent().find('.btn-c input.color-pick').val();

        if ($bghex != undefined) {
            $(this).css('background-color', add_hash_if_hex($bghex) )
        }
        if ($bhex != undefined) {
            $(this).css('border', add_hash_if_hex($bhex) )
        }
        if ($chex != undefined) {
            $(this).css('color', add_hash_if_hex($chex) )
        }
    }) 

    $('.button-wrap .btn').mouseout(function() { 

        $(this).attr('style', '');
        
        var $bghex, $bhex, $chex = "";
        $bghex = $(this).parent().parent().find('.btn-bg input.color-pick').val();
        $bhex = $(this).parent().parent().find('.btn-b input.color-pick').val();      
        $chex = $(this).parent().parent().find('.btn-c input.color-pick').val();

        if ($bghex != undefined) {
            $(this).css('background-color', add_hash_if_hex($bghex) );
        }
        if ($bhex != undefined) {
            $(this).css('border', add_hash_if_hex($bhex) );
        }
        if ($chex != undefined) {
            $(this).css('color', add_hash_if_hex($chex) );
        }
    })
    /*End hover buttons*/


    var currentlyClickedElement = '';
    
    $('.color-pick-color').bind("click", function(){ 
        currentlyClickedElement = this;
    });

    /* Scheme Creator */

    /*var allColors = [];

    $('input[type="text"]').each(function() {
        allColors.push($(this).val());
    });

    console.log(allColors);*/

    $('.color-pick-color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).css("background","#"+hex);
            $(el).attr("data-value", "#"+hex);
            //$(el).attr("data-value", hex);
            $(el).parent().children(".color-pick").val("#"+hex);
            //$(el).parent().children(".color-pick").val(hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor($(this).attr("data-value"));
        },
        onChange: function (hsb, hex, rgb) {
            $(currentlyClickedElement).css("background","#"+hex);
           // $(currentlyClickedElement).attr("data-value", "#"+hex);
            $(currentlyClickedElement).attr("data-value", hex);
            //$(currentlyClickedElement).parent().children(".color-pick").val("#"+hex);
            $(currentlyClickedElement).parent().children(".color-pick").val(hex);
            
            //is there a button to be changed?
            var anps_button = $(currentlyClickedElement).parents('.button-wrap').find('.btn');
            if ($(anps_button).length) {

                var parentdiv = $(currentlyClickedElement).parent().parent();
                var cssproperty = "";

                if ( $(parentdiv).hasClass('btn-bg')) {
                   cssproperty = 'background-color';
                } else if ($(parentdiv).hasClass('btn-c')) { 
                     cssproperty = 'color';
                } else if ($(parentdiv).hasClass('btn-b')) { 
                    cssproperty = 'border';
                }                                
                anpsbuttons(anps_button, cssproperty, hex);
            }
            
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
	 
 
    $('.color-pick').bind('keyup', function(){
        //check if hex, than add hashtag if needed.
        var colorvalue = $(this).val();
        if (check_hex(colorvalue)) {
            if (!check_hashtag(colorvalue)) {
               colorvalue = '#' + colorvalue;
            }
         }
        //console.log(colorvalue);
        $(this).parent().children(".color-pick-color").css("background", colorvalue);
    });
    
    var default_val = ["898989", "3498db", "2a76a9", "ffffff", "16242e", "000000", "8c8c8c", "16242e", "171717", "7f7f7f", "ffffff", "9C9C9C", "f8f9f9", "4e4e4e", "ffffff", "8c8c8c", "#ececec", "ffffff", "3daaf3", "2f4d60", "69cd72", "32853a", "3498db", "ffffff", "2a76a9", "ffffff", "3498db", "ffffff", "2a76a9", "ffffff", "242424", "ffffff", "ffffff", "242424", "ffffff", "242424", "242424", "ffffff", "3498db", "2a76a9"];
    var green = ["898989", "89c218", "64910a", "ffffff", "16242e", "000000", "8c8c8c", "16242e", "171717", "7f7f7f", "ffffff", "9C9C9C", "f8f9f9", "4e4e4e", "ffffff", "8c8c8c", "#ececec", "ffffff", "92d40f", "3d5c00", "69cd72", "32853a", "89c218", "ffffff", "64910a", "ffffff", "89c218", "ffffff", "64910a", "ffffff", "242424", "ffffff", "ffffff", "242424", "ffffff", "242424", "242424", "ffffff", "89c218", "64910a"];
    var orange = ["898989", "f2881d", "c96500", "ffffff", "16242e", "000000", "8c8c8c", "16242e", "171717", "7f7f7f", "ffffff", "9C9C9C", "f8f9f9", "4e4e4e", "ffffff", "8c8c8c", "#ececec", "ffffff", "f2881d", "7d3f00", "69cd72", "32853a", "f2881d", "ffffff", "c96500", "ffffff", "f2881d", "ffffff", "c96500", "ffffff", "242424", "ffffff", "ffffff", "242424", "ffffff", "242424", "242424", "ffffff", "f2881d", "c96500"];
    var red = ["898989", "e82a2a", "ba0000", "ffffff", "16242e", "000000", "8c8c8c", "16242e", "171717", "7f7f7f", "ffffff", "9C9C9C", "f8f9f9", "4e4e4e", "ffffff", "8c8c8c", "#ececec", "ffffff", "f23535", "630000", "69cd72", "32853a", "e82a2a", "ffffff", "ba0000", "ffffff", "e82a2a", "ffffff", "ba0000", "ffffff", "242424", "ffffff", "ffffff", "242424", "ffffff", "242424", "242424", "ffffff", "e82a2a", "ba0000"];  

    $(".palette").bind("click", function(){ 
        var table; 	
        switch($('input', this).val()) {
            case "default" :
                table = default_val;
                break;
            case "green" :
                table = green;
                break;
            case "orange" :
                table = orange;
                break;
            case "red" :
                table = red;
                break;
        }
        $(".color-pick").each(function(index){
            $(".color-pick").eq(index).val(table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").css("background", '#' + table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").attr("data-value", table[index]);
        });
    });
    $(".input-type").change(function(){
        if($(this).val() == "dropdown") {
            $(this).parent().parent().children(".validation").hide();
            $(this).parent().parent().children(".label-place-val").children("label").html("Values");
        }
        else {
            $(this).parent().parent().children(".validation").show();
            $(this).parent().parent().children(".label-place-val").children("label").html("Placeholder");
        }
    });
});