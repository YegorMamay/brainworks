<?php
/**
 * Подключение стилей и скриптов для темы.
 */
function bw_enqueues()
{
    /** Styles */
    // Регистрация и подключение основного стиля темы
    wp_register_style('style-css', get_template_directory_uri() . '/style.css', false, null);
    wp_enqueue_style('style-css');

    // Регистрация и подключение стилей FontAwesome
    wp_register_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', false, null);
    wp_enqueue_style('fontawesome');

    /** Scripts */
    // Регистрация и подключение скриптов для поддержки старых браузеров
    wp_register_script('html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', [], null, false);
    wp_register_script('respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', [], null, false);

    // Установка условий для загрузки скриптов только в старых браузерах (IE < 9)
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
    wp_script_add_data('respond', 'conditional', 'lt IE 9');

    wp_enqueue_script('html5shiv');
    wp_enqueue_script('respond');

    // Регистрация и подключение Modernizr
    wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', [], null, true);
    wp_enqueue_script('modernizr');

    // Регистрация и подключение Slick Carousel, если есть посты типа "reviews"
    wp_register_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
    if (post_type_exists('reviews') && intval(wp_count_posts('reviews')->publish) > 0) {
        wp_enqueue_script('slick');
    }

    // Регистрация и подключение основного скрипта темы
    wp_register_script('brainworks-js', get_template_directory_uri() . '/assets/js/brainworks.js', ['jquery'], null, true);
    wp_enqueue_script('brainworks-js');

    // Локализация скрипта для передачи данных из PHP в JS
    wp_localize_script('brainworks-js', 'jpAjax', [
        'sticky_header' => [
            'enable' => get_theme_mod('bw_sticky_header_enable', false),
            'autohide' => get_theme_mod('bw_sticky_header_autohide', false)
        ],
    ]);

    // Подключение скрипта для ответов на комментарии, если они включены
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'bw_enqueues', 100);

/**
 * Подключение скриптов для квиза.
 */
function bw_enqueues_kviz() {
    // Регистрация и подключение скрипта для квиза
    wp_register_script('kviz', get_template_directory_uri() . '/kviz/js/kviz.js', ['jquery'], null, true);
    wp_enqueue_script('kviz');

    // Локализация скрипта для передачи данных из PHP в JS
    wp_localize_script('kviz', 'kvizVariable', array(
        'template_url' => get_template_directory_uri(),
    ));

    // Подключение файла с шорткодом для квиза
    require get_template_directory() . '/kviz/kviz-shortcode.php';
}

add_action('wp_enqueue_scripts', 'bw_enqueues_kviz', 100);

/**
 * Настройка стандартных стилей WordPress.
 *
 * @param WP_Styles $styles Объект стилей WordPress.
 */
function bw_wp_default_styles($styles) {
    $editor = get_option('classic-editor-replace');
    // Здесь можно добавить логику для настройки стандартных стилей
}

add_action('wp_default_styles', 'bw_wp_default_styles', 11);

/**
 * Добавление аналитического кода в <head>.
 */
function bw_wp_head()
{
    analytics_tracking_code('head');
}

add_action('wp_head', 'bw_wp_head', 20);

/**
 * Добавление аналитического кода в <body>.
 */
function bw_wp_footer()
{
    analytics_tracking_code('body');
}

add_action('wp_footer', 'bw_wp_footer', 20);
