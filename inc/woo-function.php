<?php

// Проверяем, активен ли плагин WooCommerce
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    /**
     * Добавляет поддержку WooCommerce для темы.
     */
    function mytheme_add_woocommerce_support() {
        add_theme_support('woocommerce');
    }

    add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

    /**
     * Добавляет обёртку для сортировки и переключения вида товаров.
     */
    add_action('woocommerce_before_shop_loop', 'sort_view_start', 29);
    add_action('woocommerce_before_shop_loop', 'sort_view_end', 40);

    /**
     * Начало обёртки для сортировки и переключения вида товаров.
     */
    function sort_view_start() { ?>
        <div class="wrapper-top-ordering d-flex">
    <?php }

    /**
     * Конец обёртки для сортировки и переключения вида товаров.
     */
    function sort_view_end() { ?>
        <div class="wrapper-top-btns">
            <?php echo do_shortcode('[br_grid_list]'); // Шорткод для переключения вида (сетка/список) ?>
        </div>
        </div>
    <?php }

    /**
     * Добавляет обёртку для верхней части страницы магазина.
     */
    add_action('woocommerce_before_shop_loop', 'top_wrapper_start', 15);
    add_action('woocommerce_before_shop_loop', 'top_wrapper_end', 45);

    /**
     * Начало обёртки для верхней части страницы магазина.
     */
    function top_wrapper_start() { ?>
        <div class="wrapper-top d-flex">
    <?php }

    /**
     * Конец обёртки для верхней части страницы магазина.
     */
    function top_wrapper_end() { ?>
        </div>
    <?php }

} ?>
