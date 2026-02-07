# BrainWorks WordPress Theme - Полная документация

## Общая информация

**Название темы:** BrainWorks WP Theme  
**Автор:** BrainWorks  
**Версия:** 17.08.25  
**Последние изменения:** 25.07.25  
**Text Domain:** brainworks  
**URI темы:** https://github.com/YegorMamay/brainworks

## Описание

BrainWorks - это полнофункциональная WordPress тема, разработанная для создания современных веб-сайтов с поддержкой WooCommerce, многоязычности (Polylang), кастомных типов записей и расширенными возможностями кастомизации через WordPress Customizer.

---

## Структура темы

### Основные файлы

```
brainworks-master/
├── functions.php           # Главный файл функций
├── header.php             # Шапка сайта
├── footer.php             # Подвал сайта
├── index.php              # Главный шаблон
├── home.php               # Шаблон главной страницы блога
├── single.php             # Шаблон одиночной записи
├── page.php               # Шаблон страницы
├── archive.php            # Шаблон архива
├── search.php             # Шаблон поиска
├── 404.php                # Страница ошибки 404
├── sidebar.php            # Боковая панель
├── searchform.php         # Форма поиска
├── style.css              # Главный файл стилей
├── screenshot.png         # Скриншот темы
├── inc/                   # Папка с функциями
├── loops/                 # Папка с шаблонами циклов
├── assets/                # Ресурсы (CSS, JS, изображения)
├── woocommerce/           # Шаблоны WooCommerce
├── kviz/                  # Функционал квизов
└── languages/             # Файлы переводов
```

### Шаблоны страниц

- `page-auth-only.php` - Страница только для авторизованных пользователей
- `page-container.php` - Страница с контейнером
- `page-home.php` - Шаблон главной страницы
- `page-landing.php` - Шаблон лендинга
- `page-login.php` - Страница входа
- `page-no-breadcrumbs.php` - Страница без хлебных крошек
- `page-no-title.php` - Страница без заголовка
- `page-sidebar-left.php` - Страница с левым сайдбаром
- `page-sidebar-right.php` - Страница с правым сайдбаром
- `page-sitemap.php` - Карта сайта
- `page-thank-you.php` - Страница благодарности
- `page-user.php` - Страница пользователя
- `page-with-decor-image.php` - Страница с декоративным изображением

---

## Функциональные возможности

### 1. Поддержка WordPress

- ✅ Custom Logo
- ✅ Post Thumbnails (миниатюры записей)
- ✅ Custom Background
- ✅ Title Tag
- ✅ HTML5 разметка
- ✅ Automatic Feed Links
- ✅ Навигационные меню
- ✅ Виджеты
- ✅ Excerpt для страниц

### 2. Поддержка WooCommerce

- ✅ Полная интеграция WooCommerce
- ✅ Кастомные шаблоны товаров
- ✅ Поддержка GIF-изображений для товаров
- ✅ Кнопки +/- для выбора количества товаров
- ✅ Перемещение закончившихся товаров в конец списка
- ✅ Кастомная корзина
- ✅ Виджет корзины

### 3. Кастомные типы записей (Custom Post Types)

#### Reviews (Отзывы)
```php
Slug: reviews
Поддержка: title, editor, thumbnail, excerpt
Архив: Да
Таксономия: review_category
```

#### Catalog (Каталог)
```php
Slug: catalog
Поддержка: title, editor, thumbnail, custom-fields, excerpt
Архив: Да
Таксономия: sn_cat (Категории)
```

#### HTML Blocks (HTML блоки)
```php
Slug: blocks
Поддержка: title, editor
Архив: Нет
Использование: [html_block id=X]
```

### 4. Области виджетов

1. **PreHeader** (`pre-header-widget-area`) - Область перед шапкой
2. **Sidebar Left** (`sidebar-widget-area`) - Левая боковая панель
3. **Sidebar Right** (`sidebar-widget-area2`) - Правая боковая панель
4. **Review Page Sidebar** (`sidebar-widget-area3`) - Сайдбар страницы отзывов
5. **Woo Cart** (`cart-widget-area`) - Область корзины WooCommerce
6. **Footer** (`footer-widget-area`) - Подвал сайта

---

## Шорткоды

### 1. Социальные сети

#### `[bw-social]`
Выводит список социальных сетей, настроенных в Customizer.

**Использование:**
```php
[bw-social]
```

**Вывод в PHP:**
```php
<?php echo do_shortcode('[bw-social]'); ?>
```

