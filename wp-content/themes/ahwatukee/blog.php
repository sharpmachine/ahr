<?php
/* Template Name: Blog Template
*/
?>

<?php get_header(); ?>



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="box">

			


<?php endwhile; ?>
</div>


<?php get_footer(); ?>
