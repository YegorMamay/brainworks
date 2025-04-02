<?php

if (!function_exists('bw_polylang_shortcode')) {
    /**
     * Add Shortcode Polylang
     *
     * @param $atts
     *
     * @return string
     */
    function bw_polylang_shortcode($atts) {
        // Устанавливаем атрибуты шорткода
        $atts = shortcode_atts(
            array(
                'dropdown' => 0, // показывать как список, а не как выпадающий
                'show_flags' => 1, // показывать флаги
                'show_names' => 1, // показывать имена языков
                'hide_if_empty' => 1, // скрывать языки с пустым контентом
            ),
            $atts
        );

        if (function_exists('pll_the_languages')) {
            // Параметры для вывода языков
            $args = array(
                'show_flags' => $atts['show_flags'],
                'show_names' => $atts['show_names'],
                'hide_if_empty' => $atts['hide_if_empty'],
                'dropdown' => $atts['dropdown'],
                'echo' => 0, // Мы не выводим его сразу, чтобы получить результат в переменную
            );

            // Получаем языковый переключатель
            $output = pll_the_languages($args);

            // Если вывод пустой, возвращаем пустое значение
            if (!$output) {
                return ''; // если ничего не возвращает, выводим пустое
            }

            return $output; // возвращаем результат
        }

        return ''; // если функция не существует, возвращаем пустое значение
    }

    // Регистрируем шорткод
    add_shortcode('polylang', 'bw_polylang_shortcode');
}

if (!function_exists('bw_social_shortcode')) {
    /**
     * Add Shortcode Socials
     *
     * @param $atts
     *
     * @return string
     */
    function bw_social_shortcode($atts)
    {
        // Атрибуты шорткода (можно добавить по необходимости)
        $atts = shortcode_atts(array(), $atts);

        // Проверка на наличие социальных ссылок
        if (!has_social()) {
            return ''; // Возвращаем пустое значение, если социальных ссылок нет
        }

        // Генерация списка социальных иконок
        $items = array_map(function ($name, $social) {
            // Устанавливаем иконку по умолчанию или пользовательскую
            $icon = !empty($social['img-link'])
                ? sprintf('<img src="%s" alt="%s">', esc_url($social['img-link']), esc_attr($social['text']))
                : (empty($social['icon-html']) ? sprintf('<i class="%s" aria-hidden="true"></i>', esc_attr($social['icon'])) : strip_tags($social['icon-html'], '<i>'));

            // Формируем ссылку с социальной иконкой
            return sprintf(
                '<li class="social-item"><a class="social-link social-%s" href="%s" target="_blank" rel="nofollow noopener" aria-label="%s">%s</a></li>',
                esc_attr($name),
                esc_url($social['url']),
                esc_attr($social['text']),
                $icon
            );
        }, array_keys(get_social()), get_social());

        // Объединяем элементы в один список и возвращаем результат
        return sprintf('<ul class="social">%s</ul>', implode('', $items));
    }

    add_shortcode('bw-social', 'bw_social_shortcode');
}

if (!function_exists('bw_phone_shortcode')) {

    function bw_phone_shortcode($atts)
    {
        // Обработка атрибутов шорткода
        $atts = shortcode_atts(array(
            'column' => 'false' // По умолчанию вывод не в колонку
        ), $atts);

        // Проверяем, включен ли режим колонки
        $is_column_mode = ($atts['column'] === 'true');

        // Проверка наличия телефонов
        if (!has_phones()) {
            return ''; // Если нет телефонов, возвращаем пустую строку
        }

        // Создание списка телефонов
        $items = array_map(function ($phone) {
            return sprintf(
                '<li class="phone-item"><a class="phone-number" href="tel:%s">%s</a></li>',
                strip_tags(get_phone_number($phone)),
                trim($phone)
            );
        }, get_phones());

        // Формируем класс контейнера в зависимости от режима
        $class = $is_column_mode ? 'phone phone--column' : 'phone';

        // Возвращаем форматированный список телефонов
        return sprintf('<ul class="%s">%s</ul>', $class, implode('', $items));
    }

    add_shortcode('bw-phone', 'bw_phone_shortcode');
}

