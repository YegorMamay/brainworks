<?php

function bw_switch_theme()
{
    // Только при первой активации, если еще не установлен флаг
    if (!get_option('bw_theme_initialized')) {
        // Отключить структуру папок
        update_option('uploads_use_yearmonth_folders', '');

        // Очистить виджеты
        update_option('sidebars_widgets', array(
            'wp_inactive_widgets' => array(),
            'sidebar-widget-area' => array(),
            'sidebar-widget-area2' => array(),
            'footer-widget-area' => array(),
            'array_version' => 3
        ));

        // Удалить стандартные записи
        $post_ids = array(1, 2, 3);
        foreach ($post_ids as $id) {
            if (get_post($id)) {
                wp_delete_post($id, true);
            }
        }

        // Установить флаг, чтобы не выполнять повторно
        update_option('bw_theme_initialized', 1);
    }
}
add_action('after_switch_theme', 'bw_switch_theme');


function bw_custom_menu_order($menu_ord)
{
    // Включить пользовательский порядок меню, если не передан массив
    if (!$menu_ord) {
        return true;
    }

    // Возвращаем кастомный порядок пунктов меню в админке
    return [
        'index.php',                   // Консоль
        'separator1',                  // Первый разделитель
        'edit.php?post_type=page',     // Страницы
        'edit.php',                    // Записи
        'edit-comments.php',           // Комментарии
        'edit.php?post_type=reviews',  // Отзывы (кастомный тип записей)
        'upload.php',                  // Медиафайлы
        'separator2',                  // Второй разделитель
        'plugins.php',                 // Плагины
        'users.php',                   // Пользователи
        'options-general.php',         // Настройки
        'themes.php',                  // Внешний вид
        'tools.php',                   // Инструменты
        'separator-last',              // Финальный разделитель
    ];
}
add_filter('custom_menu_order', 'bw_custom_menu_order'); // Разрешает пользовательский порядок
add_filter('menu_order', 'bw_custom_menu_order');        // Задает сам порядок


function bw_setup()
{
    /** Перевод темы — загрузка файлов перевода */
    load_theme_textdomain('brainworks', get_template_directory() . '/languages');

    /** Включение поддержки миниатюр */
    add_theme_support('post-thumbnails');

    /** Включение поддержки логотипа */
    add_theme_support('custom-logo');

    /** Включение поддержки виджетов */
    add_theme_support('widgets');

    /** Включение автоматических ссылок на RSS */
    add_theme_support('automatic-feed-links');

    /** Поддержка автоматического управления <title> */
    add_theme_support("title-tag");

    /** Поддержка пользовательского заголовка */
    add_theme_support("custom-header");

    /** Поддержка пользовательского фона */
    add_theme_support("custom-background");

    /** Стартовый контент для демо-установки */
    add_theme_support('starter-content', [
        'posts' => [
            'home' => [
                'post_type'    => 'page',
                'post_name'    => 'home',
                'post_title'   => 'Home',
                'post_content' => '',
                'template'     => 'page-home.php',
            ],
        ],
    ]);

    /** Поддержка WooCommerce */
    add_theme_support('woocommerce');

    /** Подключение пользовательских стилей редактора */
    add_editor_style('theme/css/editor-style.css');

    /** Установка размеров изображений по умолчанию */
    update_option('thumbnail_size_w', 250);
    update_option('thumbnail_size_h', 250);
    update_option('medium_size_w', 600);
    update_option('medium_size_h', 400);
    update_option('large_size_w', 970);
}
add_action('after_setup_theme', 'bw_setup');

function bw_content_width() {
    if (!isset($GLOBALS['content_width'])) {
        $GLOBALS['content_width'] = 600;
    }
}
add_action('after_setup_theme', 'bw_content_width', 0);


function bw_excerpt_readmore()
{
    return '&nbsp; &hellip; <a class="button-style" style="padding: 0 5px" href="' . get_permalink() . '"><i class="fal fa-arrow-right blog"></i></a>';
}
add_filter('excerpt_more', 'bw_excerpt_readmore');

function bw_enable_excerpt_for_pages() {
    // Включаем поддержку отрывков (excerpt) для страниц (page)
    add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'bw_enable_excerpt_for_pages');

/* Функции касающиеся меню */
function bw_wp_nav_menu_args($args)
{
    $args['container'] = '';

    return $args;
}

