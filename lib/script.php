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


if(!DEV_MODE){ 
	add_action('wp_head', 'lgm_add_criticalcss', 1);    
	function lgm_add_criticalcss() {
		global $post;
		$dir = get_template_directory_uri().'/assets/css/critical/';
		$tmp = get_post_meta( $post->ID, '_wp_page_template', TRUE );
		$page = null;
		if( $tmp && is_page_template()) {
				 switch ( $tmp ) {
						case 'page-accueil.php' :
								$page = file_get_contents($dir.'home.css');
								break;
						case 'page-contact.php' :
								$page = file_get_contents($dir.'contact.css');
								break;
				 }
		} elseif (is_single() && file_exists($dir.'single.css')) {
			 $page = file_get_contents($dir.'single.css');
		} elseif (is_archive() && file_exists($dir.'archive.css')) {
			$page = file_get_contents($dir.'archive.css');
		} elseif (is_page() && file_exists($dir.'page.css')) {
			$page = file_get_contents($dir.'page.css');
		} else {
		  $page = file_get_contents($dir.'contact.css');
		}
		if(!empty($page)){
						$output = $page;
						$theme = wp_get_theme();
						$version = $theme->get('Version');
						$cssversion = get_bloginfo( 'stylesheet_directory' ).'/assets/css/style.min.'.$version.'.css';
						$css = printf('<!--CriticalCSS--><style>%s</style><!--CriticalCSS-->', $output);
						echo PHP_EOL.'<script>function loadCSS(e,t,n){"use strict";function o(){var t;for(var i=0;i<s.length;i++){if(s[i].href&&s[i].href.indexOf(e)>-1){t=true}}if(t){r.media=n||"all"}else{setTimeout(o)}}var r=window.document.createElement("link");var i=t||window.document.getElementsByTagName("script")[0];var s=window.document.styleSheets;r.rel="stylesheet";r.href=e;r.media="only x";i.parentNode.insertBefore(r,i);o();return r}loadCSS("'.$cssversion.'" );</script><noscript><link rel="stylesheet" href="'.$cssversion.'"></noscript>';
		}
	}
}