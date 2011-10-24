<?php 
/*
  Plugin Name: Collision Testimonials
  Plugin URI: http://www.backendlabs.com/plugins/collision-testimonials/
  
  Description: With this plugin you can easily add, edit, and delete client testimonials for your website. Your users can submit testimonials and with your approval they will instantly be displayed on your website.

  Author: Backend Labs, Inc.
  Author URI: http://www.backendlabs.com/

  Version: 2.9
*/

// Creating tables on plugin activation
function testimonials_install() {
	
	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Current DB Version
	$current_db_query = mysql_query("SELECT value FROM $testimonials_settings WHERE name='db_version'");
	$row = mysql_fetch_array($current_db_query);
	$current_db_ver = $row['value'];
	
	// Settings current DB version for future upgrades
	$db_version_new = '2.9';
	
	// Does the database already exist?
	if ($wpdb->get_var("show tables like '$testimonials'") != $testimonials) { // No, it doesn't
		
		// Creating the testimonials table!
		$sql1 = "CREATE TABLE " . $testimonials . " (
		id INT(12) NOT NULL AUTO_INCREMENT,
		status INT(12) NOT NULL DEFAULT '0',
		featured INT(12) NOT NULL DEFAULT '0',
		date DATE NULL,
		name VARCHAR(255),
		location VARCHAR(255),
		headline VARCHAR(255),
		quote TEXT,
		website VARCHAR(255),
		PRIMARY KEY (id)
		);";
		
		// Creating the testimonials settings table!
		$sql2 = "CREATE TABLE " . $testimonials_settings . " (
			id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(255) NOT NULL,
			value VARCHAR(100)
		);";

		// Requiring WP upgrade and running SQL query
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql1);
		dbDelta($sql2);

		// Populating the DB with test entry
		$name = "Backend Labs, Inc.";
		$date = date("Y-m-d");
		$location = "Somewhere in the universe";
		$headline = "Got healed!";
		$quote = "Congratulations, you have completed the installation! If you find our plugin useful, please rate it 5 stars!";
		$website = "http://www.backendlabs.com/";
		
		// Inserting testimonial into the DB
		$insert = "INSERT INTO " . $testimonials .
		" (id, status, featured, name, location, ,headline, quote, website) " .
		"VALUES ('','0','0','" . $wpdb->escape($date) . "','" . $wpdb->escape($name) . "','" . $wpdb->escape($location) . "','" . $wpdb->escape($headline) . "','" . $wpdb->escape($quote) . "','" . $wpdb->escape($website) . "')";
		
		// Running the query
		$results = $wpdb->query($insert);
		
		// Required for all WordPress database manipulations
		global $wpdb;
		
		// Grabbing DB prefix and settings table names to variable
		$options_table = $wpdb->prefix . "options";
		
		// Getting the admin email for plugin
		$admin_email_query = mysql_query("SELECT option_value FROM $options_table WHERE option_name='admin_email'");		
		$admin_email_row = mysql_fetch_array($admin_email_query);
		$admin_email = $admin_email_row['option_value'];
		
		// Inserting default settings into the DB		
		$insert = "INSERT INTO " . $testimonials_settings .
		" (id, name, value) " .
		"VALUES ('1','plugin_name_s','Testimonial'), ('2','plugin_name_p','Testimonials'), ('3','testimonial_num','1'), ('4','testimonial_prefix','<p class=\"testimonial\">'), ('5','testimonial_suffix','</p>'), ('6','testimonial_privileges',''), ('7','admin_email','$admin_email'),('8','testimonial_page_num','15'),('9','page_prefix','<p class=\"testimonials_page\">'),('10','page_suffix','</p>'),('11','featured_prefix','<p class=\"featured\">'),('12','featured_suffix','</p>'),('13','date','1'),('14','captcha','1'),('15','captcha_question','Is fire hot or cold?'),('16','captcha_answer','hot'),('17','db_version','$db_version_new')";
		
		// Running the query
		$results = $wpdb->query($insert);
	}
	
	elseif ($current_db_ver == '2.9') {
		// Required for all WordPress database manipulations
		global $wpdb;

		// No DB changes needed!
		
		// Updating version number!
		$update_option = "UPDATE $testimonials_settings SET value='$db_version_new' WHERE name='db_version'";
		$wpdb->query($update_option);
	}
	
	else {

		// Update to 2.9 DB structure....

		// Required for all WordPress database manipulations
		global $wpdb;
			
		// Grabbing DB prefix and settings table names to variable
		$testimonials = $wpdb->prefix . "testimonials";
		$testimonials_settings = $wpdb->prefix . "testimonials_settings";
			
		// Backing up testimonials....
		$testimonialsQuery = "SELECT * FROM $testimonials";
		$theTestimonials = mysql_query($testimonialsQuery);	

		// Drop existing tables
		mysql_query("DROP TABLE IF EXISTS $testimonials");
		mysql_query("DROP TABLE IF EXISTS $testimonials_settings");
			
		// Creating the testimonials table!
		$sql1 = "CREATE TABLE " . $testimonials . " (
		id INT(12) NOT NULL AUTO_INCREMENT,
		status INT(12) NOT NULL DEFAULT '0',
		featured INT(12) NOT NULL DEFAULT '0',
		date DATE NULL,
		name VARCHAR(255),
		location VARCHAR(255),
		headline VARCHAR(255),
		quote TEXT,
		website VARCHAR(255),
		PRIMARY KEY (id)
		);";
		
		// Creating the testimonials settings table!
		$sql2 = "CREATE TABLE " . $testimonials_settings . " (
		id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(255) NOT NULL,
		value VARCHAR(100)
		);";
		
		// Requiring WP upgrade and running SQL query
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql1);
		dbDelta($sql2);
	
		// Populating the DB with existing entries.		
		while ($data = mysql_fetch_array($theTestimonials)) {
				
			// Setting the testimonial information to variables for easy access
			$status = $data['status'];
			$featured = $data['featured'];
			$name = $data['name'];
			$location = $data['location'];
			$headline = $data['headline'];
			$quote = $data['quote'];
			$website = $data['website'];
			
			// Inserting testimonial into the DB
			$insert = "INSERT INTO " . $testimonials .
			" (id, status, featured, date, name, location, headline, quote, website) " .
			"VALUES ('','" . $wpdb->escape($status) . "','" . $wpdb->escape($featured) . "',NULL,'" . $wpdb->escape($name) . "','" . $wpdb->escape($location) . "', '" . $wpdb->escape($headline) . "','" . $wpdb->escape($quote) . "','" . $wpdb->escape($website) . "')";
			
			// Running the query
			$wpdb->query($insert);			
		}
		
		// Required for all WordPress database manipulations
		global $wpdb;
		
		// Grabbing DB prefix and settings table names to variable
		$options_table = $wpdb->prefix . "options";
		
		// Getting the admin email for plugin
		$admin_email_query = mysql_query("SELECT option_value FROM $options_table WHERE option_name='admin_email'");		
		$admin_email_row = mysql_fetch_array($admin_email_query);
		$admin_email = $admin_email_row['option_value'];
		
		$insert = "INSERT INTO " . $testimonials_settings .
		" (id, name, value) " .
		"VALUES ('1','plugin_name_s','Testimonial'), ('2','plugin_name_p','Testimonials'), ('3','testimonial_num','1'), ('4','testimonial_prefix','<p class=\"testimonial\">'), ('5','testimonial_suffix','</p>'), ('6','testimonial_privileges',''), ('7','admin_email','$admin_email'),('8','testimonial_page_num','15'),('9','page_prefix','<p class=\"testimonials_page\">'),('10','page_suffix','</p>'),('11','featured_prefix','<p class=\"featured\">'),('12','featured_suffix','</p>'),('13','date','1'),('14','captcha','1'),('15','captcha_question','Is fire hot or cold?'),('16','captcha_answer','hot'),('17','db_version','$db_version_new')";
		
		// Running the query
		$results = $wpdb->query($insert);

		// Updating version number!
		$update_option = "UPDATE $testimonials_settings SET value='$db_version_new' WHERE name='db_version'";
		$wpdb->query($update_option);
	}		
}

