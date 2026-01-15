<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">

    <?php wp_site_icon(); ?>

    <!-- Если плагин Yoast SEO не активирован, срабатывает этот код START -->
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
    <!-- Если Yoast END -->

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

                <!-- Кнопка логина -->
                <?php if ( is_user_logged_in() ) : ?>
                    <!-- Если пользователь залогинен, показываем кнопку выхода -->
                    <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="btn btn1">
                        <?php _e('Log Out', 'brainworks'); ?> <i class="fa-light fa-arrow-right-from-bracket"></i>
                    </a>
                <?php else : ?>
                    <!-- Если пользователь не залогинен, показываем кнопку входа -->
                    <a href="<?php echo esc_url( '/login/?redirect_to=' . urlencode( get_permalink() ) ); ?>" class="btn btn2"><i class="fa-light fa-user"></i>
                        <?php _e('Log In', 'brainworks'); ?>
                    </a>
                <?php endif; ?>

                <!-- Language switcher menu START -->
                <div class="nav-wrapper language-switcher">
                    <?php if (has_nav_menu('language-switcher')) { ?>
                    <nav class="nav js-menu">
                    <button type="button" class="menu-item-close menu-close js-menu-close" tabindex="0"></button>
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'language-switcher',
                            'container' => false,
                            'menu_class' => 'menu-container',
                            'menu_id' => false,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'depth' => 2
                        ));
                    ?>
                    </nav>
                    <?php } ?>
                </div>
                <!-- Language switcher menu END -->

                <!-- Dropdown phones -->
                <?php echo do_shortcode('[phone_dropdown light_mode="false"]'); ?>

                <!-- Messengers shortcode -->
                <?php /* echo do_shortcode('[bw-messengers]'); */ ?>

                <!-- The button for a pop-up -->
                <button class="btn btn2 highlight <?php the_lang_class('callback'); ?>"><?php _e('Callback', 'brainworks') ?></button>

                <!-- If WOO: Список желаний, кабинет, корзина. START -->
                <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                <div class="header__woo d-flex align-items-center">
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
            <!-- Main Navigation. END -->

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
            <!-- If WOO: Список желаний, кабинет, корзина. END -->

            <div class="d-flex align-items-center">

            <?php echo do_shortcode('[polylang show_flags="1" show_names="1" dropdown="1"]'); ?>

            <!-- Hamburger button. START -->
            <button class="hamburger js-hamburger" type="button" tabindex="0">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <!-- Hamburger button. END -->

            </div>

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
                    'fallback_cb' => 'wp_page_menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 2
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
