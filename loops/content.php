<?php if (have_posts()): ?>
<div class="js-ajax-posts">
    <?php while (have_posts()): the_post(); ?>
    <article id="post_<?php the_ID() ?>" class="row">
        <div class="col-12 col-md-6">
            <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>

            <div class="vh-xs-3 vh-sm-0"></div>

        </div>

        <div class="col-12 col-md-6">
            <h3><a href="<?php echo get_permalink(); ?>"><?php the_title() ?></a></h3>

            <div class="vh-xs-1"></div>

            <p><?php the_excerpt(); ?></p>

            <div class="vh-xs-2"></div>

            <a class="btn btn1 btn-sm" href="<?php echo get_permalink(); ?>"><?php _e('Continue reading', 'brainworks') ?></a>
        </div>
    </article>
    <div class="vh-xs-2"></div>
    <hr>
    <div class="vh-xs-2"></div>
    <?php endwhile; ?>
</div>

<?php
if (get_theme_mod('bw_load_more_enable') && function_exists('bw_load_more')): ?>
<div class="text-center"><?php bw_load_more(); ?></div>
<?php
elseif (function_exists('bw_pagination')):
    bw_pagination();
elseif (is_paged()): ?>
<ul class="pagination">
    <li class="older"><?php next_posts_link('<i class="fa fa-arrow-left"></i> ' . __('Previous', 'brainworks')) ?></li>
    <li class="newer"><?php previous_posts_link(__('Next', 'brainworks') . ' <i class="fa fa-arrow-right"></i>') ?></li>
</ul>
<?php endif; ?>

<?php else : ?>
<?php get_template_part('loops/content', 'none'); ?>
<?php endif; ?>
