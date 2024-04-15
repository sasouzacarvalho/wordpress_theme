<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Verificar se há postagens
        while (have_posts()) :
            the_post();

            // Incluindo o template de exibição de postagem
            get_template_part('template-parts/content', get_post_format());

            // Se os comentários estiverem permitidos ou se houver pelo menos um comentário, exibir a área de comentários
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
