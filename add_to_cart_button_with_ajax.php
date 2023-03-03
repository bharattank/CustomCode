<?php
add_action('wp_ajax_nopriv_woocommerce_add_variation_to_cart', 'bfa_display_variation_add_to_cart');
add_action('wp_ajax_woocommerce_add_variation_to_cart', 'bfa_display_variation_add_to_cart');
if (!function_exists('bfa_display_variation_add_to_cart')) {
  /*
   * Add to cart variation wise products using ajax
   */
  function bfa_display_variation_add_to_cart($atts)  {
	  	ob_start();

        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
        $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

        $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : '';
        $variations = !empty($_POST['variation']) ? (array) $_POST['variation'] : '';
        $variations = array($variations[0] => $variations[1]);
        // print_r($new_variation);
        // exit;
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data);

        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations)) {

            do_action('woocommerce_ajax_added_to_cart', $product_id);

            if (get_option('woocommerce_cart_redirect_after_add') == 'yes') {
                wc_add_to_cart_message($product_id);
            }

            // Return fragments
            WC_AJAX::get_refreshed_fragments();
        } else {

            // If there was an error adding to the cart, redirect to the product page to show any errors
            $data = array(
                'error' => true,
                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
            );

            wp_send_json($data);
        }

        die();
  	}
}
if (!function_exists('bfa_display_variation_in_table_format')) {

  function bfa_display_variation_in_table_format($atts)  {
   ob_start();
	   global $product;
            $product_data = shortcode_atts( array(
                'id' => ''
            ), $atts );
        
            $id = $product_data['id'];
      ?>
        <div class="product-variation-display-section table-responsive">
            <?php
//             global $product;
//             $id = $product->get_id();
            $product = new WC_Product_Variable($id);
	  		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
            // get the product variations
            $product_variations = $product->get_available_variations();
            $attributes = $product->get_attributes();
            //            echo "<pre>";
            //            print_r($attributes);
            foreach ($attributes as $key => $attribute) {
                if ($attribute->get_variation()) {
                    $attribute_name = $attribute->get_name();
                }
            }
            if (!empty($product_variations)) {
                ?>
                <table class="product_type">
                    <tbody>
                    <tr class="main-tr">
						<td class="p_image">
							<div class="product_img">
								<a class="thumbnail" href="<?php echo get_permalink($id); ?>">
									<img src="<?php echo $image[0]; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo $alt; ?>" class="img-responsive" width="200px">
								</a>
							</div>
						</td>
                        <td class="block">
                            <table class="table footable footable-1 breakpoint-lg table-bordered"
                                   data-toggle-column="last">
                                <thead>
                                <tr class="row-title">
                                    <th colspan="5"><h2 class="variation-product-title"><?php echo $product->get_title() . ' - ' . $attribute_name; ?></h2>
                                    </th>
                                </tr>
                                <tr class="footable-header">
                                    <th class="footable-first-visible"><?php echo $attribute_name; ?></th>
                                    <th>Price:</th>
                                    <th class="hide-mobile">Price/unit</th>
                                    <th>Quantity</th>
                                    <th class="footable-last-visible">Add To Cart</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($product_variations as $key => $product_variation) {
                                    $attribute = array_values($product_variation['attributes']);
                                    ?>
                                    <tr>
                                        <td class="footable-first-visible"><?php echo($attribute[0]); ?></td>
                                        <td> <?php echo $product_variation['price_html']; ?></td>
                                        <td class="hide-mobile">
                                            <?php
                                            $tablets = explode(' ', $attribute[0]);
                                            $unit_price = $product_variation['display_price'] / $tablets[0];
                                            $final_unit = round(number_format($unit_price, 2), 2);
                                            echo '$' . $final_unit . ' /Piece';
                                            ?>
                                        </td>
                                        <td>
                                            <select class="form-control select-qty">
                                            <!-- <select class="form-control select-qty"> -->
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                        <td class="footable-last-visible">
                                            <?php
                                            $attr = '';
                                            $attrs = $product_variation['attributes'];
                                            foreach ($attrs as $key => $attr) {
                                                if (!empty($attr)) {
                                                    $attr = $key . '=' . $attr;
                                                } else {
                                                    $attr .= '&' . $key . '=' . $attr;
                                                }
                                            }
                                            $key = '_stock_status';
                                            $checkStock = get_post_meta($product_variation["variation_id"], $key, true);
                                            if (!empty($checkStock) && $checkStock == 'outofstock') {
                                                ?><span class="text-danger">Out of stock</span><?php
                                            } else {
                                                // echo apply_filters(
                                                //                         'woocommerce_loop_add_to_cart_link', sprintf(
                                                //                                 '<a href="%s" rel="nofollow" data-product_id="%s" data-quantity="1" data-product_sku="%s" class="button btn-add-to-cart-ajax_set %s product_type_%s add_to_cart_button ajax_add_to_cart add-to-cart-loop"><i class="astra-icon ast-icon-shopping-basket"></i></a>', esc_url($brand_product->add_to_cart_url()), esc_attr($brand_product->get_id()), esc_attr($brand_product->get_sku()), $brand_product->is_purchasable() ? 'add_to_cart_button' : '', esc_attr($brand_product->product_type), esc_html('$brand_product->add_to_cart_text()')
                                                //                         ), $brand_product
                                                //                 );
                                                ?>
<!--                                             <a href="<?php //echo get_the_permalink() . '?add-to-cart=' . $id . '&quantity=1&variation_id=' . $product_variation["variation_id"] . '&' . $attr . ''; ?>" class="btn btn-primary btn-add-to-cart-ajax enable-desktop" data-quantity="1">add to cart</a>
											<a href="<?php //echo get_the_permalink() . '?add-to-cart=' . $id . '&quantity=1&variation_id=' . $product_variation["variation_id"] . '&' . $attr . ''; ?>" class="btn btn-primary btn-add-to-cart-ajax enable-mobile" data-quantity="1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20" fill="#ffffff"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></a> -->
											<button type="button" class="btn-add-to-cart-ajax btn btn-link enable-desktop" data-product_id="<?php echo abs($id); ?>" data-variation_id="<?php echo $product_variation["variation_id"]; ?>" data-quantity = "1" data-variation = "<?php echo $attr; ?>">add to cart</button>
											<?php
                                            }
                                            ?>
                                            <!--<a href="<?php //echo get_the_permalink() . '?add-to-cart=' . $id . '&quantity=1&variation_id=' . $product_variation["variation_id"] . '&' . $attr . ''; ?>" class="btn btn-primary btn-add-to-cart-ajax">add to cart</a>-->
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>

        <?php
      return ob_get_clean();
  }
}
add_shortcode('product_table', 'bfa_display_variation_in_table_format');