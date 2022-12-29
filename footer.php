<footer class="footer js-footer">
    <?php if (is_active_sidebar('footer-widget-area')) : ?>
        <div class="pre-footer">
            <div class="container d-flex justify-content-between <!--align-items-center-->">
                <?php dynamic_sidebar('footer-widget-area'); ?>
            </div>
        </div><!-- .pre-footer end-->
    <?php endif; ?>

    <div class="container">
        <div class="copyright">

            <div class="date"><?php _e('All rights reserved', 'brainworks'); ?> &copy; <?php echo date('Y'); ?></div>

            <nav class="second-menu">
                <?php wp_nav_menu(array(
                    'theme_location' => 'second-menu',
                    'container' => false,
                    'menu_class' => 'menu-container',
                    'menu_id' => '',
                    'fallback_cb' => 'wp_page_menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 1
                )); ?>
            </nav>

            <div class="developer">
                <?php _e('Developed by ', 'brainworks') ?><a href="https://brainworks.pro/" target="_blank">BrainWorks</a>
            </div>

        </div>
    </div>
</footer>

</div><!-- .wrapper end Do not delete! -->

<?php scroll_top(); ?>

<?php wp_footer(); ?>

</body>
</html>