**Поддерживаемые социальные сети:**
- Facebook
- Instagram
- YouTube
- TikTok
- LinkedIn
- X (Twitter)
- VK
- Odnoklassniki
- 3 кастомные социальные сети

---

### 2. Телефоны

#### `[bw-phone]`
Выводит список телефонов.

**Параметры:**
- `column` - Вывод в колонку (true/false)

**Использование:**
```php
[bw-phone]
[bw-phone column="true"]
```

**Вывод в PHP:**
```php
<?php echo do_shortcode('[bw-phone]'); ?>
<?php echo do_shortcode('[bw-phone column="true"]'); ?>
```

---

#### `[phone_dropdown]`
Выводит выпадающий список телефонов.

**Параметры:**
- `light_mode` - Светлый режим (true/false)

**Использование:**
```php
[phone_dropdown]
[phone_dropdown light_mode="true"]
```

---

### 3. Мессенджеры

#### `[bw-messengers]`
Выводит список мессенджеров (Skype, Viber, WhatsApp, Telegram, Facebook Messenger).

**Использование:**
```php
[bw-messengers]
```

**Вывод в PHP:**
```php
<?php echo do_shortcode('[bw-messengers]'); ?>
```

---

### 4. Переключатель языков (Polylang)

#### `[polylang]`
Выводит переключатель языков Polylang.

**Параметры:**
- `dropdown` - Выпадающий список (0/1)
- `show_flags` - Показывать флаги (0/1)
- `show_names` - Показывать названия языков (0/1)
- `hide_if_empty` - Скрывать пустые языки (0/1)

**Использование:**
```php
[polylang]
[polylang dropdown="1" show_flags="1" show_names="1"]
```

---

### 5. HTML карта сайта

#### `[bw-html-sitemap]`
Выводит HTML карту сайта.

**Параметры:**
- `list` - Режим списка (true/false)

**Использование:**
```php
[bw-html-sitemap]
[bw-html-sitemap list="true"]
```

---

### 6. Последние записи

#### `[bw-last-posts]`
Выводит последние записи блога.

**Параметры:**
- `count` - Количество записей (по умолчанию: 3)
- `button_title` - Текст кнопки (по умолчанию: "Continue reading")

**Использование:**
```php
[bw-last-posts]
[bw-last-posts count="5" button_title="Читать далее"]
```

---

### 7. Рекламные записи

#### `[bw-advert]`
Выводит записи с меткой "на главной".

**Параметры:**
- `count` - Количество записей (по умолчанию: 3)
- `class` - CSS класс (по умолчанию: front-news)
- `category` - ID категорий через запятую
- `display_category` - Показывать категорию (true/false)
- `display_datetime` - Показывать дату (true/false)
- `display_tags` - Показывать теги (true/false)
- `array_index` - Индекс элемента массива

**Использование:**
```php
[bw-advert count="3" display_datetime="true"]
[bw-advert category="1,5,10" display_category="true"]
```

---

### 8. Отзывы

#### `[bw-reviews]`
Выводит список отзывов.

**Параметры:**
- `cat` - ID категории отзывов

**Использование:**
```php
[bw-reviews]
[bw-reviews cat="5"]
```

---

### 9. Авторизация

#### `[bw-custom-login]`
Форма входа.

#### `[bw-custom-register]`
Форма регистрации.

#### `[bw-custom-auth]`
Комбинированная форма входа и регистрации.

**Использование:**
```php
[bw-custom-login]
[bw-custom-register]
[bw-custom-auth]
```

---

### 10. Удаление аккаунта

#### `[delete_account_button]`
Кнопка удаления аккаунта пользователя.

**Использование:**
```php
[delete_account_button]
```

---

### 11. Скрыть/Показать контент

#### `[showhide]`
Скрывает контент с кнопкой "Показать больше".

**Параметры:**
- `type` - Тип контента (по умолчанию: pressrelease)
- `more_text` - Текст кнопки "Показать" (по умолчанию: "Show Press Release (%s More Words)")
- `less_text` - Текст кнопки "Скрыть" (по умолчанию: "Hide Press Release (%s Less Words)")
- `hidden` - Скрыт по умолчанию (yes/no)

**Использование:**
```php
[showhide]Ваш скрытый контент[/showhide]
[showhide hidden="no"]Видимый контент[/showhide]
```

---

### 12. HTML блоки

#### `[html_block]`
Выводит HTML блок по ID.

**Параметры:**
- `id` - ID блока

**Использование:**
```php
[html_block id="123"]
```

---

### 13. WooCommerce шорткоды

