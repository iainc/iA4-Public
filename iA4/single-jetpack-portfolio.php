<?php
/**
 * The template for displaying a single jetpack portfolio entry.
 *
 * @author iA <ia@ia.net>
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', 'portfolio');
            }
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
