<?php
if ( !defined('ABSPATH') ) die();
/**
 * Enqueue scripts and stylesheets
 */
function lgm_theme_scripts() {
	//CSS
	if(DEV_MODE){ 
		wp_register_style('base', get_template_directory_uri() . '/assets/css/style.css','', '', 'all');
		wp_enqueue_style('base');
	}
	//JS
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('lgm_js', get_template_directory_uri() . '/assets/js/main.min.js','','',true);
    	wp_enqueue_script('lgm_js');
	}
	if ( (!is_admin()) && is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	//PAGE CARTE GOOGLE
	if(is_page_template( 'page-contact.php' ) ){
		wp_enqueue_script('Google maps','http://maps.googleapis.com/maps/api/js?key=AIzaSyAkOS5wPh_4SYyfpZV5NxkT3FOVeY-iHXM','lgm_js','',true);
		wp_enqueue_script('Script Google maps', get_template_directory_uri() . '/assets/js/googlemap.js', 'lgm_js', '', true );
		}
	//PAGE FORMULAIRE GESTION AJAX
	if(is_page_template( 'page-contact.php' ) ){
		wp_localize_script('lgm_js', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	}	
}

add_action('wp_enqueue_scripts', 'lgm_theme_scripts', 100);

/**
 * Enqueue scripts and stylesheets
 */
function lgm_theme_remove_version_js_css( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'lgm_theme_remove_version_js_css', 9999 );
add_filter( 'script_loader_src', 'lgm_theme_remove_version_js_css', 9999 );
