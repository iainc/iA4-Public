<?php
/**
 * The template for displaying archive pages.
 * Template Name: Recent Posts
 *
 * @author iA <ia@ia.net>
 */
get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        $is_page = false;
        if (is_page()) {
            $is_page = true;
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', 'page');
            }
            global $paged;
            if (!$paged) {
                $paged = get_query_var('page', 1);
            } //'tis a bug
            query_posts('posts_per_page='.get_option('posts_per_page').'&paged='.$paged);
        }
        ?>        
        <div class="center">
            <?php if (have_posts()) : ?>
                <?php if (is_home()): ?>
                    <h1 class="page-title page-title-news">
                    <?php echo get_theme_mod('ia4_news_headline', __('News', 'ia4')); ?>
                    </h1>
                <?php else: ?>
                    <h1 class="page-title">
                    <?php the_archive_title(); ?>
                    </h1>
                <?php endif; ?>
                <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/content', get_post_format());
                    }
                    ia4_paging_nav();
                ?>
            <?php else : ?>
                <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </div>
    </main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>
