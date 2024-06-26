<?php

if (!class_exists('LoadMorePosts')) {
    /**
     * Class LoadMorePosts
     */
    class LoadMorePosts
    {
        /**
         * LoadMorePosts constructor.
         */
        public function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueueScripts'], 101);
            add_action('customize_register', [$this, 'customizeRegister']);

            if (wp_doing_ajax()) {
                add_action('wp_ajax_load_more_posts', [$this, 'ajaxCallback']);
                add_action('wp_ajax_nopriv_load_more_posts', [$this, 'ajaxCallback']);
            }
        }

        /**
         * Enqueue a script
         */
        public function enqueueScripts()
        {
            $condition = is_front_page() || is_home() || is_archive();

            if (get_theme_mod('bw_load_more_enable') && $condition) {
                wp_localize_script('brainworks-js', 'jpAjax', [
                    'action' => 'load_more_posts',
                    'nonce' => wp_create_nonce('load_more_posts_action'),
                    'url' => admin_url('admin-ajax.php'),
	                'sticky_header' => [
		                'enable' => get_theme_mod('bw_sticky_header_enable', false),
		                'autohide' => get_theme_mod('bw_sticky_header_autohide', false)
	                ],
                ]);
            }
        }

        /**
         * Customize
         *
         * @param $wp_customize WP_Customize_Manager
         * @return void
         */
        public function customizeRegister($wp_customize)
        {
            // Section Load More
            $wp_customize->add_section('bw_load_more', [
                'title' => 'Load More',
                'description' => 'If this function enabled, the pagination will ignore.',
                'panel' => 'bw_theme_options',
            ]);

            $wp_customize->add_setting('bw_load_more_enable', [
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            ]);

            $wp_customize->add_control('bw_load_more_enable', [
                'label' => 'Enable/Disable',
                'section' => 'bw_load_more',
                'settings' => 'bw_load_more_enable',
                'type' => 'checkbox',
            ]);
        }

        /**
         * Fires Ajax actions for users.
         */
        public function ajaxCallback()
        {
            check_ajax_referer('load_more_posts_action', 'nonce');

            $paged = empty($_POST['paged']) ? 1 : $_POST['paged'] + 1;

            $args = [
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => get_option('posts_per_page'),
                'order' => 'DESC', // ASC, DESC
                'orderby' => 'date',
                'paged' => $paged,
            ];

            $query = new WP_Query($args);

            $posts = '';

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $posts .= '

                            <article id="post-' . get_the_ID() . '" class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    ' . get_the_post_thumbnail(null, 'large') . '
                                    <div class="vh-xs-3 vh-sm-0"></div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <header>
                                        <h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>
                                        <div class="vh-xs-1"></div>
                                        <p>' . get_the_excerpt() . '</p>
                                    </header>
                                    <div class="vh-xs-2"></div>
                                    <a class="btn btn1 btn-sm" href="' . get_permalink() . '">' . __('Continue reading', 'brainworks') . '<i class="glyphicon glyphicon-arrow-right"></i></a>
                                </div>
                            </article>

                    <div class="vh-xs-2"></div>
                    <hr>
                    <div class="vh-xs-2"></div>
                    ';
                }

                wp_reset_postdata();
            }

            wp_send_json_success($posts, 200);
        }
    }

    new LoadMorePosts();
}

if (!function_exists('bw_load_more')) {
    /**
     * Load More HTML Markup
     *
     * @return void
     */
    function bw_load_more()
    {
        /** @var WP_Query $wp_query */
        global $wp_query;

        $total = isset($wp_query->max_num_pages) ? intval($wp_query->max_num_pages) : 1;

        $output = sprintf(
            '<button class="btn btn1 js-load-more" type="button">%s</button> <div class="vh-xs-3"></div>',
            __('Load more posts...', 'brainworks')
        );

        if ($total < 2) {
            return;
        }

        echo $output;
    }
}
