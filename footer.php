</div><!-- .page-wrapper end-->

<footer class="footer js-footer">
    <?php if (is_active_sidebar('footer-widget-area')) : ?>
        <div class="pre-footer">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar('footer-widget-area'); ?>
                </div>
            </div>
        </div><!-- .pre-footer end-->
    <?php endif; ?>

    <div class="copyright">
        <p class="container">
            <?php _e('Developed by', 'brainworks') ?>
            <a href="https://brainworks.pro/" target="_blank">BRAIN WORKS</a>
            &copy; <?php echo date('Y'); ?>
        </p>
    </div>
</footer>

</div><!-- .wrapper end-->

<?php scroll_top(); ?>

<div class="is-hide"><?php svg_sprite(); ?></div>

<?php wp_footer(); ?>

</body>
</html>
