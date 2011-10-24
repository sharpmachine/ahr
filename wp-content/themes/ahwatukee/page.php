<?php get_header(); ?>
<!--begin page content-->
<div id="page">


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="box">

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				

<?php endwhile; ?>
</div>
<div class="clear">&nbsp;</div>
</div><!--end page content-->

<?php get_footer(); ?>
