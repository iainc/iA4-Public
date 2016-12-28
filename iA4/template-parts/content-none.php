<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @author iA <ia@ia.net>
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Nothing Found', 'ia4'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ia4'), esc_url(admin_url('post-new.php'))); ?></p>

        <?php elseif (is_search()) : ?>

            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ia4'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e('We can&rsquo;t find what you&rsquo;re looking for. Perhaps searching will help?', 'ia4'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
