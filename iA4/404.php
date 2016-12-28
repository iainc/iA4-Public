<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @author iA <ia@ia.net>
 */
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="center">
            <div class="col">
                <h1 class="page-title">
                    <?php _e('Page Not Found', 'ia4'); ?>
                </h1>
                <p>
                    <?php _e('Sorry, something went wrong here. Let us take you <a href="/">home</a> or you can search for what you are looking for.', 'ia4'); ?>
                </p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
