<?php
/**
 * The theme's single file use for displaying single Documenation Pages.
 *
 * @since 1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
defined( 'ABSPATH' ) || die;

add_action( 'wp_head', 'rbp_single_documentation_colors' );

/**
 * Outputs some CSS for coloring based on the specific download.
 *
 * @since {{VERSION}}
 * @access private
 */
function rbp_single_documentation_colors() {

	global $documentation_page_styled;

	$documentation_page_styled = false;

	if ( ! ( $link_download_ID = rbm_cpts_get_p2p_parent( 'download' ) ) ) {

		return;
	}

	if ( ! ( $primary_color = get_post_meta( $link_download_ID, '_rbm_primary_color', true ) ) ) {

		return;
	}

	$documentation_page_styled = true;
	?>
	<style type="text/css">
		.documentation-header {
			background-color: <?php echo $primary_color; ?>;
			color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;
		}

		<?php if ( ! rbp_is_light( $primary_color ) ) : ?>
		.single-documentation .magellan .active {
			background-color: <?php echo $primary_color; ?>;
			color: <?php echo ( rbp_is_light( $primary_color ) ) ? '#000' : '#fff'; ?>;
		}

		.single-documentation .magellan a {
			color: <?php echo $primary_color; ?>;
		}

		.button {
			background-color: <?php echo $primary_color; ?>;
		}

		.button:hover {
			background-color: <?php echo rbp_darken_hex( $primary_color, 10 ); ?>;
		}
		<?php endif; ?>
	</style>
	<?php
}

/**
 * Loops through documentation descendents and outputs them.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param int $parent_ID
 * @param int $depth
 */
function rbp_documentation_loop( $parent_ID, $depth = 0 ) {

	global $post;

	// Max of 2 (index of 1)
	if ( $depth > 1 ) {

		return;
	}

	$docs = get_posts( array(
		'post_type'   => 'documentation',
		'post_parent' => $parent_ID,
		'orderby'     => 'menu_order title',
		'order'       => 'ASC',
		'numberposts' => - 1,
	) );

	if ( ! $docs ) {

		return;
	}

	foreach ( $docs as $post ) {

		$header_tag = 'h' . ( $depth + 2 );

		setup_postdata( $post ); ?>

		<article id="documentation-<?php the_ID(); ?>" <?php post_class( array( "depth-$depth" ) ); ?>>

			<?php $child_magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

			<?php echo "<$header_tag id=\"$child_magellan_link\" data-magellan-target=\"$child_magellan_link\" class=\"section-title\">"; ?>
			<?php the_title(); ?>
			<?php edit_post_link( '<span class="fa fa-edit"></span>' ); ?>
			<?php echo "</$header_tag>"; ?>

			<?php the_content(); ?>

		</article>

		<?php rbp_documentation_loop( get_the_ID(), $depth + 1 ); ?>

		<?php wp_reset_postdata();
	}
}


get_header();

the_post();

global $documentation_page_styled;

$has_children = get_posts( array(
		'post_type'   => 'documentation',
		'numberposts' => 1,
		'post_parent' => get_the_ID(),
	) ) || false;


$link_download_ID = rbm_cpts_get_p2p_parent( 'download' );
?>

	<div class="page-content row">

		<div id="docs" class="small-12 <?php echo $has_children ? 'medium-9' : ''; ?> columns">

			<header
				class="documentation-header <?php echo $documentation_page_styled ? 'documentation-styled' : ''; ?>">

				<?php $parent_magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

				<h1 id="<?php echo $parent_magellan_link; ?>"
				    data-magellan-target="<?php echo $parent_magellan_link; ?>" class="page-title">
					<?php the_title(); ?>
				</h1>

				<p class="documentation-subheader">
					Documentation
				</p>

			</header>

			<?php if ( $link_download_ID ) : ?>
				<div class="documentation-plugin-link">
					<a href="<?php echo get_permalink( $link_download_ID ); ?>" class="button large">
						View Plugin <span class="fa fa-arrow-right"></span>
					</a>
				</div>
			<?php endif; ?>

			<section class="documentation-content">
				<?php the_content(); ?>
			</section>

			<?php rbp_documentation_loop( get_the_ID() ); ?>

			<?php if ( $link_download_ID && class_exists( 'EDD_SL_Download' ) ) : 

				$sl_download = new EDD_SL_Download( $link_download_ID );

				if ( $changelog = $sl_download->get_changelog() ) : ?>

					<article id="documentation-<?php the_ID(); ?>-changelog" class="documentation depth-0">

						<h2 id="changelog" class="section-title"
						    data-magellan-target="changelog"><?php _e( 'Changelog', THEME_ID ); ?></h2>

						<?php echo apply_filters( 'the_content', wp_unslash( $changelog ) ); ?>

					</article>

				<?php endif;

			endif; ?>

		</div>

		<?php if ( $has_children ): ?>

			<div class="medium-3 columns sticky-container hide-on-small" data-sticky-container>

				<nav class="docs-toc-wrap magellan" data-sticky data-anchor="docs" data-margin-top="7">

					<ul class="docs-toc vertical menu expanded" data-magellan data-bar-offset="60">

						<li <?php post_class(); ?>>
							<a href="#<?php echo $parent_magellan_link; ?>">
								<?php the_title(); ?>
							</a>
						</li>

						<?php wp_list_pages( array(
							'post_type'    => 'documentation',
							'child_of'     => get_the_ID(),
							'title_li'     => null,
							'sort_columns' => 'post_title',
							'walker'       => new Foundation_Magellan_Walker(),
						) ); ?>

						<?php if ( isset( $changelog ) && $changelog ) : ?>

							<li <?php post_class( array(), $link_download_ID ); ?>>
								<a href="#changelog">
									<?php _e( 'Changelog', THEME_ID ); ?>
								</a>
							</li>

						<?php endif ?>

					</ul>

				</nav>

			</div>

		<?php endif; ?>

	</div>

<?php
get_footer();