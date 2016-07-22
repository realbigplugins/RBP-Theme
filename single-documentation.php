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
        
$args = array( 
    'post_type' => 'documentation',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
);

$documentation_sections = new WP_Query( $args );

?>

	<div class="page-content row">
        
        <div id="docs" class="small-12<?php echo ( $documentation_sections->have_posts() ) ? ' medium-9' : ''; ?> columns">

            <article id="top" <?php post_class(); ?>>
                
                <?php $magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

                <h1 id="<?php echo $magellan_link; ?>" data-magellan-target="<?php echo $magellan_link; ?>" class="page-title">
                    <?php the_title(); ?>
                </h1>

                <?php the_content(); ?>

            </article>

            <?php if ( $documentation_sections->have_posts() ) : 

                while ( $documentation_sections->have_posts() ) : $documentation_sections->the_post(); ?>

                    <article id="<?php the_ID(); ?>" <?php post_class(); ?>>
                        
                        <?php $magellan_link = Foundation_Magellan_Walker::magellan_target( get_the_title() ); ?>

                        <h2 id="<?php echo $magellan_link; ?>" data-magellan-target="<?php echo $magellan_link; ?>" class="section-title">
                            <?php the_title(); ?>
                        </h1>

                        <?php the_content(); ?>

                    </article>

                <?php endwhile;

                wp_reset_postdata();

            endif; ?>
            
        </div>
        
        <?php if ( $documentation_sections->have_posts() ): ?>
        
            <div class="medium-3 columns sticky-container hide-on-small" data-sticky-container>
                
                <nav class="columns docs-toc-wrap" data-sticky data-anchor="docs" data-margin-top="7">
                    
                    <ul class="docs-toc vertical menu expanded" data-magellan data-bar-offset="60">
                    
                        <?php wp_list_pages( array(
                            'post_type' => 'documentation',
                            'child_of' => get_the_ID(),
                            'title_li' => null,
                            'walker' => new Foundation_Magellan_Walker(),
                        ) ); ?>
                        
                    </ul>
                    
                </nav>

            </div>
        
        <?php endif; ?>

	</div>

<?php
get_footer();