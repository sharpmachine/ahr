<?php
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . "collision-testimonials" . '/i/css/admin.css';
?>

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>" />

<div class="wrap">
	<h2>Collision Testimonials</h2>

<?php if (isset($_POST['addQuote'])) { ?>
	<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('New testimonial added successfully!'); ?></p></div>
<?php } ?>

<?php if (isset($_POST['editQuote'])) { ?>
	<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('Testimonial edited successfully!'); ?></p></div>
<?php } ?>

<?php if (isset($_POST['featQuote']) || isset($_GET['featQuote'])) { ?>
<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('Testimonial featured successfully!'); ?></p></div>
<?php } ?>

<?php if (isset($_POST['unfeatQuote']) || isset($_GET['unfeatQuote'])) { ?>
<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('Testimonial unfeatured successfully!'); ?></p></div>
<?php } ?>

<?php if (isset($_POST['bulkQuote']) || isset($_GET['bulkQuote'])) { ?>
<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('Testimonial status updated successfully!'); ?></p></div>
<?php } ?>

<?php if (isset($_GET['deleteQuote']) || isset($_POST['deleteQuote'])) { ?>
<div class="updated" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo ('Testimonial deleted successfully!'); ?></p></div>
<?php } ?>

<?php
	
	// Required for all WordPress database manipulations
	global $wpdb;
 
	// Grabbing DB prefix and settings table names to variable
	$testimonials = $wpdb->prefix . "testimonials";
	$testimonials_settings = $wpdb->prefix . "testimonials_settings";
 
	// Getting the plugin name for display purposes
	$plugin_name_s = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_s'", ARRAY_A);
	$plugin_name_s = strtolower($plugin_name_s['value']);
	$plugin_name_sUCase = ucwords($plugin_name_s);
	
	$plugin_name_p = $wpdb->get_row("SELECT value FROM $testimonials_settings WHERE name='plugin_name_p'", ARRAY_A);
	$plugin_name_p = strtolower($plugin_name_p['value']);
	$plugin_name_pUCase = ucwords($plugin_name_p);
	
	
	// Add
	if (isset($_POST['addQuote'])){
		
		$currdate = date("Y-m-d");
	
		$status = $_POST['status'];		
		$name = $_POST['name'];
		$location = $_POST['location'];
		$headline = $_POST['headline'];
		$quote = $_POST['quote'];
		$website = $_POST['website'];
		
		$website_final = "";
		if (!empty($website)) {
			$website_final = (substr(ltrim($website), 0, 7) != 'http://' ? 'http://' : '') . $website;
		}
		
		if (!empty($name) && !empty($quote)){
	
			$insert = "INSERT INTO " . $testimonials .
			" (id, status, date, name, location, headline, quote, website) " .
			"VALUES ('', '" . $wpdb->escape($status) . "', '" . $wpdb->escape($currdate) . "', '" . $wpdb->escape($name) . "', '" . $wpdb->escape($location) . "', '" . $wpdb->escape($headline) . "', '" . $wpdb->escape($quote) . "', '" . $wpdb->escape($website_final) . "')";
			
		}
		
		$results = $wpdb->query($insert);
	};
	
	// Edit
	if (isset($_POST['editQuote'])) {
		$status = $_POST['status'];
		$name = $_POST['name'];
		$location = $_POST['location'];
		$headline = $_POST['headline'];
		$quote = $_POST['quote'];
		$website = $_POST['website'];
		$id = $_POST['id'];
		
		$website_final = "";
		if (!empty($website)) {
			$website_final = (substr(ltrim($website), 0, 7) != 'http://' ? 'http://' : '') . $website;
		}
		
		if (!empty($name) && !empty($quote)){
	
			$update = "UPDATE " . $testimonials .
			" SET status='" . $wpdb->escape($status) . "', name='" . $wpdb->escape($name) . "', location='" . $wpdb->escape($location) . "', headline='" . $wpdb->escape($headline) . "' quote='" . $wpdb->escape($quote) . "', website='" . $wpdb->escape($website_final) . "' WHERE id='". $id ."'";
			
		}
		
		$results = $wpdb->query($update);
	};
	
	// Feature
	if (isset($_POST['featQuote'])) {
		foreach($_POST as $id){
			$featsql = "UPDATE $testimonials SET featured=1 WHERE id=$id";
			$results = $wpdb->query($featsql);
		}
	};
	if (isset($_GET['featQuote'])) {
		$id = $_GET['id'];
		mysql_query("UPDATE $testimonials SET featured=1 WHERE id=$id");
	};
	
	// Unfeature
	if (isset($_POST['unfeatQuote'])) {
		foreach($_POST as $id){
			$featsql = "UPDATE $testimonials SET featured=0 WHERE id=$id";
			$results = $wpdb->query($featsql);
		}
	};
	if (isset($_GET['unfeatQuote'])) {
		$id = $_GET['id'];
		mysql_query("UPDATE $testimonials SET featured=0 WHERE id=$id");
	};
	
	// Set status bulk
	if (isset($_POST['bulkQuote'])){
		$bulkstatus = $_POST['bulkstatus'];
		$status = '';
		if ($bulkstatus == "public"){
			$status = '0';
		}
		else if ($bulkstatus == "hidden"){
			$status = '1';
		}
		else if ($bulkstatus == "pending"){
			$status = '2';
		}
		else {
			$status = '0';
		}
		foreach($_POST as $id){
			if (is_numeric($id)){
				$statussql = "UPDATE $testimonials SET status=$status WHERE id=$id";
				$results = $wpdb->query($statussql);
			}
		}
	};
	
	// Delete single
	if (isset($_GET['deleteQuote'])) {
		$id = $_GET['id'];
		mysql_query("DELETE FROM $testimonials WHERE id='$id'");
	};

	// Delete bulk
	if (isset($_POST['deleteQuote'])) {
		foreach($_POST as $id) {
		  mysql_query("DELETE FROM $testimonials WHERE id='$id'");
		}
	};

