<?php

if (!isset($content_width)) $content_width = 940;

if (!function_exists('gt3_pre')) {
    function gt3_pre($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}

if (!function_exists('gt3_theme_comment')) {
    function gt3_theme_comment($comment, $args, $depth)
    {
        $max_depth_comment = ($args['max_depth'] > 4 ? 4 : $args['max_depth']);

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
            <div class="commentava">
                <?php echo get_avatar($comment->comment_author_email, 53); ?>
            </div>
            <div class="thiscommentbody">
                <div class="comment_info">
                    <span class="author_name"><b><?php printf('%s', get_comment_author_link()) ?></b><?php edit_comment_link('(Edit)', '  ', '') ?></span>
                    <span class="date"><?php printf('%1$s', get_comment_date("F d, Y")) ?></span>
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => __('<i class="fa fa-mail-reply"></i>', 'gt3_theme_localization'), 'max_depth' => $max_depth_comment))) ?>
                </div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <p><em><?php _e('Your comment is awaiting moderation.', 'gt3_theme_localization'); ?></em></p>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php
    }
}

#Custom paging
if (!function_exists('gt3_get_theme_pagination')) {
    function gt3_get_theme_pagination($type = "")
    {
        if ($type == "query2") {
            global $paged, $wp_query2;
            $wp_query = $wp_query2;
        } else {
            global $paged, $wp_query;
        }
        $range = 2;
		$showitems = $range;

        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $max_page = $wp_query->max_num_pages;
        if ($max_page > 1) {
            echo '<ul class="pagerblock nolist">';
        }
		if($paged > 1) echo '<li class="newer_posts"><a href="' .get_pagenum_link($paged - 1) . ' "><i class="fa fa-angle-left"></i>' . __('Newer Posts','gt3_theme_localization') . '</a></li>';
        if ($max_page > 1) {
            if (!$paged) {
                $paged = 1;
            }
            if ($max_page > $range) {
                if ($paged < $range) {
                    for ($i = 1; $i <= ($range + 1); $i++) {
                        echo "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) echo " class='current'";
                        echo ">$i</a></li>";
                    }
                } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                    for ($i = $max_page - $range; $i <= $max_page; $i++) {
                        echo "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) echo " class='current'";
                        echo ">$i</a></li>";
                    }
                } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                    for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                        echo "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) echo " class='current'";
                        echo ">$i</a></li>";
                    }
                }
            } else {
                for ($i = 1; $i <= $max_page; $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
        }
		if ($paged < $max_page) echo '<li class="older_posts"><a href="' . get_pagenum_link($paged + 1) . '">' . __('Older Posts','gt3_theme_localization') . '<i class="fa fa-angle-right"></i></a></li>';
        if ($max_page > 1) {
            echo '</ul>';
        }
    }
}

if (!function_exists('gt3_get_selected_pf_images')) {
    function gt3_get_selected_pf_images($gt3_theme_pagebuilder)
    {
        if (!isset($compile)) {
            $compile = '';
        }
        if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
            if (count($gt3_theme_pagebuilder['post-formats']['images']) == 1) {
                $onlyOneImage = "oneImage";
            } else {
                $onlyOneImage = "";
            }
            $compile .= '
                <div class="slider-wrapper theme-default">
                    <div class="nivoSlider ' . $onlyOneImage . '">
            ';

            if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
                foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
                    $compile .= '<img src="' . aq_resize(wp_get_attachment_url($img['attach_id']), "1170", "563", true, true, true) . '" data-thumb="' . aq_resize(wp_get_attachment_url($img['attach_id']), "1170", "563", true, true, true) . '" alt="" />
                    ';
                }
            }

            $compile .= '
                    </div>
                </div>
            ';

        }

        $GLOBALS['showOnlyOneTimeJS']['nivo_slider'] = "
        <script>
            jQuery(document).ready(function($) {
                jQuery('.nivoSlider').each(function(){
                    jQuery(this).nivoSlider({
						directionNav: true,
						controlNav: false,
						effect:'fade',
						pauseTime:4000,
						slices: 1
					});
                });
            });
        </script>
        ";

        wp_enqueue_script('gt3_nivo_js', get_template_directory_uri() . '/js/nivo.js', array(), false, true);
        return $compile;
    }
}

if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex = "ffffff")
    {
        $color = array();
        if (strlen($hex) < 1) {
            $hex = "ffffff";
        }

        if (strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        } else if (strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }

        return $color['r'] . "," . $color['g'] . "," . $color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
                                          $break_words = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return $string;
        }
    }
}

add_action("wp_head", "wp_head_mix_var");
if (!function_exists('wp_head_mix_var')) {
    function wp_head_mix_var()
    {
        echo "<script>var " . GT3_THEMESHORT . "var = true;</script>";
    }
}

