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
        // Iniciando o loop da página do WordPress
        while (have_posts()) :
            the_post();

            // Incluindo o conteúdo da página
            get_template_part('template-parts/content', 'page');

            // Se os comentários estiverem abertos ou se houver pelo menos um comentário, exibir a área de comentários
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // Fim do loop da página
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
