function gt3_show_admin_post_format_cont() {
    var nowpostformat = jQuery('#post-formats-select input:checked').val();
    jQuery('.post_format_admin_option_cont').hide();

    if (nowpostformat == 'video') {
        jQuery('.post_format_admin_option_cont.pf_video').fadeIn('slow');
    }

    if (nowpostformat == 'link') {
        jQuery('.post_format_admin_option_cont.pf_link').fadeIn('slow');
    }

    if (nowpostformat == 'quote') {
        jQuery('.post_format_admin_option_cont.pf_quote').fadeIn('slow');
    }

    if (nowpostformat == 'audio') {
        jQuery('.post_format_admin_option_cont.pf_audio').fadeIn('slow');
    }
}

jQuery(document).ready(function () {
    "use strict";
    gt3_show_admin_post_format_cont();
    jQuery('#post-formats-select input').click(function () {
        gt3_show_admin_post_format_cont();
    });
});