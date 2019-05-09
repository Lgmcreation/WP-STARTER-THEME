<?php get_header(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<article  id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>
	<div class="post-content">
		<?php the_content(); ?>
	</div>
	<time datetime="<?php the_time('c'); ?>">Publié le <?php echo the_time('d/m/Y'); ?></time>
	<?php if (get_the_modified_time() != get_the_time()) : ?>
    <time datetime="<?php the_modified_time('c'); ?>">Mise à jour le <?php the_modified_time('d/m/Y'); ?></time>
	<?php endif; ?>
<?php the_author(); ?>
<?php the_category( '&gt; ' ); ?>
<?php if ( ! get_comments_number()==0 ) : ?>
<p class="meta-comments">
	<a href="<?php the_permalink() ?>#comments"><?php comments_number('0', '1', '%'); ?> <?php _e( 'Commentaire(s)', 'lgm_theme' ); ?></a>
</p>
<?php endif; ?>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
/*COMMENTAIRE*/
<?php if ( comments_open() || get_comments_number() ) : ?>
	<?php comments_template(); ?>
<?php endif;?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>