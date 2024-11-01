=== Wppa+ extra Feeds ===
Contributors: Odyno
Donate link: http://www.staniscia.net/wppa-extra-feed/
Tags: wppa+, photo, photoalbum, photoblog, photowidget
Requires at least: 3.5.1
Tested up to: 3.5.1
Stable tag: 0.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin add the extra RSS feeds feature at plugin WP Photo Album Plus.

== Description ==
This plugin add the extra RSS feeds feature at plugin [WP Photo Album Plus](http://wordpress.org/plugins/wp-photo-album-plus/ "WP Photo Album Plus").

The default activity of this plugin is add a new RSS feed at link www.your-wp-site.lan/?feed=last_photo with the last 10 photos of all albums of WP Photo Album Plus.
But you can add the a new feed on your forum or on your page with this shortcode:

`[wppaef]`

You can control the link and you can add these attributes on shortcode

* `max-num` Max number of feed(default is 10)
* `icon_url` Url to custom icon
* `text_url` Text to show as url of feed
* `album_id` Filter for album id (you can add multiple albumId, it separated by comma)

example:

* `[wppaef max-num=5]` show only 5 photos
* `[wppaef max-num=5 album-id=2,3]` show only the last 5 photos of album id 2 and 3
* `[wppaef max-num=5 album-id=2,3 text_url="Last 5 photo of album 2 and 3"]` show only the last 5 photos of album id 2 and 3 marked as "Last 5 photo of album 2 and 3" string link


== Installation ==

WPPA+ extra Feeds can be installed using integrated WordPress plugin installer or manually.

= Integrated WordPress plugin installer method =

* Go to Plugins > Add New.
* Under Search, type in ’WPPA+ extra Feeds’.
* Click Install Now to install the WordPress Plugin.
* A popup window will ask you to confirm your wish to install the Plugin.
* If this is the first time you've installed a WordPress Plugin, enter the FTP login credential information. If you've installed a Plugin before, it will still have the login information.
* Click Proceed to continue with the installation. The resulting installation screen will list the installation as successful or note any problems during the install.
* If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

= Manual method =

* Upload ’WPPA+ extra Feeds’ folder from wppa-extra-feed.zip file downloaded from WPPA+ extra Feeds WordPress plugin directory page to the ’/wp-content/plugins/’ directory.
* Activate ’WPPA+ extra Feeds’ plugin through the ’Plugins’ menu in WordPress.

You are ready!

== Changelog ==

= 0.0.2 =
* Valid ATOM

= 0.0.1 =
* Base line
