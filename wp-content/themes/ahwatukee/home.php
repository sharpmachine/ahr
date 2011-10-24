<?php get_header(); ?>
<!--begin page content-->
<div id="page">
<div id="wave">
<h3>Mark 16:17, 18<br />
<span>&quot;In my name they will...lay hands on the sick and they will recover&quot;</span></h3>
<div><a class="buttonlink see-us" href="contact-us/come-see-us">Come See us!</a></div>
</div>


<div class="span-7 infobox push-1"><h2><a href="testimonies">Recent Testimonies</a></h2>
<div class="box">
<?php if ( is_active_sidebar( 'testimonies' ) ) : ?>

<?php dynamic_sidebar( 'testimonies' ); ?>
<?php endif; ?>

</div>

</div>

<div class="span-7 infobox"><h2><a href="soaking-music">Soaking Music</a></h2>
<div class="box">

<p>Visit our soaking page and get drenched in the healing power and peace of Jesus.</p>

</div>	
    

<div><a class="buttonlink soaking" href="http://localhost/ahr/soaking-music">Experience Soaking</a></div>	
</div>

<div class="span-7 infobox last"><h2><a href="shop">Featured Products</a></h2>
<div class="box">
<?php if ( is_active_sidebar( 'featured-products' ) ) : ?>

<?php dynamic_sidebar( 'featured-products' ); ?>
<?php endif; ?>
<a href="shop">Visit the Book Store</a>
</div>
</div>

<div class="clear">&nbsp;</div>
</div><!--end page content-->
<?php get_footer(); ?>
