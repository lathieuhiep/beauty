
<?php if( is_active_sidebar( 'beauty-sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( beauty_col_sidebar() ); ?> site-sidebar">
        <?php dynamic_sidebar( 'beauty-sidebar-main' ); ?>
    </aside>

<?php endif; ?>