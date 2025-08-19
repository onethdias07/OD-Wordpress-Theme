<?php if (have_posts()) : ?>
    <div class="single-posts">
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post" itemscope itemtype="https://schema.org/BlogPosting">

                <?php 
                    $first_name = get_the_author_meta('first_name');
                    $last_name = get_the_author_meta('last_name');
                    $date = get_the_date();
                    $tags = get_the_tags();
                    $categories = get_the_category();
                ?>

                <header>
                    <h1 itemprop="headline"><?php the_title(); ?></h1>
                    <meta itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
                    <meta itemprop="dateModified" content="<?php echo get_the_modified_date('c'); ?>">
                </header>

                <div class="featured-image">
                    <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <?php endif; ?>
                </div>

                <div class="post-info">
                    <div class="post-meta">
                        <div class="author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <p>By: <span itemprop="name"><?php echo $first_name . ' ' . $last_name; ?></span></p>
                        </div>
                        
                        <div class="date">
                            <p>Published on: <time datetime="<?php echo get_the_date('c'); ?>"><?php echo $date; ?></time></p>
                        </div>
                        
                        <?php if ($categories) : ?>
                            <div class="categories" itemprop="about">
                                <p>Categories: 
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($tags) : ?>
                            <div class="tags" itemprop="keywords">
                                <p>Tags: 
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="single-content" itemprop="articleBody">
                    <?php the_content(); ?>
                </div>
                
                <div class="comments">
                    <?php comments_template(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
