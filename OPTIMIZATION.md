# Рекомендации по оптимизации темы BrainWorks

## 🔴 Критические рекомендации (высокий приоритет)

### 1. Производительность: Оптимизация загрузки скриптов

**Проблема:** Загрузка внешних библиотек из CDN может замедлить сайт и создать зависимость от внешних сервисов.

**Файл:** `inc/enqueues.php`

**Текущий код:**
```php
wp_register_script('html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', [], null, false);
wp_register_script('respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', [], null, false);
wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', [], null, true);
wp_register_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
```

**Рекомендация:**
- Удалить поддержку IE < 9 (html5shiv, respond.js) - эти браузеры устарели
- Скачать Modernizr и Slick локально в `/assets/js/vendor/`
- Использовать `defer` или `async` для неблокирующей загрузки

**Улучшенный код:**
```php
function bw_enqueues() {
    // Styles
    wp_enqueue_style('style-css', get_template_directory_uri() . '/style.css', false, '1.0.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', false, '6.0.0');

    // Scripts - локальные файлы
    wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr.min.js', [], '2.8.3', false);
    wp_enqueue_script('modernizr');
    
    // Slick только если есть отзывы
    if (post_type_exists('reviews') && intval(wp_count_posts('reviews')->publish) > 0) {
        wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/vendor/slick.min.js', ['jquery'], '1.8.1', true);
    }
    
    // Основной скрипт с defer
    wp_enqueue_script('brainworks-js', get_template_directory_uri() . '/assets/js/brainworks.js', ['jquery'], '1.0.0', true);
    wp_script_add_data('brainworks-js', 'defer', true);
    
    // Локализация
    wp_localize_script('brainworks-js', 'jpAjax', [
        'sticky_header' => [
            'enable' => get_theme_mod('bw_sticky_header_enable', false),
            'autohide' => get_theme_mod('bw_sticky_header_autohide', false)
        ],
    ]);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bw_enqueues', 100);
```

### 3. Безопасность: Удалить console.log из production

**Проблема:** В production коде найдены console.log вызовы.

**Файл:** `assets/js/es6/brainworks.js`

**Найденные строки:**
```javascript
console.log('%cThe website developed by BRAIN WORKS — https://brainworks.pro/', 'color: blue');
console.log(slick, direction);  // Строка 316
console.log(slick, currentSlide);  // Строка 320
console.log($('.wc-tabs').offset().top - fixedHeaderHeight);  // Строка 789
```

**Рекомендация:**
Удалить все console.log или использовать условную отладку:

```javascript
// Добавить в начало файла
const DEBUG = false; // или window.location.hostname === 'localhost'

// Заменить console.log на:
if (DEBUG) {
    console.log('debug info');
}
```

---

### 4. Безопасность: Улучшить nonce проверки

**Проблема:** В файле `functions.php` есть обработка POST запросов без nonce проверки.

**Файл:** `functions.php` (строки 614-626)

**Текущий код:**
```php
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
```

**Улучшенный код:**
```php
function delete_account_button() {
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $nonce = wp_create_nonce('delete_account_' . $user_id);
        
        return '<form method="post">
                    <input type="hidden" name="delete_account" value="' . $user_id . '"/>
                    <input type="hidden" name="delete_account_nonce" value="' . $nonce . '"/>
                    <input type="submit" value="' . esc_attr__('Удалить аккаунт', 'brainworks') . '" 
                           onclick="return confirm(\'' . esc_js(__('Вы уверены, что хотите удалить свой аккаунт?', 'brainworks')) . '\');"/>
                </form>';
    }
    return __('Вам нужно залогиниться', 'brainworks');
}
add_shortcode('delete_account_button', 'delete_account_button');

function process_delete_account() {
    if (isset($_POST['delete_account']) && isset($_POST['delete_account_nonce'])) {
        $user_id = intval($_POST['delete_account']);
        
        // Проверка nonce
        if (!wp_verify_nonce($_POST['delete_account_nonce'], 'delete_account_' . $user_id)) {
            wp_die(__('Ошибка безопасности. Попробуйте снова.', 'brainworks'));
        }
        
        // Проверка прав
        if (get_current_user_id() === $user_id) {
            require_once(ABSPATH . 'wp-admin/includes/user.php');
            wp_delete_user($user_id);
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('init', 'process_delete_account');
```


