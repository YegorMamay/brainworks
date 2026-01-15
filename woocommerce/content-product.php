<?php
/**
 * Template for displaying product content in loops
 *
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$link = esc_url( get_permalink( $product->get_id() ) );
?>

<li <?php wc_product_class( '', $product ); ?> itemscope itemtype="https://schema.org/Product">

    <meta itemprop="sku" content="<?php echo esc_attr( $product->get_sku() ); ?>">
    <meta itemprop="url" content="<?php echo $link; ?>">

    <a href="<?php echo $link; ?>" class="product__img" itemprop="image" content="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>">
        <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
    </a>

    <div class="product__info">
        <a href="<?php echo $link; ?>" class="product__title" itemprop="name">
            <h3><?php echo $product->get_name(); ?></h3>
        </a>

        <div class="product_price brand-color-2 bold" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
            <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>">
            <meta itemprop="availability" content="https://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>">
            <meta itemprop="price" content="<?php echo $product->get_price(); ?>">
            <?php echo $product->get_price_html(); ?>
        </div>

        <?php if ( $product->is_in_stock() ) : ?>
        <div class="product_actions">

        </div>
        <?php endif; ?>
    </div>

</li>
