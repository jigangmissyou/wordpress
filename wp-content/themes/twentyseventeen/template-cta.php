<?php
/**
 * Template Name: Call To Action
 */
 get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                <a href="<?php echo esc_url( add_query_arg( 'cta', '0' ) ); ?>">Skip &raquo;</a>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php get_footer(); ?>