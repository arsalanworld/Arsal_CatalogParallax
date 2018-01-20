define(
    [
        'Magento_Ui/js/form/element/abstract',
        'ko',
        'jquery',
        'jquery/colorpicker/js/colorpicker'
    ],
    function (Abstract, ko, $) {
        "use strict";


        $(document).on('click','input[name="ritzy_parallax_heading_color"]',function(){
            var $el = $(this);
            var value = $($el).val();
            if(value.trim() == '') value = '#ffffff';
            if(value) $($el).css("backgroundColor", value);

            $($el).ColorPicker({
                color: value,
                onChange: function (hsb, hex, rgb) {
                    $($el).css("backgroundColor", "#" + hex).val("#" + hex)
                        .trigger('change');
                }
            }).ColorPickerShow().css('zIndex', 3);
        });

        return Abstract.extend({
            initialize: function ()
            {
                this._super();
            }
        });
    });