<?php if ( have_posts() ) : ?>
    <div class="search-results-posts">
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="search-result-item" itemscope itemtype="https://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" class="post-link" aria-label="Read full article: <?php the_title(); ?>">
                    <header>
                        <h3 itemprop="headline"><?php the_title(); ?></h3>
                        <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
                    </header>
                    
                    <div class="search-excerpt" itemprop="description">
                        <?php echo get_the_excerpt(); ?>
                    </div>
                </a>
            </article>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="no-search-results">
        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'textdomain' ); ?></p>
        
        <div class="search-suggestions">
            <h3><?php esc_html_e( 'Search Suggestions:', 'textdomain' ); ?></h3>
            <ul>
                <li><?php esc_html_e( 'Check your spelling.', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'Try more general keywords.', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'Try different keywords.', 'textdomain' ); ?></li>
            </ul>
        </div>
        
        <?php get_search_form(); ?>
    </div>
<?php endif; ?>