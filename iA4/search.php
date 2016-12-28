<?php
/**
 * The template for displaying search results.
 *
 * @author iA <ia@ia.net>
 */
?>
<?php get_header(); ?>

<div id="iA4search">
    <div class="center">
    <?php if (htmlspecialchars($_GET['s']) == '') : ?>

        <?php get_search_form(); ?>

    <?php elseif (have_posts()) : ?>
        <h1 class="page-title">
            <?php
            $searchAll = new WP_Query("s=$s&showposts=0");
            $foundPosts = $searchAll->found_posts;
            if ($foundPosts <= 1) {
                    echo $foundPosts.' result found';
            } else {
                    echo $foundPosts.' results found';
            }
            ?>
        </h1>
        <?php 
            while (have_posts()) {
                the_post(); 
                get_template_part('template-parts/content', get_post_format());
            } 
            ia4_paging_nav();
        ?>
    <?php else : ?>
        <div class="cols">
            <div class="col">
                <p class="search-term text-center">
                    <?php _e('No results. Try searching for something else.', 'ia4') ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
    </div><!-- .center -->
</div><!-- #iA4search -->

<?php get_footer(); ?>
