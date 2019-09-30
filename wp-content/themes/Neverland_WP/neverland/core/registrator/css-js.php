<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("gt3_owl_css", get_template_directory_uri() . '/css/owl.carousel.css');
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');

        #JS
        wp_enqueue_script("jquery");
        wp_enqueue_script('gt3_owl_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');

    wp_enqueue_style("gt3_admin", get_template_directory_uri() . '/css/admin.css');
    wp_enqueue_script('gt3_admin_js', get_template_directory_uri() . '/js/admin.js', array(), false, true);
}