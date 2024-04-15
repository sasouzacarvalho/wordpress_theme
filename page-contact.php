<?php
/*
Template Name: Contact
*/
get_header(); 

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="bar-top">
            <div class="bar-top-title">
                 <h1><?php wp_title('', true, 'right'); ?></h1>
            </div>            
        </div>
        <?php echo do_shortcode('[contact-form-7 id="93a3214" title="Formulário de contato"]'); ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();