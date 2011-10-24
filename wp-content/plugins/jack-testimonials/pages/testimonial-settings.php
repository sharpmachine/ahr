<?php if (isset($_POST['Submit'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
 
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";

/********************************
 * Testimonial Settings
 ********************************/	
	// Get values from post!
	$testimonial_options = array();
	$testimonial_options['plugin_name_s'] = $_POST['plugin_name_s'];
	$testimonial_options['plugin_name_p'] = $_POST['plugin_name_p'];
	$testimonial_options['testimonial_num'] = $_POST['testimonial_num'];
	$testimonial_options['testimonial_prefix'] = stripslashes($_POST['testimonial_prefix']);
	$testimonial_options['testimonial_suffix'] = stripslashes($_POST['testimonial_suffix']);
	$testimonial_options['testimonial_privileges'] = stripslashes($_POST['editors']);
	$testimonial_options['admin_email'] = $_POST['admin_email'];
	
	$testimonial_options['date'] = $_POST['date'];

	$testimonial_options['testimonial_page_num'] = $_POST['testimonial_page_num'];
	$testimonial_options['page_prefix'] = stripslashes($_POST['page_prefix']);
	$testimonial_options['page_suffix'] = stripslashes($_POST['page_suffix']);
	$testimonial_options['featured_prefix'] = stripslashes($_POST['featured_prefix']);
	$testimonial_options['featured_suffix'] = stripslashes($_POST['featured_suffix']);
	
	$testimonial_options['captcha']	= $_POST['catpcha'];
	$testimonial_options['captcha_question'] = $_POST['captcha_question'];
	$testimonial_options['captcha_answer'] = $_POST['captcha_answer'];
	
/********************************
 * General Update
 ********************************/	
	// 4 hours of pulling my hair out...presenting the db query updates...blah!
	$sql = ("UPDATE $testimonials_settings SET value='".$testimonial_options['plugin_name_s']."' WHERE name='plugin_name_s'");
	$sql0 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['plugin_name_p']."' WHERE name='plugin_name_p'");
	$sql1 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_num']."' WHERE name='testimonial_num'");
	$sql2 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_prefix']."' WHERE name='testimonial_prefix'");
	$sql3 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_suffix']."' WHERE name='testimonial_suffix'");
	$sql4 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_privileges']."' WHERE name='testimonial_privileges'");
	$sql5 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['admin_email']."' WHERE name='admin_email'");
	$sql55 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['date']."' WHERE name='date'");
	$sql6 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_page_num']."' WHERE name='testimonial_page_num'");
	$sql7 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['page_prefix']."' WHERE name='page_prefix'");
	$sql8 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['page_suffix']."' WHERE name='page_suffix'");
	$sql9 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['featured_prefix']."' WHERE name='featured_prefix'");
	$sql10 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['featured_suffix']."' WHERE name='featured_suffix'");
	$sql11 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha']."' WHERE name='captcha'");
	$sql12 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha_question']."' WHERE name='captcha_question'");
	$sql13 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha_answer']."' WHERE name='captcha_answer'");
	
	// Requiring WP upgrade and running SQL query
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	dbDelta($sql0);
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);
	dbDelta($sql5);
	dbDelta($sql55);
	dbDelta($sql6);
	dbDelta($sql7);
	dbDelta($sql8);
	dbDelta($sql9);
	dbDelta($sql10);
	dbDelta($sql11);
	dbDelta($sql12);
	dbDelta($sql13);
?>

<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Settings saved!', 'collision-testimonials' ); ?></p></div>

<?php } ?>

