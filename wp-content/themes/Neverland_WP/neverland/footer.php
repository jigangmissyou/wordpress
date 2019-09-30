</div>

<footer>
	<div class="footer_instagram_block">
		<?php 
			$instagramm_id = get_theme_mod('instagram_id', '[jr_instagram id="2"]');
			echo do_shortcode( $instagramm_id );
		?>
	</div>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="copyblock fleft">
                    <?php echo get_theme_mod('copyright', 'Copyright &copy 2020 Neverland. All Rights Reserved.'); ?>
                </div>
                <?php if (is_front_page()) { ?>
					<div class="footer_site_descr fright">
	                    <a class="main_color_text" rel="nofollow" href="http://www.gt3themes.com/wordpress/free-personal-blog-wordpress-theme/" target="_blank"><?php echo __('Free Personal Blog WordPress Theme','gt3_theme_localization'); ?></a> <?php echo __('by GT3themes.com','gt3_theme_localization'); ?>
	                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>