<?php get_header(); ?>

<div class="content-wrapper">
    <div class="content-area">
        <div class="single-page">
            <?php get_template_part( 'includes/section', 'blogcontent' ); ?>
        </div>

        <div class="post-pagination">
            <?php wp_link_pages(); ?>
        </div>
    </div>

    <div class="sidebar">
        <?php if (is_active_sidebar('blog-sidebar')): ?>
            <?php dynamic_sidebar('blog-sidebar'); ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>