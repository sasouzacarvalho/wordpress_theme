<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css">
    <?php if (is_front_page()) : ?>
    <?php endif; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//code.jquery.com/jquery-2.1.0.min.js"></script>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="main">
        <header>
         <div class="center-header desktop-menu">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <?php
                
                if (has_nav_menu('primary')) {                
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'menu_class' => 'primary-menu',
                        'container' => false, 
                    ));
                } else {

                    ?>
                <ul class="fallback-menu">
                    <?php
                            wp_list_pages(array(
                            'title_li' => '', 
                        ));
                        ?>
                </ul>
                <?php } ?>
            </nav><!-- #site-navigation -->
            <h1 class="site-title logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <div class="site-branding">
                        <?php the_custom_logo(); ?>
                    </div>
                </a>
            </h1>
            <?php 
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) :
                // Se houver uma descrição do site
                ?>
            <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
            <div class="menu-redes">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'redes-menu', 
                        
                    ));
                    ?>
            </div>
         </div>
         <div class="menu-responsivo">

            <span class="btn-mobile" href="#" title="Menu"><span class="material-symbols-outlined">menu</span></span>

            <div class="controla-menu">
                <?php
                    
                    if (has_nav_menu('primary')) {                
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'primary-menu',
                            'container' => false, 
                        ));
                    } else {
    
                        ?>
                    <ul class="fallback-menu">
                        <?php
                                wp_list_pages(array(
                                'title_li' => '', 
                            ));
                            ?>
                    </ul>
                    <?php } ?>
                    <script>
                        $('.btn-mobile').click(function () {
                    
                            if (!$(this).hasClass('menu-ativo')) {
                                $(this).addClass('menu-ativo');
                                $('.controla-menu').slideDown(500);
                            } else {
                                $(this).removeClass('menu-ativo');
                                $('.controla-menu').slideUp(400);
                            }
                        });
                    </script>                         
            </div>

        </div><!--Menu Responsivo-->
        </header>