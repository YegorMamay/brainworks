<?php

/**
 * Bootstrap pagination for index and category pages
 */

if (!function_exists('bw_pagination')) {
    function bw_pagination()
    {
        global $wp_query;
        $big = 999999999; // This needs to be an unlikely integer
        $paginate_links = paginate_links([
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'total' => $wp_query->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'mid_size' => 2,
            'type' => 'list',
            'prev_next' => true,
            'prev_text' => __('<i class="fa fa-angle-left"></i> Newer', 'brainworks'),
            'next_text' => __('Older <i class="fa fa-angle-right"></i>', 'brainworks'),
        ]);

        if ($paginate_links) {
            // Check if $paginate_links is not null before replacing
            $paginate_links = str_replace(
                "<ul class='page-numbers'>",
                "<ul class='pagination'>",
                $paginate_links ?? '' // Provide a default empty string if null
            );
            $paginate_links = str_replace(
                "<li>",
                "<li class='page-item'>",
                $paginate_links ?? ''
            );
            $paginate_links = preg_replace(
                '/page-numbers/',
                'page-link',
                $paginate_links ?? ''
            );

            echo $paginate_links;
        }
    }
}
