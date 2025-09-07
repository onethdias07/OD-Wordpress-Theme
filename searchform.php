<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php wp_nonce_field('search_nonce', 'search_nonce_field'); ?>
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'od-theme' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search the site...', 'placeholder', 'od-theme' ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" maxlength="100" required />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'od-theme' ); ?></span>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/search.svg" alt="<?php echo esc_attr__('Search', 'od-theme'); ?>" class="search-icon" />
    </button>
</form>
