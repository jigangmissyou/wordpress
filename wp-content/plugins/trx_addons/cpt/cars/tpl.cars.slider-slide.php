<?php
/**
 * Template of the custom slide content with Car's data for the Swiper
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.25
 */

$args = get_query_var('trx_addons_args_cars_slider_slide');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();

?><div class="sc_cars_slider_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?>"><?php

	// Second column with image
	?><div class="sc_cars_slider_column <?php echo esc_attr(trx_addons_get_column_class(1, 3)); ?>">
		<h6 class="sc_cars_slider_categories"><?php trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_CARS_TAXONOMY_TYPE)); ?></h6>
		<h2 class="sc_cars_slider_title"><?php the_title(); ?></h2>
		<div class="sc_cars_slider_description">
			<?php the_excerpt(); ?>
		</div>
		<?php
		trx_addons_show_layout(trx_addons_sc_button(array(
				'link' => $link,
				'title' => esc_html__('Learn more', 'trx_addons'),
				'class' => 'sc_cars_slider_data_button'
			)
		));
		?>
	</div><?php
	
	// First column with data
	?><div class="sc_cars_slider_column <?php echo esc_attr(trx_addons_get_column_class(5, 12)); ?>">
		<figure class="sc_cars_slider_image">
			<?php the_post_thumbnail(trx_addons_get_thumb_size('big'), array('alt' => get_the_title())); ?>
			<div class="cars_page_title_price">
				<span class="cars_price">
					<?php if (!empty($meta['before_price'])) { ?>
						<span class="cars_price_label cars_price_before"><?php trx_addons_show_layout(trx_addons_prepare_macros($meta['before_price'])); ?></span><?php } ?><?php if (!empty($meta['price'])) { ?><span class="cars_price_data cars_price"><?php trx_addons_show_layout(trx_addons_prepare_macros($meta['price'])); ?></span><?php } ?><?php if (!empty($meta['price2'])) { ?><span class="cars_price_data cars_price2"><?php trx_addons_show_layout(trx_addons_prepare_macros($meta['price2'])); ?></span><?php } ?><?php if (!empty($meta['after_price'])) { ?><span class="cars_price_label cars_price_after"><?php trx_addons_show_layout(trx_addons_prepare_macros($meta['after_price'])); ?></span>
					<?php } ?>
				</span>
			</div>
		</figure>
	</div><?php

	// Second column with image
	?><div class="sc_cars_slider_column <?php echo esc_attr(trx_addons_get_column_class(1, 4)); ?>">
		<div class="cars_page_features_list">
			<?php
			if (!empty($meta['doors'])) {
				$path = grab_taxi_get_file_dir('trx_addons/cpt/cars/images/doors.png',true);
				?>
				<div class="cars_page_features_list_item">
					<?php
					if ($path != '') { ?>
						<img class="trx_addons_image_selector_preview trx_addons_image_preview" src="<?php echo esc_url($path); ?>" alt="">
					<?php }	?>
					<div class="cars_page_features_list_item_name">
						<?php echo esc_html_e('Doors','grab-taxi'); ?>:
						<em><?php echo esc_html($meta['doors']); ?></em>
					</div>
				</div>
			<?php }

			if (!empty($meta['passengers'])) {
				$path = grab_taxi_get_file_dir('trx_addons/cpt/cars/images/passengers.png',true);
				?>
				<div class="cars_page_features_list_item">
					<?php
					if ($path != '') { ?>
						<img class="trx_addons_image_selector_preview trx_addons_image_preview" src="<?php echo esc_url($path); ?>" alt="">
					<?php }	?>
					<div class="cars_page_features_list_item_name">
						<?php echo esc_html_e('Passengers','grab-taxi'); ?>:
						<em><?php echo esc_html($meta['passengers']); ?></em>
					</div>
				</div>
			<?php }

			if (!empty($meta['luggage'])) {
				$path = grab_taxi_get_file_dir('trx_addons/cpt/cars/images/luggage.png',true);
				?>
				<div class="cars_page_features_list_item">
					<?php
					if ($path != '') { ?>
						<img class="trx_addons_image_selector_preview trx_addons_image_preview" src="<?php echo esc_url($path); ?>" alt="">
					<?php }	?>
					<div class="cars_page_features_list_item_name">
						<?php echo esc_html_e('Luggage','grab-taxi'); ?>:
						<em><?php echo esc_html($meta['luggage']); ?></em>
					</div>
				</div>
			<?php }

			$term = wp_get_post_terms( get_the_ID(),TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES );
			$q = 1;
			foreach($term as $t) {
				if ($q >	 3) break;
				echo '<div class="cars_page_features_list_item">';
				$img = $t->term_id > 0
					? trx_addons_get_term_meta(array(
						'taxonomy'	=> TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES,
						'term_id'	=> $t->term_id,
						'key'		=> 'image'
					))
					: '';
				if (!empty($img)) {
					?><img class="trx_addons_image_selector_preview trx_addons_image_preview" src="<?php
					echo esc_url(trx_addons_add_thumb_size($img, 'tiny31'));
					?>" alt=""><?php
				}
				if (!empty($t->name)) { ?>
					<div class="cars_page_features_list_item_name">
						<?php echo esc_html($t->name); ?>:
						<em><?php echo esc_html__('Yes','grab-taxi');?></em>
					</div>
				<?php }
				echo '</div>';
				$q = $q + 1;
			}
			?>
		</div>
	</div>
</div>