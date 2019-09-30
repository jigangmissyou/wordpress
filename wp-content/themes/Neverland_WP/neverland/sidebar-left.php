<?php
if (is_active_sidebar('page-sidebar-1')) {
    global $post_options;
    $sidebar_position = (isset($post_options['sidebar_position']) ? (($post_options['sidebar_position'] !== 'default') ? $post_options['sidebar_position'] : get_theme_mod('default_sidebar_position')) : get_theme_mod('default_sidebar_position'));

    if ($sidebar_position == 'left_sidebar') {
        echo "<div class='span3 left-sidebar-block'>";
        dynamic_sidebar("Default");
        echo "</div>";
    }
}