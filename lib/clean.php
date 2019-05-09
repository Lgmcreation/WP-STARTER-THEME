<?php
if ( !defined('ABSPATH') ) die();
/**
* MAJ
*/
//Activation des màj autos majeures
add_filter( 'allow_dev_auto_core_updates', '__return_false' );           // Enable development updates 
add_filter( 'allow_minor_auto_core_updates', '__return_false' );         // Enable minor updates
add_filter( 'allow_major_auto_core_updates', '__return_false' );         // Enable major updates

//Activation des màj autos des plugins
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

/**
* Clean wp_head
*/
function lgm_theme_head_clean() {
	//Clean wp_head
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);        
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);      
	remove_action('wp_head', 'print_emoji_detection_script', 7 ); 

	//Remove the WordPress version from RSS feeds
	add_filter('the_generator', '__return_false');     

}
add_action('init', 'lgm_theme_head_clean');


/**
* Add and remove body_class() classes
*/
function lgm_theme_body_class($classes) {
	// Add post/page slug
	if (is_single() || is_page() && !is_front_page()) {
		$classes[] = basename(get_permalink());
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option('page_on_front');
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff($classes, $remove_classes);

	return $classes;
}
add_filter('body_class', 'lgm_theme_body_class');

/*
Plugin Name: Disable Emojis
Plugin URI: https://geek.hellyer.kiwi/plugins/disable-emojis/
Description: Disable Emojis
Version: 1.5.3
Author: Ryan Hellyer
Author URI: https://geek.hellyer.kiwi/
License: GPL2

------------------------------------------------------------------------
Copyright Ryan Hellyer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
	// Remove all embeds rewrite rules.
    add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for.
 * @return array                 Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}
//Remove oembed js footer
function deregister_scripts_oembed_footer(){
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_scripts_oembed_footer' );

//Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

//Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

//Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//Remove oEmbed JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');