if (!function_exists('bw_messengers_shortcode')) {
    /**
     * Add Shortcode Messengers
     *
     * @param $atts
     *
     * @return string
     */
    function bw_messengers_shortcode($atts)
    {
        // Атрибуты шорткода (не используются в данном случае)
        $atts = shortcode_atts([], $atts);

        // Проверка наличия мессенджеров
        if (!has_messengers()) {
            return ''; // Если нет мессенджеров, возвращаем пустую строку
        }

        // Массив с элементами списка
        $items = [];
        foreach (get_messengers() as $name => $messenger) {
            // Формируем иконку
            $icon = sprintf('<i class="%s" aria-hidden="true"></i>', esc_attr($messenger['icon']));

            // Обработка URL в зависимости от мессенджера
            $tel = ($messenger['tel']);
            switch ($name) {
                case 'viber':
                    $tel = wp_is_mobile() ? 'viber://chat?number=' . str_replace('+', '', $tel) : "viber://chat?number=%2B$tel";
                    break;
                case 'whatsapp':
                    $tel = "https://wa.me/+$tel";
                    break;
                case 'telegram':
                    $tel = "https://t.me/$tel";
                    break;
                case 'facebook':
                    $tel = "https://m.me/$tel";
                    break;
                default:
                    $tel = get_phone_number($tel);
            }

            // Формируем ссылку
            $link = sprintf(
                '<a class="messenger-link messenger-%s" href="%s" target="_blank" aria-label="%s" rel="noopener nofollow">%s</a>',
                esc_attr($name),
                esc_attr($tel),
                esc_attr($messenger['text']),
                $icon
            );

            // Добавляем элемент списка
            $items[] = sprintf('<li class="messenger-item">%s</li>', $link);
        }

        // Возвращаем список мессенджеров
        return sprintf('<ul class="messenger">%s</ul>', implode(PHP_EOL, $items));
    }

    add_shortcode('bw-messengers', 'bw_messengers_shortcode');
}

