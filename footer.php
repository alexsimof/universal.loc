
        <footer class="footer">
            <div class="container">

                <div class="footer-menu-bar">

                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </div>
                <!-- footer-menu-bar -->
                <div class="footer-info">
                    <?php
                    wp_nav_menu( [
                        'theme_location'  => 'footer_menu',
                        'container'       => 'nav',
                        'menu_class'      => 'footer-nav',
                        'echo'            => true,

                    ] );

                    
                    $instance = array(
                        'facebook'  => 'https://facebook.com',
                        'instagram' => 'https://instagram.com',
                        'twitter'   => 'https://twitter.com',
                        'youtube'   => 'https://youtube.com',
                        'title'     => '',
                    );
                    
                    $args = array(
                        'before_widget' => '<div class="footer-social">',
                        'after_widget' => '</div>',
                        
                    );
                    
                    the_widget( 'Social_Widget', $instance, $args );

                    ?>
                </div>
                <!-- footer-info -->
                <div class="footer-text-wrapper">
                    <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
                    <span class="footer-copyright"><?php echo date(' Y ') . '&copy; ' . get_bloginfo(); ?></span>
                </div>
            </div>
        </footer>
        <?php  wp_footer(); ?>
    </body>
</html>