#### `[product_viewers]`
Показывает количество пользователей, просматривающих товар (автоматически добавляется на страницу товара).

#### `[sold_in_last_24_hours]`
Показывает количество проданных товаров за последние 24 часа.

**Использование:**
```php
[product_viewers]
[sold_in_last_24_hours]
```

---

## WordPress Customizer

### Панель: Theme Options

#### 1. Scroll Top (Кнопка "Наверх")

**Настройки:**
- Display - Показать/скрыть кнопку
- Width - Ширина (по умолчанию: 45px)
- Height - Высота (по умолчанию: 45px)
- Shape - Форма (circle/rounded/square)
- Position - Позиция (right/left)
- Offset Left/Right - Отступ слева/справа (по умолчанию: 20px)
- Offset Bottom - Отступ снизу (по умолчанию: 20px)
- Border Width - Ширина границы (по умолчанию: 1px)
- Border Color - Цвет границы
- Background Color - Цвет фона
- Background Color Hover - Цвет фона при наведении
- Arrow Color - Цвет стрелки

**Код получения:**
```php
<?php scroll_top(); ?>
```

---

#### 2. Analytics (Аналитика)

**Поддерживаемые сервисы:**
- Google Analytics
- Yandex Metrika
- Chat Code (онлайн-чаты)
- Remarketing Code
- Facebook Pixel
- Custom Analytics

**Для каждого сервиса:**
- Placed - Место вставки (head/body)
- Tracking Code - Код отслеживания

**Код вывода:**
```php
<?php analytics_tracking_code('head'); ?>
<?php analytics_tracking_code('body'); ?>
```

---

#### 3. Login (Страница входа)

**Настройки:**
- Logo - Логотип (80x80px)
- Background Color - Цвет фона
- Background Image - Фоновое изображение
- Image Position - Позиция изображения
- Image Size - Размер изображения (auto/contain/cover)
- Repeat Background Image - Повтор фона
- Scroll with Page - Прокрутка с страницей (scroll/fixed)

---

#### 4. Additional (Дополнительно)

**Настройки:**
- Address - Адрес
- Email - Email
- Work Schedule - График работы

**Код получения:**
```php
<?php theme_mod('bw_additional_address'); ?>
<?php theme_mod('bw_additional_email'); ?>
<?php theme_mod('bw_additional_work_schedule'); ?>
```

---

#### 5. Messenger (Мессенджеры)

**Поддерживаемые мессенджеры:**
- Skype
- Viber (без знака +)
- WhatsApp (без знака +)
- Telegram (username или номер телефона)
- Facebook (имя страницы)

**Код получения:**
```php
<?php if (has_messengers()): ?>
    <?php echo do_shortcode('[bw-messengers]'); ?>
<?php endif; ?>
```

---

#### 6. Social (Социальные сети)

**Поддерживаемые социальные сети:**
- Facebook
- Instagram
- YouTube
- TikTok
- LinkedIn
- X (Twitter)
- VK
- Odnoklassniki
- Custom One
- Custom Two
- Custom Three

**Для каждой социальной сети:**
- URL - Ссылка на профиль
- Icon - HTML код иконки (например: `<i class="fab fa-facebook"></i>`)
- Image - Ссылка на изображение иконки

**Код получения:**
```php
<?php if (has_social()): ?>
    <?php echo do_shortcode('[bw-social]'); ?>
<?php endif; ?>
```

---

#### 7. Phone (Телефоны)

**Настройки:**
- Phone 1-6 - До 6 номеров телефонов

**Код получения:**
```php
<?php if (has_phones()): ?>
    <?php echo do_shortcode('[bw-phone]'); ?>
<?php endif; ?>
```

---

#### 8. Sticky Header (Липкая шапка)

**Настройки:**
- Enable - Включить липкую шапку
- Auto Hide - Автоматическое скрытие

**Код получения:**
```php
<header class="header <?php sticky_header(); ?>">
    <!-- Содержимое шапки -->
</header>
```

---

## Вспомогательные функции (Helpers)

### Телефоны

```php
// Получить очищенный номер телефона для href="tel:"
get_phone_number($phone_number);
the_phone_number($phone_number);

// Проверить наличие телефонов
has_phones();

// Получить массив телефонов
get_phones();
```

**Пример использования:**
```php
<?php if (has_phones()): ?>
    <ul class="phone">
        <?php foreach (get_phones() as $phone): ?>
            <li>
                <a href="tel:<?php echo get_phone_number($phone); ?>">
                    <?php echo $phone; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

---

### Социальные сети

```php
// Проверить наличие социальных сетей
has_social();