// Let's run the above install/upgrade function
register_activation_hook(__FILE__,'testimonials_install');

/* WordPress Menu */
function testimonials() {
	include_once('pages/testimonials.php');
}

function testimonial_settings() {
	include_once('pages/testimonial-settings.php');
}

function collision_tags() {
	include_once('pages/testimonial-tags.php');
}

function collision_support() {
	include_once('pages/testimonial-support.php');
}

/*
	Creates the menu with the following options in order.
	(Page Title, Menu Title, Permission Level, File, Admin Page Function, Icon URL)
*/

function testimonials_config_menu() {

	// Required for all WordPress database manipulations
	global $wpdb;
		
	// Grabbing DB prefix and settings table names to variable
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	$query = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_privileges'", ARRAY_A);		
	$testimonial_privileges = $query['value'];
	
	if($testimonial_privileges == 2) {
		$user_permission = '7';
	}
	
	else {
		$user_permission = '10';
	}
	
	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Getting the plugin name for display purposes
	$plugin_name = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_p'", ARRAY_A);
	$plugin_name = strtolower($plugin_name['value']);
	$plugin_nameUCase = ucwords($plugin_name);
	
	if (function_exists('add_menu_page')) {
		add_menu_page("Collision Testimonials", "$plugin_nameUCase", $user_permission, "testimonials", "testimonials", get_option('siteurl') . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/i/images/testimonials.png');			
		add_submenu_page('testimonials', 'Collision Testimonials Settings', 'Settings', '10', 'testimonial_settings', 'testimonial_settings');
		add_submenu_page('testimonials', 'Collision Testimonials Tags', 'Tags', '10', 'collision_tags', 'collision_tags');
		add_submenu_page('testimonials', 'Collision Testimonials Support', 'Support', '10', 'collision_support', 'collision_support');
	}
}

// Main Function Code, to be included on themes
function collision_testimonials($id="") {

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";

	if (!empty($id)) { // If the id has been set, show that testimonial instead!

		// Getting prefix and suffix from database
		$testimonial_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_prefix'", ARRAY_A);		
		$testimonial_prefix = $testimonial_prefix['value'];
		
		$testimonial_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_suffix'", ARRAY_A);		
		$testimonial_suffix = $testimonial_suffix['value'];

		// New query adds in status checking to ensure we are only grabing the public testimonials!
		$query = "SELECT * FROM $testimonials WHERE status!='1' AND status!='2' AND id IN($id) ORDER BY FIELD(id, $id)";
		$results = mysql_query($query);
		
		while ($data = mysql_fetch_array($results)) {
			// Setting the testimonial information to variables for easy access
			$name = stripslashes($data['name']);
			$date = stripslashes($data['date']);
			$location = stripslashes($data['location']);
				if (!empty($location)){
					$location = ", ".$location;
				}
			$headline = stripslashes($data['headline']);
				if (!empty($headline)){
					$headline = " ".$headline;
				}
			$quote = stripslashes($data['quote']);
			$websitepre = '';
			$websitesuf = '';
			$website = $data['website'];
				if (!empty($website)) {					
					$websitepre = '<a href="'.$website.'">';
					$websitesuf = '</a>';
				}
		
			// Final HTML Output
			$theTestimonials .= $testimonial_prefix . $quote . '<br /><span>&mdash; <strong>' . $websitepre . $name . $websitesuf . '</strong><em>' . $location . "</em></span>" . $headline . $testimonial_suffix;
		}

		// Let's echo it to the screen baby!
		echo $theTestimonials;

		mysql_free_result($results);
	}

	else { // Nothing set, let's randomize it!
		// How many testimonials are we going to show when called?
		$testimonial_num = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_num'", ARRAY_A);		
		$testimonial_num = $testimonial_num['value'];
				
		// New query adds in status checking to ensure we are only grabing the public testimonials!
		$query = "SELECT * FROM $testimonials WHERE status!='1' AND status!='2' ORDER BY RAND() LIMIT $testimonial_num";
		$results = mysql_query($query);
		
		while ($data = mysql_fetch_array($results)) {
			
			// Setting the testimonial information to variables for easy access for Widget
			$name = stripslashes($data['name']);
			$location = stripslashes($data['location']);
				if (!empty($location)){
					$location = " - ".$location;
				}
			$headline = stripslashes($data['headline']);
				if (!empty($headline)){
					$headline = " ".$headline;
				}
			$quote = stripslashes($data['quote']);
			$websitepre = '';
			$websitesuf = '';
			$website = $data['website'];
				if (!empty($website)) {					
					$websitepre = '<a href="'.$website.'">';
					$websitesuf = '</a>';
				}
			
			// Getting prefix and suffix from database
			$testimonial_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_prefix'", ARRAY_A);		
			$testimonial_prefix = $testimonial_prefix['value'];
			
			$testimonial_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_suffix'", ARRAY_A);		
			$testimonial_suffix = $testimonial_suffix['value'];
	
			// Final HTML Output for Widget
			#$theTestimonial = $testimonial_prefix . '<br /><span>&mdash; <strong>' . $websitepre . $name . $websitesuf . '</strong><em>' . $location . "</em></span>" . $headline . $testimonial_suffix;
			
			$theTestimonial = $testimonial_prefix . '<span>&bull; <strong>' . $headline . '</strong><br />' . $name . '<em>' . $location . '</em></span>' . $testimonial_suffix;
					
			// Let's echo it to the screen baby!
			echo $theTestimonial;
			
		}
		
		echo "<p><a href='testimonies'>Read More Testimonies&hellip;</a></p>";
		mysql_free_result($results);
	}
}

// Function to display all testimonials on a testimonials page
function collision_testimonials_page() {
	// Required for all WordPress database manipulations
	global $wpdb;
	
	$theTestimonials = '';
	$featuredTestimonials = '';

	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Getting max number of testimonials to show on testimonials page
	$testimonial_page_num = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_page_num'", ARRAY_A);
	$testimonial_page_num = $testimonial_page_num['value'];
	
	// Getting prefix and suffix from database
	$page_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='page_prefix'", ARRAY_A);
	$page_prefix = $page_prefix['value'];

	$page_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='page_suffix'", ARRAY_A);
	$page_suffix = $page_suffix['value'];
	
	// Getting the featured prefix and suffix from the database
	$featured_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='featured_prefix'", ARRAY_A);
	$featured_prefix = $featured_prefix['value'];
	
	$featured_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='featured_suffix'", ARRAY_A);
	$featured_suffix = $featured_suffix['value'];

	/********************************
	 * Featured Testimonials
	 ********************************/
	$current_testimonial_num = '0';

	$featured = "SELECT * FROM $testimonials WHERE status!='1' AND status!='2' AND featured='1' ORDER BY RAND()";	
	$featured_results = mysql_query($featured);
	
	while ($data = mysql_fetch_array($featured_results)) {
		// Setting the testimonial information to variables for easy access
		$name = stripslashes($data['name']);
		$location = stripslashes($data['location']);
			if (!empty($location)){
				$location = ", ".$location;
			}
		$headline = stripslashes($data['headline']);
			if (!empty($headline)){
				$headline = ", ".$headline;
			}
		$quote = stripslashes($data['quote']);
			$websitepre = '';
			$websitesuf = '';
			$website = $data['website'];
				if (!empty($website)) {
					$websitepre = '<a href="'.$website.'">';
					$websitesuf = '</a>';
				}

		// Final HTML Output
		$featuredTestimonials .= $featured_prefix . $quote . '<br /><span>&mdash; <strong>' . $websitepre . $name . $websitesuf . '</strong><em>' . $location . "</em></span>" . $featured_suffix;
		
		
		$current_testimonial_num++;
	}
	
	mysql_free_result($featured_results);


	/********************************
	 * Testimonials
	 ********************************/
	// Subtracting featured testimonials from the max num (user set)
	$generate_x = $testimonial_page_num - $current_testimonial_num;

	$query = "SELECT * FROM $testimonials WHERE status!='1' AND status!='2' AND featured!='1' ORDER BY RAND() LIMIT $generate_x";
	$results = mysql_query($query);

	while ($data = mysql_fetch_array($results)) {
		// Setting the testimonial information to variables for easy access
		$name = stripslashes($data['name']);
		$location = stripslashes($data['location']);
			if (!empty($location)){
				$location = ", ".$location;
			}
		$headline = stripslashes($data['headline']);
			if (!empty($headline)){
				$headline = ", ".$headline;
			}
		$quote = stripslashes($data['quote']);
			$websitepre = '';
			$websitesuf = '';
			$website = $data['website'];
				if (!empty($website)) {
					$websitepre = '<a href="'.$website.'">';
					$websitesuf = '</a>';
				}

		// Final HTML Output
		$theTestimonials .= $page_prefix . $quote . '<br /><span>&mdash; <strong>' . $websitepre . $name . $websitesuf . '</strong><em>' . $location . "</em></span>" . $page_suffix;

	}
	
	mysql_free_result($results);
	

	/********************************
	 * Outputting Testimonials Page
	 ********************************/
	
	// Setting featured testimonials to a display variable.
	$final_display = $featuredTestimonials;
	
	// Concatenating the testimonials to the display variable.
	$final_display .= $theTestimonials;
	
	// Return everything to the screen.
	return $final_display;
}

// Function to allow users to submit testimonials through a form
function collision_testimonials_form() {
	// Variables
	$clientname = $_POST['clientname'];
	$email = $_POST['email'];
	$location = $_POST['location'];
	$headline = $_POST['headline'];
	$testimonial = $_POST['testimonial'];
	$website = $_POST['website'];
	$captcha_value = strtolower($_POST['captcha_value']);
	$html = '';

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Getting the plugin name for display purposes
	$plugin_name = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_s'", ARRAY_A);
	$plugin_name = strtolower($plugin_name['value']);
	$plugin_nameUCase = ucwords($plugin_name);

	$paragraph = '<p class="info">Please fill in the form below to submit your ' . $plugin_name. '.<br /><em>Required fields are marked *</em></p>';
	
	// Getting the Captcha Question
	$captcha_question = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='captcha_question'", ARRAY_A);
	$captcha_question = $captcha_question['value'];

	// Getting the Captcha Answer	
	$captcha_answer = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='captcha_answer'", ARRAY_A);
	$captcha_answer = strtolower($captcha_answer['value']);
	
	// Ensuring the website URL has http://
	$website_final = '';
	if (!empty($website)) {
		$website_final = (substr(ltrim($website), 0, 7) != 'http://' ? 'http://' : '') . $website;
	}

	if (isset($_POST['submit'])){ // check if form has been submitted

		// start an empty array
		$formerrors = array();
		$formerrorBits = array();

		if (empty($clientname)){
			$formerrorBits['clientname'] = true;
		}
	
		if (empty($email)){
			$formerrorBits['email'] = true;
		}
	
		if (empty($testimonial)){
			$formerrorBits['testimonial'] = true;
		}
		
		if (empty($location)){
			$formerrorBits['location'] = true;
		}
		
		if (empty($headline)){
			$formerrorBits['headline'] = true;
		}

		if (empty($captcha_value)){
			$formerrorBits['captcha_value'] = true;
		}

		if (empty($clientname) || empty($email) || empty($testimonial) || empty($location) || empty($headline) || empty($captcha_value)){
			$formerrors[] = "<p class=\"collisionerror\">Please fill in all required fields.</p>\n";
		}

		if (!empty($email) && !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]*)*@[a-z0-9-]+(\.[a-z0-9-]+)+$",$email)){
			$formerrors[] = "<p class=\"collisionerror\">Please enter a valid email address.</p>\n";
			$formerrorBits['email'] = true;
		}

		if (!empty($captcha_value) && ($captcha_value !== $captcha_answer)){
			$formerrors[] = "<p class=\"collisionerror\">Please enter the correct answer to the anti-spam question.</p>\n";
			$formerrorBits['captcha_value'] = true;
		}
	
		// Check for errors before_title sending email
		if (!count($formerrors)){
			
			$insert = "INSERT INTO " . $testimonials .
			" (id, status, name, location, headline, quote, website) " .
			"VALUES ('','" . $wpdb->escape('2') . "','" . $wpdb->escape($clientname) . "','" . $wpdb->escape($location) . "','" . $wpdb->escape($headline) . "','" . $wpdb->escape($testimonial) . "','" . $wpdb->escape($website_final) . "')";
			$results = $wpdb->query($insert);
			
			$to = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='admin_email'", ARRAY_A);		
			$to = $to['value'];
			$subject = "$plugin_nameUCase Added";
			$body = "Name: ".$clientname."\n"
					."Email: ".$email."\n"
					."Location: ".$location."\n"
					."Headline: ".$headline."\n"
					."$plugin_nameUCase: ".stripcslashes($testimonial)."\n"
					."Website: ".$website."\n"
					."\n"
					."Please log into your WordPress Dashboard and approve the $plugin_name by clicking on Edit, and setting the status to \"Public\".";
					
			$from = "From: $name <$email>\r\n";

			mail($to, $subject, $body, $from);

			$html .= "<p class=\"collisionsuccess\">Thanks for adding your $plugin_name. Please wait for an administrator to approve it.</p>";
		}

		else {
			$html .= $paragraph;
			// now output the errors for user to see
			foreach ($formerrors as $msg)
			$html .= $msg;
		}
	}

	if (!isset($_POST['submit'])){
		$html .= $paragraph;
	}

	// if the form hasn't been submitted or it has and there were errors, the form will be written
	if (!isset($_POST['submit']) || (isset($formerrorBits) && count($formerrorBits))){

	$html .= '<form enctype="multipart/form-data" action="" id="testimonials" name="testimonials" method="post">
		<p';
		
		if($formerrorBits['clientname'] == true){$html .= ' class="collisionerror"';}
	
	$html .= '><label for="clientname">Name *</label>
		<input type="text" name="clientname" id="clientname" value="';
		
		if(isset($clientname)){$html .= $clientname;}
	
	$html .= '" /></p>
		
		<p';
	
		if($formerrorBits['email'] == true){$html .= ' class="collisionerror"';}
	
	$html .= '><label for="email">Email *</label>
		<input type="text" name="email" id="email" value="';
		
		if(isset($email)){$html .= $email;}
	
	$html .= '" /></p>
		
		<p';
	
		if($formerrorBits['location'] == true){$html .= ' class="collisionerror"';}
	
	$html .= '><label for="location">Location (City, State)*</label>
		<input type="text" name="location" maxlength="12" id="location" value="';
		
		if(isset($location)){$html .= $location;}
		
	$html .= '" /></p>
	
	<p';
	
		if($formerrorBits['headline'] == true){$html .= ' class="collisionerror"';}
	
	$html .= '><label for="headline">Headline*</label>
		<input type="text" name="headline" maxlength="21" id="headline" value="';
		
		if(isset($headline)){$html .= $headline;}
		
	$html .= '" /></p>
		
		<p';
		
		if($formerrorBits['testimonial'] == true){$html .= ' class="collisionerror"';}
	
	$html .= '><label for="testimonial">' . $plugin_nameUCase . ' *</label>
		<textarea name="testimonial" id="testimonial" rows="8">';
		
		if(isset($testimonial)){$html .= $testimonial;}
		
	$html .= '</textarea></p>
		
		<p';
	
		if($formerrorBits['website'] == true){$html .= ' class="collisionerror"';}
		
	$html .= '><label for="website" style="display: none;">Website</label>
		<input type="text" name="website" id="website" style="display: none;" value="';
		
		if(isset($website)){$html .= $website;}
	
	$html .= '" /></p>
		
		<p';
		
		if($formerrorBits['captcha_value'] == true){$html .= ' class="collisionerror"';}
		
	$html .= '><label for="captcha_value">';
	$html .= $captcha_question;
	$html .= '*</label>
		<input type="text" name="captcha_value" id="captcha_value" value="';
		
		if(isset($captcha_value)){$html .= $captcha_value;}
	
	$html .= '" /></p>
		
		<p><input type="submit" name="submit" value="Submit" id="submit" /></p>
	</form>';
		
	}

	// mysql_free_result($results);
	
	return $html;
}