?>

<?php
if (($_GET['action'] == "edit") && (!isset($_POST['editQuote']))){
	
global $wpdb;
$testimonials = $wpdb->prefix . "testimonials";

$oldid = $_GET['oldid'];
$query = "SELECT * FROM $testimonials WHERE id='$oldid'";
$results = mysql_query($query);
$count = mysql_num_rows($results);
while ($data = mysql_fetch_array($results)) {
	$id = $data['id'];
	$status = $data['status'];
	$name = stripslashes($data['name']);
	$location = stripslashes($data['location']);
	$headline = stripslashes($data['headline']);
	$quote = stripslashes($data['quote']);
	$website = $data['website'];
?>
<h3 class="title">Edit <?php echo $plugin_name_sUCase; ?></h3>
<p>Make changes in the form below to edit a <?php echo $plugin_name_s; ?>. <strong>Required fields are marked *</strong></p>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><label for="name">Name *</label></th>
			<td>
				<input type="text" id="name" name="name" class="regular-text" value="<?php echo $name; ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="location">Location</label></th>
			<td>
				<input type="text" id="location" name="location" class="regular-text" value="<?php echo $location; ?>" />
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="headline">Headline</label></th>
			<td>
				<input type="text" id="headline" name="headline" class="regular-text" maxlength="21" value="<?php echo $headline; ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="quote"><?php echo $plugin_name_sUCase; ?> *</label></th>
			<td>
				<textarea class="large-text code" id="quote" cols="50" rows="3" name="quote"><?php echo $quote; ?></textarea>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="website">Website URL</label></th>
			<td>
				<input type="text" id="website" name="website" class="regular-text" value="<?php echo $website; ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="status"><?php echo $plugin_name_sUCase; ?> Status *</label></th>
			<td>
				<input type="radio" name="status" value="0" <?php if ($status == 0){echo 'checked';} ?>> Public<br />
				<input type="radio" name="status" value="1" <?php if ($status == 1){echo 'checked';} ?>> Hidden<br />
				<input type="radio" name="status" value="2" <?php if ($status == 2){echo 'checked';} ?>> Pending<br />
			</td>
		</tr>
	<tbody>
</table>
	<p class="submit">
		<input type="hidden" value="editQuote" name="editQuote" />
		<input type="hidden" value="<?php echo $id; ?>" name="id" />
		<input type="submit" value="Submit" class="button-primary" name="Update" />
	</p>
</form>
	
<?php } } else { ?>
<h3 class="title">Add New <?php echo $plugin_name_sUCase; ?></h3>
<p>Fill in the form below to add a new <?php echo $plugin_name_s; ?>. <strong>Required fields are marked *</strong></p>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row"><label for="name">Name *</label></th>
			<td>
				<input type="text" id="name" name="name" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="location">Location (City, State)*</label></th>
			<td>
				<input type="text" id="location" name="location" class="regular-text" />
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="headline">Headline*</label></th>
			<td>
				<input type="text" id="headline" name="headline" maxlength="21" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="quote"><?php echo $plugin_name_sUCase; ?> *</label></th>
			<td>
				<textarea class="large-text code" id="quote" cols="50" rows="3" name="quote"></textarea>
			</td>
		</tr>
		<tr valign="top" style="display: none;">
			<th scope="row"><label for="website">Website URL</label></th>
			<td>
				<input type="text" id="website" name="website" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="status"><?php echo $plugin_name_sUCase; ?> Status *</label></th>
			<td>
				<input type="radio" name="status" value="0" checked> Public<br />
				<input type="radio" name="status" value="1"> Hidden<br />
				<input type="radio" name="status" value="2"> Pending<br />
			</td>
		</tr>
	<tbody>
</table>
	<p class="submit">
		<input type="hidden" value="addQuote" name="addQuote" />
		<input type="submit" value="Submit" class="button-primary" name="Submit" />
	</p>
</form>
<?php } ?>
<br>
<h3 class="title">All <?php echo $plugin_name_pUCase; ?></h3>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">	
	<table cellspacing="0" class="widefat fixed">
	<thead>
		<tr class="thead">
		
		<?php if ($_GET['dir'] == "desc" || !isset($_GET['dir']) || empty($_GET['dir'])){ ?>
			<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
			<th class="column_id" id="id" scope="col" style="width:35px;"><a href="admin.php?page=testimonials&sort=id&dir=asc">ID</a></th>
			<th class="column_id" id="id" scope="col" style="width:30px;"><a href="admin.php?page=testimonials&sort=featured&dir=asc"><img src="<?php $image = get_option('siteurl') . '/wp-content/plugins/jack-testimonials/i/images/star.png'; echo $image; ?>" alt="" style="width:18px;" /></a></th>
			<th class="column-name" id="name" scope="col" style="width:130px;"><a href="admin.php?page=testimonials&sort=name&dir=asc">Name</a></th>
			<th class="column-location" id="location" scope="col" style="width:140px;"><a href="admin.php?page=testimonials&sort=location&dir=asc">Location</a></th>
            <th class="column-headline" id="headline" scope="col" style="width:140px;"><a href="admin.php?page=testimonials&sort=headline&dir=asc">Headline</a></th>
			<th class="column-testimonial" id="testimonial" scope="col"><a href="admin.php?page=testimonials&sort=quote&dir=asc"><?php echo $plugin_name_sUCase; ?></a></th>
			<th class="column-website" id="website" scope="col" style="width:240px;"><a href="admin.php?page=testimonials&sort=website&dir=asc">Website</a></th>
			<th class="column-status" id="status" scope="col" style="width:60px;"><a href="admin.php?page=testimonials&sort=status&dir=asc">Status</a></th>
		<?php } else { ?>
			<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
			<th class="column_id" id="id" scope="col" style="width:35px;"><a href="admin.php?page=testimonials&sort=id&dir=desc">ID</a></th>
			<th class="column_id" id="id" scope="col" style="width:30px;"><a href="admin.php?page=testimonials&sort=featured&dir=desc"><img src="<?php $image = get_option('siteurl') . '/wp-content/plugins/jack-testimonials/i/images/star.png'; echo $image; ?>" alt="" style="width:18px;" /></a></th>
			<th class="column-name" id="name" scope="col" style="width:130px;"><a href="admin.php?page=testimonials&sort=name&dir=desc">Name</a></th>
			<th class="column-location" id="location" scope="col" style="width:140px;"><a href="admin.php?page=testimonials&sort=location&dir=desc">Location</a></th>
            <th class="column-headline" id="headline" scope="col" style="width:140px;"><a href="admin.php?page=testimonials&sort=headline&dir=desc">Headline</a></th>
			<th class="column-testimonial" id="testimonial" scope="col"><a href="admin.php?page=testimonials&sort=quote&dir=desc"><?php echo $plugin_name_sUCase; ?></a></th>
			<th class="column-website" id="website" scope="col" style="width:200px;"><a href="admin.php?page=testimonials&sort=website&dir=desc">Websites</a></th>
			<th class="column-status" id="status" scope="col" style="width:60px;"><a href="admin.php?page=testimonials&sort=status&dir=desc">Status</a></th>		
		<?php } ?>

		</tr>
	</thead>
	<tbody>
