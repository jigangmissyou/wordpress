<?php
namespace App\Controllers\Web;

class HomeController {
    public function index( $request, $view ) {
        if ( $request->get( 'cta' ) === '0' ) {
            // ... return the view WordPress was trying to load:
            return \WPEmerge\view( $view );
        }
        return \WPEmerge\view( 'template-cta.php' );
    }
}