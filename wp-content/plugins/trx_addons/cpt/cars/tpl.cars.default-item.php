<?php
/**
 * The style "default" of the Cars
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.25
 */

$args = get_query_var('trx_addons_args_sc_cars');
if (empty($args['slider'])) $args['slider'] = 0;

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?><div class="sc_cars_item with_image<?php
	echo isset($args['hide_excerpt']) && $args['hide_excerpt'] ? ' without_content' : ' with_content';
?>">
	<?php
	// Featured image
	if ( has_post_thumbnail() ) {
		trx_addons_get_template_part('templates/tpl.featured.php',
										'trx_addons_args_featured',
										apply_filters('trx_addons_filter_args_featured', array(
															'class' => 'sc_cars_item_thumb',
															'hover' => '',
															'thumb_size' => apply_filters('trx_addons_filter_thumb_size',
																							trx_addons_get_thumb_size($args['columns'] > 2 ? 'medium' : 'big'),
																							'cars-default'),
															'post_info' => '<div class="sc_cars_item_labels">'
																				. trx_addons_get_post_terms('', get_the_ID(), TRX_ADDONS_CPT_CARS_TAXONOMY_LABELS)
																			. '</div>'
																			. '<div class="sc_cars_item_price">'
																				. trx_addons_get_template_part_as_string(
																					'cpt/cars/tpl.cars.parts.price.php',
																					'trx_addons_args_cars_price',
																					array(
																						'meta' => $meta
																					)
																				)
																			. '</div>'
															), 'cars-default'
														)
									);
	}

	?><div class="sc_cars_item_info">
		<div class="sc_cars_item_header"><?php
			// Title
			?><h5 class="sc_cars_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h5>
		</div><?php
	// Add to Compare
	$list = trx_addons_get_value_gpc('trx_addons_cars_compare_list', array());
	if (!empty($list)) $list = json_decode($list, true);
	?><div class="sc_cars_item_compare not_inited trx_addons_icon-balance-scale<?php
	if (!empty($list['id_'.intval(get_the_ID())])) echo ' in_compare_list';
	?>"
		   data-car-id="<?php echo esc_attr(get_the_ID()); ?>"
		   title="<?php esc_attr_e('Add to compare list', 'trx_addons'); ?>"></div>

		<div class="sc_cars_item_params"><?php

			// City
			?><span class="sc_cars_item_param sc_cars_item_param_address" title="<?php esc_html_e('Location', 'trx_addons'); ?>">
				<span class="sc_cars_item_param_label"><?php esc_html_e('Location', 'trx_addons'); ?></span>
				<span class="sc_cars_item_param_text"><?php trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_CARS_TAXONOMY_CITY)); ?></span>
			</span><?php
			// Engine
			?><span class="sc_cars_item_param sc_cars_item_param_engine" title="<?php esc_html_e('Engine', 'trx_addons'); ?>">
				<span class="sc_cars_item_param_label"><?php esc_html_e('Engine', 'trx_addons'); ?></span>
				<span class="sc_cars_item_param_text"><?php
					trx_addons_show_layout($meta['engine_size']
						. ($meta['engine_size_prefix']
							? ' ' . trx_addons_prepare_macros($meta['engine_size_prefix'])
							: '')
						. ($meta['engine_type']
							? ' ' . trx_addons_prepare_macros($meta['engine_type'])
							: '')
					);
					?></span>
			</span><?php
			// Mileage
			?><span class="sc_cars_item_param sc_cars_item_param_mileage" title="<?php esc_html_e('Mileage', 'trx_addons'); ?>">
				<span class="sc_cars_item_param_label"><?php esc_html_e('Mileage', 'trx_addons'); ?></span>
				<span class="sc_cars_item_param_text"><?php
					trx_addons_show_layout(trx_addons_num2kilo($meta['mileage'])
											. ($meta['mileage_prefix'] 
													? ' ' . trx_addons_prepare_macros($meta['mileage_prefix'])
													: '')
											);
				?></span>
			</span>
		</div>
		
		<div class="sc_cars_item_options sc_cars_item_footer">
			<div class="cars_page_features_list">
				<?php
				$term = wp_get_post_terms( get_the_ID(),TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES );
				foreach($term as $t) {
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
						echo esc_url(trx_addons_add_thumb_size($img, trx_addons_get_thumb_size('tiny')));
						?>" alt=""><?php
					}
					if (!empty($t->name)) { ?>
						<div class="cars_page_features_list_item_name"><?php echo esc_html($t->name); ?></div>
					<?php }
					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>