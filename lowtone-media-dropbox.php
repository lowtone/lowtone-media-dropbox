<?php
/*
 * Plugin Name: Dropbox
 * Plugin URI: http://wordpress.lowtone.nl/media-dropbox
 * Description: Integrate Dropbox Chooser.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2011-2012, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\plugins\lowtone\media\dropbox
 */

namespace lowtone\media\dropbox {

	use lowtone\content\packages\Package,
		lowtone\media\types\Type;

	// Includes
	
	if (!include_once WP_PLUGIN_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content plugin is required", E_USER_ERROR) && false;

	$__i = Package::init(array(
			Package::INIT_PACKAGES => array("lowtone", "lowtone\\media"),
			Package::INIT_MERGED_PATH => __NAMESPACE__,
			Package::INIT_SUCCESS => function() {

				// Register textdomain
				
				load_plugin_textdomain("lowtone_media_dropbox", false, basename(__DIR__) . "/assets/languages");

				\lowtone\media\addMediaType(new Type(array(
						Type::PROPERTY_TITLE => __("Dropbox", "lowtone_media_dropbox"),
						Type::PROPERTY_NEW_FILE_TEXT => __("Import a file from your Dropbox.", "lowtone_media_dropbox"),
						Type::PROPERTY_SLUG => "dropbox",
						Type::PROPERTY_IMAGE => plugins_url("/assets/images/dropbox-icon.png", __FILE__),
						Type::PROPERTY_NEW_FILE_CALLBACK => function() {

							echo '<div class="wrap">' . 
								get_screen_icon() . 
								'<h2>' . __("Select a file on Dropbox", "lowtone_media_dropbox") . '</h2>' . 
								'<p>' . __("Use the chooser to select the file you want to import.", "lowtone_media_dropbox") . '</p>';

							echo '</div>';

								
						}
					)));

				add_filter("media_upload_tabs", function($tabs) {
					$tabs["dropbox"] = __("Dropbox", "lowtone_media_dropbox");

					return $tabs;
				});

				/*add_action("admin_print_scripts", function() {
					$appKey = get_option("dropbox_app_key");

					echo sprintf('<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="%s"></script>', $appKey);
				});*/

				add_action("media_upload_dropbox", function() {
					wp_enqueue_script("lowtone_dropbox", plugins_url("/assets/scripts/jquery.dropbox.js", __FILE__));

					return wp_iframe(function() {
						media_upload_header();
						echo "FOO";
						// echo '<iframe src="https://www.dropbox.com/chooser?origin=https%3A%2F%2Fapp.asana.com&amp;app_key=asana&amp;link_type=preview" style="display: block; width: 100%; height: 100%; background-color: white; border: none;"></iframe>';
						// echo '<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="u2bmkj958mnne3y"></script>';
						// echo '<script type="text/javascript">Dropbox.choose({iframe: true});</script>';
					});

				});

				/*add_action("admin_enqueue_scripts", function() {
					wp_enqueue_script("lowtone_media_dropbox", plugins_url("/assets/scripts/lowtone-media-dropbox.js", __FILE__), array("media-views"), false, true);
				});*/

				return true;
			}
		));

	if (!$__i)
		return false;

}