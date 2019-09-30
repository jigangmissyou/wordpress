<?php
get_header();
?>
    <div class="container content without_sidebar">
        <div class="row">
            <div class="content_block span12">
                <div class="tiny_contentarea">
                    <?php
                    echo '<h1>' . __('404', 'gt3_theme_localization') . '</h1>';
                    echo '<h2>' . __('Sorry, no posts were found!', 'gt3_theme_localization') . '</h2>';
                    echo '<h3>' . __('Either Something Get Wrong or the Page Doesn’t Exist Anymore. Visit Our Homepage or Search the Best Match Below.', 'gt3_theme_localization') . '</h3>';
                    get_search_form(true);
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();