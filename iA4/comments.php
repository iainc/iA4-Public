<?php
/**
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @author iA <ia@ia.net>
 */
?>
<?php
    if (!post_password_required()) :

        $fields = array(
            'author' => '<p class="comment-form-author">'.
            '<input id="author" name="author" type="text" placeholder="Name (required)" size="30" aria-required="true" required /></p>',

            'email' => '<p class="comment-form-email">'.
            '<input id="email" name="email" type="text" placeholder="Email (required)" size="30" aria-required="true" required /></p>',
        );

        // Comment field gets configured in functions.php
        // "Logged in as" gets configured in functions.php
        $comment_form_args = array(
            'comment_field' => '',
            'fields' => $fields,
            'logged_in_as' => '',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'title_reply' => '',
        );
?>

    <h1 class="comment-reply-title no-print"><?php _e('Leave a comment', 'ia4'); ?></h1>
    <div class="no-print">
        <?php comment_form($comment_form_args); ?>
    </div>
    <?php if (get_comments($count = true) > 0): ?>
        <div id="comments" class="comments-area">
            <ul class="comments">
                <?php wp_list_comments(); ?>
            </ul>
        </div><!-- #comments -->
    <?php endif;?>
<?php endif;?>