<?php if (isset($_POST['Reset'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Grabbing DB prefix and settings table names to variable
	$options_table = $wpdb->prefix . "options";
		
	// Getting the admin email for plugin
	$admin_email_query = mysql_query("SELECT option_value FROM $options_table WHERE option_name='admin_email'");		
	$admin_email_row = mysql_fetch_array($admin_email_query);
	$admin_email_default = $admin_email_row['option_value'];

/********************************
 * Defining Default Testimonial Settings
 ********************************/
	$testimonial_options = array();
	$testimonial_options['plugin_name_s'] = "Testimonial";
	$testimonial_options['plugin_name_p'] = "Testimonials";
	$testimonial_options['testimonial_num'] = '1';
	$testimonial_options['testimonial_prefix'] = '<p class="testimonials">';
	$testimonial_options['testimonial_suffix'] = '</p>';
	$testimonial_options['testimonial_privileges'] = '';
	$testimonial_options['admin_email'] = $admin_email_default;
	
	$testimonial_options['date'] = 1;
	
	$testimonial_options['testimonial_page_num'] = '15';
	$testimonial_options['page_prefix'] = '<p class="testimonials_page">';
	$testimonial_options['page_suffix'] = '</p>';
	$testimonial_options['featured_prefix'] = '<p class="featured">';
	$testimonial_options['featured_suffix'] = '</p>';
	
	$testimonial_options['captcha'] = 1;
	$testimonial_options['captcha_question'] = 'Is fire hot or cold?';
	$testimonial_options['captcha_answer'] = 'hot';
	
/********************************
 * Updating To Default Above
 ********************************/
 	$sql = ("UPDATE $testimonials_settings SET value='".$testimonial_options['plugin_name_s']."' WHERE name='plugin_name_s'");
 	$sql0 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['plugin_name_p']."' WHERE name='plugin_name_p'");
	$sql1 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_num']."' WHERE name='testimonial_num'");
	$sql2 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_prefix']."' WHERE name='testimonial_prefix'");
	$sql3 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_suffix']."' WHERE name='testimonial_suffix'");
	$sql4 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_privileges']."' WHERE name='testimonial_privileges'");
	$sql5 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['admin_email']."' WHERE name='admin_email'");
	
	$sql55 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['date']."' WHERE name='date'");
	
	
	$sql6 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['testimonial_page_num']."' WHERE name='testimonial_page_num'");
	$sql7 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['page_prefix']."' WHERE name='page_prefix'");
	$sql8 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['page_suffix']."' WHERE name='page_suffix'");
	$sql9 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['featured_prefix']."' WHERE name='featured_prefix'");
	$sql10 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['featured_suffix']."' WHERE name='featured_suffix'");
	
	$sql11 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha']."' WHERE name='captcha'");
	$sql12 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha_question']."' WHERE name='captcha_question'");
	$sql13 = ("UPDATE $testimonials_settings SET value='".$testimonial_options['captcha_answer']."' WHERE name='captcha_answer'");
	
	// Requiring WP upgrade and running SQL query
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	dbDelta($sql0);
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);
	dbDelta($sql5);
	dbDelta($sql55);
	dbDelta($sql6);
	dbDelta($sql7);
	dbDelta($sql8);
	dbDelta($sql9);
	dbDelta($sql10);
	dbDelta($sql11);
	dbDelta($sql12);
	dbDelta($sql13);
?>

<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Settings Reset!', 'collision-testimonials' ); ?></p></div>

<?php } ?>

<?php if (isset($_POST['Delete'])) {

	// Required for all WordPress database manipulations
	global $wpdb;
	
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
	
	// Deleting The Databases
	mysql_query("DROP table $testimonials");
	mysql_query("DROP table $testimonials_settings");
	
?>

<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo __('Database Tables Deleted!', 'collision-testimonials' ); ?></p></div>

<?php } ?>

<?php

/********************************
 * Global Settings
 ********************************/
	// Required for all WordPress database manipulations
	global $wpdb;
 
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
 
	// Getting the plugin name for display purposes
	$plugins = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_s'", ARRAY_A);
	$plugins = strtolower($plugins['value']);
	$pluginsUCase = ucwords($plugins);
	
	$pluginp = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_p'", ARRAY_A);
	$pluginp = strtolower($pluginp['value']);
	$pluginpUCase = ucwords($pluginp);

