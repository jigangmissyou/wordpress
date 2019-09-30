<?php
get_header();
$sidebar_position = get_theme_mod('default_sidebar_position');
?>
    <div class="container content <?php echo $sidebar_position; ?>">
        <div class="row">
            <div
                class="content_block <?php echo(($sidebar_position == 'right_sidebar' || $sidebar_position == 'left_sidebar') ? 'span9' : 'span12'); ?>">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('loop');
                    }
                    gt3_get_theme_pagination();
                } else {
                    echo '
                    <div class="tiny_contentarea">
                        <h1>' . __('Nothing Found!', 'gt3_theme_localization') . '</h1>';
                    get_search_form(true);
                    echo '
                    </div>
                    ';

                }
                ?>
            </div>
            <?php
            get_sidebar('left');
            get_sidebar('right');
            ?>
        </div>
    </div>
<?php

get_footer();