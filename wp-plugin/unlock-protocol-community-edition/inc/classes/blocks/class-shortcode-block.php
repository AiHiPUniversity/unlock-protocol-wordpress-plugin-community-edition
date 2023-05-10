<?php
/**
 * Shortcode Block class file.
 *
 * @since 3.0.0
 *
 * @package unlock-protocol
 */

namespace Unlock_Protocol\Inc\Blocks;

use Unlock_Protocol\Inc\Traits\Singleton;
use Unlock_Protocol\Inc\Blocks\Unlock_Box_Block;

/**
 * Class Shortcodes
 *
 * @since 3.0.0
 */
class Shortcode_Block {

	use Singleton;

	/**
	 * Construct method.
	 *
	 * @since 3.0.0
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Setup hooks.
	 *
	 * @since 3.0.0
	 */
	protected function setup_hooks() {
		add_action( 'init', array( $this, 'register_shortcodes' ) );
	}

	/**
	 * Register shortcodes.
	 *
	 * @since 3.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'unlockp_block_content_lock', array( $this, 'unlockp_block_content_lock_shortcode' ) );
	}

	/**
	 * Shortcode for Gutenberg Block Content Lock.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string HTML elements.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content The original post content.
	 *
	 */
	public function unlockp_block_content_lock_shortcode( $atts, $content ) {
		// Default attributes for the shortcode
		$attributes = shortcode_atts(
			array(
				'address' => '',
				'network' => -1,
			),
			$atts
		);
	
		// Sanitize and validate the Ethereum address
		$attributes['address'] = sanitize_text_field( $attributes['address'] );
		if ( ! preg_match( '/^0x[a-fA-F0-9]{40}$/', $attributes['address'] ) ) {
			return 'Invalid lock address.';
		}
	
		$settings = get_option( 'unlock_protocol_settings', array() );
		$networks = isset( $settings['networks'] ) ? $settings['networks'] : array();
	
		$ethereumNetworks = array();
		$networkExists    = false;
	
		// Loop through the saved networks and build the ethereumNetworks array
		foreach ( $networks as $network ) {
			// Check if the 'network_name' and 'network_id' keys are set for the network
			if ( isset( $network['network_name'] ) && isset( $network['network_id'] ) ) {
				$ethereumNetworks[] = array(
					'label' => $network['network_name'],
					'value' => $network['network_id'],
				);
	
				// Check if the provided network ID exists in the saved networks
				if ( intval( $attributes['network'] ) === $network['network_id'] ) {
					$networkExists = true;
				}
			}
		}
	
		// Sanitize the network ID input
		$attributes['network'] = sanitize_text_field( $attributes['network'] );

		// Ensure the network ID only contains numbers
		if ( ! ctype_digit( $attributes['network'] ) ) {
			return 'Invalid network ID.';
		}

		// Convert the sanitized network ID to an integer
		$attributes['network'] = intval( $attributes['network'] );

		// Validate the network ID against the existing saved network IDs
		if ( ! $networkExists ) {
			return 'Invalid network ID.';
		}

	
		// Create the locks array using the provided address and network ID
		$locks = array(
			array(
				'address' => $attributes['address'],
				'network' => $attributes['network'],
			),
		);
		
	
		// Build the attributes object for the render_block function
		$block_attributes = array(
			'locks'            => $locks,
			'ethereumNetworks' => $ethereumNetworks,
		);
	
		$unlock_box_block = Unlock_Box_Block::get_instance();
	
		return $unlock_box_block->render_block( $block_attributes, $content );
	}
}