function replace_br_to_rn_in_multiarray(&$item, $key)
{
    $item = str_replace(array("<br>", "<br />"), "\n", $item);
}

function gt3pb_get_plugin_pagebuilder($postid)
{
    $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }

    if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
        $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
    }
    if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
        $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
    }

    array_walk_recursive($gt3_theme_pagebuilder, 'stripslashes_in_array');

    return $gt3_theme_pagebuilder;
}

function replace_rn_to_br_in_multiarray(&$item, $key)
{
    if ($key !== "html") {
        $item = nl2br($item);
        $item = str_replace(array("\r\n", "\r", "\n"), '', $item);
    }
}

function before_save_pagebuilder_array(&$item, $key)
{
    if (
        $key == "heading_text" ||
        $key == "main_text" ||
        $key == "additional_text" ||
        $key == "iconbox_heading" ||
        $key == "block_name" ||
        $key == "block_price" ||
        $key == "block_period" ||
        $key == "get_it_now_caption" ||
        $key == "title" ||
        $key == "button_text"
    ) {
        $item = str_replace("'", "&#039;", $item);
        $item = str_replace('"', "&quot;", $item);
    }
}

function stripslashes_in_array(&$item)
{
    $item = stripslashes($item);
}

function gt3pb_update_theme_pagebuilder($post_id, $variableName, $gt3_theme_pagebuilderArray)
{
    array_walk_recursive($gt3_theme_pagebuilderArray, 'before_save_pagebuilder_array');
    update_post_meta($post_id, $variableName, $gt3_theme_pagebuilderArray);
    return true;
}

if (!function_exists('gt3_get_field_media_and_attach_id')) {
    function gt3_get_field_media_and_attach_id($name, $attach_id, $previewW = "200px", $previewH = null, $classname = "")
    {
        return "<div class='select_image_root " . $classname . "'>
        <input type='hidden' name='" . $name . "' value='" . $attach_id . "' class='select_img_attachid'>
        <div class='select_img_preview'><img src='" . ($attach_id > 0 ? aq_resize(wp_get_attachment_url($attach_id), $previewW, $previewH, true, true, true) : "") . "' alt=''></div>
        <input type='button' class='button button-secondary button-large select_attach_id_from_media_library' value='Select'>
    </div>";
    }
}

if (!function_exists('gt3_the_breadcrumb')) {
    function gt3_the_breadcrumb()
    {
        $showOnHome = 1;
        $delimiter = '';
        $home = __('Home', 'gt3_theme_localization');
        $showCurrent = 1;
        $before = '<span>';
        $after = '</span>';

        global $post;
        $homeLink = home_url();

        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) echo '<div class="breadcrumbs type2"><div class="container">' . $home . '</div></div>';

        } else {

            echo '<div class="breadcrumbs type2"><div class="container"><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . 'Archive "' . single_cat_title('', false) . '"' . $after;

            } #PORTFOLIO
            elseif (get_post_type() == 'port') {

                the_terms($post->ID, 'portcat', '', '', '');

                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif (is_search()) {
                echo $before . 'Search for "' . get_search_query() . '"' . $after;

            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;

            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;

            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;

            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {

                    $parent_id = $post->post_parent;
                    if ($parent_id > 0) {
                        $breadcrumbs = array();
                        while ($parent_id) {
                            $page = get_page($parent_id);
                            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                            $parent_id = $page->post_parent;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for ($i = 0; $i < count($breadcrumbs); $i++) {
                            echo $breadcrumbs[$i];
                            if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                        }
                        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    } else {
                        echo $before . get_the_title() . $after;
                    }

                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }

            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1) echo $before . get_the_title() . $after;

            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo '' . $delimiter . '' . $before . get_the_title() . $after;

            } elseif (is_tag()) {
                echo $before . 'Tag "' . single_tag_title('', false) . '"' . $after;

            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Author ' . $userdata->display_name . $after;

            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }

            echo '</div></div>';

        }
    }
}

if (!function_exists('gt3_showJSInFooter')) {
    function gt3_showJSInFooter()
    {
        if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
            foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
                echo $js;
            }
        }
    }
}
add_action('wp_footer', 'gt3_showJSInFooter');


if (!function_exists('gt3_get_dynamic_sidebar')) {
    function gt3_get_dynamic_sidebar($index)
    {
        $sidebar_contents = "";
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();
        return $sidebar_contents;
    }
}

function gt3_theme_slug_setup()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'gt3_theme_slug_setup');

if (!function_exists('_wp_render_title_tag')) {
    function theme_slug_render_title()
    {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php
    }

    add_action('wp_head', 'theme_slug_render_title');
}

