=== demobbled ===
Contributors: husobj
Tags: mobile, conditional, functions
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 1.0

A helper plugin that stores a cookie if a user wants to override their device being detected as mobile.

== Description ==

Functions to store/remove a cookie if a user doesn't want their device to be detected as mobile.

Intended to be used in conjunction with a plugin like <a href="http://www.toggle.uk.com/journal/mobble" target="_blank">mobble</a> which I highly recommend if you need to do any device checking in PHP.

The reason for providing this functionality is that although a well-designed site will be responsive and automatically adapt to the user's device, if a site is heavily optimised for mobile, on an iPhone or tablet you may want to give the user the opportunity to view the full site as it would appear on a desktop computer.

== Installation ==

To install this plugin:

1. Upload the `demobbled` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You can now use the `<?php Demobbled::is_demobbled(); ?>` functions in your template

== Frequently Asked Questions ==

= How do I use this plugin? =

If you create a link to any page on your site passing the demobbled query as true, a cookie will be set so that you can detect that the user would prefer not to see the mobile version.
eg http://example.com/?demobbled=true

If you link passing the demobbled query as false, the cookie will be remove - the user would prefer to see the mobile version if detected.
eg http://example.com/?demobbled=false

In your theme/plugin use the Demobbled::is_demobbled() function to detect the cookie setting.

= What functions are available? =

`<?php 
Demobbled::is_demobbled(); // check if the cookie is set - if so, don't show mobile version
Demobbled::demobble(); // Set the cookie
Demobbled::undemobble(); // Remove the cookie
?>`

= Do you have any examples? =

If you have the mobble plugin installed, this is how you would use it:

`<?php 
if ( is_mobile() && ! Demobbled::is_demobbled() ) {
	// Do something for mobiles
}
?>`

== Changelog ==

= 1.0 =

* Initial release.
