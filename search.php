<?php get_header(); ?>
<div class="container">

    <div class="vh-xs-2"></div>
    <h1 class="mrgn-bot-30"><?php _e('Search Results for', 'brainworks'); ?> &ldquo;<?php the_search_query(); ?>&rdquo;</h1>

    <?php get_template_part('loops/content', 'search'); ?>

</div><!-- /.container -->
<?php get_footer(); ?>
