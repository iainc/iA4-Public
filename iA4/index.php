<?php
/**
 * The main template file.
 *
 * Used to display a page when nothing more specific matches a query.
 *
 * @author iA <ia@ia.net>
 */
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="center">
            <header class="header page-title">
                <?php if (is_front_page()): ?>
                    <h1 class="page-title page-title-news">
                    <?php echo get_theme_mod('ia4_news_headline', __('News', 'ia4')); ?>
                    </h1>
                <?php else: ?>
                    <h1 class="page-title">
                    <?php echo get_the_title(get_option('page_for_posts')); ?>
                    </h1>
                <?php endif; ?>
            </header>

            <?php if (have_posts()) : ?>
                <section id="posts">
                    <?php 
                        while (have_posts()) {
                            the_post(); 
                            get_template_part('template-parts/content', get_post_format()); 
                        } 
                    ?>
                </section><!-- #posts -->
                <section section id="posts_naviation">
                    <?php ia4_paging_nav(); ?>
                </section><!-- #posts_naviation -->
            <?php else : ?>
                <section id="posts_empty"><!-- #posts -->
                    <?php get_template_part('template-parts/content', 'none'); ?>
                </section><!-- #posts_empty -->
            <?php endif; ?>

        </div><!-- .center -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
