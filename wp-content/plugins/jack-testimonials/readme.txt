=== Collision Testimonials ===

Author: Backend Labs, Inc.
Website: http://www.backendlabs.com/
Email: plugins@backendlabs.com

===Plugin Information Short ===
Description: Flexible plugin that allows you to manage your websites testimonials.
Tags: testimonial, testimonials, client testimonials, testimonials plugin, quotes, website quotes, collision testimonials, backend labs

Requires at least: 2.7
Tested up to: 2.9
Stable tag: 2.9

== Description ==

Have you tried all the other testimonial plugins for Wordpress?  Do they all suck?  With our plugin you can easily manage the testimonials for your website. We allow you to configure the testimonial prefix, suffix, and even the number of testimonials displayed on your Wordpress site.

You can feature, sort, and set the status (Hidden, Pending, Public) of testimonials.  We even allow you to have a form so your users can submit testimonials right on your website.  Best of all, they are marked pending and require your approval before they go public!

We allow you to display a random number of testimonials on your websites sidebar, using either our widget, or this tag (<code>&lt;?php collision_testimonials(); ?&gt;</code>).  You can also have a testimonials page, where you display all your testimonials.  We allow you to feature testimonials and set the order in which they are displayed!  You truly have full control with our plugin!

Our plugin is highly configurable via our settings page.  You choose how many testimonials are displayed, the prefix/suffix for regular testimonials, featured testimonials, and you can even have a different prefix/suffix for your testimonials page.

A few features:<br />
 - Manage your testimonials. (Add, Edit, and Delete! Yep, full CRUD!)<br />
 - Highly configurable via our graphical interface.<br />
 - Set number of testimonials to display.<br />
 - Configure the testimonial prefix and suffix.<br />
 - Collect the following information for each testimonial: Name, Location, Testimonial, and Website.<br />
 - Set status of testimonial to "Public", "Hidden", and even "Pending Approval".  This allows you to hide a testimonial rather then deleting the testimonial from the database entirely.<br />
  - Display all public testimonials on a testimonials page, using our testimonials page tag. (<code>&lt;!-- collision_testimonials_page --&gt;</code>)<br />
 - Allow visitors to submit testimonials through a web form. Just add this tag to the page where you'd like the submission form to appear! (<code>&lt;!-- collision_testimonials_form --&gt;</code>) 
 - Feature testimonials.
 - Choose who can manage testimonials.
 - And so much more....

== Installation ==

1. Upload the 'collision-testimonials' folder to the `/wp-content/plugins` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place <code>&lt;?php collision_testimonials(); ?&gt;</code> in your template where you want the testimonials to be displayed, or use our widget!
4. Configure the testimonials settings using our graphical interface.
5. See our tags & support page for help on using some of our other features!

== Screenshots ==

1. Using our intuitive form you can add new testimonials to your site.

2. This shows you all the testimonials in the database, and allows you to edit, sort, and view/change their status.

3. As you can see you can easily access your testimonials via our sidebar menu!

4. We allow you to configure how our plugin works with your site using our settings menu.

5. Oh, and we explain what each item is on our settings menu!

6. We also have widget functionality.
 
== Changelog ==
2.9
	* Fixed styling issue with widget
	* Added custom display name feature to all of the plugin (E.g. Testimonials, Stories, Quotes...etc.)
	* Miscellaneous bug fixes and enhancements

2.8.2

	* Check if the URL has "http://". If not, add it. (Bug)
	* Have dashboard widget get pulled from new remote location.
	* Have tags page pull from new remote location.
	* Have FAQ page pull from new remote location.
	* Other small changes and bug fixes.

2.8.1

	* Update Readme.
	* Fixed bugs and styling issues.
	* Remove pull location from the support page.
	* Have tags page pull from remote location as well.
	* Make an update area on the WP-Dashboard.

2.8

	* Added widget functionality.
	* Uninstall option on settings page, complete removal of database.
	* Reset to default settings option on settings page.
	* Allow Editors to approve testimonials.
	* Remotely pulled support page which allows live updates.
	* Made columns sortable on testimonials page.
	* Added hover descriptions for testimonial settings page.
	* Bulk status changes (public, pending, hidden) on testimonials page.
	* Updated readme and screenshots.
	
2.6

	* Allow testimonials to be featured!
	* Allow user to set custom Captcha Question & Answer for form!
	* Testimonials tag, and testimonials page can have different prefix and suffix.	
	* Ability to control number of testimonials displayed on testimonials page.
	* Fixed bug where new testimonials submitted through the public form are auto-approved.
	* Reworked Install/Upgrade to work for previous versions.

2.5.2

	* Allow user to select/target which testimonials are displayed. (Requested)
	* Allow user to target multiple testimonials.
	* Display the testimonials in the order given.
	* Fine tuned to read permissions.

2.5.1

	* Bug fixes.
	* Improved styling.
	* Updated default prefix and suffix.

2.5

	* Allow user to have a testimonials page.
	* Allow visitors to submit testimonials through a web form.
	* Changed default prefix and suffix.
	* Added location field for testimonials.
	* If no website is typed in, no link tag is generated.
	* If no location is typed in, the location isn't displayed.
	* Altered default styling around testimonials.
	* Gave user more control over testimonial styling.

2.2

	* Ability for testimonials to be set as pending.
	* Grab the database prefix from wp-config.php.
	* Plugin install creates the database.
	* Add configurable options in admin panel.
	* Allow user to select number of testimonials to show.
	* Testimonials with words like "I'm" present a / before the quotation mark or apostrophe. Slashes are stripped.
	* Style the hidden and pending table rows with different colors.
	* Key for the different statuses on the testimonials page.
	* FAQ added for plugin.
	* HTML version of the plugin page created on collisionhosting.com, link in readme.
	* Edit functionality added for testimonials.
	* Screenshots added for plugin.
	* Logix fixed.
	* SQL fixed.
	
2.1

	* Comments to enhance user readability.
	* Plugin redeveloped entirely and optimized for speed and accessiblity.
	* Website field added to database.
	
2.0

	* Admin section in WordPress.
	* Ability to add new testimonials.
	
1.0

	* List existing testimonials from database.

== Support ==

For questions, feature requests, and support concerning this plugin, please use the contact form on the support page of our plugin, or email us at: <a href="mailto:plugins@backendlabs.com">plugins@backendlabs.com</a>.

Thanks,
The Backend Labs Team