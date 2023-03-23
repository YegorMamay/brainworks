<?php get_header(); ?>


<div class="container">
    <?php if (!is_front_page() && function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
</div><!-- /.container -->


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_content(); ?>

<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>