// Получить массив социальных сетей
get_social();
```

**Пример использования:**
```php
<?php if (has_social()): ?>
    <ul class="social">
        <?php foreach (get_social() as $name => $social): ?>
            <li class="social-item">
                <a href="<?php echo esc_url($social['url']); ?>" 
                   class="social-link social-<?php echo esc_attr($name); ?>" 
                   target="_blank" 
                   rel="nofollow noopener">
                    <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

---

### Мессенджеры

```php
// Проверить наличие мессенджеров
has_messengers();

// Получить массив мессенджеров
get_messengers();
```

**Пример использования:**
```php
<?php if (has_messengers()): ?>
    <ul class="messenger">
        <?php foreach (get_messengers() as $name => $messenger): ?>
            <li class="messenger-item">
                <a href="<?php echo esc_attr($messenger['tel']); ?>" 
                   class="messenger-link messenger-<?php echo esc_attr($name); ?>" 
                   target="_blank">
                    <i class="<?php echo esc_attr($messenger['icon']); ?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

---

### Логотип

```php
// Вывести логотип сайта
get_default_logo_link($args);
```

**Параметры:**
```php
$args = [
    'name' => 'logo.svg',  // Имя файла логотипа
    'options' => [
        'class' => 'logo-img',
        'width' => null,
        'height' => null,
    ]
];
```

**Пример использования:**
```php
<?php get_default_logo_link([
    'name' => 'logo.svg',
    'options' => [
        'class' => 'logo-img',
        'width' => '150',
        'height' => '50',
    ]
]); ?>
```

---

### SVG Sprite

```php
// Получить SVG спрайт
get_svg_sprite();
svg_sprite();
```

**Пример использования:**
```php
<?php svg_sprite(); ?>
```

---

### WooCommerce

```php
// Вывести иконку корзины с количеством товаров
woocommerce_cart();

// Получить общую стоимость корзины
woocommerce_get_total_price();

// Вывести всплывающую корзину
woocommerce_cart_popup();
```

**Пример использования:**
```php
<?php if (class_exists('WooCommerce')): ?>
    <div class="header-cart">
        <?php woocommerce_cart(); ?>
    </div>
<?php endif; ?>
```

---

### Отладка

```php
// Вывести информацию о переменной
dump($expression);

// Вывести информацию и остановить выполнение
dd($expression);
```

---

## Хуки и фильтры

### Actions (Действия)

```php
// После настройки темы
add_action('after_setup_theme', 'function_name');

// Инициализация
add_action('init', 'function_name');

// Подключение скриптов и стилей
add_action('wp_enqueue_scripts', 'function_name');

// Инициализация виджетов
add_action('widgets_init', 'function_name');

// Футер админки
add_action('admin_footer_text', 'function_name');

// Инициализация админки
add_action('admin_init', 'function_name');

// WooCommerce
add_action('woocommerce_single_product_summary', 'function_name', 15);
add_action('woocommerce_before_add_to_cart_quantity', 'function_name');
add_action('woocommerce_after_add_to_cart_quantity', 'function_name');
```

### Filters (Фильтры)

```php
// Длина отрывка
add_filter('excerpt_length', function() {
    return 25;
});

// Разрешенные протоколы
add_filter('kses_allowed_protocols', 'function_name');

// Типы файлов для загрузки
add_filter('upload_mimes', 'function_name');

// Перевод текста
add_filter('gettext', 'function_name');
add_filter('ngettext', 'function_name');

// WooCommerce
add_filter('posts_clauses', 'function_name', 2000);
add_filter('woocommerce_single_product_image_thumbnail_html', 'function_name', 10, 2);
```

---

## Мета-боксы

### Для записей (Posts)

**Meta Box: "Дополнительно"**
- `on-front` - Показывать на главной (checkbox)

### Для страниц (Pages)

**Meta Box: "Дополнительно"**
- Декоративное изображение (image upload)

---

## Breadcrumbs (Хлебные крошки)

**Функция:**
```php
bw_breadcrumbs();
```

**Использование:**
```php
<?php if (function_exists('bw_breadcrumbs')): ?>
    <?php bw_breadcrumbs(); ?>
