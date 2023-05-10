<?php
/**
 * Shortcode Full Post Page class file.
 *
 * @since 3.0.0
 *
 * @package unlock-protocol
 */

 namespace Unlock_Protocol\Inc\FullPostPage;

use Unlock_Protocol\Inc\Traits\Singleton;
use Unlock_Protocol\Inc\Fullpostpage\Unlock_Box_Full_Post_Page;

/**
 * Class Shortcode_Full_Post_Page
 *
 * @since 3.0.0
 */
class Shortcode_Full_Post_Page {

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
		add_filter( 'the_content', array( $this, 'apply_shortcode_full_post_page_content_lock' ) );
	}

	/**
	 * Register shortcodes.
	 *
	 * @since 3.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'unlockp_full_post_page_content_lock', array( $this, 'unlockp_full_post_page_content_lock_shortcode' ) );
	}

	/**
	 * Apply full post/page content lock.
	 *
	 * @param string $content The original post content.
	 * @return string HTML elements.
	 *
	 * @since 3.0.0
	 */
	public function apply_shortcode_full_post_page_content_lock( $content ) {
		// Check if the lock should be applied to the content.
		if ( $this->should_apply_lock() ) {
			// Extract shortcode attributes from the post content
			global $post;
			$shortcode_atts = $this->extract_shortcode_atts( $post->post_content );
			
			// Call the shortcode function with the extracted attributes
			return $this->unlockp_full_post_page_content_lock_shortcode( $shortcode_atts, $content );
		}
	
		// If the lock should not be applied, return the original content.
		return $content;
	}	

	/**
	 * Determine if the content lock should be applied.
	 *
	 * @return bool True if the lock should be applied, false otherwise.
	 *
	 * @since 3.0.0
	 */
	protected function should_apply_lock() {
		// Get the current post.
		global $post;
	
		// Check if the shortcode exists in the post content.
		if ( has_shortcode( $post->post_content, 'unlockp_full_post_page_content_lock' ) ) {
			return true;
		}
	
		return false;
	}	

	/**
	 * Extract shortcode attributes from the given content.
	 *
	 * @param string $content The post content.
	 * @return array Shortcode attributes.
	 *
	 * @since 3.0.0
	 */
	protected function extract_shortcode_atts( $content ) {
		// Define the shortcode pattern
		$pattern = '/\[unlockp_full_post_page_content_lock([^\]]*)\]/';
	
		// Find the first shortcode match in the content
		if ( preg_match( $pattern, $content, $matches ) ) {
			// Extract and parse the shortcode attributes
			return shortcode_parse_atts( $matches[1] );
		}
	
		return array();
	}	

	/**
	 * Shortcode for Full Post/Page Content Lock.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string HTML elements.
	 *
	 * @since 3.0.0
	 *
	 * @param string $content The original post content.
	 *
	 */
	public function unlockp_full_post_page_content_lock_shortcode( $atts, $content ) {
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
		$networkExists = false;
	
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
	
		$unlock_box_full_post_page = Unlock_Box_Full_Post_Page::get_instance();
	
		return $unlock_box_full_post_page->render_block( $block_attributes, $content );
	}		
}