</div><!-- #content -->
<footer id="colophon" class="site-footer" role="contentinfo"> 
    <section class="footer-content">
        <ul class="footer-primary"> 
            <div>
                <?php                
                    if (has_nav_menu('footer-menu')) {                   
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_id' => 'footer-menu',
                            'menu_class' => 'footer-menu',                       
                        ));
                    }
                    ?>  
            </div>  
            <div class="content-right">
                
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'redes-menu', 
                        
                    ));
                    ?>  
                            
            </div>  
        </ul>        
    </section>    
    <div class="site-info container">
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
