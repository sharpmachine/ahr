<?php 

/* Template Name: Soaking Page

*/

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Soaking Music</title>
<style>
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	vertical-align: baseline;
	background: transparent;
}
body {
	line-height: 1;
	overflow: hidden;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}

/* remember to define focus styles! */
:focus {
	outline: 0;
}

/* remember to highlight inserts somehow! */
ins {
	text-decoration: none;
}
del {
	text-decoration: line-through;
}

/* tables still need 'cellspacing="0"' in the markup */
table {
	border-collapse: collapse;
	border-spacing: 0;
}
</style>

<link rel="alternate" type="application/rss+xml" title="Ahwatukee Healing Rooms &raquo; Soaking Music Comments Feed" href="http://www.ahwatukeehealingrooms.com/soaking-music/feed" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js?ver=2.2'></script> 
<script type='text/javascript' src='http://www.ahwatukeehealingrooms.com/wp-includes/js/jquery/jquery.js?ver=1.4.2'></script> 
<link rel='canonical' href='http://www.ahwatukeehealingrooms.com/soaking-music' /> 
</head>
<body>

<?php if ( is_active_sidebar( 'soaking-music' ) ) : ?>

<?php dynamic_sidebar( 'soaking-music' ); ?>
<?php endif; ?>

</body>
</html>
