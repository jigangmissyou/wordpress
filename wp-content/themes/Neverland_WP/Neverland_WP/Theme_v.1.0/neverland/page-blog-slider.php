<?php
/*
Template Name: Blog (Grid)
*/
//wp_enqueue_script('gt3_masonry_js', get_template_directory_uri() . '/js/masonry.js', array(), false, true);
get_header();
the_post();

$post_options = get_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', true);
$sidebar_position = (isset($post_options['sidebar_position']) ? (($post_options['sidebar_position'] !== 'default') ? $post_options['sidebar_position'] : get_theme_mod('default_sidebar_position')) : get_theme_mod('default_sidebar_position'));
if (isset($post_options['posts_in_a_row']) && $post_options['posts_in_a_row'] == 3) {
    $posts_in_row = 3;
    $posts_in_row_span = 4;
} elseif (isset($post_options['posts_in_a_row']) && $post_options['posts_in_a_row'] == 1) {
    $posts_in_row = 1;
    $posts_in_row_span = 12;
} else {
    $posts_in_row = 2;
    $posts_in_row_span = 6;
}
if (isset($post_options['show_style']) && $post_options['show_style'] == 'masonry') {
    $show_style_class = 'masonry_style';
} else {
    $show_style_class = '';
}
?>

    <div class="container blog_grid_style content <?php echo $sidebar_position . ' ' . $show_style_class; ?>">
        <div class="row">
            <div
                class="content_block <?php echo(($sidebar_position == 'right_sidebar' || $sidebar_position == 'left_sidebar') ? 'span9' : 'span12'); ?>">
                <?php
                if ((!isset($post_options['title'])) || (isset($post_options['title']) && $post_options['title'] == 'show')) {
                    ?>
                    <div class="entry-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <?php
                }

                the_content();

                if (is_front_page()) {
                    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                } else {
                    global $paged;
                }


                $args = array(
                    'posts_per_page' => ((isset($post_options['posts_count']) && $post_options['posts_count']) ? $post_options['posts_count'] : '6'),
                    'post_type' => 'post',
                    'paged' => $paged,
                    'post_status' => 'publish'
                );

                $wp_query2 = new WP_Query();
                $wp_query2->query($args);
                $posti = 1;
                $posti_all = 1;

                echo '<div class="posts_container clearfix">';
                while ($wp_query2->have_posts()) {
                    $wp_query2->the_post();
                    if ($posti == 1 && $show_style_class !== 'masonry_style') {
                        echo '<div class="row">';
                    }
                    echo '<div class="help_class span' . $posts_in_row_span . '">';
                    if ($show_style_class == 'masonry_style') {
                        get_template_part('loop-masonry');
                    } else {
                        get_template_part('loop-grid');
                    }
                    echo '</div>';
                    if ($posti >= $posts_in_row && $show_style_class !== 'masonry_style') {
                        echo '</div>';
                        $posti = 0;
                    }
                    if ($posti !== 0 && $posti_all == $wp_query2->post_count && $show_style_class !== 'masonry_style') {
                        echo '</div>';
                    }
                    $posti++;
                    $posti_all++;
                }
                echo '</div>';
                gt3_get_theme_pagination('query2');
                wp_reset_postdata();
                comments_template();
                ?>
            </div>
            <?php
            get_sidebar('left');
            get_sidebar('right');
            ?>
        </div>
    </div>

	<!--
    <script>
        jQuery(window).load(function () {
            if (jQuery('div').hasClass('right_sidebar') || jQuery('div').hasClass('left_sidebar')) {
                if (jQuery('.help_class').hasClass('span4')) {
                    var gutterWidth = 28;
                } else {
                    var gutterWidth = 30;
                }
            } else {
                var gutterWidth = 40;
            }
            jQuery('.masonry_style .content_block .posts_container').masonry({
                itemSelector: '.help_class',
                gutterWidth: gutterWidth
            });
            jQuery('.masonry_style .content_block .posts_container').css('opacity', '1');
        });
    </script>
	-->

<?php
get_footer();