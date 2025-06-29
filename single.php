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
            <article id="post_<?php the_ID() ?>" <?php post_class() ?> itemscope itemtype="https://schema.org/Article">
                <h1 class="single-title mrgn-bot-15" itemprop="headline"><?php the_title() ?></h1>

                <div class="post-img mrgn-bot-20"><?php the_post_thumbnail('full'); ?></div>

                <!-- Метаинформация статьи -->
                <meta itemprop="author" content="<?php the_author() ?>" />
                <meta itemprop="datePublished" content="<?php the_date('c') ?>" />
                <meta itemprop="dateModified" content="<?php the_modified_date('c') ?>" />

                <div class="post-meta">
                    <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <meta itemprop="name" content="<?php bloginfo('name'); ?>" />
                    </span>
                    <span itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>"></span>
                </div>

                <section class="mrgn-bot-20" itemprop="articleBody">
                    <?php the_content() ?>
                </section>

                <!-- Преобразованный код для тега "Публикации" -->
                <p class="tags" itemprop="keywords"><?php the_tags( '', '', '' ) ?></p>
            </article>

            <hr>

            <div class="vh-xs-2"></div>

            <!-- Ссылки на предыдущую и следующую статью -->
            <div class="post-navigation mrgn-bot-20">
                <div class="prev-post"><?php previous_post_link('%link', '&laquo; ' . __('Previous post', 'brainworks')); ?></div>
                <div class="next-post"><?php next_post_link('%link', __('Next post', 'brainworks') . ' &raquo;'); ?></div>
            </div>

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
