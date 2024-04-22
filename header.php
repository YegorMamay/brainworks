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
    <meta property="og:locale" content="uk_UA">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:locale:alternate" content="en_US">
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
    <meta property="og:image:height" content="675">
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

<body <?php body_class(); ?> id="top">

    <?php wp_body_open(); ?>
    <div class="wrapper js-container">
        <!--Do not delete this openning div! It ends/closed in footer.php -->

        <header class="header <?php sticky_header(); ?>">

            <?php if (is_active_sidebar('pre-header-widget-area')) : ?>
            <div class="pre-header">
                <div class="container d-flex justify-content-between align-items-center">
                    <?php dynamic_sidebar('pre-header-widget-area'); ?>
                </div>
            </div>
            <?php endif; ?>


            <div class="header-inner container d-flex justify-content-between align-items-center">

                <div class="logo-name d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <?php the_custom_logo() ?>
                    </div>

                    <!-- <div class="site-name">
                        <h5><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h5>
                        <p><?php bloginfo( 'description' ); ?></p>
                    </div> -->
                </div>

                <!-- Language switcher menu. START -->
                <div class="nav-wrapper language-switcher">
                    <?php if (has_nav_menu('language-switcher') && function_exists('pll_the_languages')) { ?>
                    <nav class="nav js-menu">
                        <button type="button" tabindex="0" class="menu-item-close menu-close js-menu-close"></button>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'language-switcher',
                            'container' => false,
                            'menu_class' => 'menu-container',
                            'menu_id' => '',
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 2
                        )); ?>
                    </nav>
                    <?php } ?>
                </div>
                <!-- Language switcher menu. END -->

                <!-- Dropdown phones -->
                <?php if (has_phones()) { ?>
                <ul class="phone-dropdown <!--light-mode-->">
                    <li class="phone-dropdown__item">
                        <?php foreach(get_phones() as $key => $phone) { ?>
                        <?php if (count(get_phones()) > 1): ?>

                        <?php if ($key === key(get_phones())) { ?>
                        <a href="tel:<?php echo strip_tags(get_phone_number($phone)); ?>" class="phone-dropdown__link phone-dropdown--main">
                            <?php echo trim($phone); ?>
                        </a>
                        <button type="button" class="phone-dropdown__button js-dropdown"></button>
                        <ul class="phone-dropdown__list js-phone-list">
                            <?php  } else { ?>
                            <li class="phone-dropdown__item">
                                <a href="tel:<?php echo strip_tags(get_phone_number($phone)); ?>" class="phone-dropdown__link">
                                    <?php echo trim($phone); ?>
                                </a>
                            </li>
                            <?php } ?>
                            <?php else: ?>
                            <a href="tel:<?php echo strip_tags(get_phone_number($phone)); ?>" class="phone-dropdown__link phone-dropdown--main">
                                <?php echo trim($phone); ?>
                            </a>
                            <?php endif; ?>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <?php } ?>
                <!-- Dropdown phones -->

                <!-- Messengers shortcode -->
                <?php echo do_shortcode('[bw-messengers]'); ?>

                <!-- The button for a pop-up -->
                <button class="btn btn2 highlight <?php the_lang_class('callback'); ?>"><?php _e('Callback', 'brainworks') ?></button>

                <!-- If WOO: Список желаний, кабинет, корзина. START -->
                <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                <div class="header__woo d-flex align-items-center">
                    <div class="header__wishlist">
                        <a href="<?php echo get_permalink(pll_get_post(1569)) ?>" class="header__circle">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <div class="header__profile">
                        <a href="<?php echo get_permalink(pll_get_post(1562)) ?>" class="header__circle">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </div>
                    <div class="header__cart d-flex align-items-center">
                        <div class="woo-cart">
                            <div class="woo-cart woo-cart-popup-wrapper">
                                <?php if ( class_exists( 'WooCommerce' ) ) {
									woocommerce_cart(); woocommerce_cart_popup();} ?>
                            </div>
                        </div>
                        <div class="header__cart-details d-flex flex-column">
                            <span>
                                <?php _e('Cart', 'brainworks') ?>
                            </span>
                            <p id="modal-cart" class="header__cart-price">
                                <?php echo woocommerce_get_total_price(); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- If WOO: Список желаний, кабинет, корзина. END -->

            </div>

            <!-- Main Navigation. START -->
            <?php if (has_nav_menu('main-nav')) { ?>
            <nav class="nav js-menu">
                <button type="button" tabindex="0" class="menu-item-close menu-close js-menu-close"></button>
                <div class="container no-padding">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'main-nav',
                        'container' => false,
                        'menu_class' => 'menu-container',
                        'menu_id' => '',
                        'fallback_cb' => 'wp_page_menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 4
                    )); ?>
                </div>
            </nav>
            <?php } ?>
            <!-- Main Navigation. START -->

        </header>


        <!-- Mobile Header Start-->
        <div class="nav-mobile-header">

            <div class="logo-name d-flex justify-content-between align-items-center">
                <div class="logo">
                    <?php the_custom_logo() ?>
                </div>

                <!-- <div class="site-name">
                    <h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4>
                    <p><?php bloginfo( 'description' ); ?></p>
                </div> -->
            </div>

            <!-- If WOO: Список желаний, кабинет, корзина. START -->
            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
            <div class="header__woo d-flex">
                <div class="header__wishlist">
                    <a href="<?php echo get_permalink(pll_get_post(1569)) ?>" class="header__circle">
                        <i class="fal fa-heart"></i>
                    </a>
                </div>
                <div class="header__profile">
                    <a href="<?php echo get_permalink(pll_get_post(1562)) ?>" class="header__circle">
                        <i class="fal fa-user-alt"></i>
                    </a>
                </div>
                <div class="header__cart d-flex align-items-center">
                    <div class="woo-cart">
                        <div class="woo-cart woo-cart-popup-wrapper">
                            <?php if ( class_exists( 'WooCommerce' ) ) {woocommerce_cart();} ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- If WOO: Список желаний, кабинет, корзина. START -->

            <!-- Hamburger button. START -->
            <button class="hamburger js-hamburger" type="button" tabindex="0">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <!-- Hamburger button. END -->

        </div>
        <!-- Mobile Header END -->


        <!-- Mobile menu. START-->
        <?php if (has_nav_menu('main-nav')) { ?>
        <nav class="nav js-menu hide-on-desktop">
            <button type="button" tabindex="0" class="menu-item-close menu-close js-menu-close"></button>
            <?php wp_nav_menu(array(
            'theme_location' => 'main-nav',
            'container' => false,
            'menu_class' => 'menu-container',
            'menu_id' => '',
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 3
        )); ?>

            <?php if (has_nav_menu('language-switcher')) { ?>
            <div class="mobile-language">
                <?php wp_nav_menu(array(
                'theme_location' => 'language-switcher',
                'container' => false,
                'menu_class' => 'menu-container',
                'menu_id' => '',
                'fallback_cb' => 'wp_page_menu',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 3
            )); ?>
            </div>
            <?php } ?>

            <div class="mobile-phones">
                <?php echo do_shortcode('[bw-phone]'); ?>
            </div>
            <div class="vh-xs-2"></div>

            <?php echo do_shortcode('[bw-messengers]'); ?>
            <div class="vh-xs-2"></div>

            <div class="social-mob"><?php echo do_shortcode('[bw-social]'); ?></div>
            <div class="vh-xs-2"></div>

            <!-- The button for a pop-up -->
            <button class="btn btn2 highlight <?php the_lang_class('callback'); ?>"><?php _e('Callback', 'brainworks') ?></button>

        </nav>
        <?php } ?>
        <!-- Mobile menu END -->


        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
        <input id="cyr-value" type="hidden" value='<?php echo get_woocommerce_currency_symbol(); ?>' />
        <?php } ?>
