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

            <form class="cart" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" method="post" enctype="multipart/form-data">
                <div class="quantity-control">
                    <button type="button" class="qty-btn minus">−</button>
                    <?php
                    woocommerce_quantity_input( [
                        'min_value'   => 1,
                        'max_value'   => $product->get_max_purchase_quantity(),
                        'input_value' => 1,
                        'classes'     => ['input-text', 'qty', 'text'],
                    ] );
                    ?>
                    <button type="button" class="qty-btn plus">+</button>
                </div>

                <!-- Кнопка добавления в корзину -->
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </form>

            <!-- Кнопка "Buy" с ID попапов Elementor для разных языков -->
            <button class="button buy-one-click one-click"
              data-title="<?php echo esc_attr( $product->get_name() ); ?>"
              data-popup="ru:116,ua:388,en:867">
                <?php _e('Buy', 'brainworks'); ?>
            </button>


        </div>
        <?php endif; ?>
    </div>

</li>
