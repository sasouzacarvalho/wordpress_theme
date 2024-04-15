<?php
/*
Template Name: Single Projetos
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section id="projetos">
            <?php
            while (have_posts()) :
                the_post();

                $data_projeto = get_field('data_do_projeto');
                $imagem_projeto = get_field('imagem_do_projeto');
                $descricao_projeto = get_field('descricao_do_projeto');
                $tipo_do_projeto = get_field('tipo_do_projeto');
                $link_projeto = get_field('link_do_projeto');
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="tipo-projeto">
                        <?php
                        if ($tipo_do_projeto) {
                            echo '<ul>';
                            if (is_array($tipo_do_projeto)) {
                                foreach ($tipo_do_projeto as $termo) {
                                    if (is_a($termo, 'WP_Term')) {
                                        if (property_exists($termo, 'name')) {
                                            echo '<li>' . $termo->name . '</li>';
                                        } else {
                                            echo '<li>Nome do termo não encontrado</li>';
                                        }
                                    } else {
                                        echo '<li>Objeto de termo inválido</li>';
                                    }
                                }
                            } else {
                                echo '<li>Dados do termo inválidos</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>Nenhum termo encontrado para o campo personalizado.</p>';
                        }
                        ?>
                    </div>
                    <div class="projeto-data"><?php echo esc_html($data_projeto); ?></div>

                    <div class="entry-content">
                        <?php
                        if ($imagem_projeto) {
                            echo '<img src="' . esc_url($imagem_projeto['url']) . '" alt="' . esc_attr($imagem_projeto['alt']) . '" />';
                        }
                        echo '<div class="descricao-projeto">' . wp_kses_post($descricao_projeto) . '</div>';
                        echo '<a href="' . esc_url($link_projeto) . '" class="btn-link-externo btn">Ver Projeto</a>';
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
            <?php
            endwhile; // Fim do loop
            ?>

        </section>
        <section class="projetos-relacionados">
            <div class="related-posts">
                <h2>Posts Relacionados</h2>
                <ul>
                    <?php
                    $tipo_do_projeto = get_field('tipo_do_projeto', get_the_ID());

                    if ($tipo_do_projeto) {
                        $args = array(
                            'post_type' => 'projeto',
                            'posts_per_page' => 4,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category', 
                                    'field' => 'slug',
                                    'terms' => $termo,
                                ),
                            ),
                        );

                        $related_posts = new WP_Query($args);

                        if ($related_posts->have_posts()) {
                            while ($related_posts->have_posts()) {
                                $related_posts->the_post();
                                $imagem_projeto = get_field('imagem_do_projeto');
                                $resumo_projeto = get_field('resumo_do_projeto');
                                ?>
                                <li>
                                 <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-content">
                                    <?php
                                        if ($imagem_projeto) {
                                            echo '<img src="' . esc_url($imagem_projeto['url']) . '" alt="' . esc_attr($imagem_projeto['alt']) . '" />';
                                        }
                                        echo '<div class="descricao-projeto">' . wp_kses_post($resumo_projeto) . '</div>';
                                        
                                    ?>
                                 </div>
                                <?php
                                
                            }
                            wp_reset_postdata();
                        } else {
                            echo '<li>Nenhum post relacionado encontrado.</li>';
                        }
                    } else {
                        echo '<li>Nenhum termo encontrado para o campo personalizado.</li>';
                    }
                    ?>
                </ul>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
