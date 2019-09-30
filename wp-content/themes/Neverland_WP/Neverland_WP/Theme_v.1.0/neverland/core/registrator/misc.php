<?php
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails', array('post', 'page', 'port', 'team', 'testimonials', 'partners'));
    add_theme_support('automatic-feed-links');
    add_theme_support('revisions');

    add_theme_support('post-formats', array('image', 'video', 'link', 'quote', 'audio'));
}

#Support menus
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'main_menu' => 'Main menu'
        )
    );
}

#Enable shortcodes in sidebar
add_filter('widget_text', 'do_shortcode');

#ADD localization folder
add_action('init', 'enable_pomo_translation');
function enable_pomo_translation()
{
    load_theme_textdomain('gt3_theme_localization', get_template_directory() . '/core/languages/');
}