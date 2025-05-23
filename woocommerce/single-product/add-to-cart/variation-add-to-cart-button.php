<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>

<?php echo do_shortcode('[sold_in_last_24_hours]'); ?>

<div class="woocommerce-variation-add-to-cart variations_button">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php
    do_action( 'woocommerce_before_add_to_cart_quantity' );

    woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
    ) );

    do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

    <button type="submit" class="single_add_to_cart_button btn btn1"><i class="fal fa-cart-arrow-down"></i>  <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
    <button type="button" class="single_buy_one_click_button btn btn2-outline one-click <?php the_lang_class('one-click'); ?>"><?php _e('Buy in one click', 'brainworks'); ?></button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
