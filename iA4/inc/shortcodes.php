<?php
/**
 * Improve HTML5 compatibility of caption shortcode, remove size attributes from image tags.
 *
 * @author iA <ia@ia.net>
 */

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes.
 *
 * @param string $val         Empty
 * @param array    $attr        Shortcode attributes
 * @param string $content Shortcode content
 *
 * @return string Shortcode output
 */
function ia4_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id' => '',
        'align' => 'aligncenter',
        'width' => '',
        'caption' => '',
    ), $attr));

    // No caption, no dice... But why width?
    if (1 > (int) $width || empty($caption)) {
        return '<figure id="'.$id.'" class="wp-caption '.esc_attr($align).'" style="width: '.(0 + (int) $width).'px">'.do_shortcode($content).'</figure>';
    }
    if ($id) {
        $id = esc_attr($id);
    }

    // Add itemprop="contentURL" to image - Ugly hack
    $content = str_replace('<img', '<img itemprop="contentURL"', $content);

    return '<figure id="'.$id.'" class="wp-caption '.esc_attr($align).'">'.do_shortcode($content).'<figcaption id="figcaption_'.$id.'" class="wp-caption-text" itemprop="description">'.$caption.'</figcaption></figure>';
}
add_filter('img_caption_shortcode', 'ia4_img_caption_shortcode_filter', 10, 3);

/* http://www.paulund.co.uk/remove-width-and-height-attributes-from-images */
function ia4_remove_width_and_height_attribute($html)
{
    return preg_replace('/(height|width)="\d*"\s/', '', $html);
}
add_filter('get_image_tag', 'ia4_remove_width_and_height_attribute', 10);
