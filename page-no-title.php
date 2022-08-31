<?php
/**
 * Template Name: Page Without Title
 **/
?>

<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>

    <div class="container">
        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
    </div>

    <?php the_content() ?>
    <?php wp_link_pages(); ?>

<?php endwhile;
else: ?>
    <?php get_template_part('loops/content', 'none'); ?>
<?php endif; ?>

<?php get_footer(); ?>
