<?php
/**
 * All the functions are in the PHP pages in the `inc/` folder.
 */

//show_admin_bar(false);

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/auth.php';
require get_template_directory() . '/inc/admin.php';
require get_template_directory() . '/inc/login.php';
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/cleanup.php';
require get_template_directory() . '/inc/custom-logo.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueues.php';
require get_template_directory() . '/inc/navbar.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/index-pagination.php';
require get_template_directory() . '/inc/split-post-pagination.php';
require get_template_directory() . '/inc/feedback.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/meta-boxes.php';
require get_template_directory() . '/inc/custom-post-types.php';

require get_template_directory() . '/inc/LoadMorePosts.php';

add_action( 'after_setup_theme', function () {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'email', 'Email', 'Brainworks' );
		pll_register_string( 'address', 'Address', 'Brainworks' );
		pll_register_string( 'work-schedule', 'Work Schedule', 'Brainworks' );

		pll_register_string( 'social-vk', 'Vk', 'Brainworks' );
		pll_register_string( 'social-twitter', 'Twitter', 'Brainworks' );
		pll_register_string( 'social-youtube', 'YouTube', 'Brainworks' );
		pll_register_string( 'social-facebook', 'Facebook', 'Brainworks' );
		pll_register_string( 'social-linkedin', 'Linkedin', 'Brainworks' );
		pll_register_string( 'social-instagram', 'Instagram', 'Brainworks' );
		pll_register_string( 'social-google-plus', 'Google Plus', 'Brainworks' );
		pll_register_string( 'social-odnoklassniki', 'Odnoklassniki', 'Brainworks' );
	}
} );