<?php endif; ?>
```

**Поддержка:**
- Главная страница
- Страницы
- Записи
- Категории
- Теги
- Архивы
- Поиск
- 404
- WooCommerce (товары, категории)
- Кастомные типы записей

---

## Пагинация

### Пагинация архивов

```php
bw_index_pagination();
```

**Использование:**
```php
<?php bw_index_pagination(); ?>
```

### Пагинация внутри записи

```php
bw_split_post_pagination();
```

**Использование:**
```php
<?php bw_split_post_pagination(); ?>
```

---

## Поддержка GIF для WooCommerce

Тема автоматически поддерживает GIF-изображения для товаров WooCommerce:
- Отключает создание миниатюр для GIF
- Использует оригинальный GIF в каталоге товаров
- Использует оригинальный GIF на странице товара

---

## Интеграция с Polylang

Тема полностью интегрирована с плагином Polylang для многоязычности:

**Зарегистрированные строки:**
- Email
- Address
- Work Schedule
- Социальные сети (Vk, Twitter, YouTube, Facebook, LinkedIn, Instagram, TikTok, Odnoklassniki)

**Использование:**
```php
<?php if (function_exists('pll_e')): ?>
    <?php pll_e('Email'); ?>
<?php endif; ?>
```

---

## Безопасность

### Ограничения загрузки файлов

- SVG файлы могут загружать только администраторы
- Автоматическая очистка HTML в описаниях терминов

### Редиректы

- Не-администраторы перенаправляются на главную при попытке доступа к админ-панели
- Пользователи перенаправляются на `/user/` вместо админ-панели

### Скрытие админ-бара

- Админ-бар скрыт для подписчиков
- Админ-бар скрыт для пользователей без прав редактирования

---

## Оптимизация

### Отключенные функции

- Gutenberg стили (wp-block-library)
- Автоматическое удаление из корзины
- Yoast автоматические редиректы

### Кэширование

- Кэширование количества проданных товаров (24 часа)

---

## Кастомизация

### CSS классы

**Утилиты:**
- `.hide-on-mobile` - Скрыть на мобильных
- `.hide-on-tablet` - Скрыть на планшетах
- `.hide-on-desktop` - Скрыть на десктопе
- `.text-center` - Выравнивание по центру
- `.text-left` - Выравнивание по левому краю
- `.text-right` - Выравнивание по правому краю
- `.text-uppercase` - Верхний регистр
- `.text-bold` - Жирный текст
- `.brand-color-1` - Цвет бренда #28325D
- `.brand-color-2` - Цвет бренда #BB2440
- `.shadow` - Тень
- `.is-loading` - Индикатор загрузки

**Отступы:**
- `.mrgn-bot-10`, `.mrgn-bot-15`, `.mrgn-bot-20`, `.mrgn-bot-30` - Отступ снизу
- `.mrgn-top-10`, `.mrgn-top-15`, `.mrgn-top-20`, `.mrgn-top-30` - Отступ сверху
- `.mrgn-r-10`, `.mrgn-r-15`, `.mrgn-r-20`, `.mrgn-r-30` - Отступ справа
- `.mrgn-l-10`, `.mrgn-l-15`, `.mrgn-l-20`, `.mrgn-l-30` - Отступ слева

---

## Готовые сниппеты кода для разработчиков

Этот раздел содержит готовые к использованию фрагменты кода, которые можно скопировать в вашу тему без поиска во внешних источниках.

### 1. Отмена автоматического удаления из корзины

WordPress автоматически удаляет записи из корзины через 30 дней. Этот код отменяет это поведение.

```php
/**
 * Отменяет автоматическое удаление из корзины через определенный срок
 * Добавьте в functions.php
 */
function devise_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'devise_remove_schedule_delete' );
```

---

### 2. Поддержка GIF для WooCommerce

Полная поддержка анимированных GIF для товаров WooCommerce (отключает создание миниатюр и использует оригинальный GIF).

```php
/**
 * Поддержка GIF для обложек товаров WooCommerce
 * Добавьте в functions.php
 */

// Отключаем обработку миниатюр для GIF
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