if (!function_exists('bw_html_sitemap')) {
    function bw_html_sitemap($atts) {
        // Обработка параметров шорткода
        $atts = shortcode_atts(array(
            'list' => 'false'
        ), $atts);

        $is_list_mode = ($atts['list'] === 'true');
        $output = '<div class="sitemap-container' . ($is_list_mode ? ' list-mode' : '') . '">';

        // Игнорируемые типы записей
        $ignoreposttypes = array(
            'attachment', 'popup', 'reviews', 'elementor_library',
            'e-floating-buttons', 'br_product_filter', 'br_filters_group', 'blocks'
        );

        // Маппинг колонок и порядок
        $column_mapping = array(
            'page' => 1,       // Страницы
            'post' => 3,       // Записи
            'category' => 2,   // Категории записей
            'sn_cat' => 2,     // Кастомные категории
            'catalog' => 3,    // Кастомные товары
            'product' => 3,    // Товары WooCommerce
            'product_cat' => 2 // Категории WooCommerce
        );
        $entity_order = array(
            'page' => 1,
            'category' => 2,
            'post' => 3,
            'sn_cat' => 4,      // Кастомные категории
            'product_cat' => 5, // Категории WooCommerce
            'catalog' => 6,     // Кастомные товары
            'product' => 7      // Товары WooCommerce
        );

        $columns = array_fill(1, 3, array());
        $list_content = array();

        // Функция для разделения списка на три колонки
        function split_into_columns($items) {
            $total = count($items);
            $per_column = ceil($total / 3);
            $columned_output = '<div class="sitemap-list-columns">';
            for ($i = 0; $i < 3; $i++) {
                $start = $i * $per_column;
                $slice = array_slice($items, $start, $per_column);
                if (!empty($slice)) {
                    $columned_output .= '<ul class="sitemap-list-column">';
                    foreach ($slice as $item) {
                        $columned_output .= $item;
                    }
                    $columned_output .= '</ul>';
                }
            }
            $columned_output .= '</div>';
            return $columned_output;
        }

        // Страницы
        $post_type_obj = get_post_type_object('page');
        if ($post_type_obj && !in_array($post_type_obj->name, $ignoreposttypes)) {
            $pages_array = get_posts(array('posts_per_page' => -1, 'post_type' => 'page', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC'));
            if (!empty($pages_array)) {
                $pages_items = array_map(function($page) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
                }, $pages_array);
                $pages_output = '<h5 class="sitemap-headline">' . esc_html($post_type_obj->labels->name) . '</h5>';
                $pages_output .= $is_list_mode ? split_into_columns($pages_items) : '<ul class="sitemap-list">' . implode('', $pages_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['page'], 'content' => $pages_output);
                } else {
                    $columns[$column_mapping['page']][] = array('order' => $entity_order['page'], 'content' => $pages_output);
                }
            }
        }

        // Посты
        $post_type_obj = get_post_type_object('post');
        if ($post_type_obj && !in_array($post_type_obj->name, $ignoreposttypes)) {
            $posts_array = get_posts(array('posts_per_page' => -1, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC'));
            if (!empty($posts_array)) {
                $posts_items = array_map(function($post) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_permalink($post->ID)) . '">' . esc_html($post->post_title) . '</a></li>';
                }, $posts_array);
                $posts_output = '<h5 class="sitemap-headline">' . esc_html($post_type_obj->labels->name) . '</h5>';
                $posts_output .= $is_list_mode ? split_into_columns($posts_items) : '<ul class="sitemap-list">' . implode('', $posts_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['post'], 'content' => $posts_output);
                } else {
                    $columns[$column_mapping['post']][] = array('order' => $entity_order['post'], 'content' => $posts_output);
                }
            }
        }

        // Категории записей
        $taxonomy_obj = get_taxonomy('category');
        if ($taxonomy_obj) {
            $categories = get_categories(array('hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));
            if (!empty($categories)) {
                $categories_items = array_map(function($category) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                }, $categories);
                $categories_output = '<h5 class="sitemap-headline">' . esc_html($taxonomy_obj->labels->name) . '</h5>';
                $categories_output .= $is_list_mode ? split_into_columns($categories_items) : '<ul class="sitemap-list">' . implode('', $categories_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['category'], 'content' => $categories_output);
                } else {
                    $columns[$column_mapping['category']][] = array('order' => $entity_order['category'], 'content' => $categories_output);
                }
            }
        }

        // Категории sn_cat
        $taxonomy_obj = get_taxonomy('sn_cat');
        if ($taxonomy_obj) {
            $sn_cat_terms = get_terms(array('taxonomy' => 'sn_cat', 'hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));
            if (!empty($sn_cat_terms)) {
                $sn_cat_items = array_map(function($term) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }, $sn_cat_terms);
                $sn_cat_output = '<h5 class="sitemap-headline">' . esc_html($taxonomy_obj->labels->name) . '</h5>';
                $sn_cat_output .= $is_list_mode ? split_into_columns($sn_cat_items) : '<ul class="sitemap-list">' . implode('', $sn_cat_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['sn_cat'], 'content' => $sn_cat_output);
                } else {
                    $columns[$column_mapping['sn_cat']][] = array('order' => $entity_order['sn_cat'], 'content' => $sn_cat_output);
                }
            }
        }

        // Кастомные товары (catalog)
        $post_type_obj = get_post_type_object('catalog');
        if ($post_type_obj && !in_array('catalog', $ignoreposttypes)) {
            $catalog_array = get_posts(array('posts_per_page' => -1, 'post_type' => 'catalog', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC'));
            if (!empty($catalog_array)) {
                $catalog_items = array_map(function($catalog) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_permalink($catalog->ID)) . '">' . esc_html($catalog->post_title) . '</a></li>';
                }, $catalog_array);
                $catalog_output = '<h5 class="sitemap-headline">' . esc_html($post_type_obj->labels->name) . '</h5>';
                $catalog_output .= $is_list_mode ? split_into_columns($catalog_items) : '<ul class="sitemap-list">' . implode('', $catalog_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['catalog'], 'content' => $catalog_output);
                } else {
                    $columns[$column_mapping['catalog']][] = array('order' => $entity_order['catalog'], 'content' => $catalog_output);
                }
            }
        }

        // Товары WooCommerce (product)
        $post_type_obj = get_post_type_object('product');
        if ($post_type_obj && !in_array('product', $ignoreposttypes)) {
            $products_array = get_posts(array('posts_per_page' => -1, 'post_type' => 'product', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC'));
            if (!empty($products_array)) {
                $products_items = array_map(function($product) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_permalink($product->ID)) . '">' . esc_html($product->post_title) . '</a></li>';
                }, $products_array);
                $products_output = '<h5 class="sitemap-headline">' . esc_html($post_type_obj->labels->name) . '</h5>';
                $products_output .= $is_list_mode ? split_into_columns($products_items) : '<ul class="sitemap-list">' . implode('', $products_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['product'], 'content' => $products_output);
                } else {
                    $columns[$column_mapping['product']][] = array('order' => $entity_order['product'], 'content' => $products_output);
                }
            }
        }

        // Категории товаров WooCommerce (product_cat)
        $taxonomy_obj = get_taxonomy('product_cat');
        if ($taxonomy_obj) {
            $product_categories = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));
            if (!empty($product_categories)) {
                $prod_categories_items = array_map(function($term) {
                    return '<li class="sitemap-item"><a class="sitemap-link" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                }, $product_categories);
                $prod_categories_output = '<h5 class="sitemap-headline">' . esc_html($taxonomy_obj->labels->name) . '</h5>';
                $prod_categories_output .= $is_list_mode ? split_into_columns($prod_categories_items) : '<ul class="sitemap-list">' . implode('', $prod_categories_items) . '</ul>';
                if ($is_list_mode) {
                    $list_content[] = array('order' => $entity_order['product_cat'], 'content' => $prod_categories_output);
                } else {
                    $columns[$column_mapping['product_cat']][] = array('order' => $entity_order['product_cat'], 'content' => $prod_categories_output);
                }
            }
        }

        // Формирование вывода
        if ($is_list_mode) {
            usort($list_content, function ($a, $b) { return $a['order'] <=> $b['order']; });
            foreach ($list_content as $entity) {
                $output .= '<div class="sitemap-section">' . $entity['content'] . '</div>';
            }
        } else {
            foreach ($columns as $column_content) {
                usort($column_content, function ($a, $b) { return $a['order'] <=> $b['order']; });
                if (!empty($column_content)) {
                    $output .= '<div class="sitemap-column">';
                    foreach ($column_content as $entity) {
                        $output .= $entity['content'];
                    }
                    $output .= '</div>';
                }
            }
        }

        $output .= '</div>';
        return $output;
    }
    add_shortcode('bw-html-sitemap', 'bw_html_sitemap');
}

