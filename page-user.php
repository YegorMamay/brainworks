<?php
    /**
     * Template Name: User Page
     */
get_header();
the_post(); ?>

<div class="container">

    <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

    <div class="vh-xs-2"></div>
    <?php if (is_user_logged_in()) {
        $a = wp_get_current_user();
        $user_meta = get_userdata( $a->ID );
        ?>
    <div class="d-flex align-items-center">
        <p>
            <b>Ник - </b>
        </p>
        &nbsp
        <p>
            <?php echo $user_meta->nickname; ?>
        </p>
    </div>
    <div class="d-flex align-items-center">
        <p>
            <b>Имя - </b>
        </p>
        &nbsp
        <p>
            <?php echo $user_meta->first_name; ?>
        </p>
    </div>
    <div class="d-flex align-items-center">
        <p>
            <b>Email - </b>
        </p>
        &nbsp
        <p>
            <?php echo $user_meta->user_email;; ?>
        </p>
    </div>
    <?php


    } ?>

    <div class="vh-xs-2"></div>

    <?php the_content() ?>

</div><!-- /.container -->
<?php get_footer(); ?>