<?php
	global $wpdb;
	$testimonials = $wpdb->prefix . "testimonials";
	
	$sort = "";
	if (isset($_GET['sort']) && !empty($_GET['sort'])){
		$sort = $_GET['sort'];
	}
	else {
		$sort = "id";
	}
	
	$dir = "";
	if (isset($_GET['dir']) && !empty($_GET['dir'])){
		$dir = $_GET['dir'];
	}
	else {
		$dir = "asc";
	}
	  
	$query = "SELECT * FROM $testimonials ORDER BY $sort $dir";
	$results = mysql_query($query);
	$count = mysql_num_rows($results);
	while ($data = mysql_fetch_array($results)) {
		$id = $data['id'];
		$status = $data['status'];
		
		$rawdate = $data['date'];
			$year = date("Y", strtotime($rawdate));
			$month = date("M", strtotime($rawdate));
			$day = date("j", strtotime($rawdate));
		$date = $month." ".$day.", ".$year;
		
		$featured = $data['featured'];
		$name = stripslashes($data['name']);
		$location = stripslashes($data['location']);
		$headline = stripslashes($data['headline']);
		$quote = stripslashes($data['quote']);
		$website = $data['website'];
?>
	<tr style="background-color:<?php if ($status == 0) { echo "#8CFF8C"; } else if ($status == 1) { echo "#FF7171"; } else if ($status == 2) { echo "#FFFF80"; } ?>">
		<th class="check-column" scope="row">
			<input type="checkbox" value="<?php echo $id; ?>" class="administrator" id="<?php echo $id; ?>" name="<?php echo $id; ?>"/>
		</th>
		<td class="id column-id">
			<?php echo $id; ?>
		</td>
		<td class="featured column-featured" style="width:10px;">
			<?php if ($featured == 1){ ?><a href="?page=testimonials&amp;unfeatQuote&amp;id=<?php echo $id; ?>" class="feat"><span>*</span></a>
			<?php } else if ($featured == 0){ ?><a href="?page=testimonials&amp;featQuote&amp;id=<?php echo $id; ?>" class="unfeat"><span>*</span></a><?php } ?>
		</td>
		<td class="name column-name" style="width: 105px;">
			<?php echo $name; ?>
			<div class="row-actions"><span class='edit'><a href="?page=testimonials&amp;action=edit&amp;oldid=<?php echo $id; ?>" title="Edit this post">Edit</a> | </span><span class='delete'><a class='submitdelete' title='Delete this testimonial' href='?page=testimonials&amp;deleteQuote&amp;id=<?php echo $id; ?>' onclick="if ( confirm('You are about to delete a testimonial by \'<?php echo $name; ?>\'\n \'Cancel\' to stop, \'OK\' to delete.') ) { return true;}return false;">Delete</a></span></div>
		</td>
		<td class="location column-location">
			<?php echo $location; ?>
		</td>
        <td class="headline column-headline">
			<?php echo $headline; ?>
		</td>
		<td class="quote column-quote">
			<?php echo $quote; ?>
		</td>
		<td class="website column-website">
			<a target="_blank" href="<?php echo $website; ?>"><?php echo str_replace("http://", "", $website); ?></a>
		</td>
		<td class="status column-status">
			<?php if ($status == 0) { echo "Public"; } else if ($status == 1) { echo "Hidden"; } else if ($status == 2) { echo "Pending"; } ?>
		</td>
	</tr>

<?php
}
	mysql_free_result($results);
	if ($count < 1) {
?>
	<tr>
		<th class="check-column" scope="row"></th>
		<td class="name column-name" colspan="6">
			<p>There aren't any <?php echo $plugin_name_p; ?> yet!</p>
		</td>
	</tr>
<?php } ?>
	</tbody>

	<tfoot>
		<tr class="thead">
			<th class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"/></th>
			<th class="column_id" id="id" scope="col">ID</th>
			<th class="column_id" id="id" scope="col"><img src="<?php $image = get_option('siteurl') . '/wp-content/plugins/jack-testimonials/i/images/star.png'; echo $image; ?>" alt="" style="width:18px;" /></th>
			<th class="column-name" id="name" scope="col">Name</th>
			<th class="column-location" id="location" scope="col">Location</th>
            <th class="column-headline" id="headline" scope="col">Headline</th>
			<th class="column-testimonial" id="testimonial" scope="col"><?php echo $plugin_name_sUCase; ?></th>
			<th class="column-website" id="website" scope="col">Website</th>
			<th class="column-status" id="status" scope="col">Status</th>
		</tr>
	</tfoot>

</table>

	<p class="submit">
		<input type="submit" value="<?php echo __('Delete','collision-testimonials'); ?>" class="button-primary" name="deleteQuote" /> |		<input type="submit" value="<?php echo __('Feature','collision-testimonials'); ?>" class="button-secondary" name="featQuote" />
		<input type="submit" value="<?php echo __('Unfeature','collision-testimonials'); ?>" class="button-secondary" name="unfeatQuote" /> |
		<select name="bulkstatus">
			<option value="">--</option>
			<option value="public">Public</option>
			<option value="hidden">Hidden</option>
			<option value="pending">Pending</option>
		</select>
		<input type="submit" value="<?php echo __('Set Status','collision-testimonials'); ?>" class="button-secondary" name="bulkQuote" />
	</p>
</form>
</div>