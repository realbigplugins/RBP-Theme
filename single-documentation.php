<?php
/**
 * The theme's single file use for displaying single Documenation Pages.
 * 
 * @since 1.0.0
 * @package RealBigPlugins
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

global $post;

// Grab all so we are sure to include grandchildren
// I'm not sure why, but it only seems to work this way
$query = new WP_Query();
$all_documentation = $query->query( array(
    'post_type' => 'documentation',
    'orderby' => 'menu_order title',
    'order' => 'ASC',
    'posts_per_page' => -1,
) );

// Grab all Children and Grandchildren Recursively
$documentation_sections = get_page_children( get_the_ID(), $all_documentation );

?>

<div class="page-content row">
     
    <div id="docs" class="small-12<?php echo ( ! empty( $documentation_sections ) ) ? ' medium-9' : ''; ?> columns">

        <article id="top" <?php post_class(); ?>>

            <?php $parent_magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

            <h1 id="<?php echo $parent_magellan_link; ?>" data-magellan-target="<?php echo $parent_magellan_link; ?>" class="page-title">
                <?php the_title(); ?>
            </h1>
            <?php if ( current_user_can( 'edit_post' ) ) : ?>
                <a href="<?php echo get_edit_post_link( get_the_ID() ); ?>"><span class="fa fa-edit"></span> <?php _e( 'Edit Documentation Section', THEME_ID ); ?></a>
            <?php endif; ?>

            <?php the_content(); ?>

        </article>

        <?php if ( ! empty( $documentation_sections ) ) : 

            foreach ( $documentation_sections as $post ) : setup_postdata( $post ); ?>

                <article id="<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php $child_magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

                    <h2 id="<?php echo $child_magellan_link; ?>" data-magellan-target="<?php echo $child_magellan_link; ?>" class="section-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if ( current_user_can( 'edit_post' ) ) : ?>
                        <a href="<?php echo get_edit_post_link( get_the_ID() ); ?>"><span class="fa fa-edit"></span> <?php _e( 'Edit Documentation Section', THEME_ID ); ?></a>
                    <?php endif; ?>

                    <?php the_content(); ?>

                </article>

            <?php endforeach;

            wp_reset_postdata();

        endif; ?>

        <?php if ( $linked_download = get_post_meta( get_the_ID(), "p2p_children_downloads", true ) ) : // Grab Linked Download

            if ( $changelog = get_post_meta( $linked_download[0], '_edd_sl_changelog', true ) ) : ?>

                <h1 id="changelog" data-magellan-target="changelog"><?php _e( 'Changelog', THEME_ID ); ?></h1>

                <?php echo apply_filters( 'the_content', wp_unslash( $changelog ) );

            endif;

        endif; ?>

    </div>

    <?php if ( ! empty( $documentation_sections ) ) : ?>

        <div class="medium-3 columns sticky-container hide-on-small" data-sticky-container>

            <nav class="columns docs-toc-wrap magellan" data-sticky data-anchor="docs" data-margin-top="7">

                <ul class="docs-toc vertical menu expanded" data-magellan data-bar-offset="60">

                    <li <?php post_class(); ?>>
                        <a href="#<?php echo $parent_magellan_link; ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>

                    <?php wp_list_pages( array(
                        'post_type' => 'documentation',
                        'child_of' => get_the_ID(),
                        'title_li' => null,
                        'walker' => new Foundation_Magellan_Walker(),
                    ) ); ?>

                    <?php if ( $changelog ) : ?>

                        <li <?php post_class( array(), $linked_download[0] ); ?>>
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