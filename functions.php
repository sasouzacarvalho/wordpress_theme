<?php
/**
 * Theme functions and definitions
 */
add_theme_support('title-tag');

function custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100, 
        'width'       => 400, 
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
    add_action('after_setup_theme', 'custom_logo_setup');

function theme_support_menus() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'text-domain'), 
    ));
}
add_action('after_setup_theme', 'theme_support_menus');

function register_footer_menu() {
    register_nav_menu('footer-menu', __('Menu do Rodapé', 'text-domain'));
}
add_action('init', 'register_footer_menu');

function register_redes_menu() {
    register_nav_menu('redes-menu', __('Menu do Redes Sociais', 'text-domain'));
}
add_action('init', 'register_redes_menu');

add_theme_support('post-thumbnails');

function registrar_widgets_admin() {
    register_sidebar( array(
        'name'          => __( 'Widgets', 'text_domain' ),
        'id'            => 'widgets_admin',
        'description'   => __( 'Widgets será exibido no painel de administração.', 'text_domain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'registrar_widgets_admin' );

//Post-Type Projects

function post_type_projetos() {
    $labels = array(
        'name'               => 'Projetos',
        'singular_name'      => 'Projeto',
        'menu_name'          => 'Projetos',
        'name_admin_bar'     => 'Projeto',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Projeto',
        'new_item'           => 'Novo Projeto',
        'edit_item'          => 'Editar Projeto',
        'view_item'          => 'Ver Projeto',
        'all_items'          => 'Todos os Projetos',
        'search_items'       => 'Buscar Projetos',
        'parent_item_colon'  => 'Projeto Pai:',
        'not_found'          => 'Nenhum projeto encontrado.',
        'not_found_in_trash' => 'Nenhum projeto encontrado na lixeira.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projetos'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','custom-fields'),
    );

    register_post_type('projeto', $args);
}

add_action('init', 'post_type_projetos');

add_image_size('custom-thumbnail', 150, 9999);

add_filter('show_admin_bar', '__return_false');

add_action('wp_ajax_tipoProjetosFiltro', 'tipoProjetosFiltro');
add_action('wp_ajax_nopriv_tipoProjetosFiltro', 'tipoProjetosFiltro');

function tipoProjetosFiltro() {
    $termo = sanitize_text_field($_POST['termo']);
    $args = array(
        'post_type' => 'projeto', 
        'tax_query' => array(
            array(
                'taxonomy' => 'category', 
                'field' => 'slug',
                'terms' => $termo,
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $imagem_projeto = get_field('imagem_do_projeto');
            $resumo_projeto = get_field('resumo_do_projeto');

            echo '<article>';
            echo '<h3 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            echo '<img src="' . esc_url($imagem_projeto['url']) . '" alt="' . esc_attr($imagem_projeto['alt']) . '" />';
            echo '<div class="descricao-projeto">' . wp_kses_post($resumo_projeto) . '</div>';
            echo '</article>';
            
        }
        wp_reset_postdata();
    } else {
        echo '<p>Nenhum projeto encontrado.</p>';
    }

    die();
}