if (!function_exists('bw_last_posts')) {
    /**
     *
     * Shortcode для отображения трёх последних новостей в блоге.
     * Новости должны быть:
     * - Опубликованы
     * - Желательно с картинкой
     * ТАКЖЕ! Шорткод может принимать такие аттрибуты, как:
     * - count - число новостей для вывода (по-стандарту: 3)
     * - button_title - текст в кнопке (по-стандарту: 'Читать полностью')
     *
     * @param  array $atts Аттрибуты шорткода
     *
     * @return string       Разметка (на Bootstrap)
     */
    function bw_last_posts($atts = array())
    {
        $atts = shortcode_atts(
            array(
                'count' => 3, // Кол-во новостей для отображения
                'button_title' => __('Continue reading', 'brainworks') // Текст в ссылке
            ),
            $atts
        );

        $posts = wp_get_recent_posts(array(
            'numberposts' => $atts['count'],
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        ), ARRAY_A);

        $output = '<div class="container"><div class="row">';

        foreach ($posts as $key => $post) {
            $thumbnail_id = get_post_thumbnail_id($post['ID']);
            $thumbnail = get_the_post_thumbnail_url($post['ID'], 'medium');
            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            $permalink = get_permalink($post['ID']);
            $output .= '<div class="col-md-4 col-lg-4 col-12 col-sm-12"><div class="custom-card custom-card-with-image">';
            if ($thumbnail !== false) {
                $output .= '<div class="custom-card-image">
                                    <img src="' . $thumbnail . '" title="' . $post['post_title'] . '" alt="' . $thumbnail_alt . '" width="100%" height="auto"  />
                                </div>';
            }
            $output .= '<div class="custom-card-body">
                                <h6>
                                    <a href="' . $permalink . '">' . $post['post_title'] . '</a>
                                </h6>
                                <p>
                                    ' . $post['post_excerpt'] . '
                                </p>
                                <br />
                                <a href="' . $permalink . '" class="btn btn1 btn-sm">
                                    ' . $atts['button_title'] . '
                                </a>
                            </div>';
            $output .= '</div></div>';
        }

        $output .= '</div></div>';

        return $output;
    }

    add_shortcode('bw-last-posts', 'bw_last_posts');
}

