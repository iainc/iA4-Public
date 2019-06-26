<?php
/**
 * iA4 project taglines.
 *
 * @author iA <ia@ia.net>
 */

/**
 * Show a metabox to define the tagline for portfolio posts.
 */
function ia4_tagline_metabox_callback($post)
{
    // get current value
    $value = get_post_meta($post->ID, '_ia4_tagline', true);
    wp_nonce_field('ia4_tagline_metabox', 'ia4_tagline_metabox_nonce', true, true); ?>
    <textarea name="ia4_tagline" id="ia4_tagline" cols="60" rows="2" tabindex="30" style="width: 97%;"><?php echo esc_html($value); ?></textarea>
    <?php
}

/**
 * Add a tagline metabox for portfolio posts.
 */
function ia4_tagline_metabox()
{
    add_meta_box('ia4_tagline_metabox', __('Tagline', 'ia4'), 'ia4_tagline_metabox_callback', 'jetpack-portfolio', 'normal', 'high');
}
add_action('admin_menu', 'ia4_tagline_metabox');

/**
 * Save tagline metabox data.
 */
function ia4_tagline_save_data($post_id)
{
    // Make sure safe request comes from within the admin pannel by checking nonce
    if (!isset($_POST['ia4_tagline_metabox_nonce'])) {
        return $post_id;
    }
    $nonce = $_POST['ia4_tagline_metabox_nonce'];

    // Validate nonce
    if (!wp_verify_nonce($nonce, 'ia4_tagline_metabox')) {
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
    $tagline_input = sanitize_text_field($_POST['ia4_tagline']);

    // Save to database
    update_post_meta($post_id, '_ia4_tagline', $tagline_input);
}
add_action('save_post', 'ia4_tagline_save_data');
?>
