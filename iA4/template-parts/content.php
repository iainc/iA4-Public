<?php
/**
 * Displays a generic post fragment in a list of posts, e.g. on the homepage.
 *
 * @author iA <ia@ia.net>
 */
?>

<div class="cols teaser no-thumbnail">
    <div class="col">
        <?php if (is_home()): ?>
                <?php if (get_the_tags()): ?>
                    <div id="tags" class="tags">
                        <ul class = "tags">
                            <?php the_tags('<span class="tag">', '</span>, <span class="tag">', '</span>'); ?>
                        </ul>
                    </div>
                <?php endif; ?>
        <?php endif; ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

             <?php if (has_post_thumbnail() && ia4_display_featured_image_overview() && !is_search()): ?>
                <figure class="list">
                    <img src="<?php echo ia4_get_the_thumbnail_url(); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>">
                </figure>
            <?php endif; ?>
            
            <h2 class="blog-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <?php if (!is_home()): ?>
                <a href="<?php the_permalink(); ?>">
                    <p class="meta meta--blog">
                        <?php ia4_the_post_meta(); ?>
                    </p>
                </a>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>">
                <?php 
                $excerpt = get_the_excerpt();
                echo $excerpt?$excerpt:'<p></p>';
                echo '&nbsp;<span class="more__text">' . __('More', 'ia4') . '</span>';
                ?>
            </a>
        </article>

    </div>
</div>