if (!function_exists('gt3_availbale_post_categories_array')) {
    function gt3_availbale_post_categories_array()
    {
        $gt3_categories = get_categories(array('type' => 'post'));
        $gt3_available_categories = array('All' => 0);

        if (is_array($gt3_categories)) {
            foreach ($gt3_categories as $cat) {
                if (is_object($cat)) {
                    $gt3_available_categories[$cat->name] = $cat->cat_ID;
                }
            }
        }

        return $gt3_available_categories;
    }
}

require_once(get_template_directory() . "/core/loader.php");

add_action('init', 'gt3_page_init');
if (!function_exists('gt3_page_init')) {
    function gt3_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('gt3_select_image_from_media_button')) {
    function gt3_select_image_from_media_button($fieldname, $fieldvalue, $button_caption, $default_value)
    {
        if (wp_get_attachment_url($fieldvalue)) {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . wp_get_attachment_url($fieldvalue) . '" target="_blank"><img src="' . wp_get_attachment_url($fieldvalue) . '" alt="" /></a>';
        } else {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . $default_value . '" target="_blank"><img src="' . $default_value . '" alt="" /></a>';
        }
        return $compile;
    }
}

function gt3_the_logo()
{
    $compile = '';
    $logourl = get_theme_mod('logo_upload', IMGURL . '/logo.png');

    if (strlen($logourl) > 0) {
        $width = absint(get_theme_mod('logo_width', '327'));
        $height = absint(get_theme_mod('logo_height', '114'));
    } else {
        $width = 0;
        $height = 0;
    }

    $logourl_retina = get_theme_mod('logo_retina_upload', IMGURL . '/retina/logo.png');

    if (strlen($logourl_retina) > 0) {
        $width_retina = absint(get_theme_mod('logo_retina_width', '654'));
        $height_retina = absint(get_theme_mod('logo_retina_height', '228'));
    } else {
        $width_retina = 0;
        $height_retina = 0;
    }

    $compile .= '
    <div class="logo">
        <a class="default_logo" href="' . esc_url(home_url('/')) . '" style="width:' . $width . 'px;height:' . $height . 'px;">
            <img src="' . $logourl . '" alt="' . get_bloginfo('description') . '">
        </a>
        <a class="retina_logo" href="' . esc_url(home_url('/')) . '" style="width:' . $width_retina / 2 . 'px;height:' . $height_retina / 2 . 'px;">
            <img src="' . $logourl_retina . '" alt="' . get_bloginfo('description') . '">
        </a>
    </div>
    ';

    echo $compile;
}

function gt3_the_head_images()
{
    $compile = '';

    $favicon = get_theme_mod('favicon', IMGURL . '/favicon.ico');
    $apple_icons_57 = get_theme_mod('apple_icons_57', IMGURL . '/apple_icons_57x57.png');
    $apple_icons_72 = get_theme_mod('apple_icons_72', IMGURL . '/apple_icons_72x72.png');
    $apple_icons_114 = get_theme_mod('apple_icons_114', IMGURL . '/apple_icons_114x114.png');

    $compile .= '
    <link rel="shortcut icon" href="' . $favicon . '" type="image/x-icon">
    <link rel="apple-touch-icon" href="' . $apple_icons_57 . '">
    <link rel="apple-touch-icon" sizes="72x72"
          href="' . $apple_icons_72 . '">
    <link rel="apple-touch-icon" sizes="114x114"
          href="' . $apple_icons_114 . '">
    ';

    echo $compile;
}

//	Custom Header Setup
function gt3_custom_header_setup() {
	
	add_theme_support( 'custom-header', apply_filters( 'gt3_custom_header_args', array(
		'width'                  => 1920,
		'height'                 => 1080,
		'header-text'            => false,
		'default-image' 		 => IMGURL . '/header_bg1.jpg',
		'wp-head-callback'       => 'gt3_header_style',
	) ) );
	
	register_default_headers( array(
		'neverland' => array(
			'url'           => IMGURL . '/header_bg1.jpg',
			'thumbnail_url' => IMGURL . '/header_bg1.jpg',
			'description'   => ''
		),
	));

}
add_action( 'after_setup_theme', 'gt3_custom_header_setup' );
	
if ( ! function_exists( 'gt3_header_style' ) ) :
function gt3_header_style() {
	$header_image = get_header_image();
}
endif; // gt3_header_style

