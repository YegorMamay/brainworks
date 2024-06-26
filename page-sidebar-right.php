<?php
/**
 * Template Name: Sidebar Right
 **/
?>

<?php get_header(); ?>

<div class="container">

    <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <?php get_template_part('loops/content', 'page'); ?>
        </div>

        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">
            <?php dynamic_sidebar('sidebar-widget-area2'); ?>
        </div>

    </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
