<?php
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
    <div class="comments-title">
		<?php comments_number(__('There are no comments yet, you may be the first!', 'b2k')) ?>
	</div><!-- comments-title-->

	<?php if (have_comments()) : ?>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'avatar_size' => 0,
				'style'       => 'ol',
				'short_ping'  => true,
				'callback'    => 'b2k_comment_callback'
			));
			?>
		</ol>
	<?php endif; ?>

	<?php

	$name = __('Name (required)', 'b2k');
	$email = __('Email (required)', 'b2k');
    $site = __('Homepage (not required)', 'b2k');

	$fields = array(
		'author' => '<p class="comment-form-author"><input name="author" id="author" type="text" tabindex="2" required="required" placeholder="'.$name.'"></input></p>',
		'email' => '<p class="comment-form-email"><input name="email" id="email" type="text" tabindex="3" required="required" placeholder="'.$email.'"></input></p>'
	);

	$comment = __('Your comment', 'b2k');

    $comments_args = array(
        'title_reply_before' => '<div id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</div>',
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="100%" rows="10" required="required" tabindex="1" placeholder="'.$comment.'"></textarea></p>',
		'fields' => apply_filters('comment_form_default_fields', $fields)
	);

	comment_form($comments_args);
	?>
</div> <!-- #comments -->
