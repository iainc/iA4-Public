<?php
/**
 * Custom template tags for this theme.
 *
 * @author iA <ia@ia.net>
 */

/**
 * Display navigation to next/previous set of posts when applicable.
 */
if (!function_exists('ia4_paging_nav')) :
function ia4_paging_nav()
{
    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages < 2) {
        return;
    } ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text">
            <?php _e('Posts navigation', 'ia4'); ?>
        </h1>
        <div class="nav-links">
            <?php if (get_next_posts_link()) : ?>
            <div class="nav-previous">
                <?php next_posts_link(__('Older posts', 'ia4')); ?>
            </div>
            <?php endif; ?>

        <?php if (get_previous_posts_link()) : ?>
            <div class="nav-next">
                <?php previous_posts_link(__('Newer posts', 'ia4')); ?>
            </div>
        <?php endif; ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/*
 * Display navigation to next/previous post when applicable.
 */
if (!function_exists('ia4_post_nav')) :
function ia4_post_nav()
{
    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    } ?>
    <nav class="navigation post-navigation" role="navigation">
        <h1 class="screen-reader-text">
            <?php _e('Post navigation', 'ia4'); ?>
        </h1>
        <div class="nav-links">
            <?php
                previous_post_link('<div class="nav-previous">%link</div>', _x('<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'ia4'));
    next_post_link('<div class="nav-next">%link</div>', _x('%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'ia4')); ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/*
 * Output post metadata, for example:
 * By Peter Tosh on 2015-06-12 / 1 min read
 */
if (!function_exists('ia4_the_post_meta')) :
function ia4_the_post_meta()
{
    echo sprintf(__('By %s on %s — %s read', 'ia4'), get_the_author(), get_the_date(), ia4_get_the_reading_time());
}
endif;

/**
 *    Gets the featured image URL of the current post.
 */
function ia4_get_the_thumbnail_url()
{
    return has_post_thumbnail(get_the_ID()) ? wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) : false;
}

/**
 * Gets the estimated reading time for an article.
 */
function ia4_get_the_reading_time()
{
    $content = get_the_content();
    $word = str_word_count(strip_tags($content));
    $m = floor($word / 200);
    $est = ($m < 1 ? '1' : $m).' min'.($m <= 1 ? '' : 's');

    return $est;
}

/**
 * Returns true if the user defined a primary menu that is not empty or if
 * no primary menu is defined (fallback to page menu)
 */
function ia4_display_header_menu()
{
    if (get_theme_mod('ia4_center_logo', false)) {
        return false;
    }
    
    $display_header_menu = true;
    if (has_nav_menu('primary')) {
        $menu = wp_nav_menu(array('echo' => false, 'theme_location' => 'primary', 'depth' => 1, 'menu_id' => 'main-menu', 'items_wrap' => '%3$s', 'container' => ''));
        // if an empty primary header menu is defined
        if ($menu == '') {
            $display_header_menu = false;
        }
    }
    return $display_header_menu;
}

/**
 * Get Project custom fields.
 */
function ia4_get_public_custom_fields($post_id = 0)
{
    if (!empty($post_id)) {
        $custom_fields = get_post_custom($post_id);
    } else {
        $custom_fields = get_post_custom();
    }

    $public_custom_fields = array();
    foreach ($custom_fields as $key => $value) {
        if ('_' != $key[0]) {
            $public_custom_fields[$key] = $value[0];
        }
    }

    return $public_custom_fields;
}

/**
 * Output project custom fields.
 */
function ia4_the_custom_fields()
{
    $fields = ia4_get_public_custom_fields(get_the_ID());

    if (($fields)): ?>
        <dl class="meta">
            <?php foreach ($fields as $field => $value):
                $is_link = strpos($value, 'http') !== false; ?>
                <div class="custom-field">
                    <?php if ($is_link): ?>
                        <dt>
                            <a href="<?php echo $value; ?>"><?php echo $field; ?></a>
                        </dt>
                    <?php else: ?>
                        <dt>
                            <?php echo $field; ?>:
                        </dt>
                        <dd>
                            <?php echo $value; ?>
                        </dd>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </dl>
        <?php
    endif;
}