// Используем оригинальный GIF вместо миниатюр в каталоге товаров
function replace_gif_in_shop($image, $post_id, $size, $attr) {
    $thumbnail_id = get_post_thumbnail_id($post_id);
    if (!$thumbnail_id) {
        return $image;
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
```

---

### 3. Перемещение закончившихся товаров в конец списка (WooCommerce)

Автоматически перемещает товары "Нет в наличии" в конец каталога.

```php
/**
 * WooCommerce: Перемещает закончившиеся товары в конец
 * Добавьте в functions.php
 */
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
```

---

### 4. Кнопки +/- для выбора количества товара (WooCommerce)

Добавляет кнопки увеличения/уменьшения количества товара на странице товара.

```php
/**
 * Добавляет кнопки + и - для выбора количества товаров
 * Добавьте в functions.php
 */
add_action( 'woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign' );
function ts_quantity_plus_sign() {
    echo '<button type="button" class="plus" >+</button></div>';
}

add_action( 'woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign' );
function ts_quantity_minus_sign() {
    echo '<div class="qua-custom"><button type="button" class="minus" >-</button>';
}

add_action( 'wp_footer', 'ts_quantity_plus_minus' );
function ts_quantity_plus_minus() {
    if ( function_exists( 'is_product' ) && ! is_product() ) return;
    ?>
    <script type="text/javascript">
        window.onload = function () {
            jQuery(document).ready(function($){
                $('.cart .qty.text').attr('type', 'text');
                $('form.cart').on( 'click', 'button.plus, button.minus', function() {
                    var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
                    var val = parseFloat(qty.val());
                    var max = parseFloat(qty.attr( 'max' ));
                    var min = parseFloat(qty.attr( 'min' ));
                    var step = parseFloat(qty.attr( 'step' ));

                    if ( $( this ).is( '.plus' ) ) {
                        if ( max && ( max <= val ) ) {
                            qty.val( max );
                        } else {
                            qty.val( val + step );
                        }
                    } else {
                        if ( min && ( min >= val ) ) {
                            qty.val( min );
                        } else if ( val > 1 ) {
                            qty.val( val - step );
                        }
                    }
                });
            });
        }
    </script>
    <?php
}
```

**CSS для кнопок:**
```css
.qua-custom {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qua-custom button.minus,
.qua-custom button.plus {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    background: #f5f5f5;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
}

.qua-custom button:hover {
    background: #e0e0e0;
}
```

---

### 5. Разрешить загрузку SVG только администраторам

Безопасная загрузка SVG файлов только для администраторов.

```php
/**
 * Разрешить загрузку SVG только администраторам
 * Добавьте в functions.php
 */
function allow_svg_uploads_for_admins($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads_for_admins');
```

---

### 6. Скрыть админ-бар для не-администраторов

Скрывает верхнюю панель WordPress для пользователей без прав редактирования.

```php
/**
 * Скрывает топ-бар для подписчиков и пользователей без прав редактирования
 * Добавьте в functions.php
 */

// Скрыть для не-администраторов
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}

// Скрыть для пользователей без прав редактирования
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}
```

---

### 7. Удалить стили Gutenberg (блочного редактора)

Отключает загрузку стилей Gutenberg на фронтенде для ускорения сайта.

```php
/**
 * Удаляет стили Gutenberg на фронтенде
 * Добавьте в functions.php
 */
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css' );
```

---

### 8. Изменить текст в подвале админки

Заменяет стандартный текст "Спасибо за работу с WordPress" на кастомный.

```php
/**
 * Замена текста в подвале админки
 * Добавьте в functions.php
 */
function custom_admin_footer_text() {
    return __('Created with love by <a href="https://yoursite.com/" target="_blank">Your Company</a>', 'yourtheme');
}
add_filter('admin_footer_text', 'custom_admin_footer_text');
```

---

### 9. Редирект не-администраторов из админ-панели

Перенаправляет обычных пользователей на кастомную страницу вместо админ-панели.

```php
/**
 * Если пользователь не админ, перенаправляет на кастомную страницу
 * Добавьте в functions.php
 */
add_action('admin_init', 'redirect_non_admin_users');

function redirect_non_admin_users() {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        
        // Если пользователь не администратор и это не AJAX-запрос
        if (!in_array('administrator', $user->roles) && !defined('DOING_AJAX')) {
            wp_redirect(home_url('/user/')); // Перенаправляем на кастомную страницу
            exit;
        }
    }
}
```

---

### 10. Разрешить HTML в описаниях категорий и меток

Позволяет использовать HTML-код в описаниях таксономий (категорий, меток).

```php
/**
 * Разрешить HTML в описаниях терминов (категории, метки)
 * Добавьте в functions.php
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
```

---

### 11. Отключить автоматические редиректы Yoast SEO

Отменяет создание автоматических редиректов при изменении URL страницы/записи.

```php
/**
 * Плагин Yoast: отменяет создание автоматических редиректов
 * Добавьте в functions.php
 */
add_filter('wpseo_premium_post_redirect_slug_change', '__return_true' );
```

---

### 12. Изменить длину отрывка (excerpt)

Устанавливает количество слов в автоматическом отрывке.

```php
/**
 * Длина отрывка статьи (25 слов)
 * Добавьте в functions.php
 */
add_filter( 'excerpt_length', function(){
    return 25;
} );
```

---

### 13. Добавить поддержку excerpt для страниц

Включает поле "Отрывок" для страниц (по умолчанию доступно только для записей).

```php
/**
 * Добавляем поддержку excerpt (цитат) для страниц
 * Добавьте в functions.php
 */
function bw_enable_page_excerpt() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'bw_enable_page_excerpt' );
```

---

### 14. Разрешить дополнительные протоколы в ссылках

Добавляет поддержку протоколов Viber и Skype в ссылках.

```php
/**
 * Разрешить протоколы viber: и skype: в ссылках
 * Добавьте в functions.php
 */
