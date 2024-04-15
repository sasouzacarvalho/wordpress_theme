<?php
// Archive Name: Projetos
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="archives-projects">
            <div class="projeto-filtro">
                <h2>Filtrar por tipo:</h2>
                <div class="container">
                    <div class="menu" style="float: left;">
                        <ul id="menu-categorias">
                            <?php
                            $tipo_do_projeto = get_terms(array(
                                'taxonomy' => 'category', 
                                'hide_empty' => false,
                            ));

                            if ($tipo_do_projeto && !is_wp_error($tipo_do_projeto)) {
                                foreach ($tipo_do_projeto as $termo) {
                                    echo '<li><a href="#" data-termo="' . $termo->slug . '">' . $termo->name . '</a></li>';
                                }
                            } else {
                                echo '<li>Nenhum projeto encontrado.</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>               
            </div>
            <div class="conteudo" style="float: right; width: 70%;" id="tipo-projeto">
                        <!-- O conteúdo relacionado será carregado aqui via Ajax -->
                    </div>
        </section>
    </main>
</div>

<script>
jQuery(document).ready(function($) {
    $('#menu-categorias a').on('click', function(e) {
        e.preventDefault();
        var termo = $(this).data('termo');
        var $conteudoRelacionado = $('#tipo-projeto');
        $conteudoRelacionado.addClass('loading');
        $conteudoRelacionado.load('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
            action: 'tipoProjetosFiltro',
            termo: termo
        }, function() {
            $conteudoRelacionado.removeClass('loading');
        });
    });
});
</script>
<?php get_footer(); ?>
