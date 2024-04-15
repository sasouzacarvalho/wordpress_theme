<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <?php
            // Título da categoria
            single_cat_title('<h1 class="page-title">', '</h1>');
            // Descrição da categoria (se houver)
            if (category_description()) :
                echo '<div class="archive-description">' . category_description() . '</div>';
            endif;
            ?>
        </header><!-- .page-header -->

        <?php
        // Verificar se há postagens
        if (have_posts()) :
            // Loop através das postagens
            while (have_posts()) :
                the_post();

                // Incluindo o template de exibição de postagens
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
