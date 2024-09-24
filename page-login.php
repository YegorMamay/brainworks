<?php
/**
 * Template Name: Login Page
 **/
?>

<?php get_header(); ?>

<div class="container">

   <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

    <div class="row">

        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3"></div>

        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">

            <?php

                // Получаем URL для перенаправления после успешного входа
                $redirect_to = !empty( $_GET['redirect_to'] ) ? esc_url( $_GET['redirect_to'] ) : home_url();

                // Отображаем форму входа с параметром перенаправления
                $args = array(
                    'redirect' => $redirect_to,
                );

                wp_login_form( $args );

            ?>

        </div>

        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3"></div>

    </div>
</div>

<?php get_footer(); ?>
