<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <?php
            
            single_cat_title('<h1 class="page-title">', '</h1>');
            
            if (category_description()) :
                echo '<div class="archive-description">' . category_description() . '</div>';
            endif;
            ?>
        </header><!-- .page-header -->

        <?php
       
        if (have_posts()) :
            
            while (have_posts()) :
                the_post();

               
                get_template_part('template-parts/content', get_post_format());

            endwhile;

            
            the_posts_pagination(array(
                'prev_text' => __('Anterior', 'textdomain'),
                'next_text' => __('Próximo', 'textdomain'),
            ));
        else :
           
            get_template_part('template-parts/content', 'none');

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
