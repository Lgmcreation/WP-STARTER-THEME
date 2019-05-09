<?php if ( !defined('ABSPATH') ) die(); ?>
<aside class="widget-area" role="complementary">
<?php if ( is_active_sidebar( 'widgets_lgm' ) ) { 
	dynamic_sidebar( 'widgets_lgm' ); 
} ?>
</aside>