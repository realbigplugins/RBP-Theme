<?php
/**
 * Adjusts some FacetWP functionality
 *
 * @since   {{VERSION}}
 * @package rbp_ELearning_Theme
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

add_filter( 'facetwp_facet_html', 'rbp_change_checkbox_facet_output', 10, 2 );

/**
 * The way that FacetWP outputs Checkboxes is not great. You can't tab navigate them and having them span columns in a visually appealing way is challenging.
 * 
 * Adjusting these to be in a <ul> and to be actual <input type="checkbox"> helps to solve both issues.
 *
 * @param   string  $output  HTML output
 * @param   array   $params  Array of Params
 *
 * @since	{{VERSION}}
 * @return  string           HTML output
 */
function rbp_change_checkbox_facet_output( $output, $params ) {

	if ( $params['facet']['type'] !== 'checkboxes' ) return $output;

	ob_start();

	?>

	<ul>

		<?php foreach ( $params['values'] as $checkbox ) : ?>

			<li>
				<label for="<?php echo esc_attr( "{$params['facet']['name']}_{$checkbox['term_id']}" ); ?>">

					<input class="facetwp-checkbox<?php echo ( in_array( $checkbox['facet_value'], $params['facet']['selected_values'] ) ) ? ' checked' : ''; ?>" type="checkbox" id="<?php echo esc_attr( "{$params['facet']['name']}_{$checkbox['term_id']}" ); ?>" data-value="<?php echo esc_attr( $checkbox['facet_value'] ); ?>"<?php echo ( in_array( $checkbox['facet_value'], $params['facet']['selected_values'] ) ) ? ' checked="true"' : ''; ?> />

					<?php echo esc_html( $checkbox['facet_display_value'] ); ?> (<?php echo esc_html( $checkbox['counter'] ); ?>)

				</label>
			</li>

		<?php endforeach; ?>

	</ul>

	<?php

	$output = ob_get_clean();

	return $output;

}