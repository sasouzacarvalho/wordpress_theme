<aside id="secondary" class="widget-area" role="complementary">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div id="sidebar" class="widget">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    <?php else : ?>
        <!-- Se não houver widgets na barra lateral, você pode adicionar um fallback aqui -->
    <?php endif; ?>
</aside><!-- #secondary -->
