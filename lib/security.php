<?php
if ( !defined('ABSPATH') ) die();
/**
* SECURITY
**/

	/*Masque les erreurs de connexions*/
<<<<<<< HEAD
	function lgm_no_wordpress_errors(){
		return 'Erreur de connexion!';
	}
	add_filter( 'login_errors', 'lgm_no_wordpress_errors' );
=======
	add_filter('login_errors',create_function('$a', "return 'Erreur';"));
>>>>>>> 679d478cd8fd68f5df856e57fca5046629aec3b9

	/*Disable XML RPC*/
	add_filter( 'xmlrpc_enabled', '__return_false' );
	remove_action( 'wp_head', 'rsd_link' );
