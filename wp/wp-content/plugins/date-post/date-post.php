<?php
/**
 * Creation date post
 *
 * @package           CreationDatePostPackage
 * @author            Andrei Fits
 * @copyright         2023 Andrei Fits
 * @license           GPL-2.0-or-later
 *
 * @date-post
 * Plugin Name:       The creation date of the current post
 * Plugin URI:        https://example.com/plugin-name
 * Description:       This plugin adding the creation date of the current post in the format that is specified in the WordPress settings to the title of each blog post on the site.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4+
 * Author:            Andrei FIts
 * Author URI:        https://example.com
 * Text Domain:       date-post
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */

// If accessed directly, exit
if (!defined('ABSPATH')) {
    exit;
}

define( 'DATE_POST_DIR', plugin_dir_path(__FILE__) );
const DATE_POST_PHP_VERSION = '7.4';


register_activation_hook(__FILE__, array( 'Date_Post', 'plugin_activation' ) );
register_deactivation_hook(__FILE__, array('Date_Post', 'plugin_deactivation'));

require_once( DATE_POST_DIR . 'class-date-post.php' );

Date_Post::init();
