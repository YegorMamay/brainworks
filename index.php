<?php get_header(); ?>

<?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

<h1 class="text-center mrgn-bot-30"><?php single_post_title(); ?></h1>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <?php get_template_part('loops/content', get_post_format()); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
