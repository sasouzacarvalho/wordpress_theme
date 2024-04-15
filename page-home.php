<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<!-- Conteúdo da Home -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="bar-top">
            <div class="bar-top-title">
                <h1><?php wp_title('', true, 'right'); ?></h1>
            </div>
        </div>
        <section class="section_one banner">
            <div class="header-home">
                <?php
                $imagem_principal = get_field('banner_topo');
                if( $imagem_principal ): ?>
                <div class="banner-topo"
                    style="background-image: url('<?php echo esc_url($imagem_principal['url']); ?>');">
                    <div class="section-x">
                        <div class="content">
                            <?php            
                                $titulo = get_field('titulo_h1');           
                                $subtitulo = get_field('subtitulo_h2');           
                                if ($titulo) {
                                    echo '<h1>' . esc_html($titulo) . '</h1>';
                                }           
                                if ($subtitulo) {
                                    echo '<h4>' . esc_html($subtitulo) . '</h4>';
                                }

                                $link_botao = get_field('bt_try');  

                                if ($link_botao) {
                                    echo '<a href="' . esc_url($link_botao['url']) . '" class="botao">' . esc_html($link_botao['title']) . '</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <section class="section_two features section-x">
            <div class="content-text">
                <h2>Projects</h2>
            </div>
            <div class="project-home">
                <?php
                    $args = array(
                    'post_type' => 'projeto', 
                    'posts_per_page' => 4, 
                );

                $home_query = new WP_Query($args);

                if ($home_query->have_posts()) :
                    while ($home_query->have_posts()) : $home_query->the_post();
                    
                        $imagem_projeto = get_field('imagem_do_projeto');
                        $resumo_projeto = get_field('resumo_do_projeto');
                              
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="entry-content">
                        <?php
                            if ($imagem_projeto) {
                                echo '<img src="' . esc_url($imagem_projeto['url']) . '" alt="' . esc_attr($imagem_projeto['alt']) . '" />';
                            }
                            echo '<div class="descricao-projeto">' . wp_kses_post($resumo_projeto) . '</div>';
                               
                        ?>
                        <div class="tipo-projeto">
                        <?php                               
                                $tipo_do_projeto = get_field('tipo_do_projeto');
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
                    </div>
                </article>

                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Nenhum post encontrado.</p>';
                endif;
                ?>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();