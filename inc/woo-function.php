<?php

function bw_woocommerce_setup()
{
    // Проверяем, активен ли плагин WooCommerce
    if (class_exists('WooCommerce')) {

        /**
         * Добавляет поддержку WooCommerce для темы.
         */
        add_theme_support('woocommerce');

        /**
         * Добавляет обёртку для сортировки и переключения вида товаров.
         */
        add_action('woocommerce_before_shop_loop', 'sort_view_start', 29);
        add_action('woocommerce_before_shop_loop', 'sort_view_end', 40);

        /**
         * Добавляет обёртку для верхней части страницы магазина.
         */
        add_action('woocommerce_before_shop_loop', 'top_wrapper_start', 15);
        add_action('woocommerce_before_shop_loop', 'top_wrapper_end', 45);
    }
}

add_action('after_setup_theme', 'bw_woocommerce_setup');

/**
 * Начало обёртки для сортировки и переключения вида товаров.
 */
function sort_view_start()
{ ?>
    <div class="wrapper-top-ordering d-flex">
    <?php }

/**
 * Конец обёртки для сортировки и переключения вида товаров.
 */
function sort_view_end()
{ ?>
        <div class="wrapper-top-btns bw-view-switcher">
            <button class="bw-view-grid active" aria-label="Сетка"><i class="fas fa-th"></i></button>
            <button class="bw-view-list" aria-label="Список"><i class="fas fa-bars"></i></button>
        </div>
    </div>
<?php }

/**
 * Начало обёртки для верхней части страницы магазина.
 */
function top_wrapper_start()
{ ?>
    <div class="wrapper-top d-flex">
    <?php }

/**
 * Конец обёртки для верхней части страницы магазина.
 */
function top_wrapper_end()
{ ?>
    </div>
<?php }
