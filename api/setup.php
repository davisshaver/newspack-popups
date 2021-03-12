<?php
/**
 * Setup Campaigns API.
 *
 * @package Newspack
 */

// @codeCoverageIgnoreStart
$wp_root_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, strrpos( $_SERVER['SCRIPT_FILENAME'], 'wp-content/plugins/' ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.InputNotValidated

$legacy_config_path = $wp_root_path . 'newspack-popups-config.php';
$config_path        = $wp_root_path . 'wp-content/newspack-popups-config.php';
if ( file_exists( $legacy_config_path ) ) {
	require_once $legacy_config_path;
} elseif ( file_exists( $config_path ) ) {
	require_once $config_path;
} else {
	die( 'missing config file' );
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content/' );
}

// phpcs:disable

function __( $in ) { return $in; }
function wp_load_translations_early() {return null;}
function add_filter() {}
function do_action() {}
function has_filter() { return false;}
function apply_filters( $f, $in ) { return $in; }
function is_multisite() { return false; }
function is_wp_error( $thing ) { return ( $thing instanceof WP_Error ); }
function trailingslashit( $string ) {
	return rtrim( $string, '/\\' ) . '/';
}

if ( file_exists( ABSPATH . WPINC . 'wp-db.php' ) ) {
	require_once ABSPATH . WPINC . 'wp-db.php';
	require_once ABSPATH . WPINC . 'functions.php';
} else {
	die( "{ error: 'no_wordpress' }" );
}

if ( ! defined( 'WP_TEMP_DIR' ) ) {
	define( 'WP_TEMP_DIR', WP_CONTENT_DIR . '/temp/' );
}

if ( file_exists( WP_CONTENT_DIR . '/object-cache.php' ) ) {
	require WP_CONTENT_DIR . '/object-cache.php';
} else {
	require_once ABSPATH . WPINC . 'cache.php';
}

global $wpdb;
$wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
$wpdb->set_prefix( DB_PREFIX );

global $table_prefix;
$table_prefix = DB_PREFIX;

wp_cache_init();

// phpcs:enable

require_once 'segmentation/class-segmentation.php';

// @codeCoverageIgnoreEnd