if (!function_exists('bw_advert_shortcode')) {
    /**
     * Add Shortcode Advert Post List
     *
     * @param array $atts
     *
     * @return string
     */
    function bw_advert_shortcode($atts = [])
    {
        // Attributes
        $atts = shortcode_atts([
            'count' => 3,
            'class' => 'front-news',
            'category' => null,
            'display_category' => false,
            'display_datetime' => false,
            'display_tags' => false,
            'array_index' => false,
        ], $atts);

        $posts = [];
        $output = '';

        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $atts['count'],
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => 'on-front',
                    'value' => 'yes',
                ],
            ]
        ];

        if (!is_null($atts['category'])) {
            $args['category__in'] = explode(',', $atts['category']);
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $items = '';
            $basic_class = trim(strip_tags($atts['class']));

            while ($query->have_posts()) {
                $query->the_post();

                $thumbnail = has_post_thumbnail() ? sprintf(
                    '<figure class="%s-preview"><a href="%s">%s</a></figure>',
                    $basic_class,
                    get_the_permalink(),
                    get_the_post_thumbnail(null, 'medium', ['class' => $basic_class . '-thumbnail'])
                ) : '';

                $tags = '';
                $category = '';
                $datetime = '';

                if ($atts['display_datetime']) {
                    $datetime = sprintf(
                        '<time class="%s-datetime text-small" datetime="%s">%s</time>',
                        $basic_class,
                        get_the_date('c'),
                        get_the_date()
                    );
                }

                if ($atts['display_category']) {
                    $category = sprintf(
                        '<div class="%s-category">%s</div>',
                        $basic_class,
                        get_the_category_list(',')
                    );
                }

	            if ($atts['display_tags']) {
		            $tags = sprintf(
			            '<div class="%s-tags">%s</div>',
			            $basic_class,
			            get_the_tag_list( '', ', ', '' )
		            );
	            }

                $meta = sprintf(
                    '<div class="%s-meta">%s %s %s</div>',
                    $basic_class,
                    $category,
                    $datetime,
                    $tags
                );

                $headline = sprintf(
                    '<h6 class="%s-headline"><a href="%s">%s</a></h6>',
                    $basic_class,
                    get_the_permalink(),
                    get_the_title()
                );

                $excerpt = sprintf('<div class="%s-excerpt">%s</div>', $basic_class, get_the_excerpt());

                $btn = sprintf(
                    '<div class="front-news-btn">
                        <a class="btn btn1 btn-sm %s-link" href="%s">%s</a>
                    </div>',
                    $basic_class,
                    get_the_permalink(),
                    __('Continue reading', 'brainworks')
                );

                $box = sprintf(
                    '<div class="%s-box">%s <div class="%s-inner">%s %s %s %s</div></div>',
                    $basic_class,
                    $thumbnail,
                    $basic_class,
                    $meta,
                    $headline,
                    $excerpt,
                    $btn
                );

                $item = sprintf(
                    '<section id="post-%s" class="%s">%s</section>',
                    get_the_ID(),
                    join(' ', get_post_class(['col-sm-6 col-md-4', $basic_class . '-item'])),
                    $box
                );

                $posts[] = $item;

                $items .= $item;
            }

            wp_reset_postdata();

            $output = sprintf('<div class="row %s-list">%s</div>', $basic_class, $items);
        }

        if ($atts['array_index'] && array_key_exists($atts['array_index'], $posts)) {
            return $posts[$atts['array_index']];
        }

        return $output;
    }

    add_shortcode('bw-advert', 'bw_advert_shortcode');
}

