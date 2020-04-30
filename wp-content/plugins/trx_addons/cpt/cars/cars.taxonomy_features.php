<?php
/**
 * ThemeREX Addons Custom post type: Cars (Taxonomy 'Features' support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.25
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// -----------------------------------------------------------------
// -- Custom post type registration
// -----------------------------------------------------------------

// Define Custom post type and taxonomy constants for 'Cars'
if ( ! defined('TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES') )
		define('TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES', trx_addons_cpt_param('cars', 'taxonomy_features'));

// Register post type and taxonomy
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_init')) {
	add_action( 'init', 'trx_addons_cpt_cars_taxonomy_features_init' );
	function trx_addons_cpt_cars_taxonomy_features_init() {
		
		register_taxonomy( TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES, TRX_ADDONS_CPT_CARS_PT, array(
			'post_type' 		=> TRX_ADDONS_CPT_CARS_PT,
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => esc_html__( 'Features', 'trx_addons' ),
				'singular_name'     => esc_html__( 'Feature', 'trx_addons' ),
				'search_items'      => esc_html__( 'Search Features', 'trx_addons' ),
				'all_items'         => esc_html__( 'All Features', 'trx_addons' ),
				'parent_item'       => esc_html__( 'Parent Feature', 'trx_addons' ),
				'parent_item_colon' => esc_html__( 'Parent Feature:', 'trx_addons' ),
				'edit_item'         => esc_html__( 'Edit Feature', 'trx_addons' ),
				'update_item'       => esc_html__( 'Update Feature', 'trx_addons' ),
				'add_new_item'      => esc_html__( 'Add New Feature', 'trx_addons' ),
				'new_item_name'     => esc_html__( 'New Feature Name', 'trx_addons' ),
				'menu_name'         => esc_html__( 'Features', 'trx_addons' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => trx_addons_cpt_param('cars', 'taxonomy_features_slug') )
			)
		);
	}
}


// Replace standard theme templates
//-------------------------------------------------------------

// Change standard category template for cars categories (groups)
if ( !function_exists( 'trx_addons_cpt_cars_taxonomy_features_taxonomy_template' ) ) {
	add_filter('taxonomy_template',	'trx_addons_cpt_cars_taxonomy_features_taxonomy_template');
	function trx_addons_cpt_cars_taxonomy_features_taxonomy_template( $template ) {
		if ( is_tax(TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES) ) {
			if (($template = trx_addons_get_file_dir('cpt/cars/tpl.cars.archive_features.php')) == '') 
				$template = trx_addons_get_file_dir('cpt/cars/tpl.cars.archive.php');
		}
		return $template;
	}	
}



// Admin utils
// -----------------------------------------------------------------

// Show <select> with cars categories in the admin filters area
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_admin_filters')) {
	add_action( 'restrict_manage_posts', 'trx_addons_cpt_cars_taxonomy_features_admin_filters' );
	function trx_addons_cpt_cars_taxonomy_features_admin_filters() {
		trx_addons_admin_filters(TRX_ADDONS_CPT_CARS_PT, TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES);
	}
}
  
// Clear terms cache on the taxonomy 'features' save
if (!function_exists('trx_addons_cpt_cars_admin_clear_cache_features')) {
	add_action( 'edited_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES, 'trx_addons_cpt_cars_admin_clear_cache_features', 10, 1 );
	add_action( 'delete_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES, 'trx_addons_cpt_cars_admin_clear_cache_features', 10, 1 );
	add_action( 'created_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES, 'trx_addons_cpt_cars_admin_clear_cache_features', 10, 1 );
	function trx_addons_cpt_cars_admin_clear_cache_features( $term_id=0 ) {  
		trx_addons_admin_clear_cache_terms(TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES);
	}
}

// Additional parameters to the taxonomy
//--------------------------------------------------------------------------

// Save additional parameters
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_save_custom_fields')) {
	add_action('edited_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES,	'trx_addons_cpt_cars_taxonomy_features_save_custom_fields', 10, 1 );
	add_action('created_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES,	'trx_addons_cpt_cars_taxonomy_features_save_custom_fields', 10, 1 );
	function trx_addons_cpt_cars_taxonomy_features_save_custom_fields($term_id) {
		if (isset($_POST['trx_addons_image'])) {
			trx_addons_set_term_meta(array(
											'term_id' => $term_id,
											'key' => 'image'
											),
										$_POST['trx_addons_image']
										);
		}
	}
}

// Display additional fields
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_show_custom_fields')) {
	add_action(TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES.'_edit_form_fields', 'trx_addons_cpt_cars_taxonomy_features_show_custom_fields', 10, 1 );
	add_action(TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES.'_add_form_fields', 'trx_addons_cpt_cars_taxonomy_features_show_custom_fields', 10, 1 );
	function trx_addons_cpt_cars_taxonomy_features_show_custom_fields($term) {
		$term_id = !empty($term->term_id) ? $term->term_id : 0;

		// Image
		echo ((int) $term_id > 0 ? '<tr' : '<div') . ' class="form-field">'
			. ((int) $term_id > 0 ? '<th valign="top" scope="row">' : '<div>');
		?><label id="trx_addons_image_label" for="trx_addons_image"><?php esc_html_e('Image URL:', 'trx_addons'); ?></label><?php
		echo ((int) $term_id > 0 ? '</th>' : '</div>')
			. ((int) $term_id > 0 ? '<td valign="top">' : '<div>');
		$img = $term_id > 0 
						? trx_addons_get_term_meta(array(
													'taxonomy'	=> TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES,
													'term_id'	=> $term_id,
													'key'		=> 'image'
													)) 
						: '';
		?><input id="trx_addons_image" class="trx_addons_image_selector_field" name="trx_addons_image" value="<?php echo esc_url($img); ?>"><?php
		if (empty($img)) $img = apply_filters('trx_addons_filter_no_image', trx_addons_get_file_url('css/images/no-image.jpg'));
		trx_addons_show_layout(trx_addons_options_show_custom_field('trx_addons_image_button', array(
								'type' => 'mediamanager',
								'linked_field_id' => 'trx_addons_image'
								), $img));
		echo (int) $term_id > 0 ? '</td></tr>' : '</div></div>';
	}
}

// Create additional column in the terms list
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_add_custom_column')) {
	add_filter('manage_edit-'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES.'_columns',	'trx_addons_cpt_cars_taxonomy_features_add_custom_column', 9);
	function trx_addons_cpt_cars_taxonomy_features_add_custom_column( $columns ){
		$columns['image'] = esc_html__('Image', 'trx_addons');
		return $columns;
	}
}

// Fill additional column in the terms list
if (!function_exists('trx_addons_cpt_cars_taxonomy_features_fill_custom_column')) {
	add_action('manage_'.TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES.'_custom_column',	'trx_addons_cpt_cars_taxonomy_features_fill_custom_column', 9, 3);
	function trx_addons_cpt_cars_taxonomy_features_fill_custom_column($output='', $column_name='', $term_id=0) {
		if ($column_name == 'image') {
			$img = $term_id > 0 
						? trx_addons_get_term_meta(array(
													'taxonomy'	=> TRX_ADDONS_CPT_CARS_TAXONOMY_FEATURES,
													'term_id'	=> $term_id,
													'key'		=> 'image'
													)) 
						: '';
			if (!empty($img)) {
				?><img class="trx_addons_image_selector_preview trx_addons_image_preview" src="<?php
							echo esc_url(trx_addons_add_thumb_size($img, trx_addons_get_thumb_size('tiny')));
						?>" alt=""><?php
			}
		}
	}
}
?>