### 6. Производительность: Кэширование запросов

**Файл:** `functions.php`

**Добавить кэширование для часто используемых запросов:**

```php
// Кэширование количества отзывов
function get_reviews_count() {
    $count = wp_cache_get('reviews_count', 'brainworks');
    
    if (false === $count) {
        $count = intval(wp_count_posts('reviews')->publish);
        wp_cache_set('reviews_count', $count, 'brainworks', HOUR_IN_SECONDS);
    }
    
    return $count;
}

// Использовать вместо прямого wp_count_posts
if (post_type_exists('reviews') && get_reviews_count() > 0) {
    wp_enqueue_script('slick');
}
```

---

### 8. SEO: Улучшить структурированные данные

**Файл:** `header.php`

**Добавить JSON-LD разметку:**

```php
// В functions.php
function add_schema_markup() {
    if (is_singular('product')) {
        global $product;
        
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => get_the_title(),
            'image' => get_the_post_thumbnail_url(),
            'description' => get_the_excerpt(),
            'offers' => [
                '@type' => 'Offer',
                'price' => $product->get_price(),
                'priceCurrency' => get_woocommerce_currency(),
                'availability' => $product->is_in_stock() ? 'InStock' : 'OutOfStock'
            ]
        ];
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'add_schema_markup');
```

---

## 🟢 Рекомендации по улучшению (низкий приоритет)

### 9. Код: Использовать современный PHP

**Текущая версия:** Код совместим с PHP 5.6+

**Рекомендация:** Обновить минимальную версию до PHP 7.4+ и использовать:
- Типизацию параметров и возвращаемых значений
- Null coalescing operator (`??`)
- Arrow functions
- Typed properties

**Пример:**
```php
// Старый код
function get_phone_number($phone) {
    return str_replace(array('-', '(', ')', ' '), '', $phone);
}

// Современный код
function get_phone_number(string $phone): string {
    return str_replace(['-', '(', ')', ' '], '', $phone);
}
```

---

### 10. Организация: Переместить inline стили в CSS файлы

**Файл:** `functions.php` (строки 453-461)

**Проблема:** Inline стили в PHP коде.

```php
echo '<style>
    .fade {
        opacity: 1;
        transition: opacity 0.8s ease-in-out;
    }
</style>';
```

**Рекомендация:** Переместить все стили в `style.css` или отдельный файл компонента.

---

### 11. Доступность (A11y): Улучшить доступность

**Добавить ARIA атрибуты:**

```php
// В header.php для мобильного меню
<button class="hamburger js-hamburger" 
        type="button" 
        tabindex="0"
        aria-label="<?php _e('Toggle navigation', 'brainworks'); ?>"
        aria-expanded="false"
        aria-controls="mobile-menu">
    <span class="hamburger-box">
        <span class="hamburger-inner"></span>
    </span>
</button>
```

---

### 12. Производительность: Использовать WebP изображения

**Добавить поддержку WebP:**

```php
// В functions.php
function add_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'add_webp_support');

// Автоматическая конвертация в WebP
function convert_to_webp($metadata, $attachment_id) {
    $file = get_attached_file($attachment_id);
    $pathinfo = pathinfo($file);
    
    if (in_array($pathinfo['extension'], ['jpg', 'jpeg', 'png'])) {
        $webp_file = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.webp';
        
        // Конвертация (требует GD или Imagick с поддержкой WebP)
        $image = wp_get_image_editor($file);
        if (!is_wp_error($image)) {
            $image->save($webp_file, 'image/webp');
        }
    }
    
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'convert_to_webp', 10, 2);
```

---

## 🛠️ Инструменты для тестирования

### Безопасность
- **WPScan** - сканер уязвимостей WordPress
- **Sucuri SiteCheck** - https://sitecheck.sucuri.net/

### Код
- **PHP_CodeSniffer** с WordPress Coding Standards
- **PHPStan** - статический анализ PHP кода

### Доступность
- **WAVE** - https://wave.webaim.org/
- **axe DevTools** - расширение для браузера

