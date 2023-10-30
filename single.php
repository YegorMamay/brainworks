<?php get_header(); ?>

<?php $column_class = is_active_sidebar('sidebar-widget-area2')
    ? 'col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9'
    : 'col-12';
?>

<div class="container">
    <div class="row">
        <div class="<?php echo $column_class; ?>">

            <?php if (!is_front_page() && function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article id="post_<?php the_ID() ?>" <?php post_class() ?>>
        <h1 class="single-title"><?php the_title() ?></h1>
        <div class="vh-xs-2"></div>
            <?php /*
            <h5>
                <span class="text-muted author"><?php _e('By', 'brainworks'); echo " "; the_author() ?></span>
                <time class="text-muted" datetime="<?php the_time('d-m-Y')?>"><?php the_date(get_option('date_format')); ?></time>
            </h5>
            <p class="text-muted" style="margin-bottom: 30px;">
                <i class="fa fa-folder-open-o"></i>&nbsp; <?php _e('Filed under', 'brainworks'); ?>: <?php the_category(', ') ?><br/>
                <i class="fa fa-comment-o"></i>&nbsp; <?php _e('Comments', 'brainworks'); ?>: <?php comments_popup_link(__('None', 'brainworks'), '1', '%'); ?>
            </p>
            */ ?>
        <section>
            <!--<?php the_post_thumbnail('full'); ?>-->
            <?php the_content() ?>
            <?php wp_link_pages(); ?>
        </section>
    </article>

    <div class="vh-xs-2"></div>

    <?php /*
    <hr>

    <span class="text-muted text-italic bold">
        <?php _e('By', 'brainworks'); echo " "; the_author_meta('first_name'); echo " "; the_author_meta('last_name'); ?>,
        <?php _e('Category', 'brainworks'); ?>: <?php the_category(', '); ?>,
        <?php the_time('j F Y') ?>
        <p class="tags"><?php the_tags( '', '', '' ) ?></p>
    </span>

    */ ?>

    <?php comments_template('/loops/comments.php'); ?>
<?php endwhile; ?>

<?php else : ?>
    <?php get_template_part('loops/content', 'none'); ?>
<?php endif; ?>

<div class="vh-xs-2"></div>

        </div>
        <?php if (is_active_sidebar('sidebar-widget-area2')) { ?>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 sidebar">
                <?php dynamic_sidebar('sidebar-widget-area2'); ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>
