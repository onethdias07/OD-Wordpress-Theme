<?php if ( have_posts() ) : ?>
    <div class="archive-posts">
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="archive-post" itemscope itemtype="https://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" class="post-link" aria-label="Read full article: <?php the_title(); ?>">
                    <header>
                        <h2 itemprop="headline"><?php the_title(); ?></h2>
                        <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <?php the_post_thumbnail('medium', array('alt' => get_the_title(), 'itemprop' => 'url')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="archive-excerpt" itemprop="description"><?php the_excerpt(); ?></div>
                    
                    <div class="archive-meta">
                        <div class="post-meta">
                            <span class="post-date">
                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                            </span>
                            <span class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <span itemprop="name"><?php the_author(); ?></span>
                            </span>
                            <?php 
                            $categories = get_the_category();
                            if ($categories) : ?>
                                <span class="post-categories">
                                    <?php 
                                    $cats = array();
                                    foreach ($categories as $cat) {
                                        $cats[] = $cat->name;
                                    }
                                    echo implode(', ', $cats);
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <span class="read-more">Read More</span>
                    </div>
                </a>
            </article>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <p><?php esc_html_e( 'No posts found.', 'textdomain' ); ?></p>
<?php endif; ?>