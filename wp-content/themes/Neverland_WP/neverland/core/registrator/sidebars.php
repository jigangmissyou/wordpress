<?php

if (function_exists('register_sidebar')) {

    #default values
    $register_sidebar_attr = array(
        'description' => __('Add the widgets appearance for Custom Sidebar. Drag the widget from the available list on the left, configure widgets options and click Save button. Select the sidebar on the posts or pages in just few clicks.', 'gt3_theme_localization'),
        'before_widget' => '<div class="sidepanel %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="title">',
        'after_title' => '</h4>'
    );

    #REGISTER DEFAULT SIDEBARS
    $register_sidebar_attr['name'] = "Default";
    $register_sidebar_attr['id'] = 'page-sidebar-1';
    register_sidebar($register_sidebar_attr);

}