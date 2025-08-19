<?php get_header(); ?>

<div class="search-page">
    <h1 class="page-title">
        <?php esc_html_e('Search Results for:', 'textdomain'); ?> 
        <span class="search-query"><?php echo get_search_query(); ?></span>
    </h1>
    
    <div class="search-count">
        <?php
        $found_posts = $wp_query->found_posts;
        if ($found_posts == 1) {
            echo '1 result found';
        } else {
            echo $found_posts . ' results found';
        }
        ?>
    </div>
    
    <?php get_template_part('includes/section', 'search'); ?>
    
    <?php if (have_posts()) : ?>
        <nav class="search-pagination">
            <?php 
            echo paginate_links(array(
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'mid_size' => 1,
            ));
            ?>
        </nav>
    <?php endif; ?>
</div>

<?php get_footer(); ?>