add_filter( 'kses_allowed_protocols', function ( $protocols ) {
    $protocols[] = 'viber';
    $protocols[] = 'skype';
    return $protocols;
} );
```

---

### 15. Перевод текста в WooCommerce

Изменяет перевод определенных слов в WooCommerce (например, "Подытог" на "Итого").

```php
/**
 * Изменение перевода для WooCommerce
 * Добавьте в functions.php
 */
add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');

function translate_text($translated) {
    $translated = str_ireplace('Подытог', 'Итого', $translated);
    return $translated;
}
```

---

### 16. Переместить описание категории под товары (WooCommerce)

Перемещает описание категории из верхней части страницы вниз, под список товаров.

```php
/**
 * Перемещает описание категории под товары
 * Добавьте в functions.php
 */
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 100 );
```

---

### 17. Вывести изображение категории WooCommerce

Автоматически выводит изображение категории на странице архива категории.

```php
/**
 * Вывести изображение категории на странице архива
 * Добавьте в functions.php
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
```

---

### 18. Кэширование данных с помощью Transients API

Пример кэширования случайного числа на 24 часа (используется для отображения количества продаж).

```php
/**
 * Кэширование данных с помощью WordPress Transients API
 * Пример: кэширование количества продаж на 24 часа
 */
function get_cached_sales_count() {
    global $post;
    
    if (!$post) return '';
    
    $product_id = $post->ID;
    $transient_key = 'sales_count_' . $product_id;
    
    // Проверяем, есть ли уже сохраненное значение
    $sales_count = get_transient($transient_key);
    
    if ($sales_count === false) {
        // Если нет, генерируем и кэшируем на 24 часа
        $sales_count = rand(5, 30);
        set_transient($transient_key, $sales_count, DAY_IN_SECONDS);
    }
    
    return $sales_count;
}
```

---

### 19. Удалить заголовок title из header.php

Удаляет автоматический вывод тега `<title>` (полезно, если используете кастомный вывод).

```php
/**
 * Удаляет тег title из header.php
 * Добавьте в functions.php
 */
remove_action( 'wp_head', '_wp_render_title_tag', 1 );
```

---

### 20. Регистрация строк для Polylang

Регистрирует строки для перевода в плагине Polylang.

```php
/**
 * Регистрация строк для перевода в Polylang
 * Добавьте в functions.php
 */
add_action( 'after_setup_theme', function () {
    if ( function_exists( 'pll_register_string' ) ) {
        pll_register_string( 'email', 'Email', 'YourTheme' );
        pll_register_string( 'address', 'Address', 'YourTheme' );
        pll_register_string( 'work-schedule', 'Work Schedule', 'YourTheme' );
        pll_register_string( 'social-facebook', 'Facebook', 'YourTheme' );
        pll_register_string( 'social-instagram', 'Instagram', 'YourTheme' );
        pll_register_string( 'social-youtube', 'YouTube', 'YourTheme' );
    }
} );
```

---

## Создание аналогичной темы

### Шаг 1: Структура файлов

Создайте следующую структуру:

```
your-theme/
├── style.css
├── functions.php
├── index.php
├── header.php
├── footer.php
├── sidebar.php
├── inc/
│   ├── setup.php
│   ├── enqueues.php
│   ├── customizer.php
│   ├── widgets.php
│   ├── shortcodes.php
│   ├── helpers.php
│   ├── custom-post-types.php
│   ├── breadcrumbs.php
│   ├── cleanup.php
│   └── navbar.php
└── assets/
    ├── css/
    ├── js/
    └── img/
