<?php 
/* Template Name: Events Page */


get_header(); ?>

<!--begin page content-->
<div id="page">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="box box2">

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				

<?php endwhile; ?>
</div>
<?php get_sidebar(); ?>
<div class="clear">&nbsp;</div>

<?php if ( is_active_sidebar( 'bottom-message' ) ) : ?>

<?php dynamic_sidebar( 'bottom-message' ); ?>
<?php endif; ?>

</div><!--end page content-->

<?php get_footer(); ?>