class CollisionWidget extends WP_Widget {
 /**
  * Declares the CollisionWidget class.
  *
  */
	function CollisionWidget(){
		$widget_ops = array('classname' => 'collision_widget', 'description' => __( "Collision Testimonials Widget!") );
		$control_ops = array('width' => 200, 'height' => 300);
		$this->WP_Widget('collisionwidget', __('Collision Testimonials'), $widget_ops, $control_ops);
	}

  /**
    * Displays the Widget
    *
    */
	function widget($args, $instance){
		
		// Getting theme arguments
		extract($args);

		// Applying before widget code, set by theme.
		echo $before_widget;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Testimonials' : $instance['title']);
		
		# The title
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		// Run the Collision Testimonials Function
		collision_testimonials();
		
		// Applying after widget code, set by theme.
		echo $after_widget;
	}

  /**
    * Saves the widgets settings.
    *
    */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));		
		return $instance;
	}

  /**
    * Creates the edit form for the widget.
    *
    */
	function form($instance){
		//Defaults
		$instance = wp_parse_args((array) $instance, array('title'=>''));
		
		$title = htmlspecialchars($instance['title']);
		
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
	}

} // END class

/**
  * Register Collision Testimonials Widget.
  *
  * Calls 'widgets_init' action after_title the Collision Testimonials widget has been registered.
  */
	function collisionwidgetInit() {
		register_widget('CollisionWidget');
	}