if (!function_exists('bw_custom_login_shortcode')) {
    function bw_custom_login_shortcode($atts)
    {
        if (!bw_user_logged_in()) {
            $output = '
                <form class="login-form form-" action="/wp-json/api/auth/login" method="POST" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="_redirect_url" value="' . strtok($_SERVER['REQUEST_URI'], '?') . '" />
                    <div class="login-form-row form-group">
                        <label for="login">' . __('Login', 'brainworks') . '</label>
                        <input type="text" id="login" name="login" class="form-field" required />
                    </div>
                    <div class="login-form-row form-group">
                        <label for="password">' . __('Password', 'brainworks') . '</label>
                        <input type="password" id="password" name="password" class="form-field" required />
                    </div>
                    <div class="login-form-row form-group">
                        <button type="submit" name="submit" class="btn btn2 login-form-submit">
                            ' . __('Login', 'brainworks') . '
                        </button>
                    </div>
                </fieldset>
                </form>
            ';
            return $output;
        }
        return '';
    }

    add_shortcode('bw-custom-login', 'bw_custom_login_shortcode');
}

if (!function_exists('bw_custom_register_shortcode')) {
    function bw_custom_register_shortcode($atts)
    {
        if (!bw_user_logged_in()) {
            $output = '
            <form class="login-form form-" action="/wp-json/api/auth/register" method="POST" autocomplete="off">
            <fieldset>
                <input type="hidden" name="_redirect_url" value="' . strtok($_SERVER['REQUEST_URI'], '?') . '" />
                <div class="login-form-row form-group">
                    <label for="login">' . __('Login', 'brainworks') . '</label>
                    <input type="text" id="login" name="login" class="form-field" required />
                </div>
                <div class="login-form-row form-group">
                    <label for="email">' . __('Email', 'brainworks') . '</label>
                    <input type="email" id="email" name="email" class="form-field" required />
                </div>
                <div class="login-form-row form-group">
                    <label for="password">' . __('Password', 'brainworks') . '</label>
                    <input type="password" id="password" name="password" class="form-field" required />
                </div>
                <div class="login-form-row form-group">
                    <label for="retry_password">' . __('Retry password', 'brainworks') . '</label>
                    <input type="password" id="retry_password" name="retry_password" class="form-field" required />
                </div>
                <div class="login-form-row form-group">
                    <button type="submit" name="submit" class="btn btn2 login-form-submit">
                        ' . __('Register', 'brainworks') . '
                    </button>
                </div>
            </fieldset>
            </form>
            ';
            return $output;
        }
        return '';
    }

    add_shortcode('bw-custom-register', 'bw_custom_register_shortcode');
}

