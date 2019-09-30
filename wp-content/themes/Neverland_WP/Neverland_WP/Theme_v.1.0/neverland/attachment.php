<?php
get_header();
the_post();
$post_options = get_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', true);
$sidebar_position = (isset($post_options['sidebar_position']) ? (($post_options['sidebar_position'] !== 'default') ? $post_options['sidebar_position'] : get_theme_mod('default_sidebar_position')) : get_theme_mod('default_sidebar_position'));
?>
    <div class="container content <?php echo $sidebar_position; ?>">
        <div class="row">
            <div
                class="content_block <?php echo(($sidebar_position == 'right_sidebar' || $sidebar_position == 'left_sidebar') ? 'span9' : 'span12'); ?>">
                <?php
                if (has_post_thumbnail()) {
                    echo '<div class="post_featured_image"><img src="' . wp_get_attachment_url(get_post_thumbnail_id($post->ID)) . '" alt=""></div>';
                }

                if ((!isset($post_options['title'])) || (isset($post_options['title']) && $post_options['title'] == 'show')) {
                    ?>
                    <div class="entry-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <?php
                }
                ?>
                <div class="tiny_contentarea">
                    <?php
                    the_content(__('Read more!', 'gt3_theme_localization'));
                    wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'gt3_theme_localization') . ': ', 'after' => '</div>'));
                    ?>
                </div>
                <?php comments_template(); ?>
            </div>
            <?php get_sidebar('left'); ?>
            <?php get_sidebar('right'); ?>
        </div>
    </div>

<?php
get_footer();