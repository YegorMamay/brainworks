<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/favicon.ico'); ?>"
          type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/favicon.ico'); ?>"
          type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">

<?php wp_body_open(); ?>
<div class="wrapper js-container"><!--Do not delete!-->
    <div class="pre-header container">
        <?php echo do_shortcode('[bw-phone]');?>

        <?php
            $address = get_theme_mod('bw_additional_address');
            if (!empty($address)) { ?>
                <span>
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo esc_html($address); ?>
                </span>
        <?php } ?>

        <?php
            $email = get_theme_mod('bw_additional_email');
            if (!empty($email)) { ?>
            <a href="mailto:<?php echo esc_attr($email); ?>">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <?php echo esc_html($email); ?>
            </a>
        <?php } ?>

        <?php echo do_shortcode('[bw-social]'); ?>

        <?php if (function_exists('pll_the_languages')) { ?>
            <ul class="lang">
                <?php pll_the_languages(array(
                    'show_flags' => 1,
                    'show_names' => 0,
                    'hide_if_empty' => 0,
                    'display_names_as' => 'name'
                )); ?>
            </ul>
        <?php } ?>

        <div class="woo-cart">
            <i class="far fa-shopping-cart"></i>
            <?php if ( class_exists( 'WooCommerce' ) ) woocommerce_cart() ?>
        </div>
    </div>

    <header class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <div class="logo">
	                    <?php get_default_logo_link([
                            'name'    => 'logo.svg',
                            'options' => [
                                'class'  => 'logo-img',
                                'width'  => 60,
                                'height' => 37,
                                ],
                            ])
                        ?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <button type="button" class="btn btn-secondary center-block <?php the_lang_class('js-call-back'); ?>">
                        <?php _e('Call back', 'brainworks'); ?>
                    </button>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>

    <?php if (has_nav_menu('main-nav')) { ?>
        <nav class="nav js-menu">
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
        </nav>
    <?php } ?>

    <div class="nav-mobile-header">
        <button class="hamburger js-hamburger" type="button" tabindex="0">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
        </button>
        <div class="logo"><?php get_default_logo_link(); ?></div>
    </div>