if (!function_exists('bw_custom_auth_shortcode')) {
    function bw_custom_auth_shortcode($atts)
    {

        if (!bw_user_logged_in()) {
            $login_form = do_shortcode('[bw-custom-login]');
            $register_form = do_shortcode('[bw-custom-register]');
            $output = '<div class="login-block row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                ' . $login_form . '
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                ' . $register_form . '
                </div>
            </div>';
            return $output;
        }
        return '';
    }

    add_shortcode('bw-custom-auth', 'bw_custom_auth_shortcode');
}

if (!function_exists('bw_reviews_shortcode')) {
    /**
     * Add Shortcode Reviews List
     *
     * @param $atts
     *
     * @return string
     */
    function bw_reviews_shortcode($atts)
    {
        // Attributes
        $atts = shortcode_atts(
            array(),
            $atts
        );

        $output = '';

        $args = array(
            'post_type' => 'reviews',
            'publish_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'review-display',
                    'value' => '1',
                )
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {

            $output .= '<div class="review-slider text-center js-reviews">';

            while ($query->have_posts()) {
                $query->the_post();

                $id = get_the_ID();
                $social = array();
                $socials = array(
                    'vk' => array(
                        'url' => get_post_meta($id, 'review-vk', true),
                        'icon' => 'fa-vk',
                    ),
                    'youtube' => array(
                        'url' => get_post_meta($id, 'review-youtube', true),
                        'icon' => 'fa-youtube',
                    ),
                    'twitter' => array(
                        'url' => get_post_meta($id, 'review-twitter', true),
                        'icon' => 'fa-twitter',
                    ),
                    'facebook' => array(
                        'url' => get_post_meta($id, 'review-facebook', true),
                        'icon' => 'fa-facebook-square',
                    ),
                    'linkedin' => array(
                        'url' => get_post_meta($id, 'review-linkedin', true),
                        'icon' => 'fa-linkedin-in',
                    ),
                    'instagram' => array(
                        'url' => get_post_meta($id, 'review-instagram', true),
                        'icon' => 'fa-instagram',
                    ),
                    'google-plus' => array(
                        'url' => get_post_meta($id, 'review-google-plus', true),
                        'icon' => 'fa-google-plus-g',
                    ),
                    'odnoklassniki' => array(
                        'url' => get_post_meta($id, 'review-odnoklassniki', true),
                        'icon' => 'fa-odnoklassniki',
                    ),
                );

                foreach ($socials as $item) {
                    if (!empty($item['url'])) {
                        $social['url'] = $item['url'];
                        $social['icon'] = $item['icon'];
                    }
                }

                $post_class = 'class="' . join(' ', get_post_class('review-item', null)) . '"';

                $output .= '<div id="post-' . get_the_ID() . '" ' . $post_class . '>';

                $output .= '<div class="review-client">';
                $output .= get_the_post_thumbnail(null, 'thumbnail', array('class' => 'review-avatar'));
                if (count($social)) {
                    $output .= '<a class="review-social" href="' . esc_url($social['url']) . '" target="_blank" rel="noopener noreferrer">';
                    $output .= '<i class="fab ' . esc_attr($social['icon']) . '" aria-hidden="true"></i>';
                    $output .= '</a>';
                }
                $output .= '</div>';
                $output .= '<div class="review-title">' . get_the_title() . '</div>';
                $output .= '<div class="review-content">' . get_the_content() . '</div>';

                $output .= '</div>';
            }

            wp_reset_postdata();

            $output .= '</div>';
        }

        return $output;
    }

    add_shortcode('bw-reviews', 'bw_reviews_shortcode');
}

