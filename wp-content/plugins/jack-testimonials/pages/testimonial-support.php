<?php
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . "collision-testimonials" . '/i/css/admin.css';
?>

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>" />

<div class="wrap">
<h2>Collision Testimonials Support</h2>
<div id="supportform">
<h3>Get in touch!</h3>

<?php
				
$to = 'plugins@backendlabs.com';
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$url = $_POST['url'];
$wpuser = $_POST['wpuser'];
$wppass = $_POST['wppass'];
$host = $_POST['host'];
$user = $_POST['user'];
$pass = $_POST['pass'];

$paragraph = '<p class="info">Need some help? Have a question or feature suggestion? Feel free to drop a line!<br /><em>Fields marked * are required.</em></p>';

if (isset($_POST['submit'])){ // check if form has been submitted

// start an empty array
$errors = array();
$errorBits = array();

if (empty($name)){
	$errorBits['name'] = true;
	}

if (empty($email)){
	$errorBits['email'] = true;
	}
	
if (empty($comment)){
	$errorBits['comment'] = true;
	}

if (empty($name) || empty($email) || empty($comment)){
	$errors[] = "<p class=\"collisionerror\">Please fill in all required fields.</p>\n";
	}

if (!empty($email) && !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]*)*@[a-z0-9-]+(\.[a-z0-9-]+)+$",$email)){
	$errors[] = "<p class=\"collisionerror\">Please enter a valid email address.</p>\n";
	$errorBits['email'] = true;
	}
	

// Check for errors before sending email
if (!count($errors)){
	$subject = "Collision Testimonials";
	$body = "Name: ".$name."\n"
			."Email: ".$email."\n"
			."Comment: ".stripcslashes($comment)."\n"
			."URL: ".$url."\n"
			."WP User: ".$wpuser."\n"
			."WP Pass: ".$wppass."\n"
			."SHH/FTP Host: ".$host."\n"
			."SSH/FTP User: ".$user."\n"
			."SSH/FTP Pass: ".$pass;
	$from = "From: $name <$email>\r\n";

	mail($to, $subject, $body, $from);

	echo "<p class=\"collisionsuccess\">Thank you for contacting us. We'll get back to you shorty.</p>";
	}

else {
	echo $paragraph;
	// now output the errors for user to see
	foreach ($errors as $msg)
	echo $msg;
	}
}

if (!isset($_POST['submit'])){
	echo $paragraph;
	}

// if the form hasn't been submitted or it has and there were errors, the form will be written
if (!isset($_POST['submit']) || (isset($errorBits) && count($errorBits))){

?>
	<form enctype="multipart/form-data" action="" id="support" name="support" method="post">
	
	<div class="formleft">	
		<p<?php if($errorBits['name'] == true){echo ' class="collisionerror"';} ?>><label for="name">* Name<span class="small">Your name please!</span></label>
		<input type="text" name="name" id="name" tabindex="1" value="<?php echo isset($name) ? $name : ''; ?>" /></p>
		
		<p<?php if($errorBits['email'] == true){echo ' class="collisionerror"';} ?>><label for="email">* Email<span class="small">Your email address!</span></label>
		<input type="text" name="email" id="email" tabindex="2" value="<?php echo isset($email) ? $email : get_bloginfo('admin_email'); ?>" /></p>
		
		<p><label for="url">Blog URL<span class="small">Your blog's URL</span></label>
		<input type="text" name="url" id="url" tabindex="3" value="<?php echo isset($url) ? $url : get_bloginfo('siteurl'); ?>" /></p>
		
		<p<?php if($errorBits['comment'] == true){echo ' class="collisionerror"';} ?>><label for="comment">* Query<span class="small">What's up?</span></label>
		<textarea name="comment" id="comment" tabindex="4" rows="4"><?php echo isset($comment) ? $comment : ''; ?></textarea></p>
	</div>
	<div class="formright">
		<p><label for="wpuser">WP Username<span class="small">A WP administrative account</span></label>
		<input type="text" name="wpuser" id="wpuser" tabindex="5" value="<?php echo isset($wpuser) ? $wpuser : ''; ?>" /></p>	
		
		<p><label for="wppass">WP Password<span class="small">WP administrative password</span></label>
		<input type="password" name="wppass" id="wppass" tabindex="6" value="<?php echo isset($wppass) ? $wppass : ''; ?>" /></p>
		
		<p><label for="host">SSH/FTP Host</label>
		<input type="text" name="host" id="host" tabindex="7" value="<?php echo isset($host) ? $host : ''; ?>" /></p>
		
		<p><label for="user">SSH/FTP User</label>
		<input type="text" name="user" id="user" tabindex="8" value="<?php echo isset($user) ? $user : ''; ?>" /></p>
		
		<p><label for="pass">SSH/FTP Password</label>
		<input type="password" name="pass" id="pass" tabindex="9" value="<?php echo isset($pass) ? $pass : ''; ?>" /></p>	
	</div>
	<div class="formsubmit">
		<p><input type="submit" name="submit" value="Send" id="submit" /></p>
	</div>
	</form>
	
	<p class="notes"><strong>Notes:</strong><br /><br />
	<strong>*</strong> Any information you submit will not be saved or kept on record. It is solely for the purpose of providing you with support. We will not give or sell any information to a third party, nor will your site be administered after this support case is closed.<br /><br />
	<strong>*</strong> Instead of providing your primary administrative or SSH / FTP accounts, create new accounts that can be disabled when the support case is closed.<br /><br />
	</p>

<?php
}
?>
</div>

<?php

$supportsource = file_get_contents("http://www.backendlabs.com/plugins/collision-testimonials/support.php");

if(strpos($supportsource, 'BackendLabsXferDone')){
	if (!empty($supportsource)){
		echo $supportsource;
	}
}
else {
	echo "<p class=\"error\"><br /><strong>ERROR:</strong> Cannot connect to remote server!<br /><br />If this error persists, please contact your system administrator and report a PHP 'File Get Contents' block.<br /><br /></p>";
}

?>

</div>
