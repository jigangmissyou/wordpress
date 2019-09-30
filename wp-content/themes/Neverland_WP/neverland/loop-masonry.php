<?php
$featured_image = '<a href="' . get_permalink() . '"><img class="tac" src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), $width, $height, true, true, true) . '" alt=""></a>';

    echo '
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
';