// addes shortcode posts category
if (!function_exists('sn_catalog_shortcode')) {
    add_shortcode('catalog', 'show_categories_catalog');

    function show_categories_catalog($atts)
    {
        $atts = shortcode_atts(array(
            'id' => 1,
            'count' => 6
        ), $atts);

        $args = array(
            'posts_per_page'        => $atts['count'],
            'post_type'      => 'catalog',
            'tax_query' => array(
                array(
                    'taxonomy' => 'sn_cat',
                    'field'    => 'id',
                    'terms'    => $atts['id'],
                ),
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <div class="row">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="catalog-shortcode-item">
                        <div><a href="<?php the_permalink(); ?>" class="image-catalogs"><?php the_post_thumbnail(); ?></a></div>
                        <h6 class="text-center"><a href="<?php the_permalink(); ?>" class="title-catalogs"><?php the_title(); ?></a></h6>
                    </div>
                        <div class="vh-xs-3"></div>
                </div>
                    <?php endwhile; ?>
            </div>
        <?php else :

        endif;

        wp_reset_postdata();
    }
}

add_shortcode('sn_cat', 'cat_and_child_id');

/**
 * @param array $atts
 * @return string
 * Работает как с указанием таксономии так и без
 * при указании таксономии показывает все категории [sn_cat id="7, 78, 82" term="name_term"]
 */
function cat_and_child_id( $atts ) {
    $str = $atts['id'];
    $arr_id = explode( ', ', $str );
    $name_cpt = $atts['term'];

    if ( taxonomy_exists( $name_cpt ) ) {
        $categories = get_categories( [
            'type' => 'post',
            'taxonomy' => $name_cpt,
            'hide_empty' => false,
        ] );

        $html = '<div class="row list-cat">';

        foreach ( $arr_id as $cat ) {
            $cat_id = $cat;
            $cat_url = get_category_link( $cat_id );
            $cat_name = get_cat_name( $cat_id );
            $term_id = $cat_id;
            $image_id = get_term_meta( $term_id, '_thumbnail_id', true);
            $image_url =  wp_get_attachment_image_url( $image_id, 'large' );

            if ( $categories ) {
                foreach ( $categories as $term ) {
                    $term_cat_id = $term->term_id;
                    $term_cat_name = $term->name;

                    if ( $term_cat_id == $cat_id ) {
                        if(!empty($image_url)) {
                            $image_url =  wp_get_attachment_image_url( $image_id, 'large' );
                        } else {
                            $image_url = get_parent_theme_file_uri('assets/img/placeholder.jpg');
                        }
                        $html .= sprintf( '<div class="list-cat__item col-12 col-md-4 col-lg-4"><a href="%s" class="list-cat__link"><img src="%s" class="list-cat__img" alt="image"><div class="list-cat__title h4">%s</div></a></div>', $cat_url, $image_url, $term_cat_name );
                    }
                }
            }

            if ( $cat_name ) {

                $html .= sprintf( '<div class="list-cat__item col-12 col-md-4 col-lg-4"><a href="%s" class="list-cat__link"><div class="list-cat__title h4">%s</div></a></div>', $cat_url, $cat_name );

            }

        }

        $html .= '</div>';

        return $html;
    } else {
        $html = '<div class="row list-cat">';

        foreach ( $arr_id as $cat ) {
            $cat_id = $cat;
            $cat_url = get_category_link( $cat_id );
            $cat_name = get_cat_name( $cat_id );

            if ( $cat_name ) {
                $html .= sprintf( '<div class="list-cat__item col-12 col-md-4 col-lg-4"><a href="%s" class="list-cat__link"><div class="list-cat__title h4">%s</div></a></div>', $cat_url, $cat_name );
            }

        }

        $html .= '</div>';

        return $html;
    }
}

function html_block_function( $atts ) {

	$params = shortcode_atts(
		array( // в массиве укажите значения параметров по умолчанию
			'id' => '', // параметр 1
		),
		$atts
	);
    $post_id = $atts['id'];
    $post_content = get_post($post_id);
    $content = $post_content->post_content;
	return $content;
}

add_shortcode( 'html_block', 'html_block_function' );


function bw_second_logo_shortcode($atts) {
    $logo2 = get_theme_mod('bw_logo2');
    if ($logo2) {
        return '<img src="' . esc_url($logo2) . '" class="second-logo" alt="Second Logo">';
    }
    return '';
}
add_shortcode('second-logo', 'bw_second_logo_shortcode');