```

### Шаг 2: style.css

```css
/*
Theme Name: Your Theme Name
Theme URI: https://yoursite.com
Text Domain: yourtheme
Author: Your Name
Author URI: https://yoursite.com
Version: 1.0.0
Tags: one-column, two-columns, full-width-template
*/
```

### Шаг 3: functions.php

```php
<?php
// Подключение файлов
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueues.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/breadcrumbs.php';
```

### Шаг 4: inc/setup.php

```php
<?php
function theme_setup() {
    // Поддержка заголовков
    add_theme_support('title-tag');
    
    // Поддержка миниатюр
    add_theme_support('post-thumbnails');
    
    // Поддержка HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Регистрация меню
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'yourtheme'),
    ));
    
    // Поддержка WooCommerce
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'theme_setup');
```

### Шаг 5: inc/enqueues.php

```php
<?php
function theme_enqueue_scripts() {
    // Стили
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    
    // Скрипты
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
```

### Шаг 6: inc/widgets.php

```php
<?php
function theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'yourtheme'),
        'id' => 'sidebar-1',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');
```

### Шаг 7: inc/customizer.php

```php
<?php
function theme_customize_register($wp_customize) {
    // Добавление секции
    $wp_customize->add_section('theme_options', array(
        'title' => __('Theme Options', 'yourtheme'),
        'priority' => 30,
    ));
    
    // Добавление настройки
    $wp_customize->add_setting('phone_number', array(
        'default' => '',
    ));
    
    // Добавление контрола
    $wp_customize->add_control('phone_number', array(
        'label' => __('Phone Number', 'yourtheme'),
        'section' => 'theme_options',
        'type' => 'text',
    ));
}
add_action('customize_register', 'theme_customize_register');
```

### Шаг 8: inc/shortcodes.php

```php
<?php
// Шорткод для вывода телефона
function phone_shortcode($atts) {
    $phone = get_theme_mod('phone_number');
    if (!$phone) return '';
    
    return sprintf(
        '<a href="tel:%s">%s</a>',
        str_replace(array('-', '(', ')', ' '), '', $phone),
        $phone
    );
}
add_shortcode('phone', 'phone_shortcode');

// Шорткод для вывода социальных сетей
function social_shortcode($atts) {
    $facebook = get_theme_mod('facebook_url');
    $instagram = get_theme_mod('instagram_url');
    
    $output = '<ul class="social">';
    
    if ($facebook) {
        $output .= sprintf(
            '<li><a href="%s" target="_blank"><i class="fab fa-facebook"></i></a></li>',
            esc_url($facebook)
        );
    }
    
    if ($instagram) {
        $output .= sprintf(
            '<li><a href="%s" target="_blank"><i class="fab fa-instagram"></i></a></li>',
            esc_url($instagram)
        );
    }
    
    $output .= '</ul>';
    
    return $output;
}
add_shortcode('social', 'social_shortcode');
```

### Шаг 9: inc/helpers.php

```php
<?php
// Очистка номера телефона
function get_phone_number($phone) {
    return str_replace(array('-', '(', ')', ' '), '', $phone);
}

// Проверка наличия телефонов
function has_phones() {
    return (bool) get_theme_mod('phone_number');
}

// Получение массива социальных сетей
function get_social() {
    $socials = array();
    
    $facebook = get_theme_mod('facebook_url');
    $instagram = get_theme_mod('instagram_url');
    
    if ($facebook) {
        $socials['facebook'] = array(
            'url' => $facebook,
            'icon' => 'fab fa-facebook',
        );
    }
    
    if ($instagram) {
        $socials['instagram'] = array(
            'url' => $instagram,
            'icon' => 'fab fa-instagram',
        );
    }
    
    return $socials;
}
```

### Шаг 10: inc/custom-post-types.php

```php
<?php
function register_custom_post_types() {
    // Регистрация типа записи "Отзывы"
    register_post_type('reviews', array(
        'labels' => array(
            'name' => __('Reviews', 'yourtheme'),
            'singular_name' => __('Review', 'yourtheme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
    ));
}
add_action('init', 'register_custom_post_types');
```

---

## Заключение

Эта документация охватывает все основные функции и возможности темы BrainWorks. Используйте её как руководство для создания аналогичной темы или для кастомизации существующей.

**Основные преимущества темы:**
- ✅ Полная интеграция с WooCommerce
- ✅ Поддержка многоязычности (Polylang)
- ✅ Расширенный WordPress Customizer
- ✅ Множество готовых шорткодов
- ✅ Кастомные типы записей
- ✅ Гибкая система виджетов
- ✅ SEO-оптимизация
- ✅ Адаптивный дизайн
- ✅ Поддержка современных стандартов WordPress

**Для разработчиков:**
- Чистый и понятный код
- Хорошая документация
- Модульная структура
- Использование хуков и фильтров WordPress
- Следование стандартам кодирования WordPress
