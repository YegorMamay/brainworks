<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
            <h1 class="page-name"><?php post_type_archive_title(); ?></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-md-3">
            <?php get_sidebar(); ?>
        </div>
        
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-12 col-sm-12 col-md-4">
                   <div class="catalog-item">
                    <div><a href="<?php the_permalink(); ?>" class="image-catalogs"><?php the_post_thumbnail('large'); ?></a></div>
                    <h6 class="text-center"><a href="<?php the_permalink(); ?>" class="title-catalogs"><?php the_title(); ?></a></h6>
                    </div>
                    <div class="sp-xs-3"></div>
                </div>  
                <?php endwhile;
                    else : ?>
                <?php get_template_part('loops/content', 'none'); ?>
                <?php endif; ?>
            </div>
            
            <?php if (get_theme_mod('bw_load_more_enable') && function_exists('bw_load_more')) { ?>
        <div class="text-center"><?php bw_load_more(); ?></div>
    <?php } else {
        if (function_exists('bw_pagination')) {
            bw_pagination();
        } else {
            if (is_paged()) { ?>
                <ul class="pagination">
                    <li class="older"><?php next_posts_link('<i class="fa fa-arrow-left"></i> ' . __('Previous', 'brainworks')) ?></li>
                    <li class="newer"><?php previous_posts_link(__('Next', 'brainworks') . ' <i class="fa fa-arrow-right"></i>') ?></li>
                </ul>
            <?php }
        }
    } ?>
            
        </div>

    </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>