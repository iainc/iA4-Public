<?php
/**
 * The template for displaying the stand alone search page.
 * Template Name: Search Page
 *
 * @author iA <ia@ia.net>
 */
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="center">
            <?php get_search_form(); ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
