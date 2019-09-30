<?php

add_action('save_post', 'gt3_options');
function gt3_options()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', get_the_ID())) {
        return;
    }

    if (!isset($_POST[GT3_THEMESHORT . 'post_options'])) {
        $gt3_options = array();
    } else {
        $gt3_options = $_POST[GT3_THEMESHORT . 'post_options'];
    }

    update_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', $gt3_options);
}

#REGISTER POST SETTINGS
add_action('add_meta_boxes', 'gt3_page_settings_area');
function gt3_page_settings_area()
{
    $gt3_page_settings_area = array('post', 'page');
    if (is_array($gt3_page_settings_area)) {
        foreach ($gt3_page_settings_area as $post_type) {
            add_meta_box(
                'pb_section',
                GT3_THEMENAME . __(' Page Settings', 'gt3_theme_localization'),
                'gt3_page_settings',
                $post_type
            );
        }
    }
}

function gt3_page_settings($post)
{
    $now_post_type = get_post_type();
    $post_options = get_post_meta(get_the_ID(), GT3_THEMESHORT . 'post_options', true);

    if ($now_post_type == "post" || $now_post_type == "page" || $now_post_type == "portfolio") {
        if (!isset($post_options['title'])) {
            $post_options['title'] = 'show';
        }
        if (!isset($post_options['sidebar_position'])) {
            $post_options['sidebar_position'] = get_theme_mod('default_sidebar_position', 'default');
        }
        if (!isset($post_options['posts_in_a_row'])) {
            $post_options['posts_in_a_row'] = 1;
        }
        if (!isset($post_options['show_style'])) {
            $post_options['show_style'] = 'grid';
        }

        echo '
        <div class="gt3_page_option">
            <p>Page Title:</p>
            <select name="' . GT3_THEMESHORT . 'post_options[title]">
                <option value="show" ' . ($post_options['title'] == 'show' ? 'selected' : '') . '>Show</option>
                <option value="hide" ' . ($post_options['title'] == 'hide' ? 'selected' : '') . '>Hide</option>
            </select>
        </div>
        ';

        echo '
        <div class="gt3_page_option">
            <p>Sidebar Position:</p>
            <select name="' . GT3_THEMESHORT . 'post_options[sidebar_position]">
                <option value="default" ' . ($post_options['sidebar_position'] == 'default' ? 'selected' : '') . '>Default</option>
                <option value="without_sidebar" ' . ($post_options['sidebar_position'] == 'without_sidebar' ? 'selected' : '') . '>Without Sidebar</option>
                <option value="left_sidebar" ' . ($post_options['sidebar_position'] == 'left_sidebar' ? 'selected' : '') . '>Left</option>
                <option value="right_sidebar" ' . ($post_options['sidebar_position'] == 'right_sidebar' ? 'selected' : '') . '>Right</option>
            </select>
        </div>
        ';
    }

    if ($now_post_type == "post") {
        echo '
        <div class="gt3_page_option post_format_admin_option_cont pf_video">
            <p>Post Format Video:</p>
            ' . (isset($post_options['post_format_video']) ? '<div style="padding-bottom:20px;">'.$post_options['post_format_video'].'</div>' : '') . '
            <textarea name="' . GT3_THEMESHORT . 'post_options[post_format_video]" id="" cols="30" rows="10">' . (isset($post_options['post_format_video']) ? $post_options['post_format_video'] : '') . '</textarea>
        </div>
        ';

        echo '
        <div class="gt3_page_option post_format_admin_option_cont pf_link">
            <p>Post Format Link:</p>
            <input type="text" placeholder="Please Enter URL" name="' . GT3_THEMESHORT . 'post_options[post_format_link_href]" value="' . (isset($post_options['post_format_link_href']) ? $post_options['post_format_link_href'] : '') . '" />
            <input type="text" placeholder="Please Enter Link Title" name="' . GT3_THEMESHORT . 'post_options[post_format_link_title]" value="' . (isset($post_options['post_format_link_title']) ? $post_options['post_format_link_title'] : '') . '" />
        </div>
        ';

        echo '
        <div class="gt3_page_option post_format_admin_option_cont pf_quote">
            <p>Post Format Quote:</p>
            <textarea name="' . GT3_THEMESHORT . 'post_options[post_format_quote_text]" id="" cols="30" rows="10">' . (isset($post_options['post_format_quote_text']) ? $post_options['post_format_quote_text'] : '') . '</textarea>
            <input type="text" placeholder="Please Enter Author Name" name="' . GT3_THEMESHORT . 'post_options[post_format_quote_author]" value="' . (isset($post_options['post_format_quote_author']) ? $post_options['post_format_quote_author'] : '') . '" />
        </div>
        ';

        echo '
        <div class="gt3_page_option post_format_admin_option_cont pf_audio">
            <p>Post Format Audio:</p>
            <textarea name="' . GT3_THEMESHORT . 'post_options[post_format_audio]" id="" cols="30" rows="10">' . (isset($post_options['post_format_audio']) ? $post_options['post_format_audio'] : '') . '</textarea>
        </div>
        ';
    }

    /* Blog Template */
    if (get_page_template_slug() == "page-blog-slider.php") {
		
		/*
        echo '
        <div class="gt3_page_option">
            <p>Choose Style:</p>
            <select name="' . GT3_THEMESHORT . 'post_options[show_style]">
                <option value="grid" ' . ($post_options['show_style'] == 'grid' ? 'selected' : '') . '>Grid</option>
                <option value="masonry" ' . ($post_options['show_style'] == 'masonry' ? 'selected' : '') . '>Masonry</option>
            </select>
        </div>
        ';
		*/

        echo '
        <div class="gt3_page_option">
            <p>Posts per Page:</p>
            <input style="width: 60px;" type="number" name="' . GT3_THEMESHORT . 'post_options[posts_count]" value="' . (isset($post_options['posts_count']) ? $post_options['posts_count'] : '6') . '" />
        </div>
        ';

        echo '
        <div class="gt3_page_option">
            <p>Posts in Row:</p>
            <select name="' . GT3_THEMESHORT . 'post_options[posts_in_a_row]">
                <option value="1" ' . ($post_options['posts_in_a_row'] == '1' ? 'selected' : '') . '>1</option>
                <option value="2" ' . ($post_options['posts_in_a_row'] == '2' ? 'selected' : '') . '>2</option>
                <option value="3" ' . ($post_options['posts_in_a_row'] == '3' ? 'selected' : '') . '>3</option>
            </select>
        </div>
        ';
    }
}