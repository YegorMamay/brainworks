<?php
/**
 * All the functions are in the PHP pages in the `inc/` folder.
 */

//Скрывает topbar
//show_admin_bar(false);

require get_template_directory() . '/inc/helpers.php';
// require get_template_directory() . '/inc/auth.php';
require get_template_directory() . '/inc/admin.php';
require get_template_directory() . '/inc/login.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/woo-function.php';

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
		pll_register_string( 'social-tiktok', 'TikTok', 'Brainworks' );
		pll_register_string( 'social-odnoklassniki', 'Odnoklassniki', 'Brainworks' );
	}
} );

remove_action( 'wp_head', '_wp_render_title_tag', 1 ); //удаляет тег title из header.php


// Отменяет удаление из корзины через определенный срок
function devise_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'devise_remove_schedule_delete' );

// Плагин Yoast: отменяет создание автоматических редиректов
add_filter('wpseo_premium_post_redirect_slug_change', '__return_true' );
// Плагин Yoast END


//show hide content text

### Function: Enqueue JavaScripts
add_action( 'wp_enqueue_scripts', 'showhide_scripts' );
function showhide_scripts() {
    wp_enqueue_script( 'jquery' );
}

### Function: Load Translation
add_action( 'plugins_loaded', 'brainworks' );
function showhide_textdomain() {
    load_plugin_textdomain( 'brainworks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

### Function: Short Code For Inserting Press Release Into Post
add_shortcode( 'showhide', 'showhide_shortcode' );
function showhide_shortcode( $atts, $content = null ) {
    // Variables
    $post_id = get_the_id();
    $word_count = number_format_i18n( sizeof( explode( ' ', strip_tags( $content ) ) ) );

    // Extract ShortCode Attributes
    $attributes = shortcode_atts( array(
        'type' => 'pressrelease',
        'more_text' => __( 'Show Press Release (%s More Words)', 'wp-showhide' ),
        'less_text' => __( 'Hide Press Release (%s Less Words)', 'wp-showhide' ),
        'hidden' => 'yes'
    ), $atts );

    // More/Less Text
    $more_text = sprintf( $attributes['more_text'], $word_count );
    $less_text = sprintf( $attributes['less_text'], $word_count );

    // Determine Whether To Show Or Hide Press Release
    $hidden_class = 'sh-hide';
    $hidden_css = '';
    $hidden_aria_expanded = 'false';
    if( $attributes['hidden'] === 'no' ) {
        $hidden_class = 'sh-show';
        $hidden_css = 'display: block;';
        $hidden_aria_expanded = 'true';
        $tmp_text = $more_text;
        $more_text = $less_text;
        $less_text = $tmp_text;
    }

    // Format HTML Output
    $output = '<div class="show-hide-text__wrapp"><div class="show-hide-text"><div id="' . $attributes['type'] . '-content-' . $post_id . '" class="sh-content ' . $attributes['type'] . '-content ' . $hidden_class . '" style="' . $hidden_css . '">' . do_shortcode( $content ) . '</div>';
    $output .= '<div id="' . $attributes['type'] . '-link-' . $post_id . '" class="sh-link ' . $attributes['type'] . '-link js-show-more ' . $hidden_class .'"></div></div><a href="#" class="btn-show-more"><span class="show-text">' . $more_text . '</span><span class="hide-text">'.$less_text.'</span></a></div>';

    return $output;
}


// Column shortcode cpt "html block"
add_filter( 'manage_'.'blocks'.'_posts_columns', 'add_views_column', 4 );
function add_views_column( $columns ){
	$num = 2;
	$new_columns = array(
		'views' =>  __('Shortcode', 'brainworks'),
	);
	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

add_action('manage_'.'blocks'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
	echo "[html_block id=" . $post_id . "]";
}

// Скрывает топ-бар для подписчиков
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}
// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}

/**
 * Allow HTML in term (category, tag) descriptions
 */
foreach ( array( 'pre_term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		add_filter( $filter, 'wp_filter_post_kses' );
	}
}

foreach ( array( 'term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_kses_data' );
}

// Remove Guttenberg styles
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css' );


//Длина отрывка статьи
add_filter( 'excerpt_length', function(){
	return 25;
} );

add_filter( 'kses_allowed_protocols', function ( $protocols ) {
    $protocols[] = 'viber';
    $protocols[] = 'skype';
    return $protocols;
} );

// Кнопка удаления аккаунта START
function delete_account_button() {
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        return '<form method="post">
                    <input type="hidden" name="delete_account" value="' . $user_id . '"/>
                    <input type="submit" value="' . esc_attr__('Удалить аккаунт', 'brainworks') . '" onclick="return confirm(\'' . esc_js(__('Вы уверены, что хотите удалить свой аккаунт?', 'brainworks')) . '\');"/>
                </form>';
    }
    return __('Вам нужно залогиниться', 'brainworks');
}
add_shortcode('delete_account_button', 'delete_account_button');

// Обработка удаления аккаунта
function process_delete_account() {
    if (isset($_POST['delete_account'])) {
        $user_id = intval($_POST['delete_account']);
        if (get_current_user_id() === $user_id) {
            require_once(ABSPATH . 'wp-admin/includes/user.php');
            wp_delete_user($user_id);
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('init', 'process_delete_account');
// Кнопка удаления аккаунта END

// Замена текста в подвале админки
function custom_admin_footer_text() {
    return __('Created with love by <a href="https://brainworks.in.ua/" target="_blank">BrainWorks</a>', 'brainworks');
}
add_filter('admin_footer_text', 'custom_admin_footer_text');

// Если юзер не админ логинится в админку, переадресовывается на Главную
add_action('admin_init', 'redirect_non_admin_users');

function redirect_non_admin_users() {
    // Проверяем, залогинен ли пользователь
    if (is_user_logged_in()) {
        $user = wp_get_current_user();

        // Если пользователь не администратор и это не AJAX-запрос
        if (!in_array('administrator', $user->roles) && !defined('DOING_AJAX')) {
            wp_redirect(home_url('/user/')); // Перенаправляем на Главную
            exit;
        }
    }
}
// Если юзер не админ END

// Поддержка GIF для обложек товаров START
// Отключаем обработку миниатюр для GIF
function allow_gif_thumbnails($result, $path) {
    if ($path && strpos($path, '.gif') !== false) {
        return false; // Не создавать уменьшенные версии GIF
    }
    return $result;
}
add_filter('wp_image_editors', function($editors) {
    return array('WP_Image_Editor_GD', 'WP_Image_Editor_Imagick');
});
add_filter('wp_generate_attachment_metadata', 'disable_gif_thumbnail', 10, 2);
function disable_gif_thumbnail($metadata, $attachment_id) {
    $file = get_attached_file($attachment_id);
    if ($file && strpos($file, '.gif') !== false) {
        return []; // Отменяем создание миниатюр
    }
    return $metadata;
}

// Используем оригинальный GIF вместо миниатюр в каталоге товаров WooCommerce
function replace_gif_in_shop($image, $post_id, $size, $attr) {
    $thumbnail_id = get_post_thumbnail_id($post_id);
    if (!$thumbnail_id) {
        return $image; // Если нет миниатюры, возвращаем стандартное изображение
    }

    $file = get_attached_file($thumbnail_id);
    if ($file && strpos($file, '.gif') !== false) {
        $url = wp_get_attachment_url($thumbnail_id);
        if ($url) {
            return '<img src="' . esc_url($url) . '" class="wp-post-image" alt="">';
        }
    }

    return $image;
}
add_filter('post_thumbnail_html', 'replace_gif_in_shop', 10, 4);

// Используем оригинальный GIF на странице товара
function replace_gif_in_product_page($html, $attachment_id) {
    $file = get_attached_file($attachment_id);
    if ($file && strpos($file, '.gif') !== false) {
        $url = wp_get_attachment_url($attachment_id);
        if ($url) {
            return '<img src="' . esc_url($url) . '" class="wp-post-image" alt="">';
        }
    }
    return $html;
}
add_filter('woocommerce_single_product_image_thumbnail_html', 'replace_gif_in_product_page', 10, 2);
// Поддержка GIF для обложек товаров END

function custom_seo_title() {
    if (is_front_page()) {
            echo get_bloginfo('name');
        } elseif (is_post_type_archive()) {
            echo post_type_archive_title();
        } elseif (!is_front_page() || !is_page()) {
            echo single_post_title();
        } elseif (!is_front_page() || !is_single()) {
            echo the_title();
        } elseif (is_front_page() && is_category()) {
            echo single_cat_title();
        }
        if (is_archive()) {
            echo single_cat_title();
        }
}

// Разрешить загрузку SVG только администраторам
function allow_svg_uploads_for_admins($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads_for_admins');


// Меняет порядок отображения товаров в кастомном посте Каталог - в обратном алфавитному
//function custom_post_type_archive_sort( $query ) {
//    if ( is_post_type_archive( 'catalog' ) && ! is_admin() && $query->is_main_query()) {
//        $query->set( 'orderby', 'title' );
//        $query->set( 'order', 'DESC' );
//    }
//}
//add_action( 'pre_get_posts', 'custom_post_type_archive_sort' );

//WOOCOMMERCE START
// Проверяем, активен ли WooCommerce START
if ( class_exists( 'WooCommerce' ) ) {

    // Кнопки -/+ вокруг поля количества (СТРАНИЦА ТОВАРА)
    add_action( 'woocommerce_before_add_to_cart_quantity', function() {
        echo '<div class="quantity-control shop-page"><button type="button" class="qty-btn minus">−</button>';
    } );
    add_action( 'woocommerce_after_add_to_cart_quantity', function() {
        echo '<button type="button" class="qty-btn plus">+</button></div>';
    } );

    // Единый скрипт для +/-, синхронизации с кнопкой "В корзину" и AJAX
    add_action( 'wp_footer', function() { ?>
        <script>
        (function(){
            // Универсальная функция: обновляет data-quantity у кнопки добавления
            function syncButtonQuantity(inputEl){
                if (!inputEl) return;
                var qty = inputEl.value && !isNaN(inputEl.value) ? inputEl.value : '1';

                // Ищем кнопку в пределах формы/карточки
                var scope = inputEl.closest('form.cart') || inputEl.closest('li.product') || inputEl.closest('.product');
                if (!scope) return;

                var btn = scope.querySelector('.add_to_cart_button');
                if (btn) btn.setAttribute('data-quantity', qty);
            }

            // Изменение значения в input.qty — обновляем кнопку
            document.addEventListener('input', function(e){
                if (e.target && e.target.matches('input.qty')) {
                    syncButtonQuantity(e.target);
                }
            });
            document.addEventListener('change', function(e){
                if (e.target && e.target.matches('input.qty')) {
                    syncButtonQuantity(e.target);
                }
            });

            // Клики на +/- (и для .quantity-control, и для стандартной .quantity)
            document.addEventListener('click', function(e){
                var isPlus  = e.target && (e.target.classList.contains('plus')  || e.target.classList.contains('qty-btn') && e.target.classList.contains('plus'));
                var isMinus = e.target && (e.target.classList.contains('minus') || e.target.classList.contains('qty-btn') && e.target.classList.contains('minus'));
                if (!isPlus && !isMinus) return;

                // Находим ближайший контейнер с qty
                var wrap = e.target.closest('.quantity-control') || e.target.closest('.quantity');
                if (!wrap) return;

                var input = wrap.querySelector('input.qty');
                if (!input) return;

                var val  = parseFloat(input.value) || 0;
                var max  = parseFloat(input.getAttribute('max'));
                var min  = parseFloat(input.getAttribute('min')); if (isNaN(min)) min = 1;
                var step = parseFloat(input.getAttribute('step')); if (isNaN(step)) step = 1;

                function decimals(n){ var s=String(n); return s.includes('.') ? s.split('.')[1].length : 0; }
                var dec = decimals(step);

                if (isPlus) {
                    if (!isNaN(max) && val >= max) {
                        val = max;
                    } else {
                        val = val + step;
                    }
                } else {
                    if (!isNaN(min) && val <= min) {
                        val = min;
                    } else {
                        val = Math.max(val - step, min);
                    }
                }

                input.value = val.toFixed(dec);
                // Тригерим change, чтобы подхватили другие скрипты, и синхронизируем кнопку
                var evt = new Event('change', { bubbles: true });
                input.dispatchEvent(evt);
                syncButtonQuantity(input);
            });

            // На всякий случай синхронизируем при загрузке
            document.querySelectorAll('input.qty').forEach(syncButtonQuantity);
        })();
        </script>
    <?php } );

    // Скрипт для buy-one-click. Открытие попапа и подстановка названия товара
    add_action( 'wp_footer', function() { ?>
        <script>
        jQuery(document).ready(function($) {
            $(document).on('click', '.buy-one-click', function(e) {
                e.preventDefault();

                var productTitle = $(this).data('title');
                var popupData = $(this).data('popup'); // строка вида "ru:116,ua:388,en:867"

                // Преобразуем строку в объект {ru:116, ua:388, en:867}
                var popupMap = {};
                popupData.split(',').forEach(function(pair) {
                    var parts = pair.split(':');
                    if (parts.length === 2) {
                        popupMap[parts[0].trim()] = parts[1].trim();
                    }
                });

                // Определяем текущий язык (Polylang)
                var lang = $('html').attr('lang') || '';
                lang = lang.toLowerCase();

                if (lang.startsWith('ru')) lang = 'ru';
                else if (lang.startsWith('uk')) lang = 'ua'; // "uk" у Polylang = украинский
                else if (lang.startsWith('en')) lang = 'en';

                var popupId = popupMap[lang] || null;

                if (popupId) {
                    elementorProFrontend.modules.popup.showPopup({ id: popupId });

                    // Вставляем название товара в первое поле формы
                    setTimeout(function() {
                        var $firstInput = $('.elementor-popup-modal form input[type="text"]').first();
                        if ($firstInput.length) {
                            $firstInput.val(productTitle);
                        }
                    }, 200);
                }
            });
        });
        </script>
        <?php
    });


//Автообновление корзины
add_action( 'wp_footer', 'custom_ajax_cart_quantity_script' );
function custom_ajax_cart_quantity_script() {
    if (is_cart()) : ?>
        <script type="text/javascript">
            jQuery(function($){
                let timeout = null;

                $('div.woocommerce').on('change', 'input.qty', function(){
                    if (timeout !== null) {
                        clearTimeout(timeout);
                    }

                    timeout = setTimeout(function(){
                        $("[name='update_cart']").trigger("click");
                    }, 1000); // задержка 1 секунда, можно уменьшить
                });
            });
        </script>
    <?php endif;
}
//Автообновление корзины END


// Шорткод для товара - количество пользователей, которые просматривают товар
function product_viewers_shortcode() {
    ob_start(); // Буферизация вывода
    ?>

    <div class="product-viewers mrgn-bot-20 mrgn-top-20">
        <i class="fa-solid fa-eye"></i> <?php printf(esc_html__('%s people are viewing this right now', 'brainworks'), '<span id="viewers-count">' . rand(5, 20) . '</span>'); ?>
    </div>

    <style>
        .fade {
            opacity: 1;
            transition: opacity 0.8s ease-in-out;
        }
        .fade.out {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let viewersCount = parseInt(document.getElementById("viewers-count").textContent);
            let viewersElement = document.getElementById("viewers-count");

            function updateViewers() {
                let change = Math.random() < 0.5 ? -1 : 1; // Увеличение или уменьшение
                let newCount = viewersCount + change;

                // Устанавливаем границы (чтобы не было слишком низкого или высокого числа)
                if (newCount < 5) newCount = 5;
                if (newCount > 30) newCount = 30;

                // Анимация fadeOut
                viewersElement.classList.add("out");

                setTimeout(() => {
                    viewersElement.textContent = newCount;
                    viewersCount = newCount;
                    viewersElement.classList.remove("out"); // fadeIn
                }, 800); // Задержка до замены текста

                setTimeout(updateViewers, Math.random() * 3000 + 5000); // Интервал 5-8 секунд
            }

            setTimeout(updateViewers, 5000); // Первый запуск через 5 секунд
        });
    </script>

    <?php
    return ob_get_clean(); // Возвращаем буферизированный контент
}
add_shortcode('product_viewers', 'product_viewers_shortcode');
// Шорткод для товара END


// Функция для вывода шорткода [product_viewers] под ценой товара
function display_product_viewers() {
    echo do_shortcode('[product_viewers]'); // Вставляем шорткод
}

// Добавляем вывод шорткода после цены товара
add_action('woocommerce_single_product_summary', 'display_product_viewers', 15);


// Шорткод для товара 2 - кол-во купленных товаров за сутки
// Функция для генерации и кэширования случайного числа продаж за последние 24 часа
function get_sold_in_last_24_hours() {
    global $post;

    if (!$post || !is_singular('product')) {
        return '';
    }

    $product_id = $post->ID;
    $transient_key = 'sold_in_last_24_hours_' . $product_id;

    // Проверяем, есть ли уже сохраненное значение
    $sold_count = get_transient($transient_key);

    if ($sold_count === false) {
        // Если нет, генерируем случайное число и кэшируем его на 24 часа
        $sold_count = rand(5, 30);
        set_transient($transient_key, $sold_count, DAY_IN_SECONDS);
    }

    // Оборачиваем в <div> с классом
    return '<div class="sold-last-24-hours mrgn-bot-20">' . sprintf(__('🔥 %d sold in last 24 hours', 'brainworks'), $sold_count) . '</div>';
}

// Регистрируем шорткод
add_shortcode('sold_in_last_24_hours', 'get_sold_in_last_24_hours');
// Шорткод для товара 2 END


/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img src="' . $image . '" alt="' . $cat->name . '" class="category-archive-image" />';
		}
	}
}

}

/* WOO: Перемещает закончивщиеся товары в конец START */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_filter('posts_clauses', 'order_by_stock_status', 2000);
}

