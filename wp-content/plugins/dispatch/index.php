<?php
/**
 * @package GJG
 * @version 1.7.2
 */
/*
Plugin Name: DISPATCH TEST
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: For dispatch test only.
Author: GJG
Version: 1.0.0
Author URI: http://ma.tt/
*/
require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
use \TheFold\WordPress\Router;
add_action( 'wp_ajax_nopriv_demo', 'dosome' );
add_action( 'wp_ajax_demo', 'dosome' );
wp_enqueue_script( 'demo', get_template_directory_uri() . '/demo.js', array('jquery'), null, filemtime('demo'));
function dosome(){
    echo 'ceshi';
}
var_dump(new Router());
//var_dump(get_template_directory());


Router::routes([

    'route-1' => function(){
        echo 'Hello Ted';
    },

    'hello-([a-z]+)' => function($request, $name){
        echo "Hello $name";
    }
]);
