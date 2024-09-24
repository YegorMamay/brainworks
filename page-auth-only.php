<?php
    /**
     * Template Name: Only Logged In
     */
get_header();
the_post(); ?>

<div class="container">

    <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

    <?php if ( is_user_logged_in() ) { ?>

        <h1 class="text-center mrgn-bot-30"><?php the_title() ?></h1>

        <?php the_content(); ?>

    <?php } else { ?>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3"></div>

        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">

            <div class="vh-xs-2"></div>

            <?php echo '<p class="mrgn-bot-20 bold">' . __('Please log in to see the contents of this page.', 'brainworks') . '</p>';

            wp_login_form(); ?>

            <div class="vh-xs-2"></div>

        </div>

        <div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3"></div>
    </div>

    <?php } ?>

</div><!-- /.container -->

<?php get_footer(); ?>
