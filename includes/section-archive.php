<?php if ( have_posts() ) : ?>
    <div class="archive-posts">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="archive-post">
                <h3><?php the_title(); ?></h3>
                <div class="archive-excerpt"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>">Read More</a>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p><?php esc_html_e( 'No posts found.', 'textdomain' ); ?></p>
<?php endif; ?>