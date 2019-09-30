<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php gt3_the_head_images(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var gt3_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="site_container">

    <header>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="fleft prelative">
                        <div class="mobile_menu_button"></div>
                        <?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'menu nolist', 'depth' => '3', 'walker' => new gt3_menu_walker())); ?>
                    </div>
                    <div class="fright gt3_socials">
                        <?php echo get_theme_mod('socials', '<a href="#"><i class="fa fa-facebook-square"></i></a><a href="#"><i class="fa fa-pinterest-square"></i></a><a href="#"><i class="fa fa-twitter-square"></i></a><a href="#"><i class="fa fa-google-plus-square"></i></a><a href="#"><i class="fa fa-youtube-square"></i></a><a href="#"><i class="fa fa-linkedin-square"></i></a>'); ?>
                    </div>
                    <?php gt3_the_logo(); ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </header>