function order_by_stock_status($posts_clauses) {
    global $wpdb;

    if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
	$posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
	$posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
	$posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
    }
	return $posts_clauses;
}
/* WOO: Перемещает закончивщиеся товары в конец END */

//Перемещает описание категории под товары
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );
// end

//Изменение перевода для Woo
add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');

function translate_text($translated) {
$translated = str_ireplace('Подытог', 'Итого', $translated);
return $translated;
}
//Изменение перевода END

// Изменяет порядок артикула по отношению к другим элементам на странице товара
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15 );

<?php
/**
 * Возможность загружать изображения для терминов (элементов таксономий: категории, метки).
 * Безопасный вариант (без удаления файлов).
 *
 * Text Domain: brainworks
 */

if ( is_admin() && ! class_exists( 'Term_Meta_Image' ) ) {

    add_action( 'admin_init', 'Term_Meta_Image_init' );
    function Term_Meta_Image_init() {
        $GLOBALS['Term_Meta_Image'] = new Term_Meta_Image();
    }

    class Term_Meta_Image {

        // Таксономии (по умолчанию все публичные)
        static $taxes = [];

        // Мета ключ
        static $meta_key = '_thumbnail_id';
        static $attach_term_meta_key = 'img_term';

        // URL пустой картинки
        static $add_img_url = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';

        public function __construct() {
            if ( isset( $GLOBALS['Term_Meta_Image'] ) ) {
                return $GLOBALS['Term_Meta_Image'];
            }

            $taxes = self::$taxes ? self::$taxes : get_taxonomies( [ 'public' => true ], 'names' );

            foreach ( $taxes as $taxname ) {
                add_action( "{$taxname}_add_form_fields", [ $this, 'add_term_image' ], 10, 2 );
                add_action( "{$taxname}_edit_form_fields", [ $this, 'update_term_image' ], 10, 2 );
                add_action( "created_{$taxname}", [ $this, 'save_term_image' ], 10, 2 );
                add_action( "edited_{$taxname}", [ $this, 'updated_term_image' ], 10, 2 );
                add_filter( "manage_edit-{$taxname}_columns", [ $this, 'add_image_column' ] );
                add_filter( "manage_{$taxname}_custom_column", [ $this, 'fill_image_column' ], 10, 3 );
            }
        }

        ## Поле при создании термина
        public function add_term_image( $taxonomy ) {
            wp_enqueue_media();
            add_action( 'admin_print_footer_scripts', [ $this, 'add_script' ], 99 );
            $this->css();
            ?>
            <div class="form-field term-group">
                <label><?php _e( 'Image', 'brainworks' ); ?></label>
                <div class="term__image__wrapper">
                    <a class="termeta_img_button" href="#">
                        <img src="<?php echo esc_url( self::$add_img_url ); ?>" alt="">
                    </a>
                    <input type="button" class="button button-one termeta_img_remove" value="<?php esc_attr_e( 'Remove', 'brainworks' ); ?>" />
                </div>
                <input type="hidden" id="term_imgid" name="term_imgid" value="">
            </div>
            <?php
        }

        ## Поле при редактировании термина
        public function update_term_image( $term, $taxonomy ) {
            wp_enqueue_media();
            add_action( 'admin_print_footer_scripts', [ $this, 'add_script' ], 99 );

            $image_id  = get_term_meta( $term->term_id, self::$meta_key, true );
            $image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : self::$add_img_url;

            $this->css();
            ?>
            <tr class="form-field term-group-wrap">
                <th scope="row"><?php _e( 'Image', 'brainworks' ); ?></th>
                <td>
                    <div class="term__image__wrapper">
                        <a class="termeta_img_button" href="#">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="">
                        </a>
                        <input type="button" class="button button-one termeta_img_remove" value="<?php esc_attr_e( 'Remove', 'brainworks' ); ?>" />
                    </div>
                    <input type="hidden" id="term_imgid" name="term_imgid" value="<?php echo esc_attr( $image_id ); ?>">
                </td>
            </tr>
            <?php
        }

        public function css() {
            ?>
            <style>
                .termeta_img_button { display:inline-block; margin-right:1em; }
                .termeta_img_button img { display:block; float:left; margin:0; padding:0; min-width:100px; max-width:150px; height:auto; background:rgba(0,0,0,.07); }
                .termeta_img_button:hover img { opacity:.8; }
                .termeta_img_button:after { content:''; display:table; clear:both; }
            </style>
            <?php
        }

        ## JS для выбора/удаления
        public function add_script() {
            $title      = __( 'Featured Image', 'brainworks' );
            $button_txt = __( 'Set featured image', 'brainworks' );
            ?>
            <script>
                jQuery(document).ready(function($){
                    var frame,
                        $imgwrap = $('.term__image__wrapper'),
                        $imgid   = $('#term_imgid');

                    // Добавление
                    $('.termeta_img_button').click( function(ev){
                        ev.preventDefault();

                        if( frame ){
                            frame.open();
                            return;
                        }

                        frame = wp.media.frames.questImgAdd = wp.media({
                            states: [
                                new wp.media.controller.Library({
                                    title: '<?php echo esc_js( $title ); ?>',
                                    library: wp.media.query({ type: 'image' }),
                                    multiple: false,
                                })
                            ],
                            button: { text: '<?php echo esc_js( $button_txt ); ?>' }
                        });

                        frame.on('select', function(){
                            var selected = frame.state().get('selection').first().toJSON();
                            if( selected ){
                                $imgid.val( selected.id );
                                $imgwrap.find('img').attr('src', selected.sizes.thumbnail.url );
                            }
                        });

                        frame.on('open', function(){
                            if( $imgid.val() )
                                frame.state().get('selection').add( wp.media.attachment( $imgid.val() ) );
                        });

                        frame.open();
                    });

                    // Удаление
                    $('.termeta_img_remove').click(function(){
                        $imgid.val('');
                        $imgwrap.find('img').attr('src','<?php echo esc_js( self::$add_img_url ); ?>');
                    });
                });
            </script>
            <?php
        }

        ## Добавляем колонку в таблицу терминов
        public function add_image_column( $columns ) {
            add_action( 'admin_notices', function(){
                echo '<style>.column-image{ width:50px; text-align:center; }</style>';
            });
            return array_slice( $columns, 0, 1 ) + [ 'image' => '' ] + $columns;
        }

        public function fill_image_column( $string, $column_name, $term_id ) {
            if ( 'image' === $column_name && $image_id = get_term_meta( $term_id, self::$meta_key, true ) ) {
                $string = '<img src="' . esc_url( wp_get_attachment_image_url( $image_id, 'thumbnail' ) ) . '" width="50" height="50" alt="" style="border-radius:4px;" />';
            }
            return $string;
        }

        ## Сохранение при создании
        public function save_term_image( $term_id, $tt_id ) {
            if ( isset( $_POST['term_imgid'] ) && $attach_id = (int) $_POST['term_imgid'] ) {
                update_term_meta( $term_id, self::$meta_key, $attach_id );
                update_post_meta( $attach_id, self::$attach_term_meta_key, $term_id );
            }
        }

        ## Обновление при редактировании
        public function updated_term_image( $term_id, $tt_id ) {
            if ( ! isset( $_POST['term_imgid'] ) ) {
                return;
            }

            $attach_id = (int) $_POST['term_imgid'];

            if ( $attach_id ) {
                update_term_meta( $term_id, self::$meta_key, $attach_id );
                update_post_meta( $attach_id, self::$attach_term_meta_key, $term_id );
            } else {
                delete_term_meta( $term_id, self::$meta_key );
            }
        }
    }
}

//WOOCOMMERCE END