/********************************
 * Testimonial Settings
 ********************************/
 	// Getting the plugin display name
	$plugin_name_s = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_s'", ARRAY_A);		
	$plugin_name_s = $plugin_name_s['value'];
	
	$plugin_name_p = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_p'", ARRAY_A);		
	$plugin_name_p = $plugin_name_p['value'];
 
	// Getting number of testimonials to display
	$testimonial_num = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_num'", ARRAY_A);		
	$testimonial_num = $testimonial_num['value'];

	// Getting testimonial prefix and suffix from database
	$testimonial_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_prefix'", ARRAY_A);		
	$testimonial_prefix = htmlspecialchars_decode($testimonial_prefix['value']);
	
	$testimonial_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_suffix'", ARRAY_A);		
	$testimonial_suffix = htmlspecialchars_decode($testimonial_suffix['value']);
	
	// Are we allowing editors to edit?
	$testimonial_privileges = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_privileges'", ARRAY_A);		
	$testimonial_privileges = $testimonial_privileges['value'];
	
	// Are we going to display the testimonials on a certain page?
	$admin_email = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='admin_email'", ARRAY_A);		
	$admin_email = $admin_email['value'];
	
	// Date
	$date = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='date'", ARRAY_A);		
	$date = $date['value'];
	
	// Getting Captcha Option from DB
	$captcha = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='captcha'", ARRAY_A);		
	$captcha = $captcha['value'];
	
	// Getting Captcha Question from DB
	$captcha_question = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='captcha_question'", ARRAY_A);		
	$captcha_question = $captcha_question['value'];
	
	// Getting Captcha Answer from DB
	$captcha_answer = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='captcha_answer'", ARRAY_A);		
	$captcha_answer = $captcha_answer['value'];
	
/********************************
 * Testimonial Page Settings
 ********************************/
	// Getting max number of testimonials to display on testimonials page
	$testimonial_page_num = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='testimonial_page_num'", ARRAY_A);		
	$testimonial_page_num = htmlspecialchars_decode($testimonial_page_num['value']);
	
	// Getting testimonial page prefix and suffix from database
	$page_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='page_prefix'", ARRAY_A);		
	$page_prefix = htmlspecialchars_decode($page_prefix['value']);
	
	$page_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='page_suffix'", ARRAY_A);		
	$page_suffix = htmlspecialchars_decode($page_suffix['value']);
	
	// Getting featured testimonial page prefix and suffix from database
	$featured_prefix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='featured_prefix'", ARRAY_A);		
	$featured_prefix = htmlspecialchars_decode($featured_prefix['value']);
	
	$featured_suffix = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='featured_suffix'", ARRAY_A);		
	$featured_suffix = htmlspecialchars_decode($featured_suffix['value']);
?>

<div class="wrap">

<div id="icon-options-general" class="icon32"><br /></div>
<h2><?php echo $pluginsUCase; ?> Settings</h2>
<h4>General Settings</h4>
<form method="post" action="" id="settingsform">
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="plugin_name"><span title="The display name for the plugin. The first field is the singular form, such as Testimonial. The second field is the plural form, such as Testimonials.">Plugin Display Name</span></label></th>
		<td>Singular: <input name="plugin_name_s" type="text" id="plugin_name_s" value='<?php echo $plugin_name_s; ?>' /><br>
			Plural: <input name="plugin_name_p" type="text" id="plugin_name_p" value='<?php echo $plugin_name_p; ?>' /></td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="testimonial_num"><span title="The number of <?php echo $pluginp; ?> that the tag or the widget displays."><?php echo $pluginpUCase; ?> Shown At Once</span></label></th>
		<td><input name="testimonial_num" type="text" id="testimonial_num" value='<?php echo $testimonial_num; ?>' size="2" /></td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="testimonial_prefix"><span title="The HTML that should come before each <?php echo $plugins; ?> displayed by the tag or the widget."><?php echo $pluginsUCase; ?> Prefix</span></label></th>
		<td><input name="testimonial_prefix" type="text" id="testimonial_prefix"  value='<?php echo $testimonial_prefix; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="testimonial_suffix"><span title="The HTML that should come after each <?php echo $plugins; ?> displayed by the tag or the widget."><?php echo $pluginsUCase; ?> Suffix</span></label></th>
		<td><input name="testimonial_suffix" type="text" id="testimonial_suffix"  value='<?php echo $testimonial_suffix; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="testimonial_privileges"><span title="Allow Editors to add, edit, delete, and approve <?php echo $pluginp; ?>."><?php echo $pluginsUCase; ?> Privileges</span></label></th>
		<?php if($testimonial_privileges != 2) { ?>
			<td><input type="checkbox" name="editors" value="2"> Editors | <input type="checkbox" name="administrators" value="1" checked disabled> Administrators</td>
		<?php } ?>
		
		<?php if($testimonial_privileges == 2) { ?>
			<td><input type="checkbox" name="editors" value="2" checked> Editors | <input type="checkbox" name="administrators" value="1" checked disabled> Administrators</td>
		<?php } ?>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="admin_email"><span title="The email you want to be contacted at when someone submits a <?php echo $plugins; ?> using the public form.">Admin Email</span></label></th>
		<td><input name="admin_email" type="text" id="admin_email"  value='<?php echo $admin_email; ?>' class="regular-text" />
	</tr>
	<?php /*
	<tr valign="top">
		<th scope="row"><label for="date"><span title="Enable the date field for <?php echo $pluginp; ?>.">Date</span></label></th>
		<td><input name="date" type="checkbox" id="date" value='1'<?php if ($date == 1){echo ' checked="checked"';} ?> /> Enable date field</td>
	</tr>
	*/ ?>
