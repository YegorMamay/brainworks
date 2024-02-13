<?php
/**
 * Template Name: Page With Decor Image
 **/
?>

<?php get_header(); ?>

<div class="title-wrapper">

    <?php the_post_thumbnail(); ?>

    <div class="container">
        <h1 class="text-white"><?php the_title() ?></h1>
    </div>

</div>

<div class="container">

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

        <?php the_content() ?>

    <?php endwhile;

    else: ?>

        <?php get_template_part('loops/content', 'none'); ?>

    <?php endif; ?>

</div><!-- /.container -->

<?php get_footer(); ?>
