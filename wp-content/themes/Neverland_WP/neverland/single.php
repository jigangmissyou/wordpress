<?php
get_header();
the_post();
$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
$post_options = get_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', true);
$sidebar_position = (isset($post_options['sidebar_position']) ? (($post_options['sidebar_position'] !== 'default') ? $post_options['sidebar_position'] : get_theme_mod('default_sidebar_position')) : get_theme_mod('default_sidebar_position'));
?>
    <div class="container content <?php echo $sidebar_position; ?>">
        <div <?php post_class('row'); ?>>
            <div class="content_block <?php echo (($sidebar_position == 'right_sidebar' || $sidebar_position == 'left_sidebar') ? 'span9' : 'span12'); ?>">
                <?php echo gt3_get_post_formats(); ?>
                <div class="the_category">
                    <?php the_category(' '); ?>
                </div>
                <?php
                if ((!isset($post_options['title'])) || (isset($post_options['title']) && $post_options['title'] == 'show')) {
                    ?>
                    <div class="entry-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <?php
                }
                ?>
                <div class="post_meta">
                    <div class="meta_dib"><?php echo get_the_time("M d, Y"); ?></div>
                    <div
                        class="meta_dib"><?php echo __('by', 'gt3_theme_localization') . ' <a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a>'; ?></div>
                    <div
                        class="meta_dib"><?php echo '<a href="' . get_comments_link() . '">Comments</a>: ' . get_comments_number(get_the_ID()); ?></div>
                    <?php the_tags(__('<div class="meta_dib">Tags: ', 'gt3_theme_localization'), ', ', '</div>'); ?>
                </div>
                <div class="tiny_contentarea">
                    <?php
                    the_content(__('Read more!', 'gt3_theme_localization'));
                    wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'gt3_theme_localization') . ': ', 'after' => '</div>'));
                    ?>
                </div>
                <div class="dn"><?php posts_nav_link(); ?></div>
				<div class="share_block">
					<a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
					   class=""><i class="fa fa-facebook-square"></i></a>
					<a target="_blank"
					   href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
					   class=""><i class="fa fa-twitter-square"></i></a>
					<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
					   class=""><i class="fa fa-google-plus-square"></i></a>
					<a target="_blank"
					   href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image_url) > 0) ? $featured_image_url : get_theme_mod('logo_upload', IMGURL . '/logo.png'); ?>"
					   class=""><i class="fa fa-pinterest-square"></i></a>
				</div>
                <div class="featured_items">
                    <div class="row">
                        <?php
                        $args = array(
                            'posts_per_page' => 2,
                            'offset' => 0,
                            'orderby' => 'rand',
                            'post_type' => 'post',
                            'ignore_sticky_posts' => 1,
                            'post_status' => 'publish'
                        );

                        $wp_query2 = new WP_Query();
                        $wp_query2->query($args);
                        while ($wp_query2->have_posts()) {
                            $wp_query2->the_post();
                            $featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
							$featured_image = '<a href="' . get_permalink() . '"><img class="tac" src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 570, 430, true, true, true) . '" alt=""></a>';

                            echo '
							<div class="span6">
								<div class="stand_post">';
								if (has_post_thumbnail()) {
									echo '<div class="postformats_cont gt3_pf_image">' . $featured_image . '</div>';
								}
								echo '
									<div class="post_content">
										<div class="the_category">';
											the_category(' ');
										echo '
										</div>
										<div class="entry-title">
											<a href="' . get_permalink() . '"><h1>' . get_the_title() . '</h1></a>
										</div>
										<div class="post_excerpt">
										' . apply_filters("the_content", to_excerpt(strip_shortcodes(get_the_content()), 23)) . '
										</div>
										<div class="post_meta">
											<div class="meta_dib">' . get_the_time("M d, Y") . '</div>
											<div class="meta_dib"><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></div>
											<div class="meta_dib"><a href="' . get_comments_link() . '">' . get_comments_number(get_the_ID()) . ' ' . __('Comments', 'gt3_theme_localization') . '</a></div>
										</div>
									</div>
								</div>
							</div>
							';
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <?php comments_template(); ?>
				<div class="single_post_navigation clearfix">
					<?php
						if (strlen(get_previous_post_link()) > 0) {
							echo '<div class="fleft">' . get_previous_post_link('%link', __('<i class="fa fa-angle-left"></i> Newer Posts', 'gt3_theme_localization')) . '</div>';
						}
						if (strlen(get_next_post_link()) > 0) {
							echo '<div class="fright">' . get_next_post_link('%link', __('Older Posts <i class="fa fa-angle-right"></i>', 'gt3_theme_localization')) . '</div>';
						}
					?>
				</div>
            </div>
            <?php get_sidebar('left'); ?>
            <?php get_sidebar('right'); ?>
        </div>
    </div>

<?php
get_footer();