add_action('wp_head', 'gt3_theme_customizer_in_header');
function gt3_theme_customizer_in_header()
{
    $compile = '<style>';

    $compile .= '
	body, .comment-form .submit, .wpcf7-form textarea, .wpcf7-form input, .tiny_contentarea .search_form input {font-family:"' . get_theme_mod('main_font', $GLOBALS["gt3_default_font"]) . '";}

    .main_color_bg, .the_category a, .main_color_bg, .comment-form .submit, .wpcf7-submit, .stand_slide .pmeta .help_title h2, .stand_slide .the_category a:hover, .tiny_contentarea .search_form input[type=submit], .active_mobile_menu header .menu, header .menu > li > a:before, .widget_tag_cloud a:hover {background-color:' . get_theme_mod('main_color', '#78bab8') . ';}
	
	header {background-color:' . get_theme_mod('header_bg_color', '#ffffff') . ';}

    ::selection {
        color:#fff;
		background-color:' . get_theme_mod('main_color', '#78bab8') . ';
        opacity: 1;
    }

    ::-moz-selection {
        color:#fff;
		background-color:' . get_theme_mod('main_color', '#78bab8') . ';
        opacity: 1;
    }

    a:hover, a:focus, .main_color_text, .main_color_text_hover:hover, header .menu li .sub-menu li a:hover, header .menu li .sub-menu li.current-menu-item a, .stand_post .entry-title h1:hover, .post_meta, .post_meta a, .pagerblock li a.current, .pagerblock li a:hover, .sidepanel.widget_categories .current-cat a, .sidepanel.widget_categories a:hover, .pformat-quote-author, a.post_format_link_href {color:' . get_theme_mod('main_color', '#78bab8') . ';}

    .wpcf7-submit:hover, .next_link:hover, .prev_link:hover, .tiny_contentarea .search_form input[type=submit]:hover, .comment-form .submit:hover {background-color:' . get_theme_mod('second_color', '#404143') . ';}

    h1, h2, h3, h4, h5, h6, .second_color_text, .stand_post .entry-title h1, a.post_format_link_href:hover {color:' . get_theme_mod('second_color', '#404143') . ';}

    blockquote, .widget_tag_cloud a:hover {border-color:' . get_theme_mod('main_color', '#78bab8') . ';}
    
	header{background-image:url(' . get_header_image() . ');}	
	';
	
    $compile .= '</style>';

    echo $compile;
}

function gt3_get_post_formats()
{
    $pf = get_post_format();
    if ( false === $pf ) {
        $pf = 'standard';
    }

    $compile = '';
    $post_options = get_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', true);

    $featured_image = '<img class="tac" src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 1170, 705, true, true, true) . '" alt="">';

    if ($pf == 'image' || $pf == 'video' || $pf == 'link' || $pf == 'quote' || $pf == 'status' || $pf == 'audio' || $pf == 'chat' || $pf == 'standard') {
        $compile .= '<div class="postformats_cont gt3_pf_' . $pf . '">';

        if ($pf == 'image' || $pf == 'standard') {
            if (has_post_thumbnail()) {
                $compile .= $featured_image;
            }
        }

        if ($pf == 'video') {
            if (is_single()) {
                $compile .= (isset($post_options['post_format_video']) ? $post_options['post_format_video'] : '');
            } else {
                if (has_post_thumbnail()) {
                    $compile .= $featured_image;
                } else {
                    $compile .= (isset($post_options['post_format_video']) ? $post_options['post_format_video'] : '');
                }
            }

        }

        if ($pf == 'link' && isset($post_options['post_format_link_href'])) {
            $compile .= '
                <div class="pformat-top-cont">
                    <h2 class="entry-title-pformat">' . $post_options['post_format_link_title'] . '</h2>
                    <a class="post_format_link_href" href="' . $post_options['post_format_link_href'] . '" target="_blank">' . $post_options['post_format_link_href'] . '</a>
                </div>
            ';
        }

        if ($pf == 'quote' && isset($post_options['post_format_quote_text'])) {
            $compile .= '
                <div class="pformat-top-cont">
                    <h2 class="entry-title-pformat">' . $post_options['post_format_quote_text'] . '</h2>
                    ' . (isset($post_options['post_format_quote_author']) ? '<h5 class="pformat-quote-author">- ' . $post_options['post_format_quote_author'] . '</h5>' : '') . '
                </div>
            ';
        }

        if ($pf == 'audio' && isset($post_options['post_format_audio'])) {
            $compile .= $post_options['post_format_audio'];
        }

        $compile .= '</div>';
    }

    return $compile;
}


function gt3_sanitize_input_data($value)
{
    return $value;
}


//	Post excerpt
if (!function_exists('to_excerpt')) {
    function to_excerpt($str, $length) {
        $str = strip_tags($str);
        $str = explode(" ", $str);
        return implode(" ", array_slice($str, 0, $length));
    }
}