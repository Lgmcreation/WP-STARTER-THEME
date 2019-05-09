<?php if ( !defined('ABSPATH') ) die();
if ( post_password_required() ) { return; }
?>
<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>
	<h3 class="comments-title">Titre commentaire</h3>
	<ol class="comment-list">
		<?php wp_list_comments(); ?>
	</ol>
<div class="pagination">
	<?php paginate_comments_links(); ?>
</div>
<?php endif;?>
<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
<p class="no-comments">Commentaires fermées</p>
<?php endif; ?>
<?php
	$comments_args = array(
		'title_reply' => 'test',
		'label_submit' => 'Ajouter un commentaire'
	);
	comment_form($comments_args);
?>
</div>