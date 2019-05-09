<?php
if ( !defined('ABSPATH') ) die();
/**
* ACF OPTION PAGE
**/
if( function_exists('acf_add_options_page') ) {
	function lgm_theme_acf_init() {
		    acf_add_options_page(array(
		        'page_title'    => 'ADMINISTRATION',
		        'menu_title'    => 'ADMINISTRATION',
		        'menu_slug'     => 'administration-client-acf',
		        'capability'    => 'edit_posts',
		        'position'      => '63',
		        'redirect' => true
		    ));
		    acf_add_options_sub_page(array(
		        'page_title'    => 'INFOS ENTREPRISE',
		        'menu_title'    => 'Infos entreprise',
		        'parent_slug'   => 'administration-client-acf',
		    ));
		    acf_add_options_sub_page(array(
		        'page_title'    => 'Réseaux Sociaux',
		        'menu_title'    => 'Réseaux Sociaux',
		        'parent_slug'   => 'administration-client-acf',
			));
			acf_add_options_sub_page(array(
		        'page_title'    => 'Gestion site',
		        'menu_title'    => 'Gestion site',
		        'parent_slug'   => 'administration-client-acf',
		    ));
		}
	add_action('acf/init', 'lgm_theme_acf_init');
}
