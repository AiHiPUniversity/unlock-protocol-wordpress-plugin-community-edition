<?php
/**
 * Plugin Name: Unlock Protocol Community Edition
 * Plugin URI:  https://unlock-wpplugin-community-edition.AiHiPUniversity.com
 * Description: A plugin to add lock(s) to WordPress content on post, pages and custom post types with NFTs deployed via Unlock Protocol.
 * Author:      AiHiPuniversity
 * Author URI:  https://AiHiPUniversity.com
 * Version:     1.0.0
 * Tested up to: 6.2
 * Requires PHP: 7.0
 *
 * @package unlock-protocol-community-edition
 */

define( 'UNLOCK_PLUGIN_VERSION', '1.0.0' );
define( 'UNLOCK_PROTOCOL_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'UNLOCK_PROTOCOL_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'UNLOCK_PROTOCOL_BUILD_DIR', UNLOCK_PROTOCOL_PATH . '/assets/build' );
define( 'UNLOCK_PROTOCOL_BUILD_URI', UNLOCK_PROTOCOL_URL . '/assets/build' );
define( 'UNLOCK_PROTOCOL_BASENAME_FILE', plugin_basename( __FILE__ ) );
define( 'UNLOCK_PROTOCOL_PLUGIN_FILE', untrailingslashit( __FILE__ ) );

// phpcs:disable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
require_once UNLOCK_PROTOCOL_PATH . '/inc/helpers/autoloader.php';
require_once UNLOCK_PROTOCOL_PATH . '/inc/helpers/custom-functions.php';
// phpcs:enable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

/**
 * To load plugin manifest class.
 *
 * @since 3.0.0
 *
 * @return void
 */
function unlock_protocol_plugin_loader() {
	\Unlock_Protocol\Inc\Plugin::get_instance();
}

unlock_protocol_plugin_loader();
