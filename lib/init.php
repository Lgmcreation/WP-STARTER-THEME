<?php
if ( !defined('ABSPATH') ) die();
/**
* SETUP
*/
	
	function lgm_theme_setup() {
		
		// I18n
		load_theme_textdomain( 'lgm-theme', get_template_directory() . '/languages' );
		
		// Image
		add_theme_support( 'post-thumbnails' );
		// Ajout taille image
		/*add_image_size('category-thumb', 300, 9999);*/
		/*add_image_size( 'carre', 450,  450, true );*/
		
		//Add post formats (http://codex.wordpress.org/Post_Formats)
		/*add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));*/

		// BALISE TITLE
		add_theme_support( 'title-tag' );
	}
	add_action( 'after_setup_theme', 'lgm_theme_setup' );

/**
* TINYMCE
*/

	
	/*EDITEUR TINYMCE*/
	function lgm_theme_custom_tinymce($init) {
		/*Afficher la seconde ligne*/
		$init['wordpress_adv_hidden'] = FALSE;
		/*Afficher balise html essentiel*/
		$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
		return $init;
	}
	add_filter('tiny_mce_before_init', 'lgm_theme_custom_tinymce');



