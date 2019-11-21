<?php get_header(); ?>

<div class="container">
<div class="row">
    <div class="col-12">
        <?php if (!is_front_page() && function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
    </div>
</div><!-- /.row -->
<div class="row">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="col-lg-5">
			<?php the_post_thumbnail('medium'); ?>
		</div>
		<div class="col-lg-7">
			<h1 class="single-title"><?php the_title() ?></h1>
			<div class="sp-xs-2"></div>
			<div class="prices"><?php the_excerpt(); ?></div>
			<div class="sp-xs-2"></div>
			<div><?php the_content(); ?></div>
			<div class="sp-xs-2"></div>
			<button class="btn btn-secondary one-click">Заказать</button>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
</div>
</div><!-- /.container -->

<?php get_footer(); ?>
