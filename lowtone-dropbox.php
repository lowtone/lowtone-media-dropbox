<?php
/*
 * Plugin Name: Dropbox
 * Plugin URI: http://wordpress.lowtone.nl/dropbox
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
 * @package wordpress\plugins\lowtone\dropbox
 */

namespace lowtone\dropbox {

	add_filter("media_upload_tabs", function($tabs) {
		$tabs["dropbox"] = __("Dropbox");

		return $tabs;
	});

	add_action("admin_print_scripts", function() {
		$appKey = get_option("dropbox_app_key");

		echo sprintf('<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="%s"></script>', $appKey);
	});

	add_action("media_upload_dropbox", function() {
		wp_enqueue_script("lowtone_dropbox", plugins_url("/assets/scripts/jquery.dropbox.js", __FILE__));

		return wp_iframe(function() {
			media_upload_header();

			//echo '<iframe src="https://www.dropbox.com/chooser?origin=https%3A%2F%2Fapp.asana.com&amp;app_key=asana&amp;link_type=preview" style="display: block; width: 100%; height: 100%; background-color: white; border: none;"></iframe>';
			//echo '<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="u2bmkj958mnne3y"></script>';
			//echo '<script type="text/javascript">Dropbox.choose({iframe: true});</script>';
		});

	});

}