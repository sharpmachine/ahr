


<!--begin sitemap-->
<div id="sitemap" class="clear"><?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?><span>&copy;2010 Ahwatukee Healing Rooms</span>




</div><!--end sitemap-->

<!--begin footer-->
<div id="footer">
	<a href="http://www.healingrooms.com"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo_03.jpg" width="39" height="40" alt="Healing Rooms" /></a>
	<img src="<?php bloginfo( 'template_directory' ); ?>/images/logo_05.jpg" width="108" height="40" alt="Within His Presence" />
	<a href="http://www.joanhunter.org"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo_07.png" width="47" height="45" alt="Logo" /></a>



</div><!--end footer-->

</div><!--end container-->

<!--scripts-->
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/popup.js"></script>
<script type="text/javascript">
$(function(){
  $('.soaking').popupWindow({ 
height:380, 
width:250, 
top:50, 
left:50,
menubar: 250
});
   });
</script>
<?php wp_footer(); ?>
</body>
</html>
