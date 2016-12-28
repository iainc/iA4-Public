<?php
/**
 * The template used for displaying a single portfolio teaser.
 *
 * @author iA <ia@ia.net>
 */
$image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium'); ?>

<!--
--><li class="tile tile-small">
        <?php if ($image_data): ?>
            <a href="<?php the_permalink()?>" class="tile-pan" style="background-image: url(<?php echo $image_data[0]; ?>);" aria-labelledby="meta project_tagline" role="img"></a>
        <?php else: ?>
            <a href="<?php the_permalink()?>" class="tile-pan empty"></a>
        <?php endif; ?>
        <a href="<?php the_permalink()?>">
        <p class="meta" id="meta"><?php the_title(); ?></p>
        <?php
        if (is_front_page()) {
            $page_id = get_the_ID();
        }
        $page_id = $page_id ? $page_id : get_the_ID();
        $tagline = get_post_custom_values('_ia4_tagline', $page_id);
        if (strlen($tagline[0]) > 0) {
            echo '<p class="project_tagline" id="project_tagline">'.$tagline[0].'</p>';
        }
        ?>
        </a>
     </li><!--
-->
