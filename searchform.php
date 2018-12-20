<?php $cosmetics_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $cosmetics_unique_id; ?>">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'cosmetics' ); ?></span>
    </label>
    <input type="search" id="<?php echo $cosmetics_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Tìm kiếm &hellip;', 'placeholder', 'cosmetics' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <select class="search-select-post-type">
        <option value="product">
            <?php esc_html_e( 'Sản phẩm', 'cosmetics' ); ?>
        </option>
        <option value="post">
            <?php esc_html_e( 'Tin tức', 'cosmetics' ); ?>
        </option>
    </select>
    <input type="hidden" name="post_type" value="product">
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
    </button>
</form>