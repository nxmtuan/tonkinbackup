<?php

/**
 * Add template Woocommerce
 */
function ws247_theme_woo()
{

    // Declare WooTheme support
    // https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'ws247_theme_woo');

/**
 * Chuyển Sale thành dạng +- %
 */
function custom_product_sale_flash($output, $post, $product)
{
    global $product;
    if ($product->is_on_sale()) {
        if ($product->is_type('variable')) {
            $regular_price = $product->get_variation_regular_price();
            $sale_price = $product->get_variation_price();
        } else {
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
        }
        $percent_off = (($regular_price - $sale_price) / $regular_price) * 100;
        $text = $regular_price > $sale_price ? '-' : '+';
        return '<span class="sale-off">' . $text . '' . round($percent_off) . '% </span>';
    }
}
add_filter('woocommerce_sale_flash', 'custom_product_sale_flash', 11, 3);


/**
 * Add theme suopport gallery single product
 */
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

/**
 * Custom number shop per page
 */
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = get_option('posts_per_page');
    return $cols;
}

/**
 * Remove some biliing not to used
 */
add_filter('woocommerce_billing_fields', 'remove_billing_phone_field', 20, 1);
function remove_billing_phone_field($fields)
{
    $fields['billing_country']['required'] = false;
    $fields['billing_city']['required'] = false;
    unset($fields['billing_country']);
    unset($fields['billing_address_2']);
    unset($fields['billing_postcode']);
    unset($fields['billing_city']);
    unset($fields['billing_company']);
    return $fields;
}
add_filter('woocommerce_shipping_fields', 'remove_shipping_phone_field', 20, 1);
function remove_shipping_phone_field($fields)
{
    $fields['shipping_country']['required'] = false;
    unset($fields['shipping_country']);
    unset($fields['shipping_address_2']);
    unset($fields['shipping_postcode']);
    unset($fields['shipping_city']);
    unset($fields['shipping_company']);
    return $fields;
}
