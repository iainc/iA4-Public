<?php
/**
 * The theme header.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @author iA <ia@ia.net>
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

<!--[if lt IE 9]>
     <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv-printshiv.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
     <![endif]-->

     <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#content">
        <?php _e('Skip to content', 'ia4'); ?>
    </a>
    <div class="container">
        <header id="masthead" class="site-header" role="banner">
            <div class="center">
              <?php if (!get_theme_mod('ia4_center_logo', false)): ?>
                <div class="cols table logo-and-navigation">
                    <div class="col small table-cell">
                        <div class="header-bg site-branding">
                            <?php if (get_header_image()) : ?>
                                <div id="logo">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home" class="header-logo">
                                        <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                                    </a><!-- end logo link -->
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home" class="header-text">
                                        <span class="header-title-text"><?php bloginfo('name'); ?></span>
                                        <span class="header-description-text"><?php bloginfo('description'); ?></span>
                                    </a><!-- end header-text-->
                                    <?php if(ia4_display_header_menu()) : ?>
                                        <div class="mobile-menu mobile-menu--has-logo js-action" data-action="toggleMenu"><?php _e('Menu', 'ia4'); ?></div>
                                    <?php endif; ?>
                                </div><!--end logo-->
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home" class="header-text">
                                    <span class="header-title-text"><?php bloginfo('name'); ?></span><!-- end header-text-logo-->
                                    <span class="header-description-text"><?php bloginfo('description'); ?></span><!-- header-description -->
                                </a><!-- end header-text-->
                                <?php if(ia4_display_header_menu()) : ?>
                                    <div class="mobile-menu js-action" data-action="toggleMenu"><?php _e('Menu', 'ia4'); ?></div>
                                <?php endif; ?>
                            <?php endif; // End header image check. ?>
                        </div><!--end header-bg-->
                    </div><!--end col small-->
                    <?php if(ia4_display_header_menu()) : ?>
                    <div class="col large table-cell">
                        <div class="navigation original">
                            <div class="menu-wrapper">
                                <nav id="site-navigation" class="main-navigation">
                                    <div class="main-menu-wrapper">
                                        <div class="search-field">
                                            <input type="text" name="searchterm" value="<?php if (isset($_GET['s'])) echo $_GET['s']; ?>" class="js-search" id="searchterm" aria-label="Search Terms" autocomplete="off">
                                            <a data-action="toggleSearch" class="js-action-toggleSearch search-x" href="#">×</a>
                                        </div><!--end search-field-->

                                        <?php if (has_nav_menu('primary')): ?>
                                            <?php 
                                            $menu = wp_nav_menu(array('echo' => false, 'theme_location' => 'primary', 'depth' => 1, 'menu_id' => 'main-menu', 'items_wrap' => '%3$s', 'container' => '')); ?>
                                            <ul id="main-menu" class="menu">
                                                <?php echo $menu; ?>
                                                <li id="search-box" class="search"><a data-action="toggleSearch" class="js-action-toggleSearch search-text" href="#"><?php _e('Search', 'ia4'); ?></a></li>
                                            </ul>
                                        <?php else: ?>
                                            <ul id="main-menu" class="menu">
                                            	<?php 
                                                    $menu = wp_page_menu(array('theme_location' => 'primary', 'depth' => 1, 'menu_id' => 'main-menu', 'echo' => '0'));
                                                    // whip the page menu into wp_nav_menu form
                                                    $menu = str_replace('<ul>', '', $menu);
                                                    $menu = str_replace('</ul>', '', $menu);
                                                    $menu = str_replace('<div class="menu">', '', $menu);
                                                    $menu = str_replace('</div>', '', $menu);
                                                    echo $menu;
                                                ?>
                                                <li id="search-box" class="search"><a data-action="toggleSearch" class="js-action-toggleSearch search-text" href="#"><?php _e('Search', 'ia4'); ?></a></li>
                                            </ul>
                                        <?php endif; ?>
                                    </div><!--end main-menu-wrapper-->
                                </nav><!--#site-navigation-->
                            </div><!--end menu-rapper header-test-name-->
                        </div><!--end navigation original-->
                    </div><!--end col large-->
                    <?php endif; ?>
                </div><!--end logo-and-navigation-->
              <?php else: // Header without navigation etc. ?>
                <div class="logo-no-navigation">
                  <?php if (get_header_image()) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home">
                      <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                    </a><!-- end logo link -->
                  <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home" class="header-text">
                      <div class="header-text-logo">
                        <?php bloginfo('name'); ?>
                      </div><!-- end header-text-logo-->
                      <div class="header-description">
                        <?php bloginfo('description'); ?>
                      </div><!-- header-description -->
                    </a><!-- end header-text-->
                  <?php endif; ?>
                </div>
              <?php endif ?>
            </div><!--end cols-->
        </header>
        <div id="result"></div><!-- wrapper for search results -->
        <div id="content" class="site-content">
