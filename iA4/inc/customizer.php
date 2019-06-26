<?php
/**
 * iA4 Theme Customizer.
 *
 * @author iA <ia@ia.net>
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ia4_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}
add_action('customize_register', 'ia4_customize_register');

/**
 * Adds the individual sections, settings, and controls to the theme customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ia4_customize_section($wp_customize)
{
    /*
     * Center logo in header
     */
    $wp_customize->add_setting(
        'ia4_center_logo',
        array(
            'default' => false,
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );
    $wp_customize->add_control(
        'ia4_center_logo',
        array(
            'label' => __('Logo only header?', 'ia4'),
            'priority' => 1,
            'description' => __('Makes the menu disappear from the header and centers the logo.', 'ia4'),
            'section' => 'header_image',
            'type' => 'checkbox',
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );
    
    /*
     * Add texts section to the customizer
     */
    $wp_customize->add_section(
        'ia4_texts',
        array(
            'title' => __('Texts', 'ia4'),
            'description' => __('Static texts used in various locations throughout the theme', 'ia4'),
            'priority' => 80,
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    
    /*
    * The "News" section
    */
    $wp_customize->add_setting(
        'ia4_news_headline',
        array(
            'default' => 'News',
            'transport' => 'postMessage',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'ia4_news_headline',
        array(
            'label' => __('News Headline', 'ia4'),
            'description' => __('Title used for the news section on home', 'ia4'),
            'section' => 'ia4_texts',
            'type' => 'text',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    
    /*
    * The "Portfolio" section
    */
    $wp_customize->add_setting(
        'ia4_portfolio_headline',
        array(
            'default' => 'Portfolio',
            'transport' => 'postMessage',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'ia4_portfolio_headline',
        array(
            'label' => __('Portfolio Headline', 'ia4'),
            'description' => __('Title used for the portfolio section on a page', 'ia4'),
            'section' => 'ia4_texts',
            'type' => 'text',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    
    
    /*
     * Add footer section to the customizer
     */
    $wp_customize->add_section(
        'ia4_footer',
        array(
            'title' => __('Footer', 'ia4'),
            'description' => __('Information to display in the footer', 'ia4'),
            'priority' => 75,
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );

    /*
     * Display the footer?
     */
    $wp_customize->add_setting(
        'ia4_display_footer',
        array(
            'default' => true,
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );
    $wp_customize->add_control(
        'ia4_display_footer',
        array(
            'label' => __('Display Footer?', 'ia4'),
            'description' => __('Should we display the headline and message defined below on every page?', 'ia4'),
            'section' => 'ia4_footer',
            'type' => 'checkbox',
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );
    
    /*
     * Center the footer menu?
     */
    $wp_customize->add_setting(
        'ia4_center_footer',
        array(
            'default' => true,
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );
    $wp_customize->add_control(
        'ia4_center_footer',
        array(
            'label' => __('Center footer menu?', 'ia4'),
            'description' => __('Should we center the footer menu (you can define it under "Appearance/Menus")?', 'ia4'),
            'section' => 'ia4_footer',
            'type' => 'checkbox',
            'sanitize_callback' => 'ia4_sanitize_boolean',
        )
    );

    /*
    * The headline
    */
    $wp_customize->add_setting(
        'ia4_footer_headline',
        array(
            'default' => 'Get in Touch',
            'transport' => 'postMessage',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'ia4_footer_headline',
        array(
            'label' => __('Footer Headline', 'ia4'),
            'section' => 'ia4_footer',
            'type' => 'text',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );

    /*
    * The message
    */
    $wp_customize->add_setting(
        'ia4_footer_message',
        array(
            'default' => __('Use this text to catch visitors at the end of the page. Tell them to get in touch with you. etc. HTML allowed.', 'ia4'),
            'transport' => 'postMessage',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'ia4_footer_message',
        array(
            'label' => __('Footer Message', 'ia4'),
            'section' => 'ia4_footer',
            'settings' => 'ia4_footer_message',
            'type' => 'textarea',
            'sanitize_callback' => 'ia4_sanitize_text',
        )
    );

    /*
     * Remove Color Settings from Customizer
     */
    $wp_customize->remove_section('colors');
}
add_action('customize_register', 'ia4_customize_section');

/**
 * Sanitizer used by the above theme customizer input handlers.
 */
function ia4_sanitize_boolean($value)
{
    if (!is_bool($value)) {
        return false;
    }

    return $value;
}

/**
 * Sanitizer used by the above theme customizer input handlers.
 */
function ia4_sanitize_text($value)
{
    if (!is_string($value)) {
        return '';
    }

    return $value;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ia4_customize_preview_js()
{
    wp_enqueue_script('ia4_customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20130508', true);
}
add_action('customize_preview_init', 'ia4_customize_preview_js');
