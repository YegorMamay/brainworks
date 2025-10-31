<?php
/**
 * Template Name: Landing
 **/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">

    <?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
        <link rel="preload" as="font" href="/wp-content/plugins/ti-woocommerce-wishlist/assets/fonts/tinvwl-webfont.ttf?xu2uyi" crossorigin>
    <?php endif; ?>

    <?php if ( ! defined('WPSEO_VERSION') ) : ?>

        <title><?php echo esc_html( custom_seo_title() ); ?></title>

        <meta name="description" content="<?php
            if ( has_excerpt() ) {
                echo esc_attr( get_the_excerpt() );
            } else {
                echo esc_attr( get_bloginfo( 'description' ) );
            } ?>">

        <!-- OpenGraph -->
        <?php
        $image_url = get_the_post_thumbnail_url();
        if ( empty( $image_url ) ) {
            $image_url = get_template_directory_uri() . '/assets/img/default-og-image.jpg';
        }
        ?>
        <meta property="og:locale" content="uk_UA">
        <meta property="og:locale:alternate" content="ru_RU">
        <meta property="og:locale:alternate" content="en_US">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo esc_html( custom_seo_title() ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
        <meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
        <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
        <meta property="og:image" content="<?php echo esc_url( $image_url ); ?>">
        <meta property="og:image:secure_url" content="<?php echo esc_url( $image_url ); ?>">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="675">

        <!-- Twitter Meta -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo esc_html( custom_seo_title() ); ?>">
        <meta name="twitter:image" content="<?php echo esc_url( $image_url ); ?>">
        <!-- OpenGraph. END -->
    <?php endif; ?>

    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

    <?php get_template_part('loops/content', 'page'); ?>

    <?php scroll_top(); ?>

    <?php wp_footer(); ?>

</body>

</html>
