<?php get_header(); ?>

<div class="container">
    <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
</div>

<?php get_template_part('loops/content', 'page'); ?>

<?php get_footer(); ?>
