<?php if (have_posts()) : ?>
    <div class="single-posts">
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post" itemscope itemtype="https://schema.org/BlogPosting">

                <?php 
                    $first_name = sanitize_text_field(get_the_author_meta('first_name'));
                    $last_name = sanitize_text_field(get_the_author_meta('last_name'));
                    $date = get_the_date();
                    $tags = get_the_tags();
                    $categories = get_the_category();
                ?>

                <header>
                    <h1 itemprop="headline"><?php echo esc_html(get_the_title()); ?></h1>
                    <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('c')); ?>">
                    <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('c')); ?>">
                </header>

                <div class="featured-image">
                    <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <?php endif; ?>
                </div>

                <div class="post-info">
                    <div class="post-meta">
                        <div class="author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <p><?php echo esc_html__('By:', 'od-theme'); ?> <span itemprop="name"><?php echo esc_html($first_name . ' ' . $last_name); ?></span></p>
                        </div>
                        
                        <div class="date">
                            <p><?php echo esc_html__('Published on:', 'od-theme'); ?> <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($date); ?></time></p>
                        </div>
                        
                        <?php if ($categories) : ?>
                            <div class="categories" itemprop="about">
                                <p><?php echo esc_html__('Categories:', 'od-theme'); ?> 
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($tags) : ?>
                            <div class="tags" itemprop="keywords">
                                <p><?php echo esc_html__('Tags:', 'od-theme'); ?> 
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="single-content" itemprop="articleBody">
                    <?php 
                    // Ensure content is properly filtered for security
                    $content = get_the_content();
                    $content = apply_filters('the_content', $content);
                    echo wp_kses_post($content);
                    ?>
                </div>
                
                <div class="comments">
                    <?php 
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