// Creating the tag that allows users to have testimonials page (<!-- collision_testimonials_page -->)
function testimonials_page($content) {
	if (strpos($content, "<p><!-- collision_testimonials_page -->") !== FALSE) {
		$content = str_replace("<p><!-- collision_testimonials_page -->", collision_testimonials_page(), $content);
	}
	else {
		if (strpos($content, "<!-- collision_testimonials_page -->") !== FALSE) {
			$content = str_replace("<!-- collision_testimonials_page -->", collision_testimonials_page(), $content);
		}
	}
	return $content;
}

// Creating the tag that allows users to have testimonials form (<!-- collision_testimonials_form -->)
function testimonials_form($content) {
	if (strpos($content, "<p><!-- collision_testimonials_form --></p>") !== FALSE) {
		$content = str_replace("<p><!-- collision_testimonials_form -->", collision_testimonials_form(), $content);
	}
	else {
		if (strpos($content, "<!-- collision_testimonials_form -->") !== FALSE) {
			$content = str_replace("<!-- collision_testimonials_form -->", collision_testimonials_form(), $content);
		}
	}
	return $content;
}

// Add a widget to the Dashboard
if (!function_exists('collision_db_widget')) {
	
	function collision_db_widget() {
		$widgetsource = file_get_contents("http://www.backendlabs.com/plugins/collision-testimonials/dash.php");

		if(strpos($widgetsource, 'BackendLabsXferDone')){
			if (!empty($widgetsource)){
				echo $widgetsource;
			}
		}
		else {
			echo "<p>Temporarily unavailable...</p>";
		}
	}
 
	function collision_db_widget_setup() {
	    wp_add_dashboard_widget( 'collision_db_widget' , 'Collision Testimonials' , 'collision_db_widget');
	}
 
	if (!get_option('collision_disablewidget',false)) {
		add_action('wp_dashboard_setup', 'collision_db_widget_setup');
	}
}

// Add a settings link to the Plugins page
function collision_plugin_actions($links, $file) {
	// Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;
	if (!$this_plugin){ $this_plugin = plugin_basename(__FILE__); }
	
	if ($file == $this_plugin) {
		$settings_link = '<a href="admin.php?page=testimonial_settings">' . __('Settings') . '</a>';
		array_unshift( $links, $settings_link ); // before other links
	}
	return $links;
}

function testimonial_style() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/i/css/styles.css';
	echo '<link rel="stylesheet" type="text/css" href="'.$url.'" media="all" />';
}

// Adding the filters to get the stylesheet into the head.
add_action('wp_head', 'testimonial_style');

// Registers the widget when plugin is loaded.
add_action('widgets_init', 'collisionwidgetInit');

// Adding the filters to get the content for testimonials page.
add_filter('the_content', 'testimonials_page');

// Adding the filters to get the content for testimonials form.
add_filter('the_content', 'testimonials_form');

// Registers the settings menu with the testimonials_config_menu function.
add_action('admin_menu', 'testimonials_config_menu');

// Add Settings link on Plugins page
add_filter('plugin_action_links', 'collision_plugin_actions', 10, 2);

?>