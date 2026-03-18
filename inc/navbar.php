<?php

function bw_register_nav_menus() {
    register_nav_menus(array(
        'main-nav' => __('Main Navigation', 'brainworks'),
        'second-menu' => __('Second Menu', 'brainworks'),
        'language-switcher' => __('Language switcher', 'brainworks'),
    ));
}
add_action('after_setup_theme', 'bw_register_nav_menus');
