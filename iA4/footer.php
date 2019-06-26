<?php
/**
 * The template for displaying the footer.
 *
 * @author iA <ia@ia.net>
 */
?>
        <div class="center">
            <footer>
                <?php if (get_theme_mod('ia4_display_footer', true)): ?>
                    <div>
                        <div class="cols">
                            <div class="col">
                                <h1 class="teaser-title"><?php echo get_theme_mod('ia4_footer_headline', __('Get in Touch', 'ia4')); ?></h1>
                                <p class="message">
                                    <?php echo get_theme_mod('ia4_footer_message', __('Your contact message.', 'ia4')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (has_nav_menu('footer')): ?>
                  <?php if (get_theme_mod('ia4_center_footer', true)): ?>
                    <div class="centered-footer-menu">
                        <?php wp_nav_menu(array('theme_location' => 'footer', 'depth' => 1, 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu')); ?>
                    </div>
                  <?php else: ?>
                    <div class="cols">
                        <div class="col">
                            <?php wp_nav_menu(array('theme_location' => 'footer', 'depth' => 1, 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu')); ?>
                         </div>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
            </footer>
        </div> <!-- end center -->
    </div> <!-- end contentWrapper -->
</div> <!-- end container -->
<?php wp_footer(); ?>

</body>
</html>