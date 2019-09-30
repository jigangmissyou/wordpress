<?php

add_action('customize_register', 'gt3_customize_register');
function gt3_customize_register($wp_customize)
{
    global $gt3_default_font;
    //General Section
    $wp_customize->add_section(
        'section_general',
        array(
            'title' => 'General',
            'description' => '',
            'priority' => 200,
        )
    );

    //Logo
    $wp_customize->add_setting(
        'logo_upload',
        array(
            'default' => IMGURL . '/logo.png',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo_upload',
            array(
                'label' => 'Logo Upload',
                'section' => 'section_general',
                'settings' => 'logo_upload'
            )
        )
    );

    //Logo Width
    $wp_customize->add_setting(
        'logo_width',
        array(
            'default' => '312',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'logo_width',
        array(
            'type' => 'text',
            'label' => 'Logo Width',
            'section' => 'section_general'
        )
    );

    //Logo Height
    $wp_customize->add_setting(
        'logo_height',
        array(
            'default' => '120',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'logo_height',
        array(
            'type' => 'text',
            'label' => 'Logo Height',
            'section' => 'section_general'
        )
    );

    //Logo Retina
    $wp_customize->add_setting(
        'logo_retina_upload',
        array(
            'default' => IMGURL . '/retina/logo.png',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo_retina_upload',
            array(
                'label' => 'Logo Retina Upload',
                'section' => 'section_general',
                'settings' => 'logo_retina_upload'
            )
        )
    );

    //Logo Retina Width
    $wp_customize->add_setting(
        'logo_retina_width',
        array(
            'default' => '312',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'logo_retina_width',
        array(
            'type' => 'text',
            'label' => 'Logo Retina Width',
            'section' => 'section_general'
        )
    );

    //Logo Retina Height
    $wp_customize->add_setting(
        'logo_retina_height',
        array(
            'default' => '120',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'logo_retina_height',
        array(
            'type' => 'text',
            'label' => 'Logo Retina Height',
            'section' => 'section_general'
        )
    );

    //Favicon
    $wp_customize->add_setting(
        'favicon',
        array(
            'default' => IMGURL . '/favicon.ico',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'favicon',
            array(
                'label' => 'Favicon',
                'section' => 'section_general',
                'settings' => 'favicon'
            )
        )
    );

    //Apple
    $wp_customize->add_setting(
        'apple_icons_57',
        array(
            'default' => IMGURL . '/apple_icons_57x57.png',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_icons_57',
            array(
                'label' => 'Apple Icon 57px',
                'section' => 'section_general',
                'settings' => 'apple_icons_57'
            )
        )
    );

    //Apple
    $wp_customize->add_setting(
        'apple_icons_72',
        array(
            'default' => IMGURL . '/apple_icons_72x72.png',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_icons_72',
            array(
                'label' => 'Apple Icon 72px',
                'section' => 'section_general',
                'settings' => 'apple_icons_72'
            )
        )
    );

    //Apple
    $wp_customize->add_setting(
        'apple_icons_114',
        array(
            'default' => IMGURL . '/apple_icons_114x114.png',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_icons_114',
            array(
                'label' => 'Apple Icon 114px',
                'section' => 'section_general',
                'settings' => 'apple_icons_114'
            )
        )
    );

    //Socials
    $wp_customize->add_setting(
        'socials',
        array(
            'default' => '<a href="#"><i class="fa fa-facebook-square"></i></a><a href="#"><i class="fa fa-pinterest-square"></i></a><a href="#"><i class="fa fa-twitter-square"></i></a><a href="#"><i class="fa fa-google-plus-square"></i></a><a href="#"><i class="fa fa-youtube-square"></i></a><a href="#"><i class="fa fa-linkedin-square"></i></a>',
            'transport' => 'refresh',
            'sanitize_callback' => 'gt3_sanitize_input_data'
        )
    );
    $wp_customize->add_control(
        'socials',
        array(
            'type' => 'textarea',
            'label' => 'Socials',
            'section' => 'section_general'
        )
    );

    //Copyright
    $wp_customize->add_setting(
        'copyright',
        array(
            'default' => 'Copyright 2020 Knoxville. All Rights Reserved.',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'copyright',
        array(
            'type' => 'textarea',
            'label' => 'Copyright',
            'section' => 'section_general'
        )
    );
	
	//Instagram ID
    $wp_customize->add_setting(
        'instagram_id',
        array(
            'default' => '[jr_instagram id="2"]',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'instagram_id',
        array(
            'type' => 'text',
            'label' => 'Instagram Shortcode ID',
            'section' => 'section_general'
        )
    );

    //Sidebars
    $wp_customize->add_setting(
        'default_sidebar_position',
        array(
            'default' => 'right',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'default_sidebar_position',
        array(
            'type' => 'select',
            'label' => 'Default Sidebar Position',
            'section' => 'section_general',
            'choices' => array(
                'without_sidebar' => 'Without Sidebar',
                'left_sidebar' => 'Left',
                'right_sidebar' => 'Right'
            )
        )
    );

    //Fonts Section
    $wp_customize->add_section(
        'section_fonts',
        array(
            'title' => 'Fonts',
            'description' => '',
            'priority' => 210,
        )
    );

    $wp_customize->add_setting(
        'main_font',
        array(
            'default' => $GLOBALS["gt3_default_font"],
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'main_font',
        array(
            'type' => 'select',
            'label' => 'Main Font',
            'section' => 'section_fonts',
            'choices' => get_fonts_array_only_key_name()
        )
    );

    //Colors Section
    $wp_customize->add_section(
        'section_colors',
        array(
            'title' => 'Colors',
            'description' => '',
            'priority' => 310,
        )
    );

    $wp_customize->add_setting(
        'header_bg_color',
        array(
            'default' => '#ffffff',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'header_bg_color',
        array(
            'type' => 'color',
            'label' => 'Header Background Color',
            'section' => 'section_colors'
        )
    );
	
	$wp_customize->add_setting(
        'main_color',
        array(
            'default' => '#78bab8',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'main_color',
        array(
            'type' => 'color',
            'label' => 'Main Color',
            'section' => 'section_colors'
        )
    );

    $wp_customize->add_setting(
        'second_color',
        array(
            'default' => '#404143',
            'sanitize_callback' => 'gt3_sanitize_input_data',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
        'second_color',
        array(
            'type' => 'color',
            'label' => 'Second Color',
            'section' => 'section_colors'
        )
    );
	
}