<?php
/**
 * Plugin Name:     Newspack Campaigns
 * Plugin URI:      https://newspack.com
 * Description:     Build persuasive call-to-action prompts from scratch and display them as overlays, inline with the story, or above the site header.
 * Author:          Automattic
 * Author URI:      https://newspack.com
 * Text Domain:     newspack-popups
 * Domain Path:     /languages
 * Version:         3.1.0
 *
 * @package         Newspack_Popups
 */

defined( 'ABSPATH' ) || exit;

// Define NEWSPACK_ADS_PLUGIN_FILE.
if ( ! defined( 'NEWSPACK_POPUPS_PLUGIN_FILE' ) ) {
	define( 'NEWSPACK_POPUPS_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'NEWSPACK_COMPOSER_ABSPATH' ) ) {
	define( 'NEWSPACK_COMPOSER_ABSPATH', dirname( NEWSPACK_PLUGIN_FILE ) . '/vendor/' );
}
require_once NEWSPACK_COMPOSER_ABSPATH . 'autoload.php';

// Include the main Newspack Google Ad Manager class.
if ( ! class_exists( 'Newspack_Popups' ) ) {
	include_once __DIR__ . '/includes/class-newspack-popups.php';
}
