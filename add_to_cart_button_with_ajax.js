jQuery(document).ready(function() {
    jQuery("select.select-qty").change(function () {
        var selectedQty = jQuery(this).children("option:selected").val();
        jQuery(this).parent().next().find('.btn-add-to-cart-ajax').attr('data-quantity', selectedQty);
    });
    jQuery(".btn-add-to-cart-ajax").on("click", function () {
        var data_variation, product_id, variation_id, qty, variation_key, variation_val, var_data = '';
        var var_data = {};
        product_id = jQuery(this).attr('data-product_id');
        variation_id = jQuery(this).attr('data-variation_id');
        qty = jQuery(this).attr('data-quantity');
        data_variation = jQuery(this).attr('data-variation');
        var_data = data_variation.split("=");
        variation_key = var_data['0'];
        variation_val = var_data['1'];
        var_data[variation_key] = variation_val;
        var btn = jQuery(this);
		btn.html('Adding');
		const icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20" fill="#ffffff"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>';
        console.log("Product ID = " + product_id + " Variation ID = " + variation_id + " Quantity = " + qty + " variation_key=" + variation_key + " variation_val=" + variation_val);
        jQuery.ajax({
            url: ajax_object.ajax_url,
            data: {
                "action": "woocommerce_add_variation_to_cart",
                "product_id": product_id,
                "variation_id": variation_id,
                "quantity": qty,
                "variation": var_data
            },
            type: "POST",
            success: function (data) {
                btn.html('<i class="astra-icon ast-icon-check"></i>');
                setTimeout(function () {
                    btn.html(icon);
                }, 1000);
//                 console.log(ajax_object.checkout_url);
//                 btn.parent(".footable-last-visible").append('<a href="' + ajax_object.checkout_url + '" title="Checkout" alt="Checkout" class="btn checkout_button" >added</a>');
//                 console.log(data);
                jQuery('a.cart-container').replaceWith(data.fragments["a.cart-container"]);
                jQuery('div.widget_shopping_cart_content').replaceWith(data.fragments["div.widget_shopping_cart_content"]);
//                 jQuery(".widget_shopping_cart").css({"opacity": "1", "visibility": "visible","right": "0", "left": "auto"});
//                 jQuery(".widget_shopping_cart_content").css({"opacity": "1", "visibility": "visible"});

				jQuery("html").attr("class","ast-mobile-cart-active");
                jQuery("#astra-mobile-cart-drawer").addClass('active');
//                 jQuery(".widget_shopping_cart").addClass('widget_ajax_shopping_cart-open');

                setTimeout(function(){
                    jQuery(".widget_shopping_cart").removeClass('widget_ajax_shopping_cart-open');
//                     jQuery(".widget_shopping_cart").css({"opacity": "0", "visibility": "hidden","right": "0", "left": "auto"});
//                     jQuery(".widget_shopping_cart_content").css({"opacity": "0", "visibility": "hidden"});
                }, 2000);
            }
        });
    });
});