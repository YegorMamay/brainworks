<?php
/**
 * Template Name: Thank You Page
 **/
?>

<?php get_header(); ?>
<div class="container">

<?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>

<?php get_template_part('loops/content', 'page'); ?>

<div class="text-center">   
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-one btn-lg">
        <?php _e('Back to the homepage', 'brainworks'); ?>
    </a>
</div>

</div><!-- /.container -->
<?php get_footer(); ?>
