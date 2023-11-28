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
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">


    <link rel="preload" as="font" href="<?php echo esc_url(get_template_directory_uri() . '/assets/fonts/font-awesome/fa-brands-400.woff2'); ?>" crossorigin>
    <link rel="preload" as="font" href="<?php echo esc_url(get_template_directory_uri() . '/assets/fonts/font-awesome/fa-light-300.woff2'); ?>" crossorigin>
    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
    <?php $plugin='yith-woocommerce-wishlist/init.php'; ?>
    <?php if(is_plugin_active($plugin)){ ?>
    <link rel="preload" as="font" href="/wp-content/plugins/ti-woocommerce-wishlist/assets/fonts/tinvwl-webfont.ttf?xu2uyi" crossorigin>
    <?php } ?>


    <!-- Delete if YoastSEO plugin activated. START -->
    <title>
        <?php
        if (is_front_page()) {
            echo get_bloginfo('name');
        } elseif (is_post_type_archive()) {
            echo post_type_archive_title();
        } elseif (!is_front_page() || !is_page()) {
            echo single_post_title();
        } elseif (!is_front_page() || !is_single()) {
            echo the_title();
        } elseif (is_front_page() && is_category()) {
            echo single_cat_title();
        }
        if (is_archive()) {
            echo single_cat_title();
        }
        ?>
    </title>

    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- OpenGraph -->
    <meta property="og:locale" content="ru_RU">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="
    <?php
    if (is_front_page()) {
        echo get_bloginfo('name');
    } elseif (is_post_type_archive()) {
        echo post_type_archive_title();
    } elseif (!is_front_page() || !is_page()) {
        echo single_post_title();
    } elseif (!is_front_page() || !is_single()) {
        echo the_title();
    } elseif (is_front_page() && is_category()) {
        echo single_cat_title();
    }
    if (is_archive()) {
        echo single_cat_title();
    }
    ?>
    ">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:url" content="<?php echo esc_url(site_url()); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="
        <?php
    if (is_front_page()) {
        echo get_bloginfo('name');
    } elseif (is_post_type_archive()) {
        echo post_type_archive_title();
    } elseif (!is_front_page() || !is_page()) {
        echo single_post_title();
    } elseif (!is_front_page() || !is_single()) {
        echo the_title();
    } elseif (is_front_page() && is_category()) {
        echo single_cat_title();
    }
    if (is_archive()) {
        echo single_cat_title();
    }
    ?>
    ">
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
    <!-- OpenGraph. END -->
    <!-- Delete if YoastSEO plugin activated. END -->

    <!-- Favicon. If not set in theme settings. START -->
    <!--<link rel="shortcut icon" href="<?php /* echo esc_url(get_template_directory_uri() . '/assets/img/favicon.ico'); */ ?>" type="image/x-icon">
    <link rel="icon" href="<?php /* echo esc_url(get_template_directory_uri() . '/assets/img/favicon.ico'); */ ?>" type="image/x-icon">-->
    <!-- Favicon. END -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php get_template_part('loops/content', 'page'); ?>

    <?php scroll_top(); ?>

    <?php wp_footer(); ?>

</body>

</html>
