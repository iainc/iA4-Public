<?php
/**
 * Renders a single page style content entry.
 *
 * @author iA <ia@ia.net>
 */
?>

<?php if (ia4_get_featured_image_type() == 'full' && has_post_thumbnail() && ia4_display_featured_image_single()): ?>
    <figure class="mood mood--big">
        <img src="<?php echo ia4_get_the_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
    </figure>
<?php endif; ?>

<div class="center">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if (ia4_get_featured_image_type() != 'full' && has_post_thumbnail() && ia4_display_featured_image_single()): ?>
            <section>
                <figure class="mood">
                    <img src="<?php echo ia4_get_the_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                </figure>
            </section><!-- section -->
        <?php endif; ?>
        <section>
            <div class="col">
                <h1 class="blog-title <?php if (has_post_thumbnail() && ia4_display_featured_image_single()) {
    echo 'blog-title-mfix';
} ?>">
                    <?php the_title(); ?>
                </h1>
                <p class="meta meta--blog detail">
                    <?php ia4_the_post_meta(); ?>
                </p>
            </div>
        </section>
        <section>
            <div class="col">
                <div class="entry-content post-content" id="post-content">
                    <?php the_content(); ?>

                    <?php $categories_arg = array(
                        'exclude' => get_option('default_category'),
                        'depth' => -1,
                        'title_li' => '',
                        );?>
                    <?php $categories = wp_get_post_categories(get_the_ID(), $categories_arg); ?>
                    <?php if ($categories || get_the_tags()): ?>
                        <div class="post-data">
                            <?php if ($categories): ?>
                                <div id="categories" class="categories">
                                    <?php foreach ($categories as $cat) : ?>
                                        <?php $category = get_category($cat); ?>
                                        <?php if ($cat == $categories[0]) {
                            echo _e('Posted in: ', 'ia4');
                        }?>
                                        <span class="cat-item">
                                            <a href="<?php echo get_category_link($category->term_id);?>"><!--
                                                --><?php echo $category->name;?><!--
                                             --></a><!--
                                            --><?php if ($cat != end($categories)) {
                            echo ', ';
                        } ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (get_the_tags()): ?>
                                <div id="tags" class="tags">
                                    <ul class = "tags">
                                        <?php _e('Tags: ', 'ia4'); ?><?php the_tags('<span class="tag">', '</span>, <span class="tag">', '</span>'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </div><!-- .col -->
        </section><!-- section -->
        <section>
            <div class="col">
                <?php if (comments_open() || get_comments_number()) {
                            comments_template();
                        } ?>
            </div>
        </section><!-- section -->

    </article><!-- #post-## -->
</div>
