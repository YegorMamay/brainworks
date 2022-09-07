<?php
/**
 * Template Name: Container
 **/
?>

<?php get_header(); ?>

    <div class="container">

        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

        <h1 class="page-name"><?php the_title() ?></h1>

        <?php the_content() ?>

    </div>

<?php get_footer(); ?>
