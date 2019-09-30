<?php

#Ajax import xml
add_action('wp_ajax_ajax_import_dump', 'ajax_import_dump');
if (!function_exists('ajax_import_dump')) {
    function ajax_import_dump()
    {
        if (is_admin()) {
            if (!defined('WP_LOAD_IMPORTERS')) {
                define('WP_LOAD_IMPORTERS', true);
            }

            require_once(TEMPLATEPATH . '/core/xml-importer/importer.php');

            try {
                ob_start();
                $importer = new WP_Import();
                $importer->import(TEMPLATEPATH . '/core/xml-importer/import.xml');
                ob_clean();
            } catch (Exception $e) {
                die(json_encode(array(
                    'message' => $e->getMessage()
                )));
            }
            die(json_encode(array(
                'message' => 'Data was imported successfully'
            )));
        }
    }
}

add_action('wp_ajax_gt3_save_admin_options', 'gt3_save_admin_options');
function gt3_save_admin_options()
{
    if (is_admin()) {
        $response = array();
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        $serialize_string = stripslashes($_POST['serialize_string']);

        $theme_sidebars = array();

        foreach (json_decode($serialize_string, true) as $key => $value) {
            $gt3_options[$value['name']] = $value['value'];
            $pos = strpos($value['name'], 'theme_sidebars');
            if ($pos === false) {
            } else {
                $theme_sidebars[] = $value['value'];
            }
        };

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            $response['save_status'] = "saved";
        } else {
            $response['save_status'] = "nothing_changed";
        }

        gt3_delete_theme_option("theme_sidebars");
        gt3_update_theme_option("theme_sidebars", $theme_sidebars);

        echo json_encode($response);

        global $gt3_custom_css;
        $gt3_custom_css->requestFileRecompile();
    }

    die();
}

add_action('wp_ajax_gt3_upload_file_import_settings', 'gt3_upload_file_import_settings');
function gt3_upload_file_import_settings()
{
    if (is_admin()) {
        if (isset($_FILES['gt3_UploadButton_admin_settings'])) {
            $data_file = file_get_contents($_FILES['gt3_UploadButton_admin_settings']['tmp_name']);
        }

        delete_option(GT3_THEMESHORT . "gt3_options");
        update_option(GT3_THEMESHORT . "gt3_options", unserialize($data_file));

        echo '<div>Done!</div>';
    }

    die();
}

add_action('wp_ajax_gt3_reset_admin_settings', 'gt3_reset_admin_settings');
function gt3_reset_admin_settings()
{
    if (is_admin()) {
        delete_option(GT3_THEMESHORT . "gt3_options");

        echo '<div>Done!</div>';
    }

    die();
}

if (isset($_GET['gt3_export_admin_settings'])) {
    if (is_admin()) {
        $gt3_options_export = serialize(get_option(GT3_THEMESHORT . "gt3_options"));
        $gt3_options_export_strlen = strlen($gt3_options_export);
        header("Content-Length: $gt3_options_export_strlen");
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=gt3_options.dat");
        echo $gt3_options_export;
    }
}

add_action('wp_ajax_add_like_post', 'gt3_add_like_post');
add_action('wp_ajax_nopriv_add_like_post', 'gt3_add_like_post');
function gt3_add_like_post()
{
    $post_id = absint($_POST['post_id']);
    $all_likes = get_post_meta($post_id, 'gt3_likes', true);
    $all_likes = (isset($all_likes) ? $all_likes : 0) + 1;
    update_post_meta($post_id, 'gt3_likes', $all_likes);
    echo $all_likes;
    die();
}

?>