</table>
<br />
<h4>Page Settings</h4>
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="testimonial_page_num"><span title="The maximum number of <?php echo $pluginp; ?> that should be displayed on the <?php echo $pluginp; ?> page.">Max Number Of <?php echo $pluginpUCase; ?> Displayed</span></label></th>
		<td><input name="testimonial_page_num" type="text" id="testimonial_page_num" value='<?php echo $testimonial_page_num; ?>' size="2" /></td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="page_prefix"><span title="The HTML that should come before each <?php echo $plugins; ?> displayed by the <?php echo $pluginp; ?> page."><?php echo $pluginsUCase; ?> Page Prefix</span></label></th>
		<td><input name="page_prefix" type="text" id="page_prefix" value='<?php echo $page_prefix; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="page_suffix"><span title="The HTML that should come after each <?php echo $plugins; ?> displayed by the <?php echo $pluginp; ?> page."><?php echo $pluginsUCase; ?> Page Suffix</span></label></th>
		<td><input name="page_suffix" type="text" id="page_suffix"  value='<?php echo $page_suffix; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="featured_prefix"><span title="The HTML that should come before each featured <?php echo $plugins; ?>.">Featured Prefix</span></label></th>
		<td><input name="featured_prefix" type="text" id="featured_prefix"  value='<?php echo $featured_prefix; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="featured_suffix"><span title="The HTML that should come after each featured <?php echo $plugins; ?>.">Featured Suffix</span></label></th>
		<td><input name="featured_suffix" type="text" id="featured_suffix"  value='<?php echo $featured_suffix; ?>' class="regular-text" />
	</tr>
</table>
<br />
<h4>Form Settings</h4>
<table class="form-table">	
<?php /*
	<tr valign="top">
		<th scope="row"><label for="captcha"><span title="Display a captcha question along with the form to prevent spam.">Captcha</span></label></th>
		<td><input name="captcha" type="checkbox" id="captcha" value='1'<?php if ($captcha == 1){echo ' checked="checked"';} ?> /> Enable captcha on the public form</td>
	</tr>
*/ ?>

	<tr valign="top">
		<th scope="row"><label for="captcha_question"><span title="The antispam question that should appear on the public form.">Captcha Question</span></label></th>
		<td><input name="captcha_question" type="text" id="captcha_question"  value='<?php echo $captcha_question; ?>' class="regular-text" />
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="captcha_answer"><span title="The answer to the antispam question on the public form.">Captcha Answer</span></label></th>
		<td><input name="captcha_answer" type="text" id="captcha_answer"  value='<?php echo $captcha_answer; ?>' class="regular-text" />
	</tr>
</table>

  <p class="submit">
    <input type="hidden" value="save" name="save" />
    <input type="submit" name="Submit" class="button-primary" value="Save Changes" /> | 
	<input type="submit" name="Reset" class="button-secondary" value="Reset Settings" onclick="if ( confirm('You are about to reset all settings. \n \'Cancel\' to stop, \'OK\' to reset.') ) { return true;}return false;" /> |
	<input type="submit" name="Delete" class="button-secondary" value="Uninstall Plugin" onclick="if ( confirm('You are about to UNINSTALL this plugin! This cannot be undone! \n \'Cancel\' to stop, \'OK\' to uninstall.') ) { return true;}return false;" />
  </p>
</form>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_option('siteurl') . '/wp-content/plugins/collision-testimonials/i/js/jquery.qtip.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() 
{
   $('#settingsform span[title]').qtip({
      content: {
         text: false
      },
      style: 'light'
   });
   // $('#content a[href]').qtip();
});
</script>