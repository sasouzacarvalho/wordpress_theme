<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="bar-top">
            <div class="bar-top-title">
                 <h1><?php wp_title('', true, 'right'); ?></h1>
            </div>            
        </div>
        <?php
        
        while (have_posts()) :
            the_post();

            
            get_template_part('template-parts/content', 'page');

            
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; 
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
