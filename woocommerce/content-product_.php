<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$link = esc_url( get_permalink( $product->get_id() ) );
$sku = $product->get_sku();
$size = get_post_meta ( $product->get_id() , '_size_prouduct', true );
?>

<li <?php wc_product_class( '', $product ); ?>>

    <a href="<?php echo $link; ?>" class="product__img">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
	</a>

	<div class="product__info">
		<a href="<?php echo $link; ?>" class="product__title">
			<h3><?php echo $product->get_name(); ?></h3>
		</a>

		<div class="product__price">
		    <?php echo $product->get_price_html(); ?>
		</div>

		<?php if ( $product->is_in_stock() ) : ?>

		<div class="product__actions">

            <?php
                global $product;
                echo '<div class="product-short-description text-muted">' . $product->get_short_description() . '</div>';
            ?>

		    <button class="button buy-one-click one-click" data-title="<?php echo $product->get_name(); ?>">Buy</button>
		    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>

		<?php endif; ?>

    </div>

</li>