function bw_nav_menu_css_class($classes, $item, $args, $depth)
{
    // Добавляет пользовательские классы для активного пункта меню
    if ($item->current) {
        foreach ($classes as $class) {
            if ($class === 'current-menu-item') {
                $classes[] = $depth > 0 ? 'sub-menu-item-current' : 'menu-item-current';
                break;
            }
        }
    }

    // Для вложенных пунктов меню меняет классы с "menu-item-..." на "sub-menu-item-..."
    if ($depth > 0) {
        foreach ($classes as $key => $class) {
            if (preg_match('/^menu-item/', $class)) {
                $classes[$key] = 'sub-' . $class;
            }
        }
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'bw_nav_menu_css_class', 10, 4);

function bw_nav_menu_link_attributes($atts, $item, $args, $depth)
{
    // Добавляет кастомный класс ссылке в зависимости от уровня вложенности
    $atts['class'] = $depth > 0 ? 'sub-menu-link' : 'menu-link';

    return $atts;
}
add_filter('nav_menu_link_attributes', 'bw_nav_menu_link_attributes', 10, 4);

function bw_menu_no_link($nav_menu, $args)
{
    // Указываем расположения меню, для которых нужно изменить поведение
    $theme_locations = array('main-nav', 'second-menu');

    if (in_array($args->theme_location, $theme_locations, true)) {
        // Шаблон замены для текущего элемента меню
        $in_link = '!<li(.*?)class="(.*?)current-menu-item(.*?)"><a(.*?)class="(.*?)">(.*?)</a>!si';
        $out_link = '<li$1class="\\2current-menu-item\\3"><span class="$5">$6</span>';

        // Возвращает измененное меню, заменяя ссылки на текст
        return preg_replace($in_link, $out_link, $nav_menu);
    }

    // Если меню не совпадает, возвращается без изменений
    return $nav_menu;
}
// add_filter('wp_nav_menu', 'bw_menu_no_link', 10, 2);

/** Woocommerce */
// Override theme default specification for product # per row
if (!function_exists('bw_loop_shop_columns')) {
    function bw_loop_shop_columns($columns)
    {
        if (is_shop() || is_product_category() || is_product_tag()) {
            $columns = 3; // 3 products per row
        }
        return $columns;
    }
}
add_filter('loop_shop_columns', 'bw_loop_shop_columns', 4);

function bw_body_class($classes)
{
    $classes = (array)$classes; // Преобразуем $classes в массив (если это строка)

    // Проверка на страницу магазина или категорию продуктов
    if (is_shop() || is_product_taxonomy()) {
        $classes[] = 'columns-3'; // Добавляем класс columns-3
    }
    return $classes;
}

function bw_loop_shop_per_page($cols)
{
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 12;
    return $cols;
}

add_filter('loop_shop_per_page', 'bw_loop_shop_per_page', 20);

/**
 * Remove notice-error about license YITH WooCommerce Zoom Magnifier Premium
 */
if (class_exists('YIT_Plugin_Licence')) {
    $yit_plugin_licence = YIT_Plugin_Licence();
    remove_action('admin_notices', array($yit_plugin_licence, 'activate_license_notice'), 15);
}

function bw_breadcrumbs_localization($l10n)
{
    return array(
        'home' => __('Home', 'brainworks'),
        'paged' => __('Page %d', 'brainworks'),
        '_404' => __('Error 404', 'brainworks'),
        'search' => __('Search results by query - <b>%s</b>', 'brainworks'),
        'author' => __('Author archve: <b>%s</b>', 'brainworks'),
        'year' => __('Archive by <b>%d</b> year', 'brainworks'),
        'month' => __('Archive by: <b>%s</b>', 'brainworks'),
        'day' => __('Archive for: <b>%s</b>', 'brainworks'),
        'attachment' => __('Media: %s', 'brainworks'),
        'tag' => __('Posts by tag: <b>%s</b>', 'brainworks'),
        'tax_tag' => __('%1$s from "%2$s" by tag: <b>%3$s</b>', 'brainworks'),
    );
}
add_filter('kama_breadcrumbs_default_loc', 'bw_breadcrumbs_localization', 10, 1);

add_filter( 'kama_breadcrumbs', function ( $out, $sep, $loc, $arg ) {

	$index = 1;

	$out = preg_replace_callback( '/"ORDERNUM"/i', function ( $matches ) use ( &$index ) {
		return '"' . $index ++ . '"';
	}, $out );

	unset( $index );

	return $out;

}, 10, 4 );

/**
 * Show cart contents / total Ajax
 */
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ) ?>" title="<?php _e( 'View your shopping cart', 'brainworks' ) ?>">
        <span class="cart-contents-count"><?php echo WC()->cart->get_cart_contents_count() ?></span>
    </a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
