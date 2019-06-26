<?php
/**
 * iA4 functions and definitions.
 *
 * @author iA <ia@ia.net>
 */

/**
 * Set the content width.
 */
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

/**
 * Theme update checker courtesy of w-shadow.
 */
require get_template_directory().'/inc/theme-update-checker.php';
$update_checker = new ThemeUpdateChecker(
    'iA4',
    'https://ia.net/ia4/ia4.json'
);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if (!function_exists('ia4_setup')) :
function ia4_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('ia4', get_template_directory().'/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register the menu areas: header (primary) + footer
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ia4'),
        'footer' => __('Footer Menu', 'ia4'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));

    /*
    * Theme supports custom headers
    */
    add_theme_support('custom-header', apply_filters('ia4_custom_header_args', array(
        'width' => 394,
        'height' => 130,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => true,
        'wp-head-callback' => 'ia4_header_style',
    )));
}
endif; // ia4_setup
add_action('after_setup_theme', 'ia4_setup');

/**
 * Do some more of the above, this time under init
 */
if (!function_exists('ia4_init')) :
function ia4_init()
{
    add_post_type_support('jetpack-portfolio', 'custom-fields');
}
endif;
add_action('init', 'ia4_init');

/**
 * Enqueue scripts and styles.
 */
function ia4_scripts()
{
    wp_enqueue_style('ia4-style', get_stylesheet_uri());
    wp_enqueue_script('ia4-navigation', get_template_directory_uri().'/js/navigation.js', array(), '20120206', true);
    wp_enqueue_script('ia4-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20130115', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('highlight', get_template_directory_uri().'/js/vendor/highlight/highlight.js', array('jquery'), '1.0', true);
    wp_enqueue_script('throttle-debounce', get_template_directory_uri().'/js/vendor/throttle-debounce/jquery.ba-throttle-debounce.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.js', array(), '20120206', true);
    wp_enqueue_script('ia4', get_template_directory_uri().'/js/ia4.js', array('jquery'), '1.0', true);
    wp_localize_script('ia4', 'ia4ajax', array(
        'ajaxurl' => admin_url('/admin-ajax.php'),
        'homeurl' => home_url(),
        'postID' => is_404() ? false : get_the_ID(),
        'rec_nonce' => wp_create_nonce('ia4ajax-rec-nonce'), // create nonce so we can check it back later when wpdb is manipulated
    ));
}
add_action('wp_enqueue_scripts', 'ia4_scripts');

/**
 * Excerpt customization
 */
function ia4_new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'ia4_new_excerpt_more');

/*
 * Wrap images in figure tags
 */
function ia4_html5_insert_image($html, $id, $caption, $title, $align, $url)
{
    $html5 = "<figure id='post-$id media-$id' class='align-$align'>";
    $html5 .= "<img src='$url' alt='$title' />";
    if ($caption) {
        $html5 .= "<figcaption>$caption</figcaption>";
    }
    $html5 .= '</figure>';
    
    return $html5;
}
add_filter('image_send_to_editor', 'ia4_html5_insert_image', 10, 9);

/*
 * Filter the <p> tags from the images and iFrame
 */
function ia4_filter_ptags_on_images($content)
{
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('the_content', 'ia4_filter_ptags_on_images');

/*
 * Part of custom header support, hides the header text if necessary
 */
if (!function_exists('ia4_header_style')) :
function ia4_header_style()
{
    ?>
    <?php if (get_header_textcolor() == 'blank') : ?>
        <style type="text/css">
            .header-text {
                clip: rect(1px, 1px, 1px, 1px);
                position: absolute;
            }
        </style>
     <?php endif; ?>
     <?php
}
endif; // ia4_header_style

/**
 * Custom template tags.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Full width featured images.
 */
require get_template_directory().'/inc/featured-image.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory().'/inc/extras.php';

/**
 * Add semantic figure shortcute for more expressive html and writing.
 */
require get_template_directory().'/inc/shortcodes.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer.php';

/**
 * Tagline for portfolio posts.
 */
require get_template_directory().'/inc/tagline.php';

/**
 * Enqueue Google Fonts in Front End, based on themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/.
 */
function theme_slug_fonts_url()
{
    $fonts_url = '';

    /*
    * Translators: If there are characters in your language that are not
    * supported by Merriweather, translate this to 'off'. Do not translate
    * into your own language.
    */
    $merriweather = _x('on', 'Merriweather font: on or off', 'ia4');

    if ($merriweather !== 'off') {
        $query_args = array(
            'family' => urlencode('Merriweather:400italic,400,300italic,300,700,700italic'),
            'subset' => urlencode('latin,latin-ext'),
        );
        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

function theme_slug_scripts_styles()
{
    wp_enqueue_style('theme-slug-fonts', theme_slug_fonts_url(), array(), null);
}
add_action('wp_enqueue_scripts', 'theme_slug_scripts_styles');

/**
 * Enqueue Google Fonts in Back End.
 */
function theme_slug_editor_styles()
{
    add_editor_style(array('style.css', theme_slug_fonts_url()));
}
add_action('after_setup_theme', 'theme_slug_editor_styles');

/**
 * Adding fonts to the Custom Header screen.
 */
function theme_slug_custom_header_fonts()
{
    wp_enqueue_style('theme-slug-fonts', theme_slug_fonts_url(), array(), null);
}
add_action('admin_print_styles-appearance_page_custom-header', 'theme_slug_scripts_styles');

/**
 * Change order of comment fields
 */
add_filter('comment_form_defaults', 'remove_textarea');
add_action('comment_form_top', 'add_textarea');

function remove_textarea($defaults)
{
    $defaults['comment_field'] = '';
    $defaults['logged_in_as'] = '';

    return $defaults;
}

function add_textarea()
{
    if (is_user_logged_in()) {
        // Copied from wp-includes/comment-template.php
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        echo
            get_avatar(get_current_user_id(), 32).
            '<p class="logged-in-as">'.
            sprintf(
                __(
                    'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'
            ),
                get_edit_user_link(),
                $user_identity,
                wp_logout_url(apply_filters('the_permalink', get_permalink(get_the_ID())))
            ).
            '</p>';
    }

    echo '<p class="comments-area"><textarea id="comment" name="comment" placeholder="Comment (required)" cols="45" rows="1" aria-required="true" required></textarea></p>';
}
