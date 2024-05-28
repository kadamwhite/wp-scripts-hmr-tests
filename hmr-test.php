<?php
/**
 * Plugin Name:       Hmr Test
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hmr-test
 *
 * @package CreateBlock
 */

define( 'HMR_TEST_VARIANT',
	// 'css-reloading'
	// 'block-hot-swapping'
	'multiple-blocks'
	// 'build-optimization'
);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}
if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true );
}
if ( ! defined( 'WP_ENVIRONMENT_TYPE' ) ) {
	define( 'WP_ENVIRONMENT_TYPE', 'local' );
}

if ( ! defined( 'WP_DEVELOPMENT_MODE' ) ) {
	define( 'WP_DEVELOPMENT_MODE', 'plugin' );
}

// Diagnostics for constants.
// wp_die( '<pre>' . wp_json_encode( [
// 	'WP_DEBUG' => WP_DEBUG ? 'true' : 'false',
// 	'SCRIPT_DEBUG' => SCRIPT_DEBUG ? 'true' : 'false',
// 	'WP_ENVIRONMENT_TYPE' => WP_ENVIRONMENT_TYPE ? 'true' : 'false',
// ], JSON_PRETTY_PRINT ) . '<pre>' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_hmr_test_block_init() {
	if ( HMR_TEST_VARIANT !== 'multiple-blocks' ) {
		register_block_type( trailingslashit( __DIR__ ) . HMR_TEST_VARIANT . '/build' );
	} else {
		register_block_type( trailingslashit( __DIR__ ) . HMR_TEST_VARIANT . '/build/blocks/hmr-test' );
		register_block_type( trailingslashit( __DIR__ ) . HMR_TEST_VARIANT . '/build/blocks/hmr-test-2' );
	}
}
add_action( 'init', 'create_block_hmr_test_block_init' );

if ( HMR_TEST_VARIANT === 'multiple-blocks' ) {
	// // Enqueue runtime chunk.
	// add_action( 'enqueue_block_editor_assets', function() {
	// 	$runtime_asset_file = include( trailingslashit( __DIR__ ) . '/multiple-blocks/build/runtime.asset.php');

	// 	wp_enqueue_script(
	// 		'hmr-runtime',
	// 		plugins_url( 'multiple-blocks/build/runtime.js', __FILE__ ),
	// 		$runtime_asset_file['dependencies'],
	// 		$runtime_asset_file['version']
	// 	);
	// }, 9 );
}
