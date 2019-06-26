<?php
/**
 * Add full width image checkbox to the post thumbnail box.
 * Add conditional display checkboxes to the post thumbnail box.
 *
 * @author iA <ia@ia.net>
 */
function ia4_featured_image_options($content)
{
    global $post;

    // Generate a nonce field but don't echo it
    $nonce = wp_nonce_field('ia4_featured_image', 'ia4_featured_image_nonce', true, false);

    // Check if the post has a thumbnail and if it does, render a checkbox
    if (strpos($content, 'remove-post-thumbnail')) {
        $wide_checked = get_post_meta($post->ID, '_ia4_wide_featured_image', true) == 'full' ? 'checked' : '';

        $overview_checked = ia4_display_featured_image_overview() == true ? 'checked' : '';
        $single_checked = ia4_display_featured_image_single() == true ? 'checked' : '';
        
        $checkbox_wide = '<label><input name="ia4_wide_featured_image" type="checkbox" '.$wide_checked.'>'.__('Expanded image', 'ia4').'</label><br/>';
        $display_on = 'Display on:<br/>';
        $checkbox_overview = '<label><input name="ia4_overview_featured_image" type="checkbox" '.$overview_checked.'>'.__('Overview pages', 'ia4').'</label><br/>';
        $checkbox_single = '<label><input name="ia4_single_featured_image" type="checkbox" '.$single_checked.'>'.__('Single pages', 'ia4').'</label><br/>';

        return $content.$nonce.$checkbox_wide.$display_on.$checkbox_overview.$checkbox_single;
    }

    // Otherwise, don't alter the metabox
    return $content;
}
add_filter('admin_post_thumbnail_html', 'ia4_featured_image_options');

/**
 *    Save full width image preferences.
 */
function ia4_featured_image_save($post_id)
{
    // Make sure safe request comes from within the admin pannel by checking nonce
    if (!isset($_POST['ia4_featured_image_nonce'])) {
        return $post_id;
    }
    $nonce = $_POST['ia4_featured_image_nonce'];

    // Validate nonce
    if (!wp_verify_nonce($nonce, 'ia4_featured_image')) {
        return $post_id;
    }

    // Do nothing if it's an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check user access
    if (!current_user_can('edit_page', $post_id)) {
        return $post_id;
    }

    // Sanitize text to prevent injections
    $wide_featured_image_type = !isset($_POST['ia4_wide_featured_image']) ? 'default' : 'full';
    $overview_featured_image_type = !isset($_POST['ia4_overview_featured_image']) ? 'default' : 'true';
    $single_featured_image_type = !isset($_POST['ia4_single_featured_image']) ? 'default' : 'true';
    

    // Save to database
    update_post_meta($post_id, '_ia4_wide_featured_image', $wide_featured_image_type);
    update_post_meta($post_id, '_ia4_overview_featured_image', $overview_featured_image_type);
    update_post_meta($post_id, '_ia4_single_featured_image', $single_featured_image_type);
}
add_action('save_post', 'ia4_featured_image_save');

/**
 *    Get featured image type: full width or default.
 */
function ia4_get_featured_image_type()
{
    $type = get_post_meta(get_the_ID(), '_ia4_wide_featured_image');

    return $type ? $type[0] : 'default';
}

/**
 *    Display overview featured images?
 */
function ia4_display_featured_image_overview()
{
    $display = get_post_meta(get_the_ID(), '_ia4_overview_featured_image');

    return $display ? $display[0] == 'true' : false;
}

/**
 *    Display overview featured images?
 */
function ia4_display_featured_image_single()
{
    $display = get_post_meta(get_the_ID(), '_ia4_single_featured_image');

    return $display ? $display[0] == 'true' : true;
}
