<?php
// There is nothing output here because block themes do not use php templates.
// There is a core ticket discussing removing this requirement for block themes:
// https://core.trac.wordpress.org/ticket/54272.

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Iniciando o loop padrão do WordPress
        if (have_posts()) :
            while (have_posts()) :
                the_post();

                // Incluindo o conteúdo da postagem
                get_template_part('template-parts/content', get_post_format());

            endwhile;

            // Paginação
            the_posts_pagination(array(
                'prev_text' => __('Anterior', 'textdomain'),
                'next_text' => __('Próximo', 'textdomain'),
            ));
        else :
            // Se não houver postagens
            get_template_part('template-parts/content', 'none');
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
