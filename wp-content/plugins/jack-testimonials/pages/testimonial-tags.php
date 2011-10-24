<?php
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . "collision-testimonials" . '/i/css/admin.css';
?>

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>" />

<div class="wrap">
<h2>Collision Testimonial Tags</h2>

<?php

$tagsource = file_get_contents("http://www.backendlabs.com/plugins/collision-testimonials/tags.php");

if(strpos($tagsource, 'BackendLabsXferDone')){
	if (!empty($tagsource)){
		echo $tagsource;
	}
}
else {
	echo "<p class=\"error\"><br /><strong>ERROR:</strong> Cannot connect to remote server!<br /><br />If this error persists, please contact your system administrator and report a PHP 'File Get Contents' block.<br /><br /></p>";
}

?>
</div>