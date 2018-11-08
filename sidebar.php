
<?php if( is_active_sidebar( 'cosmetics-sidebar-main' ) ): ?>

    <aside class="<?php echo esc_attr( cosmetics_col_sidebar() ); ?> site-sidebar">
        <?php dynamic_sidebar( 'cosmetics-sidebar-main' ); ?>
    </aside>

<?php endif; ?>