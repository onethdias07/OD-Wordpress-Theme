<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'textdomain' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search the site...', 'placeholder', 'textdomain' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'textdomain' ); ?></span>
    </button>
</form>
