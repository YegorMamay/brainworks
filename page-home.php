<?php
/**
 * Template Name: Home Page
 **/
?>

<?php get_header(); ?>
<div class="container">

    <i class="fa fa-home"></i>

<?php get_template_part('loops/content', 'home'); ?>

</div><!-- /.container -->
<?php get_footer(); ?>
